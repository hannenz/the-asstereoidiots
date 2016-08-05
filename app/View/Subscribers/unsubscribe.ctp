<h1><?php echo __('Unsubscribe from Newsletter'); ?></h1>
<p><?php echo __('You really won\'t be our friend no more if you do this! But ok, if you\'re totally sure that you don\'t want to get no more newsletters.... go ahead.... enter your email address and click on \'unnsubscribe\'. Do it. C\'mon! But don\'t ever come again and wanna make friends with us. Nope. Over and Out. Bye bye.... we WON\'T miss you.'); ?></p>

<?php echo $this->Form->create('Subscriber', array('action' => 'unsubscribe'))?>
<fieldset><legend><?php echo __('Unsubscribe'); ?></legend>
<?php echo $this->Form->input('email', array('label' => __('Your E-Mail')))?><br>
<?php echo $this->Form->submit(__('unsubscribe'))?>
</fieldset>
<?php $this->Form->end()?>
