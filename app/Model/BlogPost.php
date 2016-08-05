<?php
class BlogPost extends AppModel {
	var $name = 'BlogPost';

	var $actsAs = array(
		'Containable',
		'Sluggable' => array(
			'slugField' => 'subject'
		)
	);

	var $hasMany = array(
		'Comment' => array(
			'conditions' => array('Comment.model' => 'BlogPost'),
			'foreignKey' => 'foreign_key',
			'order' => array('Comment.created' => 'DESC'),
			'dependent' => true
		)
	);
	var $belongsTo = array('User');
	
	var $validate = array(
		'subject' => array(
			'rule' => 'notEmpty'
		),
		'body' => array(
			'rule' => 'notEmpty'
		),
	);
	var $order = array('BlogPost.created' => 'DESC');

	public static function getSlug ($post) {

		// App::uses('Location', 'Model');
		// $Loc = new Location();
		// $location = $Loc->findById($show['Show']['location_id']);

		// return sprintf('%s-%s-%s', strftime('%Y-%m-%d', strtotime($show['Show']['showtime'])), Inflector::slug($location['Location']['name'], '-'), Inflector::slug($location['Location']['city'], '-'));
		return Inflector::slug($post['BlogPost']['title']);
	}

}
?>
