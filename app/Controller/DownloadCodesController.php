<?php
class DownloadCodesController extends AppController {

	public $name = 'DownloadCodes';
	public $helpers = array ('Html', 'Form');
	public $theme = 'DirtyRock';
	public $layout = 'download';

	public function beforeFilter () {
		parent::beforeFilter ();
		$this->Auth->allow (['download', 'choose', 'done']);

	}

	public function index () {
		// Configure::write ('debug', 2);

		// Check if user has already validated a code and redirect to download page immediately if so
		if ($this->Session->check ('download_allowed')) {
			$this->redirect ('choose');
		}


		// The DL Code can be passed either as URL param (the-asstereoidiots.de/dirty-rock/CODEHERE
		// or in POST request
		if (!empty ($this->request->params['code'])) {
			$this->request->data['DownloadCode']['code'] = $this->request->params['code'];
		}


		if (!empty ($this->request->data)) {

			$this->DownloadCode->set ($this->request->data);

			if (!$this->DownloadCode->validates ()) {

				if ($this->request->isAjax ()) {
					die (json_encode ([ 'success' => false ]));
				}

				$this->Session->setFlash ('Das sieht mir aber mal gaaar nicht nach einem g&uuml;tigen Code aus, Freund Nase!');
			}
			else {
				$code = $this->DownloadCode->query (sprintf ("SELECT * FROM download_codes AS DownloadCode WHERE hash=SHA2('%s', 384) AND used=0 LIMIT 1", $this->request->data['DownloadCode']['code']));
				if (!empty ($code[0])) {
					$code = $code[0];
					$code['DownloadCode']['used'] = true;
					$code['DownloadCode']['used_date'] = date('Y-m-d H:i:s');
					$code['DownloadCode']['code'] = $this->request->data['DownloadCode']['code'];
					$this->DownloadCode->save ($code);
					/*  TODO: What if saving fails? */
					$this->Session->write ('download_allowed', true);

					if ($this->request->isAjax ()) {
						die (json_encode (['success' => true]));
					}

					$this->redirect (['action' => 'choose']);
				}
			}
		}
	}
	


	public function choose () {

		if (!$this->Session->check ('download_allowed')) {
			$this->Session->setFlash ('So nicht, Freund Nase!');
			$this->redirect ('index');
		}

		if (!empty ($this->request->data)) {
			$this->Session->write ('type', $this->request->data['DownloadCode']['type']);

			$this->redirect (['action' => 'done', ]);

			// $this->Session->delete ('download_allowed');
		}
	}

	public function done () {
		if (!$this->Session->check ('download_allowed')) {
			$this->Session->setFlash ('So nicht, Freund Nase!');
			$this->redirect ('index');
		}

		// Intentionally empty: Just render template, which will
		// trigger a redirect to download action!
		
	}

	public function download ($type) {
		if (!$this->Session->check ('download_allowed')) {
			$this->Session->setFlash ('So nicht, Freund Nase!');
			$this->redirect ('index');
		}

		if (!$this->Session->check ('type')) {
			$this->redirect ('choose');
		}
		$type = $this->Session->read ('type');


		switch ($type) {
			case 'mp3-lo':
				$id = 'The_Asstereoidiots_Dirty_Rock_MP3_128k.zip';
				$name = 'The_Asstereoidiots_Dirty_Rock_MP3_128k';
				break;
			case 'mp3-hi':
				$id = 'The_Asstereoidiots_Dirty_Rock_MP3_192k.zip';
				$name = 'The_Asstereoidiots_Dirty_Rock_MP3_192k';
				break;
			case 'flac':
				$id = 'The_Asstereoidiots_Dirty_Rock_FLAC.zip';
				$name = 'The_Asstereoidiots_Dirty_Rock_FLAC';
				break;
			default:
				$this->redirect ('choose');
				break;
		}

		$this->viewClass = 'Media';
		$params = [
			'id' => $id,
			'name' => $name,
			'download' => true,
			'extension' => 'zip',
			'path' => APP . 'downloads' . DS 
		];
		$this->set ($params);
	}


	public function admin_print () {
		$codes = $this->DownloadCode->find ('all');
		$this->set ('codes', $codes);
	}
}
?>
