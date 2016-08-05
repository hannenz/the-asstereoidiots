
<?php echo $this->Session->flash('email'); ?>

<h1><?php echo __('Write a Newsletter'); ?></h1>
<fieldset><legend><?php echo __('Compose'); ?></legend>
<?php echo $this->Form->create('Subscriber', array('action' => 'admin_compose'))?>
<?php echo $this->Form->input('subject', array('label' => __('Subject')));?><br>
<?php echo $this->Form->input('body', array('type' => 'textarea', 'label' => __('Message')))?><br>
<?php echo $this->Form->submit(__('Send Newsletter'))?>
</fieldset>
<?php echo $this->Form->end()?>

<?php echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));  ?>
