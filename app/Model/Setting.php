<?php class Setting extends AppModel {
	var $name = 'Setting';

	var $validate = array(
		'notification_email' => array(
			'rule' => 'email'
		)
	);

	function afterFind($results, $primary = false){
		foreach ($results as $key => $result){
			if (isset($result['Setting']['enable_comments'])){
				$results[$key]['Setting']['enable_comments'] = explode(',', $result['Setting']['enable_comments']);
			}
		}
		return ($results);
	}

	function beforeSave($options = Array()){
		if (isset($this->data['Setting']['enable_comments'])){
			if ($this->data['Setting']['enable_comments']){
				$this->data['Setting']['enable_comments'] = join(',', $this->data['Setting']['enable_comments']);
			}
			else {
				$this->data['Setting']['enable_comments'] = '';
			}
		}
		return (true);
	}
}
?>
