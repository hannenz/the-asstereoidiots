$(document).ready(function(){
	$('input').observe_field(0.5 , function(){
		var data = { query : $(this).val() };
		$('#results').load($('form').attr('action') + ' #results-inner', data);
	});
});
