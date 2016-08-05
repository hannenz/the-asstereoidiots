<?php
class MessagesController extends AppController {
	var $name = 'Messages';
	var $user_id = null;
	
	function beforeFilter(){
		$this->user_id = $this->Session->read('Auth.User.id');
		$this->Message->Recipient->recursive = 1;
		parent::beforeFilter();
	}
		
	
	function inbox(){
		$messages = $this->Message->Recipient->find('all', array(
			'conditions' => array(
				'Recipient.id' => $this->user_id
			),
			'contain' => array('Message' => array('Sender'))
		));

		$this->Message->recursive = -1;
		$trashed_messages = $this->Message->find('all', array(
			'joins' => array(
				array(
					'table' => 'messages_users',
					'alias' => 'MessagesUser',
					'type' => 'inner',
					'conditions' => array(
						'Message.id = MessagesUser.message_id'
					)
				),
				array(
					'table' => 'users',
					'alias' => 'User',
					'type' => 'inner',
					'conditions' => array(
						'MessagesUser.user_id = User.id'
					)
				)
			),
			'conditions' => array(
				'MessagesUser.trashed' => 1,
				'MessagesUser.user_id' => $this->user_id
			)
		));
		$this->Message->Recipient->recursive = -1;
		foreach ($trashed_messages as $key => $mssg){
			$sender = $this->Message->Recipient->find('first', array(
				'conditions' => array(
					'Recipient.id' => $mssg['Message']['sender']
				),
				'fields' => array('id', 'name')
			));
			$trashed_messages[$key]['Sender'] = $sender['Recipient'];
		}
/*
		debug ($trashed_messages); die();
*/

		$this->Message->recursive = 0;
		$my_messages = $this->Message->findAllBySender($this->user_id);
		$this->set('messages', $messages[0]['Message']);
		$this->set('unread', $this->Message->unread($this->user_id));
		$this->set('my_messages', $my_messages);
		$this->set('trashed_messages', $trashed_messages);
	}

	function view($id){
		$message = $this->Message->read(null, $id);
		$recipients = array();
		foreach ($message['Recipient'] as $key => $r){
			$recipients[] = $r['name'];
		}
		$this->set(array(
			'message' => $message,
			'recipients' => $recipients
		));

		$this->Message->mark($id, 1, $this->user_id);
	}

	function mark_unread($id){
		$this->Message->mark($id, 0, $this->user_id);
		$this->redirect('inbox');
	}

	function compose(){
		if (!empty($this->request->data)){
			$this->Message->set($this->request->data);
			if (isset($this->request->data['Recipient'])){
				if ($this->Message->validates()){
					$recs = $this->Message->Recipient->find('all', array(
						'conditions' => array('Recipient.id' => $this->request->data['Recipient']['Recipient']),
						'fields' => array('Recipient.id', 'Recipient.email', 'Recipient.notifyme'),
						'contain' => array()
					));
					$emails = array();
					foreach ($recs as $rec){
						if ($rec['Recipient']['notifyme'] == 1){
							$emails[] = $rec['Recipient']['email'];
						}
					}
					if (!empty($emails)){
						$sender = $this->Session->read('Auth.User.name');
						$this->admin_send_email("Neue private Nachricht", array('sender' => $sender, 'message' => $this->request->data), $emails, 'default', 'message_notification');
					}
					if ($this->Message->save($this->request->data)){
					//	$this->Session->setFlash(__('Message has been sent'), 'flash_success');
						$this->redirect('inbox');
					}
					else {
						$this->Session->setFlash(__('Message could not been sent. Check the form and try again'), 'flash_warning');
					}
				}
			}
			else {
				$this->Session->setFlash(__('Choose at least one recipient'), 'flash_warning');
			}
		}
		$this->set('recipients', $this->Message->Recipient->find('list', array('conditions' => array('Recipient.id !=' => $this->user_id))));
	}

	function reply($id = null){
		if (!empty($this->request->data)){
			$this->request->data['Message']['read'] = 0;
			if ($this->Message->save($this->request->data)){
				$this->Session->setFlash(__('Message has been sent'), 'flash_sucess');
				$this->redirect('inbox');
			}
			else {
				$this->Session->setFlash(__('Message could not been sent. Check the form and try again'), 'flash_warning');
			}
		}
		$original = $this->Message->read(null, $id);
		$this->request->data['Recipient']['Recipient'][0] = $original['Message']['sender'];
		$this->request->data['Message']['subject'] = '[RE]: ' . $original['Message']['subject'];
		$this->request->data['Message']['body'] = $original['Message']['body'];
		$this->set('recipients', $this->Message->Recipient->find('list', array('conditions' => array('Recipient.id !=' => $this->user_id))));
		$this->render('compose');
	}

	function delete($id){
/*
		$delete = true;
*/
		$message = $this->Message->read(null, $id);
		foreach ($message['Recipient'] as $recipient){
			if ($recipient['MessagesUser']['user_id'] == $this->user_id){
				$this->Message->query("UPDATE messages_users SET trashed=1 WHERE id={$recipient['MessagesUser']['id']};");
				break;
			}
/*
			else {
				if ($recipient['MessagesUser']['trashed'] == 0){
					$delete = false;
				}
			}
*/
		}

/*
		if ($delete){
			if ($this->Message->delete($id)){
				$this->Session->setFlash(__('Message has been deleted.'), 'flash_success');
			}
			else {
				$this->Session->setFlash(__('Message could not been deleted.'), 'flash_warning');
			}
		}
		else {
			$this->Session->setFlash(__('Message has been trashed'), 'flash_success');
		}
*/
		$this->redirect('inbox');
	}
}
?>
