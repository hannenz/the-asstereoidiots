$(document).ready(function(){
	$('#BandQuery').observe_field(0.5 , function(){
		var data = {query : $(this).val()};
		$('#results').load($('#base').html() + 'admin/bands/find/ #results-inner', data);
	});
});
