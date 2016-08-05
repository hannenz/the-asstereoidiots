<h1><?php echo __('Bands'); ?></h1>
<?php
	echo $this->Html->link(__('Add Band'), '/admin/bands/add', array('class' => 'button add'));
	echo $this->Form->create('Band', array('action' => 'find', 'class' => 'searchbox'))
?>
<fieldset>
	<legend><?php echo __('Search bands'); ?></legend>
	<?php
		echo $this->Form->input('query', array('type' => 'text', 'label' => __('Search'), 'class' => 'smallinput'));
		echo $this->Form->submit(__('find'));
	?>
</fieldset>
<?php echo $this->Form->end()?>

<div id="results">
<div id="results-inner">
<?php
if (isset($find)){
	echo $this->Html->tag('p', count($bands) . ' ' . __('Bands'));
}
echo $this->element('pagination', array('name' => 'posts'));
?>

<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(array($this->Paginator->sort(__('Name'), 'name'))); ?>
	</thead>
	<tbody>
	<?php
		foreach ($bands as $band){
			echo $this->Html->tableCells(array(
				$this->Html->link($band['Band']['name'], '/admin/bands/view/'. $band['Band']['id'])
			), array(
				'class' => 'odd'
			));
		}
	?>
	</tbody>
</table>

<?php echo $this->element('pagination', array('name' => 'Bands'))?>
</div>
</div>
<?php echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard')); ?>
<?php echo $this->Html->script('find.js');?>
