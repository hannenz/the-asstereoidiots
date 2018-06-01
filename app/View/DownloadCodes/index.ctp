<div class="downloadcode-form">
	<?php echo $this->Html->image ('/dist/img/dirty_rock_cover.jpg', ['class' => 'cover', 'width' => '600', 'height' => '600']); ?>

	<?php echo $this->Form->create ('DownloadCode');?>
		<?php echo $this->Form->input ('code', [
			'type' => 'text',
			'label' => 'Enter your download code<br>',
			'pattern' => '[a-zA-Z0-9]{0,8}',
			'maxlength' => 8,
			'autofocus' => true,
			'autocapitalize' => true
		]);
		?>
	<button type="submit">
		<span>Check</span>
		<!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
		<svg width="120" height="30" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" >
			<circle cx="15" cy="15" r="10">
				<animate attributeName="r" from="10" to="10"
						 begin="0s" dur="0.8s"
						 values="10;6;10" calcMode="linear"
						 repeatCount="indefinite" />
				<animate attributeName="fill-opacity" from="1" to="1"
						 begin="0s" dur="0.8s"
						 values="1;.5;1" calcMode="linear"
						 repeatCount="indefinite" />
			</circle>
			<circle cx="60" cy="15" r="6" fill-opacity="0.3">
				<animate attributeName="r" from="6" to="6"
						 begin="0s" dur="0.8s"
						 values="6;10;6" calcMode="linear"
						 repeatCount="indefinite" />
				<animate attributeName="fill-opacity" from="0.5" to="0.5"
						 begin="0s" dur="0.8s"
						 values=".5;1;.5" calcMode="linear"
						 repeatCount="indefinite" />
			</circle>
			<circle cx="105" cy="15" r="10">
				<animate attributeName="r" from="10" to="10"
						 begin="0s" dur="0.8s"
						 values="10;6;10" calcMode="linear"
						 repeatCount="indefinite" />
				<animate attributeName="fill-opacity" from="1" to="1"
						 begin="0s" dur="0.8s"
						 values="1;.5;1" calcMode="linear"
						 repeatCount="indefinite" />
			</circle>
		</svg>
		</button>
	<?php //echo $this->Form->submit ('Check');?>
	<?php $this->Form->end (); ?>
</div>

<script>
$(function () {
	$('#DownloadCodeIndexForm').on ('submit', function (ev) {

		ev.preventDefault ();

		var $form = $(this);
		var url = $form.attr('action');
		var $input = $('#DownloadCodeCode');
		data = $form.serialize ();
		$input.attr('disabled', true);
		$form.addClass ('busy');
		$submitBtn = $form.find ('button[type=submit]');

		setTimeout (sendForm, 1500);

		function sendForm () {

			$.post (url, data, function (_response) {

				$form.removeClass ('busy');
				var response = JSON.parse (_response);

				if (response['success']) {
					$input.addClass ('valid');
					var $btn = $('<a href="/download_codes/download">Click here to download your files</a>');
					$btn.addClass ('button');
					$submitBtn.replaceWith ($btn);
				}
				else {
					$input.addClass('invalid');
					var $btn = $('<a href="/dirty-rock/">Nope. Try again.</a>');
					$btn.addClass ('button');
					$submitBtn.replaceWith ($btn);
				}
			});
		}
		return false;
	});
});
</script>
