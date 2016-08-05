<?php
class SetlistsController extends AppController {
	var $name = 'Setlists';
	var $paginate = array(
		'order' => array('Setlist.created' => 'DESC'),
		'limit' => 10,
	);

	function beforeFilter(){
		parent::beforeFilter();
		$this->Setlist->recursive = 2;
		$this->Auth->allow('json');
	}

	function view($id){
		$this->set('setlist', $this->Setlist->read(null, $id));
		$this->render('/elements/setlist');
	}

	function admin_index(){
		$this->Setlist->recursive = 2;
		$setlists = $this->paginate('Setlist');

		$setlists = $this->Setlist->find('all');
		$this->set('setlists', $setlists);
	}

	function admin_view($id){
		$item = $this->Setlist->read(null, $id);
		$this->set('item', $item['Setlist']);
		$this->render('/elements/admin_view');
	}

	function admin_print($id){
		$item = $this->Setlist->find('first', array(
			'conditions' => array('Setlist.id' => $id),
			'contain' => array(
				'Songlist'
			)
		));
		$item = $this->Setlist->read(null, $id);
		$this->set('setlist', $item['Songlist']);
		$this->layout = 'setlist_print';
		$this->render('/Elements/setlist');
	}

	function admin_add(){
		if (!empty($this->request->data)){
			if ($this->Setlist->save($this->request->data)){
				$this->Session->setFlash(__('Setlist has been saved'), 'flash_success');
				$this->redirect('/admin/setlists/edit/' . $this->Setlist->id);
			}
			else {
				$this->Session->setFlash(__('Setlist could not been saved'), 'flash_warning');
			}
		}
	}

	function admin_edit($id){
		if (!empty($this->request->data)){
			if ($this->Setlist->save($this->request->data)){
				$this->Session->setFlash(__('Setlist has been saved'), 'flash_success');
				$this->redirect('/admin/setlists/index');
			}
			else {
				$this->Session->setFlash(__('Setlist could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->request->data = $this->Setlist->read(null, $id);
		}
	}

	function admin_delete($id){
		if ($this->Setlist->delete($id)){
			$this->Session->setFlash(__('Setlist has been deleted'), 'flash_success');
		}
		else{
			$this->Session->setFlash(__('Setlist could notbeen deleted'), 'flash_warning');
		}
		$this->redirect('/admin/setlists/index');
	}


	function json($id = null) {

		foreach ($this->upcoming_shows as $upcoming_show) {
			if (!empty($upcoming_show['Setlist']['id'])) {
				$id = $upcoming_show['Setlist']['id'];
				break;
			}
		}

		$conditions = array(
			'Setlist.id' => $id,
			//'public' => true
		);
		$this->Setlist->recursive = -1;
		$setlist = $this->Setlist->find('first', array(
			'conditions' => $conditions,
			'contain' => array('Songlist' => array('Song'))
		));
		echo (json_encode($setlist, JSON_PRETTY_PRINT));
		die();
	}
}
?>
