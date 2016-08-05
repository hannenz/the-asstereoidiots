<?php
class VideosController extends AppController {
	var $name = 'Videos';
	var $components = array('RequestHandler');
	var $helpers = array('Uploader.UploaderForm');

	function beforeFilter(){
		parent::beforeFilter();
	}

	function index(){
		$this->set('videos', $this->Video->find('all'));
	}

	function view($id){
		$this->set('video', $this->Video->read(null, $id));
	}

	function admin_index(){
		$this->set('videos', $this->Video->find('all'));
	}

	function admin_view($id){
		$item = $this->Video->read(null, $id);
		$this->set('item', $item['Video']);
		$this->render('/elements/admin_view');
	}

	function admin_add(){
		if (!empty($this->request->data)){

			switch ($this->request->data['Video']['type']){
				case 'youtube':
					if (empty($this->request->data['Video']['html'])){
						$this->Session->setFlash(__('Please enter the Youtube HTML Code to embedd the video'), 'flash_warning');
						return;
					}
					break;

				case 'upload':
					break;

				case 'register':
					if (!is_file(WWW_ROOT . 'files' . DS . $this->request->data['Video']['filename'])){
						$this->Session->setFlash(__('Registering video failed. Be sure to upload to /app/webroot/files and try again'), 'flash_warning');
						return;
					}
					break;
			}
			if ($this->Video->save($this->request->data)){
				$this->Session->setFlash(__('Video has been saved'), 'flash_success');
				$this->redirect('/admin/videos/index');
			}
			else {
				$this->Session->setFlash(__('Failed to save video'), 'flash_warning');
			}
		}
	}

	function admin_edit($id = null){
		if (!empty($this->request->data)){
			//~ $this->admin_upload_poster();
			switch ($this->request->data['Video']['type']){
				case 'upload':
//					$this->admin_upload_video();
					break;
				case 'youtube':
					break;
				case 'file':
					if (!is_file(WWW_ROOT . 'files' . $this->request->data['Video']['filename'])){
						$this->Session->setFlash(__('Registering video failed. Be sure to upload to /app/webroot/files and try again'), 'flash_warning');
						return;
					}
					break;
			}

			if ($this->Video->save($this->request->data)){
				$this->Session->setFlash(__('Video has been saved'), 'flash_success');
				$this->redirect('/admin/videos/index');
			}
			else {
				$this->Session->setFlash(__('Failed to save video'), 'flash_warning');
			}
		}
		else {
			$this->request->data = $this->Video->read(null, $id);
		}
	}

	function admin_delete($id){
		if ($this->Video->delete($id)){
			$this->Session->setFlash(__('Video has been deleted'), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('Video colud not been deleted'), 'flash_warning');
		}
		$this->redirect('/admin/videos/index');
	}

	function admin_reorder(){
		$videos = $_POST['videos'];

		foreach ($videos as $pos => $id){
			$this->Video->query('UPDATE videos SET pos='.$pos.' WHERE id='.$id.';');
		}
		$this->set('videos', $this->Video->find('all', array('order' => array('Video.pos' => 'ASC'))));
		$this->render('/elements/video_table');
	}
}
?>
