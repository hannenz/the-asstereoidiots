<h1><?php echo __('Songs'); ?></h1>

<?php
	echo $this->Html->link(__('Add song'), '/admin/songs/add', array('class' => 'button add'));
	echo $this->Form->create('Song', array('action' => 'admin_search', 'class' => 'searchbox'));
?>
<fieldset><legend><?php echo __('Search song'); ?></legend>
<?php
	echo $this->Form->input('query', array('label' => false, 'class' => 'smallinput'));
	echo $this->Form->submit(__('Search'));
	echo $this->Form->end();
?>
</fieldset>
<div id="results">
<div id="results-inner">
	<?php
		echo $this->Html->tag('p', $total . ' ' . __('Songs'));
		echo $this->element('pagination');
	?>
	<table class="admin-index-table">
		<thead>
			<?php echo $this->Html->tableHeaders(array(
				$this->Paginator->sort(__('Title'), 'title'),
				$this->Paginator->sort(__('Artist'), 'artist'),
				$this->Paginator->sort(__('Length'), 'length'),
				__('Actions')
			));?>
		</thead>
		<tbody>
			<?php foreach ($songs as $song){
				echo $this->Html->tableCells(array(
					$this->Html->tag('div', $this->Html->link($song['Song']['title'], '/admin/songs/view/'.$song['Song']['id']), array('class' => (count($song['Track']) > 0) ? 'hasTrack' : '')),
					$song['Song']['artist'],
					$song['Song']['length'],
					//~ $this->element('rating', array('plugin' => 'rating', 'model' => 'Song', 'id' => $song['Song']['id'])),
					$this->element('actions', array('id' => $song['Song']['id'])) . $this->Html->tag('p', $this->Html->link(__('Add track'), '/admin/tracks/add/'.$song['Song']['id']))
				), array('class' => 'odd'));
			}
			?>
		</tbody>
	</table>
	<?php
		echo $this->element('pagination');
		echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
	?>
</div>
</div>

<?php echo $this->Html->script('find.js', array('inline' => false)); ?>
