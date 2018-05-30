<?php
class DownloadCode extends AppModel {
	var $name = 'DownloadCode';

	public $validate = [
		'code' => [
			'wellformed' => [
				'rule' => '/^[A-Z0-9]{8}$/',
				'message' => 'Das sieht mir aber mal gar nicht nach einem gueltigen Code aus, Freund Nase!'
			],
			'unused' => [
				'rule' => 'isUnused',
				'message' => 'Dieser Code wurde schon mal benutzt. Dirty.'
			],
			'valid' => [
				'rule' => 'isValid',
				'message' => 'Nope. Kein Download fuer dich dabei mit diesem Code.'
			]
		]
	];

	protected function isUnused ($check) {
		$query = sprintf ("SELECT * FROM download_codes WHERE hash=SHA2(UPPER('%s'), 384) AND used=1", $check['code']);
		$result = $this->query ($query);
		return empty ($result); 
	}

	protected function isValid ($check) {
		$query = sprintf ("SELECT * FROM download_codes WHERE hash=SHA2(UPPER('%s'), 384)", $check['code']);
		$result = $this->query ($query);
		return !empty ($result);
	}
}
?>
