<h1><?php echo __('Newsletter Subscribers'); ?></h1>

<?php echo $this->element('pagination'); ?>
<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo __('E-mail'); ?></th>
			<th><?php echo __('Subscribed'); ?></th>
			<th><?php echo __('Action'); ?></th>
		</tr>
	</thead>
	<? foreach ($subscribers as $subscriber){
		echo $this->Html->tableCells(
			array(
				$subscriber['Subscriber']['email'],
				strftime('%x', strtotime($subscriber['Subscriber']['created'])),
				$this->Html->link(__('delete'), '/admin/subscribers/delete/'.$subscriber['Subscriber']['id'])
			),
			array('class' => 'odd')
		);
	}
	?>
</table>
<?php echo $this->element('pagination'); ?>
<?php 	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));  ?>

