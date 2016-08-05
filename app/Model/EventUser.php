<?php
class EventUser extends AppModel {
	var $name = 'EventUser';
	var $belongsTo = array('Event', 'User');
}
?>
