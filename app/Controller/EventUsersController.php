<?php
class EventUsersController extends AppController {
	var $name = 'EventUsers';

	function admin_confirm($event_id, $status){
		$user_id = $this->Session->read('Auth.User.id');
		$event = $this->EventUser->Event->read(null, $event_id);

		$data = $this->EventUser->find('first', array(
			'conditions' => array(
				'AND' => array(
					'EventUser.event_id' => $event_id,
					'EventUser.user_id' => $user_id
				)
			)
		));

		if (empty($data)){
			$data = array(
				'Event' => array(
					'id' => $event_id
				),
				'User' => array(
					'id' => $user_id
				)
			);
		}
		
		$data['EventUser']['status'] = $status;

		if ($this->EventUser->saveAll($data)){
/*
			$this->Session->setFlash(__('Event has been confirmed'), 'flash_success');
*/

			$confirmed = false;
			
			if ($status == 1){
				$n_users = $this->EventUser->User->find('count');
				$n_accepted = $this->EventUser->find('count', array(
					'conditions' => array(
						'EventUser.event_id' => $event_id,
						'EventUser.status' => 1
					)
				));
				if ($n_users == $n_accepted){
					$confirmed = true;
				}
			}

			$this->admin_send_email(
				'Terminbenachrichtigung',
				array(
					'event' => $event,
					'username' => $this->Session->read('Auth.User.name'),
					'status' => ($status == 1) ? 'bestätigt' : 'abgelehnt',
					'confirmed' => $confirmed
				),
				$this->EventUser->User->find('list', array('fields' => array('email'))),
				'default',
				'event_notification'
			);
		}
		else {
			$this->Session->setFlash(__('Event could not been confirmed'), 'flash_warning');
		}
		$this->redirect('/admin/events/index');
	}
}
?>
