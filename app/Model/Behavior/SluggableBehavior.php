<?php
class SluggableBehavior extends ModelBehavior {
	
	public function setup (Model $Model, $settings = Array()) {
		if (!isset($this->settings[$Model->alias])) {
			$this->settings[$Model->alias] = array(
				'slugField' => 'title'
			);
		}
		$this->settings[$Model->alias] = array_merge(
			$this->settings[$Model->alias],
			(array)$settings
		);
	}

	public function beforeSave (Model $Model, $options = array()) {

		// $i = 0;
		// do {
			if (is_callable(array($Model, 'getSlug'))){
				$slug = call_user_func(array($Model, 'getSlug'), $Model->data);
			}
			else if (is_string($this->settings[$Model->alias]['slugField'])) {
				$slug = strtolower(Inflector::slug($Model->data[$Model->alias][$this->settings[$Model->alias]['slugField']], '-'));
			}
			else {
				return false; // ?!?!?!
			}

			// if ($i++ > 0) {
			// 	$slug .= sprintf("-%u", $i);
			// }
			// $n = $Model->findBySlug($slug);
		// } while (!empty($n));

		$Model->data[$Model->alias]['slug'] = $slug;
		return true;
	}
}