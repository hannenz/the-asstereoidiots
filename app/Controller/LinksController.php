<?php
	class LinksController extends AppController {
		var $name = 'Links';
		var $paginate = array(
			'order' => array('Link.name' => 'ASC'),
			'limit' => 10
		);


		function index(){
			$this->set('links', $this->Link->find('all'));
		}

		function admin_index(){
			$this->set('links', $this->paginate('Link'));
		}

		function admin_view($id){
			$item = $this->Link->read(null, $id);
			$this->set('item', $item['Link']);
			$this->render('/elements/admin_view');
		}


		function admin_add(){
			if (!empty($this->request->data)){
				if ($this->Link->save($this->request->data)){
					$this->Session->setFlash(__('The Link has been saved'), 'flash_success');
					$this->redirect('index');
				}
				else {
					$this->Session->setFlash(__('Failed to save the link'), 'flash_warning');
				}
			}
		}

		function admin_edit($id = null){
			$this->Link->id = $id;
			if (empty($this->request->data)){
				$this->request->data = $this->Link->read();
			}
			else{
				if ($this->Link->save($this->request->data)){
					$this->Session->setFlash(__('The Link has been saved'), 'flash_success');
					$this->redirect('index');
				}
				else {
					$this->Session->setFLash(__('Failed to save the link'), 'flash_warning');
				}
			}
		}

		function admin_delete($id){
			if ($this->Link->delete($id)){
				$this->Session->setFlash(__('The Link has been deleted'), 'flash_success');
			}
			else {
				$this->Session->setFlash(__('Failed to delete the link'), 'flash_warning');
			}
			$this->redirect('index');
		}
	}
?>
