<?php
App::uses('Security', 'Utility');

class UsersController extends AppController {
	var $name = 'Users';
	var $components = array('RequestHandler', 'Auth');


	var $helpers = array('Uploader.UploaderForm', 'Number');

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('login');
	}

	function admin_login(){
		$this->login();
		$this->render('login');
	}

	function login(){
		//~ $json = array(
			//~ 'success' => false,
			//~ 'redirect' => $this->Auth->redirect()
		//~ );

		if ($this->request->is('post')){
			if ($this->Auth->login()){
				//~ $json['success'] = true;
				//~ if (!$this->request->is('ajax')){
					$this->redirect($this->Auth->redirect());
				//~ }
			}
			else {
				$this->Session->setFlash(__('Login failed'), 'flash_warning');
			}
			//~ if ($this->request->is('ajax')){
				//~ die(json_encode($json));
			//~ }
		}
	}

	function admin_logout(){
		$this->redirect($this->Auth->logout());
	}

	function admin_dashboard(){
	}

	function admin_settings(){
		if (empty($this->request->data)){
			$this->request->data = $this->User->read(null, $this->Session->read('Auth.User.id'));
		}
		else {
			if ($this->User->save($this->request->data)){
				$this->Session->setFlash(__('Settings have been saved'), 'flash_success');
				$this->redirect('/admin/users/dashboard');
			}
			else {
				$this->Session->setFlash(__('Settings could not been saved'), 'flash_warning');
			}
		}
	}

	function admin_change_password(){
		if (!empty($this->request->data)){
			if ($this->request->data['User']['pw1'] == $this->request->data['User']['pw2']){
				$this->request->data['User']['username'] = $this->Session->read('Auth.User.username');
				$this->request->data['User']['password'] = $this->request->data['User']['pw1'];
				unset($this->request->data['User']['pw1']);
				unset($this->request->data['User']['pw2']);

				$data = $this->Auth->hashPasswords($this->request->data);
				if ($this->User->save($data)){
					$this->Session->setFlash(__('Password has been saved'), 'flash_success');
					$this->redirect('/admin/users/dashboard');
				}
				else {
					$this->Session->setFlash(__('Password could not been changed'), 'flash_warning');
				}
			}
			else {
				$this->Session->setFlash(__('The passwords you have entered do not match'), 'flash_warning');
			}
		}
		$this->request->data = $this->User->read(null, $this->Session->read('Auth.User.id'));
		$this->render('admin_settings');
	}

	function admin_files($type = 'all', $user_id = null){

		$this->User->recursive = 1;
		$files = array();
		$title = __('Files');
		if ($type !== 'all'){
			$title .= ' ' . __('of type "%s"', $type);
		}


		if ($user_id == null){
			$users = $this->User->find('all');
			foreach ($users as $user){
				foreach ($user['UserFile'] as $file){
					$pattern = '/^'.$type.'(.*)$/';

					if ($type == 'all' || preg_match($pattern, $file['type'])){
						$file['User'] = $user['User'];
						$files[] = $file;
					}
				}
			}
		}
		else {
			$this->User->id = $user_id;
			if (!$this->User->exists()){
				throw new NotFoundException(__('No such user'));
			}
			$user = $this->User->read(null, $user_id);
			$files = $user['UserFile'];
			$title = $user['User']['name'] . "'s $title";
			foreach ($files as $n => $file){
				$files[$n]['User'] = $user['User'];
			}
		}

		$this->layout = 'filebrowser';
		$funcNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : -1;
		$this->set(compact(array('files', 'title', 'funcNum')));
	}

	public function admin_upload_files($funcNum){
		if ($this->request->is('put') || $this->request->is('post')){
			$this->User->save($this->request->data);
			$this->redirect('admin_files');
		}
		$this->User->recursive = 1;
		$this->request->data = $this->User->read(null, $this->Auth->user('id'));
		$this->layout = 'filebrowser';
		$this->set(compact(array('funcNum')));
	}

	// public function admin_send_testmail () {
	// 	if ($this->request->is('post')) {
	// 		$this->admin_send_email (
	// 			$this->request->data['subject'],
	// 			$this->request->data['message'],
	// 			$this->request->data['recipient'],
	// 			'default'
	// 		);
	// 	}
	// }

		function admin_add(){

			Configure::write('debug', 2);
			debug (Security::hash('EfieGa3d', 'sha1', Configure::read('Security.salt')));
			die();


			if (!empty($this->request->data)){
				Configure::write('debug', 2);

				if (empty($this->request->data['User']['password']) || ($this->request->data['User']['password'] != $this->request->data['User']['password2'])) {
					$this->Session->setFlash(__('Passwords do not match, please try again'), 'flash_warning');
				}
				else {
					$this->request->data['User']['password'] = Security::hash($this->request->data['User']['password']);
					if ($this->User->save($this->request->data)){
						$this->Session->setFlash(__('The User has been saved'), 'flash_success');
					}
					else {
						$this->Session->setFlash(__('Failed to save the user'), 'flash_warning');
					}
				}
			}
		}

		function admin_edit($id = null){
			$this->User->id = $id;
			if (empty($this->request->data)){
				$this->request->data = $this->User->read();
			}
			else {

				if ($this->User->save($data)){
					$this->Session->setFlash(__('The Link has been saved'), 'flash_success');
				}
				else {
					$this->Session->setFLash(__('Failed to save the link'), 'flash_warning');
				}
			}
		}
	}
?>
