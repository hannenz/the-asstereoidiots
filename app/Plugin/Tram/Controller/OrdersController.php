<?php
class OrdersController extends TramAppController  {

	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Text');
	public $components = array('Email', 'RequestHandler');

	public $togo;
	public $timeStatus;
	public $ticketsLeft;
	public $timeToGoString;
	public $availableTickets = 0;

	public function beforeFilter(){
		parent::beforeFilter();
		setlocale(LC_ALL, 'de_DE.utf8');

		$this->Auth->allow('add', 'order', 'done', 'index');

		if ($this->Auth->User('id') > 0){
			$this->set('isLoggedIn', true);
		}

		$this->timeStatus = null;
		$now = time();

		$sellStart = mktime(10, 5, 0, 5, 10, 2012);
		//$sellStart = mktime(10, 5, 0, 1, 1, 2012);
		$sellEnd = mktime(0, 0, 0, 5, 27, 2012);

		$diff = ($sellStart - $now);
		$this->togo['days'] = (int)($diff / 86400);
		$this->togo['hours'] = (int)(($diff % 86400) / 3600);
		$this->togo['minutes'] = (int)(($diff % 3600) / 60);
		$this->togo['seconds'] = (int)(($diff % 60));

		$this->timeStatus = ($diff > 0) ? 'notyet' : 'yes';
		if ($now > $sellEnd){
			$this->timeStatus = 'closed';
		}

		$this->timeToGoString = sprintf('%02u:%02u:%02u:%02u', $this->togo['days'], $this->togo['hours'], $this->togo['minutes'], $this->togo['seconds']);

		$soldTickets = 0;
		$orders = $this->Order->find('all');
		foreach ($orders as $order){
			$soldTickets += $order['Order']['amount'];
		}

		$this->ticketsLeft = $this->availableTickets - $soldTickets;

		$this->set(array(
			'togo' => $this->togo,
			'timeStatus' => $this->timeStatus,
			'ticketsLeft' => $this->ticketsLeft,
			'timeToGoString' => $this->timeToGoString,
			'availableTickets' => $this->availableTickets
		));

		if ($this->Auth->User('id') > 0){
			return;
		}

		if ($this->request->params['action'] != 'index' && $this->request->params['action'] != 'done'){
			if ($this->timeStatus != 'yes'){
				$this->Session->setFlash('Der Vorverkauf startet am 10.05.2012 um 10:05 Uhr', 'flash_warning');
				$this->redirect(array('action' => 'index'));
			}
			if ($this->ticketsLeft <= 0){
				$this->Session->setFlash('Die Tickets sind alle ausverkauft!', 'flash_warning');
				$this->redirect(array('action' => 'index'));
			}
		}
	}

	public function index(){
		$this->Session->setFlash('Sorry für die technischen Probleme!! Falls ihr schon bestellt habt, checkt noch einmal Euere E-Mails. Alle eingegangenen Bestellungen wurden inzwischen nachträglich benachrichtigt und sind GEBUCHT! Nur wer bis jetzt keine E-Mail erhalten hat bitte noch einmal bestellen!', 'flash_warning');
		// empty
	}

	public function done(){
		// empty
	}

	public function order(){
		if ($this->request->is('post')){
			$this->Order->set($this->request->data);
			if (!$this->Order->validates()){
				$this->Session->setFlash('Oh no! Bitte prüfe das Formular und versuche es noch einmal', 'flash_error');
			}
			else {
				$this->render('add');
				return;
			}
		}
	}

	public function add(){
		if ($this->request->is('post')){
			$this->request->data['Order']['email2'] = $this->request->data['Order']['email'];


			if ($this->Order->save($this->request->data)){
				// Newsletter eintragen
				if ($this->request->data['Order']['newsletter']){
					App::uses('Subscriber', 'Model');
					$this->Subscriber = new Subscriber();
					$this->Subscriber->create();
					$this->Subscriber->save(array('Subscriber' => array('email' => $this->request->data['Order']['email'])));
				}

				// E-Mail verschicken!
				if (!$this->notify()){
					$this->Session->setFlash('Oh no, Bestellung wurde aufgenommne, aber beim versenden der Bestätigungs E-Mail ist ein Fehler aufgetreten. Bitte wende Dich an info@the-asstereoidiots.de!!!', 'flash_warning');
				}
				$this->request->data = null;
				$this->redirect(array('action' => 'done'));
				return;
			}
			else {
				$this->Session->setFlash('Tut uns leid, aber beim Bestellvorgang ist ein Fehler aufgetreten - versuche es noch einmal', 'flash_error');
			}
		}
		else {
			$this->redirect(array('action' => 'index'));
		}
	}

	public function admin_delet($id){
		$this->Order->delet($id);
		$this->redirect(array('action' => 'index', 'admin' => true));
	}

	public function notify(){


		$this->Email->reset();
		$this->Email->smtpOptions = array(
			'host' => 'smtp.1und1.de',
			'username' => 'noreply@the-asstereoidiots.de',
			'password' => 'fucksys',
			'port' => 25,
			'timeout' => 30
		);
		$this->Email->from = 'noreply@the-asstereoidiots.de';
		$this->Email->to = $this->request->data['Order']['email'];
		$this->Email->bcc = 'me@hannenz.de';
		$this->Email->subject = 'THE ASSTEREOIDIOTS RocknRoll Tram - Bestellbestätigung';
		$this->Email->template = 'tram_notify';
		$order = $this->Order->read();
		$this->set(array('order' => $order['Order']));
		return $this->Email->send();



			die('done');


		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail();

		$email->config(array(
			'host' => 'smtp.1und1.de',
			'port' => 25,
			'username' => 'noreply@the-asstereoidiots.de',
			'password' => 'fucksys',
			'transport' => 'Smtp'
		));

		$email->from(array('noreply@the-asstereoidiots.de' => 'The ASSTEREOIDIOTS - RNR Tram'));
		$email->to($this->request->data['Order']['email']);
		$email->subject('The ASSTEREOIDIOTS Rock\'n\'Roll Tram - Bestellbestätigung');
		$email->emailFormat('text');
		$email->template('tram_notify');
		$order = $this->Order->read();
		$email->viewVars($order['Order']);
		return $email->send();
	}

	public function admin_index(){
		$this->paginate = array(
			'order' => array('created' => 'desc'),
			'limit' => 50
		);
		$orders = $this->paginate();
		$this->set('orders', $orders);
		$this->set('_serialize', array('orders'));
	}

	function admin_export(){
		$orders = $this->Order->find('all');
		$this->set('orders', $orders);
		$this->layout = 'default';
	}

	public function admin_toggle($id, $what) {

		if ($what == 'payed' || $what == 'shipped'){

			$this->Order->id = $id;
			if ($this->Order->exists()){
				$order = $this->Order->read();
				if (empty($order['Order'][$what])){
					$order['Order'][$what] = strftime('%Y-%m-%d %H:%M');
				}
				else {
					$order['Order'][$what] = '';
				}
				if ($this->Order->saveField($what, $order['Order'][$what])){
					$this->Session->setFlash('Bestellung wurde gespeichert', 'flash_success');
				}
				else {
					$this->Session->setFlash('Bestellung konnte nicht gespeichert werden', 'flash_error');
				}
			}
		}
		$this->redirect($this->referer());
	}

	public function admin_delete($id){
		$this->Order->id = $id;
		if ($this->Order->exists()){
			if ($this->Order->delete()){
				$this->Session->setFlash('Bestellung wurde gelöscht', 'flash_success');
			}
			else {
				$this->Session->setFlash('Bestellung konnte nicht gelöscht werden', 'flash_error');
			}
		}
		$this->redirect($this->referer());
	}
}
