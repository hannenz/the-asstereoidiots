	<p>Your download should start in a few seconds, if  it doesn't, <?php echo $this->Html->link ('click here', ['action' => 'download']); ?> …</p>

	<div class="thank-you">
		<span>
		If you listen to it,<br>
		Listen to it loud.<br>
		Thank you!
		</span>
	</div>
	<iframe src="/download_codes/download" style="border:0;width:0;height:0;visibility:hidden">
		<?php echo $this->Html->link ('Click here to download your files', ['action' => 'download']); ?>
	</iframe>

<script>
/*
document.addEventListener ('DOMContentLoaded', function () {
	window.setTimeout (function () {
		window.location.href = '/download_codes/download';
	}, 3000);
});
 */
</script>
