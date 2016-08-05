<?php
class TracksController extends AppController {
	var $name = 'Tracks';
	//~ var $paginate = array(
		//~ 'order' => array('Track.id' => 'ASC'),
		//~ 'limit' => 10
	//~ );
	var $helpers = array('Uploader.UploaderForm');

	function beforeFilter(){
		parent::beforeFilter();
	}

	function index(){
		$tracks = $this->Track->find('all');
		$this->set('tracks', $tracks);
	}

	function admin_index(){
		$this->Track->recursive = 1;
		$tracks = $this->paginate('Track');
		// Configure::write('debug', 1);
		// debug ($tracks);
		// die();
		$this->set(compact(array('tracks')));
	}

	function admin_add($song_id = null){
		if (!empty($this->request->data)){
			if ($this->request->data['Track']['song_id'] == 0 && !empty($this->request->data['Track']['newsong'])){
				$this->Track->Song->create();
				if ($this->Track->Song->save(array('Song' => array('title' => $this->request->data['Track']['newsong'], 'length' => 0, 'artist' => 'The Asstereoidiots')))){
					$this->request->data['Track']['song_id'] = $this->Track->Song->id;
				}
				else {
					$this->Session->setFlash(__('Creating new song failed'), 'flash_warning');
				}
			}
			if ($this->Track->save($this->request->data)){
				$this->Session->setFlash(__('Track has been saved'), 'flash_success');
				$this->redirect('/admin/tracks/index');
			}
			else {
				$this->Session->setFlash(__('Track could not been saved'), 'flash_warning');
			}
		}
		$this->set('songs', $this->Track->Song->find('list'));
		$this->set('song_id', $song_id);
	}

	function admin_edit($id = null){
		if (!empty($this->request->data)){
			if ($this->Track->save($this->request->data)){
				$this->Session->setFlash(__('Track has been saved'), 'flash_success');
				$this->redirect('/admin/tracks/index');
			}
			else {
				$this->Session->setFlash(__('Track could not been saved. Please check the form and try again'), 'flash_warning');
			}
		}
		else {
			$this->Track->recursive = 1;
			$this->request->data = $this->Track->read(null, $id);
			$songs = $this->Track->Song->find('list');
			$this->set('songs', $songs);
			$this->set('song_id', $this->request->data['Song']['id']);
		}
	}

	function admin_delete($id){
		$track = $this->Track->read(null, $id);
		if ($this->Track->delete($id)){
			$this->Session->setFlash(__('Track has been deleted'), 'flash_success');
		}
		else {
			$this->Session->setFlash(__('Failed to delete track'), 'flash_warning');
		}
		$this->redirect($this->referer());
	}

		public function migrate(){
			$tracks = $this->Track->find('all', array(
			));
			App::uses('File', 'Utility');

			foreach ($tracks as $track){
				foreach ($track['Audiofile'] as $audiofile){
					$f = new File(WWW_ROOT . 'files' . DS . 'Audiofiles' . DS . $audiofile['name']);
					if (($size = $f->size()) !== false){
						$query = sprintf("UPDATE `uploads` SET `size`=%u WHERE `id`=%u", $size, $audiofile['id']);
						$this->Track->query($query);
						debug ($query);
					}
				}
			}
			die();
		}


}
?>
