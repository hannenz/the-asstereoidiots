$(function () {

	var $form = $('#DownloadCodeIndexForm');
	var url = $form.attr('action');
	var $input = $('#DownloadCodeCode');
	var $submitBtn = $form.find ('button[type=submit]');

	$input.on ('keyup', function (ev) {
		$submitBtn.attr('disabled', (this.value.length < 8));
		if (this.value.length == 8) {
			$submitBtn.focus ();
		}
	});
	$input.keyup ();



	$form.on ('submit', function (ev) {

		ev.preventDefault ();

		data = $form.serialize ();
		$input.attr('disabled', true);
		$form.addClass ('busy');

		// setTimeout (sendForm, 1500);
		sendForm ();

		function sendForm () {

			$.post (url, data, function (_response) {

				$form.removeClass ('busy');
				var response = JSON.parse (_response);

				if (response['success']) {
					// $input.addClass ('valid');
					// var $btn = $('<a href="/download_codes/download">Click here to download your files</a>');
					// $btn.addClass ('button');
					// $submitBtn.replaceWith ($btn);

					$.get ('/download_codes/download', function (_response) {
						$newForm = $(_response).find ('form');
						$newForm.insertAfter ($form);
					});
				}
				else {
					$input.addClass('invalid');
					var $btn = $('<a href="/dirty">Nope. Try again.</a>');
					$btn.addClass ('button');
					$submitBtn.replaceWith ($btn);
					$btn.focus ();
				}
			});
		}
		return false;
	});
});

