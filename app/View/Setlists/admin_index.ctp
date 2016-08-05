<?php
	echo $this->Html->tag('h1', __('Setlists'));
	echo $this->Html->link(__('Add Setlist'), '/admin/setlists/add', array('class' => 'button add'));
	echo $this->element('pagination');
?>
<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(
			array(
				$this->Paginator->sort(__('Name'), 'Setlist.name'),
				__('Actions')
			)
		);
		?>
	</thead>
	<tbody>
		<?php foreach ($setlists as $setlist){
			echo $this->Html->tableCells(
				array(
					$this->Html->link($setlist['Setlist']['name'], '/admin/setlists/edit/'.$setlist['Setlist']['id']),
					join(' ', array(
						$this->Html->link(__('Print setlist'), '/admin/setlists/print/'.$setlist['Setlist']['id']),
						$this->Html->link(__('Delete'), '/admin/setlists/delete/'.$setlist['Setlist']['id'], array(), __('Are you sure?'))
					))
				),
				array('class' => 'odd')
			);
		}
		?>
	</tbody>
</table>
<?php
	echo $this->element('pagination');
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
