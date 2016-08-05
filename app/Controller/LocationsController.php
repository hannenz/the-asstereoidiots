<?php
	class LocationsController extends AppController {
		var $name = 'Locations';
		var $paginate = array(
			'limit' => 15,
			'order' => array('Location.name' => 'asc')
		);
		var $components = array('Auth');

		function admin_index(){
			$this->set('locations', $this->paginate('Location'));
		}

		function admin_view($id){
			$this->Location->recursive = -1;
			$location = $this->Location->find('first', array(
				'conditions' => array(
					'Location.id' => $id
				),
				'contain' => array(
					'Show',
					'User'
				)
			));
			foreach ($location['Show'] as $n => $show){
				$location['Show'][$n] = $this->Location->Show->read(null, $show['id']);
			}
			$this->set('location', $location);
		}

		function admin_add(){
			if (!empty($this->request->data)){
				if ($this->Location->save($this->request->data)){
					$this->Session->setFlash('Location has been saved', 'flash_success');
					$this->redirect($this->request->data['Location']['redirect']);
				}
				else{
					$this->Session->setFlash('Failed to save location', 'flash_warning');
				}
			}
		}

		function admin_edit($id = null){
			$this->Location->id = $id;
			if (empty($this->request->data)){
				$this->request->data = $this->Location->read();
			}
			else{
				if ($this->Location->save($this->request->data)){
					$this->Session->setFlash('Location has been saved', 'flash_success');
					$this->redirect('/admin/locations/index');
				}
				else{
					$this->Session->setFlash('Failed to save location', 'flash_warning');
				}
			}
		}

		function admin_delete($id){
			if ($this->Location->delete($id)){
				$this->Session->setFlash("Location #$id has been successfully deleted");
				$this->redirect('/admin/locations/index');
			}
			else {
				$this->Session->setFlash('Failed to delete location', 'flash_warning');
			}
		}


		function acomplete(){
			$query = $this->request->data['Location']['name'];
			$conditions = array(
				"OR" => array(
					'Location.name LIKE' => "%$query%",
					'Location.city LIKE' => "%$query%"
				)
			);
			$this->set('locations', $this->Location->find('all',
				array('conditions' => $conditions,
				'fields' => array('name', 'city')
			)));
			$this->layout = 'ajax';
		}

		function search(){
			$this->layout = 'ajax';
			$query = $_POST['query'];
			$show_id = $_POST['show_id'];

			if (strlen($query) > 0){
				$conditions = array(
					"OR" => array(
						'Location.name LIKE' => "%$query%",
						'Location.city LIKE' => "%$query%"
					)
				);
				$result = $this->Location->find('all', array('conditions' => $conditions));
				$this->set('result', $result);
				$this->set('query', $query);
				$this->set('show_id', $show_id);
			}
			else{
				exit();
			}
		}

		function admin_find($query = null) {
			$query = isset($_POST['query']) ? $_POST['query'] : $this->request->data['Location']['query'];

			$conditions = array(
				"OR" => array(
					'Location.name LIKE' => "%$query%",
					'Location.city LIKE' => "%$query%"
				)
			);
			$this->paginate = array(
				'conditions' => $conditions,
				'order' => array('Location.name' => 'ASC'),
				'limit' => 100
			);
			$this->set('locations', $this->Paginate('Location'));
			$this->render('admin_index');
		}

		function admin_addonthefly($location){
			$this->layout = 'ajax';
			$loc = $this->Location->create();
			$arr = explode(" ", $location);
			$loc['Location']['city'] = (count($arr) > 1) ? array_pop($arr) : "";
			$loc['Location']['name'] = implode(" ", $arr);
			$loc['Location']['user_id'] = $this->Session->read('Auth.User.id');
			$this->Location->save($loc);
			$this->set('location', $this->Location->read(null, $this->Location->id));
		}

		function update_lat_lng() {
			$locations = $this->Location->find('all');
			$this->Location->saveAll($locations);
			die ('Done.');
			// foreach ($locations as $location) {
			// 	$this->Location->save($location);
			// }
		}

		function admin_map () {
			// $locations = $this->Location->find('all');
			// $this->set(compact('locations'));
		}

		function get_all() {
			$locations = $this->Location->find('all', array(
				'contain' => 'Show'));
			die (json_encode($locations));
		}
	}
?>
