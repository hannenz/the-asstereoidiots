<?php
class SubscribersController extends AppController {
	var $name = 'Subscribers';
	var $paginate = array(
		'order' => array('Subscriber.created' => 'DESC'),
		'limit' => 10
	);

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('subscribe', 'unsubscribe');
	}
	
	function admin_index(){
		$this->set('subscribers', $this->paginate('Subscriber'));
	}

	function admin_view($id){
		$item = $this->Subscriber->read(null, $id);
		$this->set('item', $item['Subscriber']);
		$this->render('/elements/admin_view');
	}

	function subscribe(){
		if (!empty($this->request->data)){
			if ($this->Subscriber->save($this->request->data)){
				$this->Session->setFlash('thanks for subscribing: '.$this->request->data['Subscriber']['email'], 'flash_success');
				$this->redirect('/');

				$body = "Willkommen beim Asstereoidiots Newsletter. Schön, dass du dich angemeldet hast. Du erhälst diese Email, weil du dich auf http://www.the-asstereoidiots.de mit dieser Email-Adresse zum Newsletter angemeldet hast. Wenn dies ein Irrtumist oder sich jemand deiner Email Adfresse bemächtigt hat und du keinen Newsletter von uns erhalten willst, gehe auf http://www.the-asstereoidiots.de/subscribers/unsubscribe, um dich abzumelden. Wir werden dich dann nicht weiter belästigen.";
				$this->sendNewsletter($body);
			}
			else {
				$this->Session->setFlash('Subscribing failed', 'flash_warning');
			}
		}
	}

	function admin_delete($id){
		$s = $this->Subscriber->findById($id);
		if ($this->Subscriber->delete($id)){
			$this->Session->setFlash($s['Subscriber']['email'].' has been deleted', 'flash_success');
			$this->redirect('/');
		}
		else {
			$this->Session->setFlash('Failed to delete '.$s['Subscriber']['email'], 'flash_warning');
		}
	}

	function unsubscribe($email = null){
		if (!empty($this->request->data)){
			$email = $this->request->data['Subscriber']['email'];
		}
		if (!empty($email)){
			$s = $this->Subscriber->findByEmail($email);
			if (isset($s)){
				if ($this->Subscriber->delete($s['Subscriber']['id'])){
					$this->Session->setFlash($s['Subscriber']['email'].' unsubscribed successfully', 'flash_success');
				} 
				else {
					$this->Session->setFlash('Unsubscribing \'' . $email . '\' failed', 'flash_warning');
				}
			}
			$this->redirect('/');
		}
	}

	function admin_compose(){
		if (!empty($this->request->data)){
			$this->admin_send_newsletter($this->request->data['Subscriber']['subject'], $this->request->data['Subscriber']['body'], $this->Subscriber->find('list', array('fields' => array('email'))));
			$this->redirect('/admin/users/dashboard');
		}
	}
}
?>
