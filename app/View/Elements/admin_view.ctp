<?php
	echo $this->Html->tag('h1', isset($item['name']) ? $item['name'] : (isset($item['title']) ? $item['title'] : ''));
?>

<table class="admin-index-table">
	<tbody>
		<?php
			foreach ($item as $key => $value){
				echo $this->Html->tableCells(array($key, $value), array('class' => 'odd'));
			}
		?>
	</tbody>
</table>

<?php echo $this->element('backlink', array('admin' => true)); ?>
