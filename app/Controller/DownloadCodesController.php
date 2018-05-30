<?php
class DownloadCodesController extends AppController {

	public $name = 'DownloadCodes';
	public $helpers = array ('Html', 'Form');
	public $theme = 'Idiotic';

	public function beforeFilter () {
		parent::beforeFilter ();
		$this->Auth->allow ('download');
	}
	public function index () {
		Configure::write ('debug', 2);

		if (!empty ($this->data)) {

			$this->DownloadCode->set ($this->data);

			if (!$this->DownloadCode->validates ()) {
				$this->Session->setFlash ('Das sieht mir aber mal gaaar nicht nach einem g&uuml;tigen Code aus, Freund Nase!');
			}
			else {
				$code = $this->DownloadCode->query (sprintf ("SELECT * FROM download_codes AS DownloadCode WHERE hash=SHA2('%s', 384) AND used=0 LIMIT 1", $this->data['DownloadCode']['code']));
				$code = $code[0];
				$code['DownloadCode']['used'] = true;
				$code['DownloadCode']['used_date'] = date('Y-m-d H:i:s');
				$code['DownloadCode']['code'] = $this->data['DownloadCode']['code'];
				$this->DownloadCode->save ($code);
				/*  TODO: What if saving fails? */
				$this->Session->write ('download_allowed', true);
				$this->redirect (['action' => 'view']);
			}
		}
	}
	
	public function view () {
		if (!$this->Session->check ('download_allowed')) {
			die ("So nicht, Freund Nase!");
		}
	}

	public function download () {
		if (!$this->Session->check ('download_allowed')) {
			die ("So nicht, Freund Nase!");
		}
		$this->viewClass = 'Media';
		$params = [
			'id' => 'dirty_rock.zip',
			'name' => 'DirtyRock',
			'download' => true,
			'extension' => 'zip',
			'path' => APP . 'downloads' . DS 
		];
		$this->set ($params);
		$this->Session->delete ('download_allowed');
	}
}
?>
