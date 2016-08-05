<?php
class ReleasesController extends AppController {
	var $name = 'Releases';
	//~ var $components = array('Image');
	var $helpers = array('Form', 'Html', 'Session', 'Paginator', 'Uploader.UploaderForm');

	function beforeFilter(){
		parent::beforeFilter();
		$this->Release->recursive = 2;
		$this->set('current', 'music');
	}

	function index(){
		$this->set('releases', $this->Release->find('all'));

		$this->Release->Tracklist->recursive = 2;
		$playlist = $this->Release->Tracklist->find('all', array(
			'conditions' => array(
				'model' => 'Playlist',
				'foreign_key' => 1
			)
		));
		$this->set('playlist', $playlist);
	}

	function view($id){
		$this->Release->recursive = 1;
		$this->set('release', $this->Release->read(null, $id));

		$this->Release->Tracklist->recursive = 2;
		$tracklist = $this->Release->Tracklist->find('all', array(
			'conditions' => array(
				'model' => 'Release',
				'foreign_key' => $id
			)
		));
/*
		debug ($tracklist); die();
*/
		$this->set('tracklist', $tracklist);
	}

	function admin_index(){
		$this->Release->recursive = 1;
		$this->paginate = array(
			'order' => array('Release.year' => 'DESC'),
			'limit' => 10
		);
		$releases = $this->paginate('Release');
		$this->set('releases', $releases);
	}

	function admin_view($id){
		$item = $this->Release->read(null, $id);
		$this->set('item', $item['Release']);
		$this->render('/elements/admin_view');
	}


	function admin_add(){
		if (!empty($this->request->data)){
			if ($this->Release->save($this->request->data)){
				$this->Session->setFlash(__('Release has been saved'), 'flash_success');
				$this->redirect('/admin/releases/index');
			}
			else {
				$this->Session->setFlash(__('Release could not been saved'), 'flash_warning');
			}
		}
	}

	function admin_edit($id = null){
		if (!empty($this->request->data)){
			if ($this->Release->save($this->request->data)){
				$this->Session->setFlash(__('Release has been saved'), 'flash_success');
				$this->redirect('/admin/releases/index');
			}
			else {
				$this->Session->setFlash(__('Release could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->request->data = $this->Release->read(null, $id);
			$this->Release->Tracklist->recursive = 2;
			$tracklist = $this->Release->Tracklist->find('all', array(
				'conditions' => array(
					'Tracklist.model' => 'Release',
					'Tracklist.foreign_key' => $id
				)
			));
			$this->set('tracklist', $tracklist);
		}
	}

	function admin_delete($id){
		if ($this->Release->delete($id)){
			$this->Session->setFlash(__('Release has been deleted'), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('Release could not been deleted'), 'flash_warning');
		}
		$this->redirect('/admin/releases/index');
	}
}
?>
