<h1><?php echo __('Locations'); ?></h1>
<?php
	echo $this->Html->link(__('Add Location'), '/admin/locations/add', array('class' => 'button add'));
	echo $this->Form->create('Location', array('action' => 'find', 'class' => 'searchbox'))
?>
<fieldset>
	<legend><?php echo __('Search Location')?></legend>
	<?php
		echo $this->Form->input('query', array('type' => 'text', 'label' => __('Search'), 'class' => 'smallinput'));
		echo $this->Form->submit(__('find'));
	?>
</fieldset>
<?php echo $this->Form->end();?>

<div id="results">
<div id="results-inner">

<?php
if (isset($find)){
	echo $this->Html->tag('p', count($locations) . ' ' . __('locations'));
}
echo $this->element('pagination', array('name' => __('locations')));
?>

<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort(__('Name'), 'name'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Country'), 'country'); ?></th>
			<th><?php echo $this->Paginator->sort(__('Zip'), 'zip'); ?></th>
			<th><?php echo $this->Paginator->sort(__('City'), 'city'); ?></th>
			<!--th><?php echo __('Actions'); ?></th-->
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($locations as $location){
			echo $this->Html->tableCells(array(
				$this->Html->link($location['Location']['name'], '/admin/locations/view/'.$location['Location']['id']),
				$location['Location']['country'],
				$location['Location']['zip'],
				$location['Location']['city'],
/*
				$this->element('actions', array('id' => $location['Location']['id']))
*/
			), array(
				'class' => 'odd'
			));
		}
	?>
	</tbody>
</table>

<?php echo $this->element('pagination', array('name' => __('locations')))?>
</div>
</div>
<?php echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>
<?php echo $this->Html->script('find.js'); ?>
