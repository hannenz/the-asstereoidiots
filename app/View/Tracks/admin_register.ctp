<h1><?php echo __('Register Media File'); ?></h1>

<?php echo $this->Form->create('Track', array('action' => 'admin_register'));?>
<?php echo $this->Form->input('title');?><br>
<?php echo $this->Form->input('comment');?><br>
<?php echo $this->Form->input('type', array('type' => 'select', 'options' => array('audio', 'video')));?><br>
<?php echo $this->Form->input('filename');?><br>
<?php echo $this->Form->submit(__('save'));?>
<?php echo $this->Form->end();?>
