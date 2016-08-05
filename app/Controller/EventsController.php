<?php
class EventsController extends AppController {
	var $name = 'Events';

	var $paginate = array(
		'order' => array('Event.start' => 'DESC'),
		'limit' => 25
	);

	function beforeFilter(){
		parent::beforeFilter();
	}

	function admin_index(){
		$this->Event->recursive = -1;

		$this->paginate = array(
			'order' => array('Event.start ASC'),
			'limit' => 10,
			'conditions' => array('Event.start > ' => strftime('%Y-%m-%d 00:00:00')),
			'contain' => array(
				'EventType',
				'EventUser' => array(
					'User' => array(
						'Portrait'
					)
				)
			)
		);

		$futureEvents = $this->Paginate('Event');
		//~ debug ($futureEvents); die();
		$this->set(compact(array('futureEvents')));
	}

	function admin_feed(){
		$this->Event->recursive = 2;
		$this->layout = 'json';
		$vars = $_GET;
		$conditions = array(
			'conditions' => array(
				'UNIX_TIMESTAMP(start) >=' => $vars['start'],
				'UNIX_TIMESTAMP(start) <=' => $vars['end']
			)
		);
		$events = $this->Event->find('all', $conditions);
		foreach($events as $event) {
			if($event['Event']['all_day'] == 1) {
				$allday = true;
				$end = $event['Event']['start'];
			} else {
				$allday = false;
				$end = $event['Event']['end'];
			}
			$data[] = array(
					'id' => $event['Event']['id'],
					'title'=>$event['Event']['title'],
					'start'=>$event['Event']['start'],
					'end' => $end,
					'allDay' => $allday,
					'url' => '/admin/events/view/'.$event['Event']['id'],
					'details' => $event['Event']['details'],
					'className' => $event['EventType']['color'] . ' ' . $event['Event']['status']
			);
		}
		$this->set("json", json_encode($data));
	}

	function admin_view($id){
		$this->Event->recursive = 2;
		$event = $this->Event->read(null, $id);
		$parts = array();
		$self = 0;
		foreach ($event['EventUser'] as $eu){
			$parts[] = array('username' => $eu['User']['name'], 'class' => (($eu['status'] == 1) ? 'accepted' : 'declined'));
			if ($eu['User']['id'] == $this->Session->read('Auth.User.id')){
				$self = $eu['status'];
			}
		}
		$this->set('self', $self);
		$this->set('parts', $parts);
		$this->set('event', $this->Event->read(null, $id));
	}

	function admin_add($date = null){
		if (!empty($this->request->data)){
			$this->request->data['EventUser'][0]['user_id'] = $this->Session->read('Auth.User.id');
			$this->request->data['EventUser'][0]['status'] = 1;
			if ($this->Event->saveAll($this->request->data)){
				$event = $this->Event->read(null, $this->Event->id);

				$this->Session->setFlash(__('Event has been saved'), 'flash_success');

				$this->admin_send_email(
					'Terminanfrage',
					array(
						'event' => $this->Event->read(null, $this->Event->id),
						'username' => $this->Session->read('Auth.User.name'),
						'status' => 'vorgeschlagen',
						'confirmed' => false
					),
					$this->Event->EventUser->User->find('list', array('fields' => array('email'))),
					'default',
					'event_notification'
				);

				$this->redirect('index');
			}
			else {
				$this->Session->setFlash(__('Event could not been saved'), 'flash_warning');
			}
		}
		if ($date == null){
			$date = time();
		}
		$eventTypes = $this->Event->EventType->find('list');
		$this->set('eventTypes', $eventTypes);
		$this->set('date', strftime('%Y-%m-%d', $date));
	}

	function admin_edit($id = null){
		if (empty($this->request->data)){
			$this->request->data = $this->Event->read(null, $id);
		}
		else {
			$flag = false;
			$this->request->data['Event']['start'] = substr($this->request->data['Event']['start'], 0, 11) . $this->request->data['Event']['time'];
			$old = $this->Event->findById($this->request->data['Event']['id']);
			if ($old['Event']['user_id'] != $this->Session->read('Auth.User.id')){
				$this->Session->setFlash(__('You cannot edit an event that you haven\'t created'), 'flash_warning');
				$this->redirect('index');
			}
			if (substr($this->request->data['Event']['start'], 0, 16) != substr($old['Event']['start'], 0, 16)){
				foreach ($old['EventUser'] as $eu){
					$this->Event->EventUser->delete($eu['id']);
				}
				$this->request->data['EventUser'] = array();
				$this->request->data['EventUser'][0]['user_id'] = $this->Session->read('Auth.User.id');
				$this->request->data['EventUser'][0]['status'] = 1;
				$flag = true;
			}
			if ($this->Event->saveAll($this->request->data)){
				$this->Session->setFlash(__('Event has been saved'), 'flash_success');
				if ($flag){
					$this->admin_send_email(
						'Terminänderung',
						array(
							'event' => $this->Event->read(null, $this->Event->id),
							'old' => $old,
							'username' => $this->Session->read('Auth.User.name'),
							'status' => 'geändert',
							'confirmed' => false
						),
						$this->Event->EventUser->User->find('list', array('fields' => array('email'))),
						'default',
						'event_changed_notification'
					);
				}
				$this->redirect('index');
			}
			else {
				$this->Session->setFlash(__('Event could not been saved'), 'flash_warning');
			}
		}
		$this->set('eventTypes', $this->Event->EventType->find('list'));
	}

	function admin_push($id){
		$event = $this->Event->findById($id);
		$users = $this->Event->EventUser->User->find('list', array('fields' => array('email')));
		foreach ($event['EventUser'] as $eu){
			unset($users[$eu['user_id']]);
		}
		$this->admin_send_email(
			'Termin Erinnerung',
			array(
				'event' => $event,
				'username' => $this->Session->read('Auth.User.name'),
				'status' => 'erinnert',
				'confirmed' => false
			),
			$users,
			'default',
			'event_notification'
		);
		$this->redirect('index');
	}

	function admin_delete($id){
		$event = $this->Event->read(null, $id);
		if ($event['Event']['user_id'] == $this->Session->read('Auth.User.id')){
			if ($this->Event->delete($id)){
				$this->Session->setFlash(__('Event has been deleted'), 'flash_success');
				$this->admin_send_email(
					'Termin gelöscht',
					array(
						'event' => $event,
						'username' => $this->Session->read('Auth.User.name'),
						'status' => 'gelöscht',
						'confirmed' => false
					),
					$this->Event->EventUser->User->find('list', array('fields' => array('email'))),
					'default',
					'event_notification'
				);
			}
			else {
				$this->Session->setFlash(__('Event could not been deleted'), 'flash_warning');
			}
		}
		else {
			$this->Session->setFlash(__('You cannot delete a event that you have not created'), 'flash_warning');
		}
		$this->redirect('index');
	}

}
?>
