<h1><?php echo __('Edit Show'); ?></h1>
<?php echo $this->Form->create('Show', array('action' => 'admin_edit', 'type' => 'file'))?>
<fieldset><legend><?php echo __('Showtime'); ?></legend>
<?php echo $this->Html->tag('div', '', array('id' => 'datepicker')); ?>
<?php echo $this->Form->input('showtime', array('label' => __('Select date'), 'type' => 'text', 'readonly' => 'readonly', 'value' => strftime('%Y-%m-%d', strtotime($this->request->data['Show']['showtime']))))?><br>
<?php echo $this->Form->input('showtimeTime', array('label' => __('Time'), 'type' => 'text', 'value' => strftime('%H:%M', strtotime($this->request->data['Show']['showtime'])))); ?>
<?php echo $this->Form->input('comment');?>
<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.id')))?>
<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $this->request->data['Show']['id']));?>
</fieldset>
<fieldset><legend><?php echo __('Location'); ?></legend>
<?php echo $this->Form->input('location_id', array('type' => 'hidden')); ?>
<div id="ShowLocationName"><?php echo $this->request->data['Location']['name']; ?> <?php echo $this->request->data['Location']['country']; ?>-<?php echo $this->request->data['Location']['zip']; ?> <?php echo $this->request->data['Location']['city']; ?></div>
<?php echo $this->Form->input('location_query', array('label' => __('Search or create location'))); ?><?php echo $this->Html->image('spinner.gif', array('id' => 'locSpinner')); ?>
<div id="LocationSearchResults"></div>
</fieldset>

<fieldset><legend><?php echo __('Other Bands'); ?></legend>
<?php
	$val = '';
	foreach ($this->request->data['Band'] as $band){
		$val .= ('bands[]='.$band['id']);
	}
	echo $this->Form->input('band_ids', array('type' => 'hidden', 'value' => $val));
?>

<ul id="bands">
<?php
foreach ($this->request->data['Band'] as $band){
	echo $this->Html->tag('li', $band['name'], array('id' => 'bands_'.$band['id']));
}
?>
</ul>

<div id="trash"><?php echo __('Drop here to delete'); ?></div>

<?php echo $this->Form->input('band_query', array('label' => __('Search or create band'))); ?><?php echo $this->Html->image('spinner.gif', array('id' => 'bandSpinner')); ?>
<div id="BandSearchResults"></div>
</fieldset>

<fieldset><legend><?php echo __('Bill'); ?></legend>
<?php echo $this->UploaderForm->file('Bill', array('label' => false, 'multiple' => true)); ?>
</fieldset>

<fieldset>
	<legend><?php echo __('Setlist'); ?></legend>
	<?php echo $this->Form->input('Show.setlist_id', array('label' => false)); ?>
	<?php echo $this->Form->input('setlist_public', array('type' => 'checkbox')); ?>
</fieldset>
<fieldset><legend><?php echo __('Newsletter'); ?></legend>
	<?php echo $this->Form->input('newsletter', array('type' => 'checkbox', 'label' => __('Send newsletter'))); ?>
	<div id="show-newsletter">
		<?php echo $this->Form->input('newsletter_subject', array('default' => 'Konzertterminänderung')); ?>
		<?php echo $this->Form->input('newsletter_body', array('type' => 'textarea', 'default' => 'Bitte beachtet die folgende Konzertterminänderung')); ?>
		<p><?php echo __('Date and Location will be inserted automatically');?></p>
	</div>
</fieldset>

<?php echo $this->Form->submit(__('save'))?><br />
<?php echo $this->Form->end()?>

<?php echo $this->element('backlink', array('admin' => true));?>

<?php
echo $this->Html->css(array('Aristo/Aristo', 'uploader'), null, array('inline' => false));
echo $this->Html->script(array(
		'shows_admin_add_edit.js',
		'jquery.observe_field',
		'jquery.html5_upload',
		'uploader'
	), array('inline' => false)
);
?>

