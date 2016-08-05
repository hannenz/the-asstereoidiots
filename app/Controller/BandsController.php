<?php
	class BandsController extends AppController {
		var $name = 'Bands';
		var $paginate = array(
			'limit' => 20,
			'order' => array('Band.name' => 'asc')
		);
		var $components = array('Auth');

		function admin_index(){
			$this->set('bands', $this->paginate('Band'));
		}

		function admin_view($id){
			$this->Band->recursive = -1;
			$band = $this->Band->find('first', array(
				'conditions' => array(
					'Band.id' => $id
				),
				'contain' => array(
					'Location',
					'User',
					'Show'
				)
			));
			foreach ($band['Show'] as $n => $show){
				$band['Show'][$n] = $this->Band->Show->read(null, $show['id']);
			}
			$this->set('band', $band);
		}

		function admin_add(){
			if (!empty($this->request->data)){
				if ($this->Band->save($this->request->data)){
					$this->Session->setFlash('The band \''.$this->request->data['Band']['name'].'\' has been added', 'flash_success');
					$this->redirect('/admin/bands/index');
				}
				else {
					$this->Session->setFlash('Failed to add the band '.$this->request->data['Band']['name'], 'flash_warning');
				}
			}
		}

		function admin_edit($id = null){
			$this->Band->id = $id;
			if (empty($this->request->data)){
				$this->request->data = $this->Band->read();
			}
			else{
				if ($this->Band->save($this->request->data)){
					$this->Session->setFlash('The band \''.$this->request->data['Band']['name'].'\' has been saved', 'flash_success');
					$this->redirect('/admin/bands/index');
				}
				else {
					$this->Session->setFlash('Failed to save the band \''.$this->request->data['Band']['name'].'\'', 'flash_warning');
				}
			}
		}

		function admin_delete($id){
			$this->Band->id = $id;
			$band = $this->Band->read();
			if ($this->Band->delete($id)){
				$this->Session->setFlash('The band \''.$band['Band']['name'].'\' has been successfully deleted', 'flash_success');
				$this->redirect('/admin/bands/index');
			}
			else {
				$this->Session->setFlash('Failed to delete the band \''.$band['Band']['name']);
			}
		}

		function search(){
			$this->layout = 'ajax';
			$query = $_POST['query'];
			$show_id = $_POST['show_id'];

			$this->set('query', $query);
			$this->set('debug', $this->request->data);
			$this->set('show_id', $show_id);
			if (strlen($query) > 0){
				$this->set('result', $this->Band->find('all', array('conditions' => array('Band.name LIKE' => "%$query%"))));
				$this->set('query', $query);
			}
			else{
				exit();
			}
		}

		function admin_find(){
			if (isset($_POST['query'])){
				$query = $_POST['query'];
			}
			else {
				$query = $this->request->data['Band']['query'];
			}

			$this->paginate = array(
				'limit' => 10,
				'order' => array('Band.name' => 'ASC'),
				'conditions' => array('Band.name LIKE' => "%$query%")
			);
			$this->set('bands', $this->paginate('Band'));
			$this->set('find', true);
			$this->request->data['Band']['query'] = $query;
			$this->render('admin_index');
		}

		function admin_addonthefly($query){
			$this->layout = 'ajax';
			$band = $this->Band->create();
			$band['Band']['name'] = $query;
			$this->Band->save($band);
			$this->set('band', $this->Band->read(null, $this->Band->id));
		}
	}
?>
