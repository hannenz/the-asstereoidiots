<?php
class SongsController extends AppController {
	var $name = 'Songs';
	var $paginate = array(
		'order' => array('Song.title' => 'ASC'),
		'limit' => 10,
		'fields' => array('Song.id', 'Song.title', 'Song.artist', 'Song.length'),
		'contain' => array(
			'Track' => array(
				'fields' => array('Track.id', 'Track.length'),
			)
		)
	);
	var $components = array('RequestHandler');
	var $helpers = array('Uploader.UploaderForm');

	function beforeFilter(){
		parent::beforeFilter();
		$this->Song->recursive = -1;
		$this->set('current', '');
	}

	function index(){
		$this->set('songs', $this->paginate('Song'));
		$this->set('total', $this->Song->find('count'));
	}

	function view($id){
		$this->set('song', $this->Song->read(null, $id));
	}

	function admin_index(){
		$this->set('songs', $this->paginate('Song'));
		$this->set('total', $this->Song->find('count'));
	}

	function admin_add($ajax = null){
		if ($this->RequestHandler->isAjax() && !empty($_POST)){
			$this->layout = 'ajax';
			if ($this->Song->save(array('Song' => $_POST))){
				$song = $this->Song->read(null, $this->Song->id);
			}
			$this->set('song', $song);
			$this->render('/elements/songlist_song_item');
			return;
		}

		if (!empty($this->request->data)){

			if ($this->Song->save($this->request->data)){
				$this->Session->setFlash(__('Song has been saved'), 'flash_success');
				$this->redirect('/admin/songs/index');
			}
			else {
				$this->Session->setFlash(__('Song could not been saved'), 'flash_warning');
			}
		}
	}


	function admin_edit($id = null){
		if (!empty($this->request->data)){
			if ($this->Song->save($this->request->data)){
				$this->Session->setFlash(__('Song has been saved'), 'flash_success');
				$this->redirect('/admin/songs/index');
			}
			else {
				$this->Session->setFlash(__('Song could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->Song->recursive = 1;
			$this->request->data = $this->Song->read(null, $id);
		}
	}

	function admin_delete($id){
		if ($this->Song->delete($id)){
			$this->Session->setFlash(__('Song has been deleted'), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('Song could not been deleted'), 'flash_warning');
		}
		$this->redirect('/admin/songs/index');
	}

	function admin_search(){
		if (isset($_POST['query'])){
			$query = $_POST['query'];
		}
		else {
			$query = $this->request->data['Band']['query'];
		}

		$this->paginate = array(
			'limit' => 10,
			'order' => array('Song.title' => 'ASC'),
			'conditions' => array('Song.title LIKE' => "%$query%"),
			'contain' => array('Track')
		);
		$songs = $this->paginate('Song');
		$this->set('songs', $songs);
		$this->set('total', count($songs));
/*
		$this->set('find', true);
		$this->request->data['Band']['query'] = $query;
*/
		$this->render('admin_index');
	}

	function admin_view($id){
		$song = $this->Song->find('first', array(
			'conditions' => array('Song.id' => $id),
			'contain' => array(
				'Track'
			)
		));
		$this->set('song', $song);
	}
}
?>
