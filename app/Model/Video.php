<?php
class Video extends AppModel {
	var $name = 'Video';

	var $validate = array(
		'title' => 'notEmpty'
	);


	var $actsAs = array(
		'Uploader.Uploadable' => array(
			'Videofile' => array(
				'allow' => array(
					'video/*',
					//~ 'video/mp4',
					//~ 'video/x-theora+ogg',
					//~ 'video/webm'
				),
				'files' => array(
					'Videofile' => array(
					'path' => 'files/Videofiles'
					)
				)
			)
		)
	);

	var $hasMany = array(
		'Comment' => array(
			'conditions' => array('Comment.model' => 'Video'),
			'order' => array('Comment.created' => 'DESC'),
			'foreignKey' => 'foreign_key',
			'dependent' => true
		)
	);
	var $belongsTo = array('User');
	var $order = array('Video.pos' => 'ASC');

	//~ function beforeDelete(){
		//~ $video = $this->read(null, $this->id);
		//~ @unlink(WWW_ROOT . 'files' . DS . $video['Video']['filename']);
		//~ @unlink(WWW_ROOT . 'img' . DS . 'video_posters' . DS . $video['Video']['poster']);
		//~ $query = 'UPDATE videos SET pos=pos-1 WHERE pos >' . $video['Video']['pos'];
		//~ $this->query($query);
		//~ return (true);
	//~ }
}
?>
