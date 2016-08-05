<?php
	App::uses('AppModel', 'Model');

	class Show extends AppModel {
		var $name = 'Show';

		var $actsAs = array(
			'Containable',
			'Sluggable' => array(
//				'slugField' => Show::getSlug
			),
			'Uploader.Uploadable' => array(
				'Bill' => array(
					'allow' => 'image/*',
					'files' => array(
						'full' => array(
							'path' => '/files/Bills',
							'action' => array(
								'Image' => array(
									'resize' => array('width' => 1000)
								)
							)
						),
						'thumb' => array(
							'path' => 'files/Bills/thumbs',
							'action' => array(
								'Image' => array(
									'resize' => array('width' => 100)
								)
							)
						)
					)
				)
			)
		);

		var $hasAndBelongsToMany = array(
			'Band'
		);

		var $belongsTo = array(
			'User',
			'Location',
			'Setlist'
		);

		var $hasMany = array(
			'Comment' => array(
				'order' => array('Comment.created' => 'DESC'),
				'foreignKey' => 'foreign_key',
				'conditions' => array('Comment.model' => 'Show'),
				'dependent' => true
			)
		);

		var $hasOne = array(
			'Album'
		);

		var $order = 'Show.showtime desc';

		function getByYear($year){
			$shows = $this->find('all', array('conditions' => array("Show.showtime BETWEEN '$year-01-01' AND '$year-12-31'", "Show.showtime < NOW()")));
			return ($shows);
		}

		function getUpcoming(){
			//$shows = $this->find('all', array('conditions' => 'Show.showtime > NOW()', 'order' => array('Show.showtime' => 'ASC')));

			$shows = $this->find('all', array(
				'conditions' => array(
					'Show.showtime >=' => strftime('%Y-%m-%d 00:00:00', strtotime('+0day'))
				),
				'fields' => array('Show.showtime', 'Show.comment', 'Show.id', 'Show.slug'),
				'contain' => array(
					'Location' => array(
						'fields' => array('Location.name', 'Location.city', 'Location.zip', 'Location.country')
					),
					'Bill',
					'Setlist'
				),
				'order' => array('Show.showtime' => 'ASC')
			));
			return ($shows);
		}

		function getAccomplished(){
//			$shows = $this->find('all', array('conditions' => 'Show.showtime <= NOW()'));
			$shows = $this->find('all', array(
				'conditions' => array(
					'Show.showtime <' => strftime('%Y-%m-%d 00:00:00', strtotime('+0day'))
				),
				'fields' => array('Show.showtime', 'Show.comment', 'Show.id', 'Show.slug'),
				'contain' => array(
					'Location' => array(
						'fields' => array('Location.name', 'Location.city', 'Location.zip', 'Location.country')
					),
					'Bill'
				),
				'order' => array('Show.showtime' => 'ASC')
			));
			return ($shows);
		}

		public static function getSlug ($show) {

			App::uses('Location', 'Model');
			$Loc = new Location();
			$location = $Loc->findById($show['Show']['location_id']);


			return sprintf('%s-%s-%s', strftime('%Y-%m-%d', strtotime($show['Show']['showtime'])), Inflector::slug($location['Location']['name'], '-'), Inflector::slug($location['Location']['city'], '-'));
		}
	}
?>
