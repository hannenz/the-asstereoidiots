<?php
	class Location extends AppModel {
		var $name = 'Location';
		var $belongsTo = array('User');
		var $hasMany = array('Show');
		var $order = array('Location.name' => 'ASC');
		var $actsAs = array('Containable');

		var $validate = array(
			'name' => array(
				'rule' => 'notEmpty'
			)
		);

		function beforeSave ($options = Array()) {


			if (empty($this->data[$this->alias]['lat']) || empty($this->data[$this->alias]['lng'])) {
				$addr = preg_replace('/\s{2,}/', ' ', trim (join(' ', array($this->data[$this->alias]['name'], $this->data[$this->alias]['address1'], $this->data[$this->alias]['address2'], $this->data[$this->alias]['zip'], $this->data[$this->alias]['city']))));
				$url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($addr);

				$jsonData = file_get_contents($url);
				if ($jsonData === false) {
					die ('file_get_contents failed.');
					return;
				}

				$data = json_decode($jsonData, true);
				if (!empty($data['results'][0]['geometry']['location'])) {
					$this->data[$this->alias]['lat'] = $data['results'][0]['geometry']['location']['lat'];
					$this->data[$this->alias]['lng'] = $data['results'][0]['geometry']['location']['lng'];
				}

				return true;
			}
		}

		function afterFind($results, $primary = false){
			if (count($results) == 0){
				return ($results);
			}
			if (isset($results[0])){
				foreach ($results as $key => $result){
					if (isset($result['Location']['city'])){
						$results[$key]['Location']['full_city'] = join(" ", array($result['Location']['country'], $result['Location']['zip'], $result['Location']['city']));
						$results[$key]['Location']['full_name'] = join(" ", array($result['Location']['name'], $result['Location']['city']));
					}
					else if (isset($result['city'])){
						$results[$key]['full_city'] = join(" ", array($result['country'], $result['zip'], $result['city']));
						$results[$key]['full_name'] = join(" ", array($result['name'], $result['city']));
					}
				}
			}
			else {
				$results['full_name'] = join(" ", array($results['name'], $results['city']));
				$results['full_city'] = join(" ", array($results['country'], $results['zip'], $results['city']));
			}
			return ($results);
		}

/*
		var $virtualFields = array(
			'full_city' => 'CONCAT (Location.country, "-", Location.zip, " ", Location.city)',
			'full_name' => 'CONCAT (Location.name, " " , Location.city)'
		);
*/
/*
		var $validate = array(
			'name' => 'notEmpty',
			'email' => array(
				'rule' => 'email',
				'required' => false,
				'allowEmpty' => true
			),
			'url' => array(
				'rule' => 'url',
				'required' => false,
				'allowEmpty' => true
			),
			'phone1' => array(
				'rule' => 'numeric',
				'allowEmpty' => true
			),
			'phone2' => array(
				'rule' => 'numeric',
				'allowEmpty' => true
			),
			'zip' => array(
				'onlynumbers' => array(
					'rule' => 'numeric',
					'allowEmpty' => true
				),
				'five' => array(
					'rule' => array('between', 5, 5),
					'allowEmpty' => true
				)
			)
		);

*/
	}
?>
