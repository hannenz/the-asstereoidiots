<?php
	echo $this->Html->tag('h1', __('Videos'));
	echo $this->Html->link(__('Add Video'), '/admin/videos/add', array('class' => 'button add'));
	echo $this->Html->tag('div', $this->element('video_table'), array('id' => 'videosContent'));
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
<script type="text/javascript">

function on_update(){
	var data = $(this).sortable('serialize');
	$.post($('#base').html() + 'admin/videos/reorder', data, function(response){
		$('#videosContent').html(response);
		$('.admin-index-table').sortable({ items : 'tr', update : on_update });	
	});
}

$(document).ready(function(){
	$('.admin-index-table').sortable({
		items : 'tr',
		update : on_update
	});
});
</script>
