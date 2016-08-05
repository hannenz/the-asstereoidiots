$(document).ready(function(){
	$('#LocationQuery').observe_field(0.5, function(){
		var data = { query : $(this).val() };
		$('#results').load($('#base').html() + 'admin/locations/find #results-inner', data);
	});
});
