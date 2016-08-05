<?php
if (!isset($name)){
	$name = 'records';
}
?>
<div class="pagination">
	<?php
//	echo $this->Paginator->first();
	echo $this->Paginator->prev('<', null, null, array('class' => 'disabled'));
	echo $this->Paginator->numbers(array('modulus' => 5, 'separator' => false));
	echo $this->Paginator->next('>', null, null, array('class' => 'disabled'));
//	echo $this->Paginator->last('>>');
	?>
</div>
<?php ob_start();?>
<script>
$(document).ready(function(){

	return;

	function onPaginationClicked(event){
		event.preventDefault();
		var url = $(this).attr('href');
		var target = $(this).parents('.pagination').siblings('table.admin-index-table').first();

		$.get(url, function(r){
			var response = $('<div>'+r+'</div>');
			var newTable = $(response).find('table.admin-index-table');
			var newPagination = $(response).find('div.pagination').first();
			target.replaceWith(newTable);
			$('div.pagination').each(function(i, el){
				$(this).replaceWith(newPagination.clone());
			});
			$('.pagination a').click(onPaginationClicked);
		});
	}

	$('.pagination a').click(onPaginationClicked);
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
