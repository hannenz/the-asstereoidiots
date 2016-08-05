$(document).ready(function(){

	if (!$('#ShowNewsletter').attr('checked')){
		$('#show-newsletter').hide();
	}

	$('#ShowNewsletter').change(function(){
		if ($(this).attr('checked')){
			$('#show-newsletter').show();
		}
		else {
			$('#show-newsletter').hide();
		}
	});

	var date = $('#ShowShowtime').val();
	if (date.length == 0){
		date = null;
	}

	$('#datepicker').datepicker({
		dateFormat : 'yy-mm-dd',
		firstDay : 1,
		altField : $('#ShowShowtime'),
		altFormat : 'yy-mm-dd',
		changeYear : true,
	});
	$('#datepicker').datepicker('setDate', date);
	$('#ShowShowtime').parent().hide();

	$('#LocationSearchResults').hide();
	$('#BandSearchResults').hide();
	$('#locSpinner,#bandSpinner').hide();
	if ($('#bands').children().length == 0){
		$('#trash').hide();
	}

	$('#bands li').css({cursor : 'move'});
	$('#bands').sortable({
		update : function(){
			var ids = $(this).sortable('serialize');
			$('#ShowBandIds').val(ids);
		}
	});

	$('#trash').droppable({
		drop : function(event, ui){
			ui.draggable.remove();
			if ($('#bands').children('li').length == 1){
				$('#trash').hide();
			}
		},
		hoverClass : 'trash-hover',
	});


	$('#ShowLocationQuery').observe_field(0.5, function(){
		if ($('#ShowLocationQuery').val().length < 2){
			return;
		}
		$('#locSpinner').show();
		$.post('/locations/search/', { show_id : 0, query : $('#ShowLocationQuery').val() }, function(response){
			$('#locSpinner').hide();
			$('#LocationSearchResults').html(response);
			$('#LocationSearchResults').show();
			$('#LocationSearchResults li a').click(function(){
				$('#ShowLocationId').val($(this).attr('id'));
				$('#ShowLocationName').html($(this).html());
				$('#LocationSearchResults').hide();
				return (false);
			});
			$('#locfly').click(function(){
				$.post($(this).attr('href'), function(response){
					$('#ShowLocationId').val($(response).attr('id'));
					$('#ShowLocationName').html($(response).html());
				});
				$('#ShowLocationQuery').val('');
				$('#ShowLocationQuery').focus();
				return (false);
			});
		});
	});
	$('#ShowBandQuery').observe_field(0.5, function(){
		if ($('#ShowBandQuery').val().length < 2){
			return;
		}
		$('#bandSpinner').show();
		$.post('/bands/search/', { show_id : 0, query : $('#ShowBandQuery').val() }, function(response){
			$('#bandSpinner').hide();
			$('#BandSearchResults').html(response);
			$('#BandSearchResults').show();
			$('#BandSearchResults li a').click(function(){
				$('#bands').append('<li id="bands_' + $(this).attr('id') + '">' + $(this).html() + '</li>');
				$('#BandSearchResults').hide();
				$('#ShowBandQuery').val('');
				var band_ids = $('#ShowBandIds').val();
				$('#ShowBandIds').val(band_ids + (band_ids.length > 0 ? '&' : '') + 'bands[]=' + $(this).attr('id'));
				$('#ShowBandQuery').focus();
				$('#bands li').css({ cursor : 'move'});
				$('#trash').show();

				return (false);
			});
			$('#bandfly').click(function(){
				$.post($(this).attr('href'), function(response){
					$('#bands').append('<li id="bands_' + $(response).attr('id')+ '">' + $(response).html() + '</li>');
					$('#ShowBandQuery').val('');
					var band_ids = $('#ShowBandIds').val();
					$('#ShowBandIds').val(band_ids + (band_ids.length > 0 ? '&' : '') + 'bands[]=' + $(response).attr('id'));
				});
				$('#BandSearchResults').hide();
				$('#ShowBandQuery').focus();
				$('#bands li').css({ cursor : 'move'});
				$('#trash').show();
				return (false);
			});
		});
	});

	$('input[type=submit]').click(function(){
		if (
			$('#ShowShowtime').val().length == 0 ||
			$('#ShowLocationId').val().length == 0
		){
			alert('Please fill in Showtime and Location at least!');
			return (false);
		}
		return (true);
	});
});
