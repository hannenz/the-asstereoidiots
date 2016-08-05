
$(document).ready(function(){
	$('.song-length').hide();
	$('#tracklist').sortable({
		connectWith : $('#available'),
		update : update_amounts
	});
	
	$('#available').sortable({
		connectWith : $('#tracklist'),
		update : update_amounts
	});

	$('#clearbutton').click(function(){
		$('#tracklist li').appendTo($('#available'));
		update_amounts();
		return (false);
	});
	
	$('#savebutton').click(function(){
		var data = {
			foreign_key : $('#TracklistForeignKey').val(),
			model : $('#TracklistModel').val(),
			tracks : $('#tracklist').sortable('serialize')
		};

		var url = $('form').attr('action');
		$.post(url, data, function(r){
			$('#debug').html(r);
		});
		alert ('Tracklist has been saved');
		return (false);
	});
	update_amounts();
});

function update_amounts(){
	$('#n_available').html($('#available li').length);
	$('#n_tracklist').html($('#tracklist li').length);

	var total = 0;
	$('#tracklist li').each(function(){
		var l = $(this).attr('length').split(':');
		total = total + 60 * parseInt(l[0]) + parseInt(l[1]);
	});
	var date = new Date((total - 3600) * 1000);
	$('#tracklist_length').html(date.toLocaleTimeString());
	
	var total = 0;
	$('#available li').each(function(){
		var l = $(this).attr('length').split(':');
		total = total + 60 * parseInt(l[0]) + parseInt(l[1]);
	});
	var date = new Date((total - 3600) * 1000);
	
	$('#available_length').html(date.toLocaleTimeString());

	$('#tracklist,#available').height('auto');
	var h1 = $('#tracklist').height();
	var h2 = $('#available').height();
	var max = (h1 < h2) ? h2 : h1;
	$('#tracklist,#available').height(max);

	$('#tracklist li').each(function(i){
		$(this).find('span.index').remove();
		$(this).prepend('<span class="index">' + (i + 1) + '</span>');
	});
	
	$('#available li span.index').remove();
	sort_available();
}

function sort_available(){
	var mylist = $('ul#available');
	var listitems = mylist.children('li').get();
	listitems.sort(function(a, b) {
		var compA = $(a).text().toUpperCase();
		var compB = $(b).text().toUpperCase();
		return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
	})
	$.each(listitems, function(idx, itm) { mylist.append(itm);});
}
