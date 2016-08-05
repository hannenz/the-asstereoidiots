<?php
class Message extends AppModel {
	var $name = 'Message';

	var $actsAs = array('Containable');
	var $validate = array(
		'subject' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
		'body' => array(
			'rule' => 'notEmpty',
			'required' => true
		),
	);
	var $belongsTo = array(
		'Sender' => array(
			'className' => 'User',
			'foreignKey' => 'sender',
			'fields' => array('id', 'name')
		)
	);
	var $hasAndBelongsToMany = array(
		'Recipient' => array(
			'className' => 'User',
			'joinTable' => 'messages_users',
			'foreignKey' => 'message_id',
			'associationForeignKey' => 'user_id',
			'fields' => array('id', 'name')
		)
	);
	
	var $order = array(
		'Message.created' => 'DESC'
	);

	function unread($user_id){
		$n = $this->Recipient->find('all', array(
			'conditions' => array(
				'Recipient.id' => $user_id,
			),
			'fields' => array('id'),
			'contain' => array(
				'Message' => array(
					'fields' => array('id'),
					'conditions' => array(
						'MessagesUser.read' => 0
					)
				)
			)
		));
		return (count($n[0]['Message']));
	}

	function mark($id, $status, $user_id){
		$message = $this->read(null, $id);

		foreach ($message['Recipient'] as $recipient){
			if ($recipient['MessagesUser']['user_id'] == $user_id){
				$query = "UPDATE messages_users SET `read`={$status} WHERE id={$recipient['MessagesUser']['id']}";
				$this->query($query);
				break;
			}
		}
	}
}
?>
