<?php
	class AlbumsController extends AppController {
		var $name = 'Albums';
		var $uses = array('Album', 'Show');
		var $helpers = array('Html', 'Form', 'Uploader.UploaderForm');

		function beforeFilter(){
			parent::beforeFilter();
			$this->Album->recursive = -1;
			$this->set('current', 'fotos');
		}

		function index(){
			$albums = $this->Album->find('all', array(
				'contain' => array(
					'Picture',
					'User' => array(
						'fields' => array('User.name')
					),
					'Show' => array(
						'Location',
						'Band'
					)
				)
			));
			$this->set('albums', $albums);
		}

		function view($id){
			$album = $this->Album->find('first', array(
				'conditions' => array(
					'Album.id' => $id
				),
				'contain' => array(
					'Picture',
					'User' => array(
						'fields' => array('User.name')
					),
					'Show' => array(
						'fields' => array('Show.id', 'Show.showtime'),
						'Location' => array(
							'fields' => array('Location.name', 'Location.city', 'Location.zip', 'Location.country')
						),
						'Band',
						'Bill'
					)
				)
			));
			$this->set('album', $album);
		}

		function admin_index(){
			$this->Album->recursive = 2;
			$this->paginate = array(
				'order' => array('Album.id' => 'ASC'),
				'limit' => 10
			);
			$this->set('albums', $this->paginate('Album'));
		}

		function admin_view($id){
			$album = $this->Album->read(null, $id);
			$this->set('item', $album['Album']);
			$this->render('/elements/admin_view');
		}


		function admin_add(){

			if ($this->request->is('post') || $this->request->is('put')){
				$this->Album->create();
				if ($this->Album->save($this->request->data)) {
					$this->Session->setFlash(__('Album has been saved'), 'flash_success');
					$this->redirect(array('action' => 'index', 'admin' => true));
				}
				else {
					$this->Session->setFlash(__('Album could not been saved'), 'flash_warning');
				}
			}
			$this->request->data = $this->Album->getPendingUploads();

			$sh = $this->Album->Show->find('all');
			$shows = array();
			foreach ($sh as $s){
				$shows[$s['Show']['id']] = strftime('%x', strtotime($s['Show']['showtime']))." {$s['Location']['full_name']}";
			}
			$this->set('shows', $shows);
		}

		function admin_edit($id = null){
			$this->Album->id = $id;
			if (!$this->Album->exists()) {
				throw new NotFoundException(__('Invalid album'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {

				if (isset($this->request->data['uploader_delete']) && !empty($this->request->data['uploadsToDelete'])){
					$n = $this->Album->deleteUploads($this->request->data['uploadsToDelete']);
					$this->Session->setFlash(__('%u pictures have been deleted', $n));
				}
				else {
					if ($this->Album->save($this->request->data)) {
						$this->Session->setFlash(__('The album has been saved'));

						// Check for upload errors
						if (empty($this->Album->uploadErrors)){
							// No errors, let's see if we want to redirect or re-render the edit view
							if (!$this->Album->wasUploading){
								$this->redirect(array('action' => 'index', 'admin' => true));
							}
						}
						else {
							// Upload errors occured, give a flash message and re-render the edit view
							$this->Session->setFlash(__('File upload failed'));
						}
					}
					else {
						$this->Session->setFlash(__('The album could not be saved. Please, try again.'));
					}
				}
			}
			$this->Album->recursive = 1;
			$this->request->data = $this->Album->read(null, $id);

			$sh = $this->Album->Show->find('all');
			$shows = array();
			foreach ($sh as $s){
				$shows[$s['Show']['id']] = strftime('%x', strtotime($s['Show']['showtime']))." {$s['Location']['full_name']}";
			}
			$this->set('shows', $shows);
		}

		function admin_delete($id){
			if ($this->Album->delete($id)){
				$this->Session->setFlash('Album has been deleted successfully', 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash('Failed to delete album', 'flash_warning');
			}
		}
	}
?>
