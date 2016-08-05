<?php //echo $this->Form->create('Comment', array('action' => 'add'))?>
<!--fieldset>
	<legend><?php echo __('Leave a comment'); ?></legend-->
	<?php
	/*
		echo $this->Form->input('model', array('type' => 'hidden', 'value' => 'None'));
		echo $this->Form->input('name', array('label' => __('Your name')));
		echo $this->Form->input('email', array('label' => __('Your E-Mail')));
		echo $this->Form->input('body', array('label' => __('Your Comment')));
		echo $this->Recaptcha->show(array(
			'theme' => 'white',
			'lang' => substr(Configure::read('Config.language'), 0, 2)
		));
		echo $this->Recaptcha->error();
		echo $this->Form->submit(__('Submit comment'));
	*/
	?>
<!--/fieldset-->
<?php //echo $this->Form->end(); ?>

<p><?php echo __('Sorry but comments are closed for the time being'); ?>&hellip;</p>
