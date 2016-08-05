<div id="debug"></div>

<?php echo $this->Form->create('Tracklist', array('action' => 'admin_edit'));?>
<fieldset>
	<legend><?php echo __('Edit:'); echo " $title"; ?></legend>
	<div id="generator" class="clearfix">
		<?php
			echo $this->Form->input('model', array('type' => 'hidden'));
			echo $this->Form->input('foreign_key', array('type' => 'hidden'));
			echo $this->Form->input('referer', array('type' => 'hidden', 'value' => $referer));
			echo $this->Form->button(__('Clear'), array('id' => 'clearbutton'));
			echo $this->Form->button(__('Save'), array('id' => 'savebutton'));
		?>
	</div>

	<div style="clear:both"></div>
	<div id="tracklist-wrap">
		<fieldset><legend><?php echo __('Tracklist'); ?></legend>
			<p>
				<?php
					echo $this->Html->tag('span', '10', array('id' => 'tracklist_length'));
					echo " " . __(' in');
					echo " " . $this->Html->tag('span', count($tracklist), array('id' => 'n_tracklist'));
					echo " " . __('Tracks');
				?>
			</p>
			<ul id="tracklist">
			<?php
	/*
			debug ($tracklist); die();
	*/
			foreach ($tracklist as $track){
				echo $this->element('tracklist_song_item', array('track' => $track['Track']));
			}
			?>
			</ul>
		</fieldset>
	</div>
	
	<div id="available-wrap">
		<fieldset><legend><?php echo __('Available'); ?></legend>
			<p>
				<?php
					echo $this->Html->tag('span', '10', array('id' => 'available_length'));
					echo " " . __('Minutes in');
					echo " " . $this->Html->tag('span', count($tracks), array('id' => 'n_available'));
					echo " " . __('Tracks');
				?>
			</p>
			<ul id="available">
			<?php
			foreach ($tracks as $track){
				$n_tracks = count($track['Track']);
				if ($n_tracks == 0){
					continue;
				}
				echo $this->element('tracklist_song_item', array('track' => $track));
			}
			?>
			</ul>
		</fieldset>
	</div>
	<div style="clear:both"></div>
</fieldset>
<?php echo $this->Form->end(); ?>

<ul>
	<?php
		echo $this->Html->tag('li', $this->Html->link(__('Add track'), '/admin/tracks/add', array('class' => 'button add')));
		echo $this->Html->tag('li', $this->Html->link(__('back'), '/admin/users/dashboard', array('class' => 'button back')));
	?>
</ul>

<?php echo $this->Html->script('tracklist_edit.js', array('inline' => false)); ?>
