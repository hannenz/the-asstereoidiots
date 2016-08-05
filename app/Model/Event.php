<?php
class Event extends AppModel {
	var $name = 'Event';
	var $order = array('Event.start' => 'DESC');
	var $actsAs = array('Containable');

	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'start' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		)
	);


	var $belongsTo = array('EventType');
	var $hasMany = array(
		'EventUser' => array(
			'dependant' => true
		)
	);

	function beforeSave(){
		if (isset($this->data['Event']['start'])){
			$this->data['Event']['start'] = substr($this->data['Event']['start'], 0, 11) . ' ' . $this->data['Event']['time'];
		}
		else if (isset($this->data['start'])){
			$this->data['start'] = substr($this->data['start'], 0, 11) . ' ' . $this->data['time'];
		}
		if (isset($this->data['Event']['end'])){
			$this->data['Event']['end'] = substr($this->data['Event']['end'], 0, 11) . ' ' . $this->data['Event']['endtime'];
		}
		else if (isset($this->data['end'])){
			$this->data['end'] = substr($this->data['end'], 0, 11) . ' ' . $this->data['endtime'];
		}
		return (true);
	}

	function afterFind($results, $primary){
		foreach ($results as $key => $event){
			if ($primary && isset($event['EventUser'])){
				$perc = 0;
				$status = 'pending';
				foreach ($event['EventUser'] as $eu){
					$perc += 25;
					if ($eu['status'] != 1){
						$status = 'declined';
						break;
					}
				}
				if ($perc == 100){
					$status = 'confirmed';
				}
				$results[$key]['Event']['status'] = $status;
				$results[$key]['Event']['perc'] = $perc;
			}
		}
		return ($results);
	}

}
?>
