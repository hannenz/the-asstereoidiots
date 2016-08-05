<div id="debug"></div>
<?php echo $this->Form->create('Songlist', array('action' => 'admin_edit'));?>
<fieldset><legend><?php echo __('Edit Setlist:');?> <?php echo $this->request->data['Setlist']['Setlist']['name']; ?></legend>
<div id="generator" class="clearfix">
	<?php
	
		echo $this->Form->input('foreign_key', array('type' => 'hidden'));
		echo $this->Form->input('referer', array('type' => 'hidden', 'value' => $referer));
		echo $this->Form->input('amount', array('id' => 'amount', 'default' => 10, 'label' => false));
		echo $this->Form->button(__('Generate Setlist'), array('id' => 'generatebutton'));
		echo $this->Form->button(__('Add song'), array('id' => 'addbutton'));
		echo $this->Form->button(__('Clear'), array('id' => 'clearbutton'));
		echo $this->Form->button(__('Save'), array('id' => 'savebutton'));
	?>
<div id="slider-wrap">
	<p><?php echo __('Minimum rating'); ?>: <span id="min_rating">0</span></p>
	<div id="slider"></div>
	<div style="clear:both"></div>
</div>
</div>
<div style="clear:both"></div>

<div id="setlist-wrap">
	<fieldset><legend><?php echo __('Setlist'); ?></legend>
		<p>
			<?php
				echo $this->Html->tag('span', '10', array('id' => 'setlist_length'));
				echo " " . __('Minutes in');
				echo " " . $this->Html->tag('span', count($setlist), array('id' => 'n_setlist'));
				echo " " . __('Songs');
			?>
		</p>
		<ul id="setlist">
		<?php
		foreach ($setlist as $song){
			echo $this->element('songlist_song_item', array('song' => $song));
		}
		?>
		</ul>
	</fieldset>
</div>

<div id="available-wrap">
	<fieldset><legend><?php echo __('Selection'); ?></legend>
		<p>
			<?php
				echo $this->Html->tag('span', '10', array('id' => 'available_length'));
				echo " " . __('Minutes in');
				echo " " . $this->Html->tag('span', count($songs), array('id' => 'n_available'));
				echo " " . __('Songs');
			?>
		</p>
		<ul id="available">
		<?php
		foreach ($songs as $song){
			$n_tracks = count($song['Track']);
			echo $this->element('songlist_song_item', array('song' => $song));
		}
		?>
		</ul>
	</fieldset>
</div>
<div style="clear:both"></div>

<ul style="display:block" id="pool">
</ul>
</fieldset>

<?php echo $this->Form->end(); ?>

<ul>
	<?php
/*
		echo $this->Html->tag('li', $this->Html->link(__('Add song'), '/admin/songs/add', array('id' => 'add-link')));
*/
		echo $this->Html->tag('li', $this->Html->link(__('back'), '/admin/setlists/edit/'.$this->request->data['Songlist']['foreign_key']));
	?>
</ul>

<?php echo $this->Html->script('songlist_edit.js', array('inline' => false)); ?>
