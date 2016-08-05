<?php echo $this->Session->flash('email'); ?>
<?php echo $this->Html->tag('h2', __('Newsletter has been sent:')); ?>
<dl>
	<?php foreach ($out as $email => $mssg){
		echo $this->Html->tag('dt', $email);
		echo $this->Html->tag('dd', $mssg);
	}?>
</dl>
<?php 	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>
