<h1><?php echo __('Subscribe to Newsletter'); ?></h1>
<p><?php echo __('Never miss a show of the Idiots, get latest news and stay in touch with the most unprofessional band in the world...'); ?></p>

<?php echo $this->Form->create('Subscriber', array('action' => 'subscribe'))?>
<fieldset><legend><?php echo __('Subscribe NOW!'); ?></legend>
<?php echo $this->Form->input('email', array('label' => __('Your E-Mail')))?>
<?php echo $this->Form->submit(__('subscribe now!'))?>
</fieldset>
<?php echo $this->Form->end()?>

<p><?php echo __('We won\'t abuse your email address and never will give it to any third party person or organisation. The only purpose is to send you a newsletter via e-mail on a regular basis. You won\'t get more than one e-mail per month.'); ?></p>
<p><?php echo __('If you have subscribed already and want to unsubscribe click'); ?> <?php echo $this->Html->link('here', 'unsubscribe')?></p>
