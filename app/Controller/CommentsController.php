<?php
class CommentsController extends AppController {
	var $name = 'Comments';
	var $paginate = array(
		'order' => array('Comment.created' => 'DESC'),
		'limit' => 5
	);
/*
	var $components = array('Email');
*/


	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add');
	}

	function index($model = null, $limit = null){
		if ($model == null){
			$model = 'None';
		}
		if ($limit == null){
			$limit = 999;
		}
		$this->paginate = array(
			'conditions' => array('Comment.model' => $model, 'approved' => true),
			'limit' => $limit,
			'order' => array('Comment.created' => 'DESC'),
		);
		$comments = $this->paginate('Comment');

		$c = array();
		foreach ($comments as $comment){
			$c[] = $comment['Comment'];
		}
		$this->set('comments', $c);
	}

	function admin_index(){
		$this->set('comments', $this->paginate('Comment'));
	}

		function admin_view($id){
			$item = $this->Comment->read(null, $id);
			$this->set('item', $item['Comment']);
			$this->render('/elements/admin_view');
		}


	function view($id){
		$comment = $this->Comment->find('first', array('conditions' => array('Comment.id' => $id, 'Comment.approved' => 1)));
		$this->set('comment', $comment);
	}

	function add(){
		Configure::load('Recaptcha.key');
		if (!empty($this->request->data)){
			$settings = Configure::read('settings');
			$this->request->data['Comment']['approved'] = $settings['Setting']['auto_approve_comments'];

			if ($this->Comment->save($this->request->data)){
				$this->Session->setFlash(
					$settings['Setting']['auto_approve_comments']
						? __('Your comment has been saved. Thanks for commenting')
						: __('Thanks for commenting. Your comment has been saved and will be published after we have approved it.')
				, 'flash_success'
				);

				$this->admin_send_email(
					'Neuer Kommentar ',
					$this->Comment->read(null, $this->Comment->id),
					array($settings['Setting']['notification_email']),
					'default',
					'notification'
				);
				$this->redirect($this->referer());
			}
			else {
				$this->Session->setFlash(__('Your comment could not been saved. Please check the form and try again'), 'flash_warning');
				$this->redirect($this->referer());
			}
		}
	}

	function admin_edit($id = null){
		if (!empty($this->request->data)){
			if ($this->Comment->save($this->request->data)){
				$this->Session->setFlash(__('Comment has been saved.'), 'flash_success');
				$this->redirect('/admin/comments/index');
			}
			else {
				$this->Session->setFlash(__('Comment could not been saved. Please check the form and try again'). 'flash_warning');
			}
		}
		else {
			$this->request->data = $this->Comment->read(null, $id);
		}
	}

	function admin_toggle_approved($id){
		$comment = $this->Comment->read(null, $id);
		if ($comment['Comment']['approved'] != 0){
			$comment['Comment']['approved'] = 0;
		}
		else {
			$comment['Comment']['approved'] = 1;
		}
		$this->Comment->save($comment);
		$this->redirect($this->referer());
	}

	function admin_delete($id){
		if ($this->Comment->delete($id)){
			$this->Session->setFlash(__('Comment has been deleted'), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('Failed to delete comment'), 'flash_warning');
		}
		$this->redirect('/admin/comments/index');
	}
}
?>
