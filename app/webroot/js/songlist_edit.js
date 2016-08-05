
$(document).ready(function(){
	$('#pool').hide();
	$('#setlist').sortable({
		connectWith : $('#available'),
		update : update_amounts
	});
	
	$('#available').sortable({
		connectWith : $('#setlist'),
		update : update_amounts
	});

	$('#clearbutton').click(function(){
		$('#setlist li').appendTo($('#available'));
		update_amounts();
		return (false);
	});
	$('#generatebutton').click(function(){
		$('#setlist li').appendTo($('#available'));
		var amount = parseInt($('#amount').val());

		if (amount > $('#available li').length){
			amount = $('#available li').length;
			$('#amount').val(amount);
		}

		for (var i = 0; i < amount; i++){
			var r = Math.floor(Math.random() * $('#available li').length);
			var track = $('#available li:eq(' + r + ')');
			$('#setlist').append(track);
		}

		update_amounts();
		return (false);
	});

	$('#savebutton').click(function(){
		var data = {
			foreign_key : $('#SonglistForeignKey').val(),
			songs : $('#setlist').sortable('serialize')
		};

		var url = $('form').attr('action');
		$.post(url, data);
		alert ('Setlist has been saved');
		return (false);
	});

	$('#addbutton').click(function(e){
		e.preventDefault();
		$.get('/admin/songs/add', function(r){
			$('<div title="Add Song">'+r+'</div>').dialog({
				width: '500px',
				open : function(){
					$(this).find('h1').hide();
					$(this).find('.back-link').hide();
					var dlg = $(this);
					$(this).find('input[type=submit]').click(function(){
						var data = {
							title : $('#SongTitle').val(),
							artist : $('#SongArtist').val(),
							lyrics : $('#SongLyrics').val(),
							comment : $('#SongComment').val(),
							length : $('#SongLength').val(),
							user_id : $('#SongUserId').val()
						}
						console.log(data);
						$.post($('#SongAdminAddForm').attr('action'), data, function(response){
							$('#available').append(response);
							$(dlg).dialog('close');
							$(dlg).dialog('destroy');
							update_amounts();
						});
					});
				}
			});
		});
	});

	$('#slider').slider({
		min : 0,
		max : 5,
		change : apply_filter,
		slide : function(event, ui){
			$('#min_rating').html(ui.value);
		}
	});

	
	$('#min_rating').change(apply_filter);
	$('#needs_track').change(apply_filter);
	update_amounts();
});

function apply_filter(event, ui){
	$('#pool li').appendTo($('#available'));
	
	var min_rating = ui.value;
	$('#available li').each(function(){
		if (parseFloat($(this).attr('rating')) < min_rating){
			$(this).appendTo($('#pool'));
		}
	});
	update_amounts();
}

function update_amounts(){
	$('#n_available').html($('#available li').length);
	$('#n_setlist').html($('#setlist li').length);

	var total = 0;
	$('#setlist li').each(function(){
		var l = $(this).attr('length').split(':');
		total = total + 60 * parseInt(l[0]) + parseInt(l[1]);
	});
	var date = new Date((total - 3600) * 1000);
	$('#setlist_length').html(date.toLocaleTimeString());
	
	var total = 0;
	$('#available li').each(function(){
		var l = $(this).attr('length').split(':');
		total = total + 60 * parseInt(l[0]) + parseInt(l[1]);
	});
	var date = new Date((total - 3600) * 1000);
	
	$('#available_length').html(date.toLocaleTimeString());

	$('#setlist,#available').height('auto');
	var h1 = $('#setlist').height();
	var h2 = $('#available').height();

	var max = (h1 < h2) ? h2 : h1;
	$('#setlist,#available').height(max);

	$('#setlist li').each(function(i){
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
