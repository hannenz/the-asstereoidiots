<?php
	echo $this->Html->tag('h1', __('Links'));
	echo $this->Html->link(__('Add link'), '/admin/links/add', array('class' => 'button add'));
	echo $this->element('pagination');
?>
<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(
			array(
				$this->Paginator->sort(__('Name'), 'name'),
				$this->Paginator->sort(__('Url'), 'url'),
				__('Actions')
			)
		);
		?>
	</thead>
	<tbody>
		<?php foreach ($links as $link){
			echo $this->Html->tableCells(
				array(
					$link['Link']['name'],
					$link['Link']['url'],
					$this->element('actions', array('id' => $link['Link']['id']))
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
