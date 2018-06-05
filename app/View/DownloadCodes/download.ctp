<div class="downloadcode-form">
	<figure class="cover">
		<?php echo $this->Html->image (
				'/dist/img/dirty_rock_cover.jpg', 
				[
					'width' => '400',
					'height' => '405'
				]);
		?>
	</figure>
	<?php echo $this->Form->create ('DownloadCode'); ?>
	<label>Choose quality</label>
	<div class="input radio">
		<?php echo $this->Form->radio ('type', [
			'mp3-lo' => 'MP3@128&thinsp;bps <span class="small">(~25&thinsp;M)</span>',
			'mp3-hi' => 'MP3@196&thinsp;bps <span class="small">(~37&thinsp;M)</span>',
			'flac' => 'FLAC <span class="small">(Lossless,~192&thinsp;M)</span>'
		], [
			'value' => 'mp3-hi',
			'legend' => false
		]);
		?>
	</div>
	<?php echo $this->Form->submit ('Download now'); ?>
	<?php echo $this->Form->end (); ?>
</div>
