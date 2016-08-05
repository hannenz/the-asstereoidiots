<h1><?php echo __('Edit Playlist'); ?></h1>
<fieldset><legend><?php echo __('Tracklist'); ?></legend>

<?php
	echo $this->element('tracklist', array('tracklist' => $tracklist));
	echo $this->Html->link(__('Edit Tracklist'), '/admin/tracklists/edit/Playlist/1');
?>
</fieldset>
<?php
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
