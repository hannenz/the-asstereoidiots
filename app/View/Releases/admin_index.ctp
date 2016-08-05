<h1><?php echo __('Releases'); ?></h1>
<?php echo $this->Html->link(__('Add Release'), '/admin/releases/add', array('class' => 'button add')); ?>

<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort(__('Cover'), 'Release.cover'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Title'), 'Release.title'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Year'), 'Release.year'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<?php foreach ($releases as $release):?>
		<tr>
			<?php
				echo $this->Html->tableCells(array(
					count($release['Cover']) ? $this->Html->image($release['Cover'][0]['icon'], array('class' => 'thumbnail')) : __('No cover available'),
					$release['Release']['title'],
					$release['Release']['year'],
					$this->element('actions', array('id' => $release['Release']['id']))
				), array(
					'class' => 'odd'
				));
			?>
		</tr>
	<?php endforeach ?>
</table>

<?php echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>

<?php ob_start(); ?>
<script type="text/javascript">
$(document).ready(function(){
	$('.tracklist').hide();
	$('.trigger').css({cursor : 'pointer'}).click(function(){
		$(this).next().toggle();
	});
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
