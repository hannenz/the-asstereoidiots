<?php
echo $this->Form->create(false, array('controller' => 'users', 'action' => 'send_testmail', 'admin' => true));
echo $this->Form->input('recipient');
echo $this->Form->input('subject');
echo $this->Form->input('message');
echo $this->Form->end('Send test mail');
?>