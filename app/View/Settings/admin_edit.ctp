<?php
	echo $this->Html->tag('h1', __('Settings'));
	echo $this->Form->create('Setting', array('action' => 'admin_edit'));
	echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Setting']['id']));
?>
	<fieldset>
<?php
	echo $this->Html->tag('legend', __('Show ratings'));
	echo $this->Form->input('enable_show_ratings', array('type' => 'checkbox'));
?>
	</fieldset>
	<fieldset>
<?php
	echo $this->Html->tag('legend', __('Comments'));
	echo $this->Form->input('enable_comments', array('type' => 'select', 'multiple' => true, 'options' => array('BlogPost' => 'BlogPost', 'Show' => 'Show', 'Release' => 'Release', 'Track' => 'Track', 'Video' => 'Video', 'Pic' => 'Pic')));
	echo $this->Form->input('auto_approve_comments', array('type' => 'checkbox'));
	echo $this->Form->input('notification_email');
	echo $this->Form->submit(__('save')); 
?>
</fieldset>
<?php
	echo $this->Form->end();
	echo $this->element('backlink', array('admin' => true));
?>
