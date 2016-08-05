<?php
class SettingsController extends AppController {
	var $name = 'Settings';

	function admin_edit($id){
		if (!empty($this->request->data)){
			if ($this->Setting->save($this->request->data)){
				$this->Session->setFlash(__('Settings have been saved'), 'flash_success');
				$this->redirect('/admin/users/dashboard');
			}
			else {
				$this->Session->setFlash(__('Settings could not been saved'), 'flash_warning');
			}
		}
		else {
			$this->request->data = $this->Setting->read(null, $id);
		}
	}
}
?>
