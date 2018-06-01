<?php
App::uses('L10n', 'I18n');
class AppController extends Controller {

	var $components = array(
		'Session',
		'AutoLogin',
		'Auth' => array(
			'allowedActions' => array('index', 'view', 'detail', 'display', 'change', 'overview'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login', 'admin' => false),
			'authError' => 'Please login to access this location'
		),
		'Email',
		'Recaptcha.Recaptcha',
		'Cookie',
		'RequestHandler'
	);
	var $helpers = array('Html', 'Form', 'Session', 'TimeL8n', 'Text', 'Recaptcha.Recaptcha');
	var $uses = array('Track', 'Show', 'BlogPost', 'Comment', 'Setting', 'Tracklist', 'Subscriber', 'Message');

	var $email_delivery = 'smtp';

	//public $theme = 'Stadium';

	function beforeFilter(){

		parent::beforeFilter();


		$this->L10n = new L10n();
		$this->L10n->get();

		$lang = $this->Cookie->read('the-language');
		if ($lang != ''){
			$this->L10n->get($lang);
			Configure::write('Config.language', $lang);
		}
		else {
			$this->L10n->get();
			$lang = Configure::read('Config.language');
		}
		$locale = ($lang == 'eng') ? 'en_US.utf8' : 'de_DE.utf8';
		setlocale(LC_ALL, $locale);

		if ($this->request->is('ajax')){
			$this->layout = 'ajax';
		}


		if ($this->request->params['controller'] == 'pages' && $this->request->params['action'] == 'display'){
			$this->set('current', $this->request->params['pass'][0]);
		}
		else {
			$this->set('current', $this->request->params['controller']);
		}

		if ($this->request->params['controller'] != 'p28n'){

			$this->upcoming_shows = $this->Show->getUpcoming ();

			// $this->upcoming_shows = $this->Show->find('all', array(
			// 	'conditions' => 'Show.showtime >= NOW()',
			// 	'fields' => array('Show.showtime', 'Show.comment', 'Show.id', 'Show.slug'),
			// 	'contain' => array(
			// 		'Location' => array(
			// 			'fields' => array('Location.name', 'Location.city', 'Location.zip', 'Location.country')
			// 		),
			// 		'Bill'
			// 	),
			// 	'order' => array('Show.showtime' => 'asc')
			// ));
			$upcoming_shows = $this->upcoming_shows;
			$latest_news = $this->BlogPost->find('all', array(
				'contain' => array(
					'User' => array(
						'Portrait'
					),
					'Comment'
				),
				'limit' => 3,
				'order' => array('BlogPost.created' => 'DESC')
			));
			$latest_comments = $this->Comment->find('all', array('conditions' => array('Comment.model' => 'None', 'Comment.approved' => true), 'limit' => 3));
			$this->set(compact(array('upcoming_shows', 'latest_news', 'latest_comments')));

			Configure::write('settings', $this->Setting->read(null, 1));
			$playlist = $this->Tracklist->find('all', array(
				'conditions' => array(
					'model' => 'Playlist',
					'foreign_key' => 1,
				),
				'limit' => 1
			));
			$this->set('playlist', $playlist);
			if ($this->Session->check('Auth.User.id')){
				$this->set('unread_messages', $this->Message->unread($this->Session->read('Auth.User.id')));
			}
		}

		$this->set(array(
			'og_image' => 'http://www.the-asstereoidiots.de/img/band.jpg',
			'og_title' => 'THE ASSTEREOIDIOTS',
			'og_url' => 'http://www.the-asstereoidiots.de',
			'og_description' => 'Maximum Punk\'n\'Roll from Wodenau a. d. Hoden',
			'og_type' => 'Website'
		));

	}

	function beforeRender(){
		parent::beforeRender();
		$this->set('title_for_layout', 'The Asstereoidiots');

		$language = Configure::read('Config.language');
		$this->set('current_language', $language);
	}


	function admin_send_email($subject, $data, $recipients = null, $layout = 'default', $template = 'newsletter'){

		if ($recipients == null || empty($recipients)){
			$recipients = $this->Subscriber->find('list', array('fields' => array('Subscriber.email')));
		}

		if ((!empty($_SERVER['SERVER_NAME']) && preg_match('/\.lan$/', $_SERVER['SERVER_NAME']))) {
			$recipients = array(
				'jbhannenz@gmail.com',
				'johannes.braun@hannenz.de'
			);
		}

		$Email = new CakeEmail('default');

		$attachments = Array ();
		$attachments['logo_500.gif'] = array(
			'file' => WWW_ROOT . 'img' . DS . 'header_500.gif',
			'contentId' => 'logo-gif'
		);

		$Email->attachments($attachments);

		foreach ((array)$recipients as $email) {
			$Email->from('noreply@the-asstereoidiots.de', '★★★ THE ASSTEREOIDIOTS ★★★');
			$Email->to($email);
			$Email->subject($subject);
			$Email->emailFormat('both');
			$Email->viewVars (array(
				'subject' => $subject,
				'data' => $data,
				'email' => $email
			));
			$Email->template($template, $layout);
			$Email->send();
		}
	}

	function admin_send_newsletter($subject, $body, $subscribers = null){

		$Email = new CakeEmail ('default');

		if ((!empty($_SERVER['SERVER_NAME']) && preg_match('/\.lan$/', $_SERVER['SERVER_NAME']))) {
			$subscribers = array(
				'jbhannenz@gmail.com',
			);
		}

		$upcoming_shows = $this->Show->getUpcoming ();
		$attachments = array();
		if (!empty ($upcoming_shows) ) {
			$attachments['newsletter_upcoming_shows.gif'] = array(
				'file' => WWW_ROOT . 'img' . DS . 'newsletter_upcoming_shows.gif',
				'contentId' => 'newsletter-upcoming-shows-gif'
			);
			foreach ($upcoming_shows as $n => $show) {
				$thumb = $show['Bill'][0]['files']['thumb'];
				if (!empty($thumb) && file_exists(WWW_ROOT . $thumb)) {
					$key = basename($thumb);
					$file = WWW_ROOT . $thumb;
				}
				else {
					$key = 'defaultbill' . $n . '.jpg';
					$file = WWW_ROOT . 'img' . DS . 'defaultbill.jpg';
				}

			 	$attachments[$key] = array(
		 			'file' => $file,
			 		'contentId' => 'bill-'.$n
			 	);
		 		$upcoming_shows[$n]['Show']['bill_cid'] = 'bill-'.$n;
		 	}
	 	}

		$attachments['newsletter_header.gif'] = array(
			'file' => WWW_ROOT . 'img' . DS . 'newsletter_header.gif',
			'contentId' => 'newsletter-header-gif'
		);
		$attachments['newsletter_footer.gif'] = array(
			'file' => WWW_ROOT . 'img' . DS . 'newsletter_footer.gif',
			'contentId' => 'newsletter-footer-gif'
		);
		$attachments['newsletter_signature.gif'] = array(
			'file' => WWW_ROOT . 'img' . DS . 'newsletter_signature.gif',
			'contentId' => 'newsletter-signature-gif'
		);

		$Email->attachments($attachments);

		foreach ((array)$subscribers as $email) {
			$Email->from('noreply@the-asstereoidiots.de', '★★★ THE ASSTEREOIDIOTS ★★★');
			$Email->to($email);
			$Email->subject($subject);
			$Email->emailFormat('both');
			$Email->viewVars (array(
				'upcomingShows' => $upcoming_shows,
				'subject' => $subject,
				'body' => $body,
				'email' => $email
			));
			$Email->template('newsletter', 'newsletter');
			$Email->send();
		}
	}

	public function _autoLogin ($user) {
		debug ('User successfully autologgedin');
	}

	public function _autoLoginError ($cookie) {
		debug ($cookie);
	}

}

?>
