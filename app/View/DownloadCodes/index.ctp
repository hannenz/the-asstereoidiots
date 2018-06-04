<div class="downloadcode-form">
	<?php echo $this->Html->image (
		'/dist/img/dirty_rock_cover.jpg', 
		[
			'class' => 'cover',
			'width' => '600',
			'height' => '605'
		]);
	echo $this->Form->create (
		'DownloadCode', 
		[
			'autocomplete' => 'off'
		]);
	echo $this->Form->input (
		'code',
		[
			'type' => 'text',
			'label' => 'Enter your download code<br>',
			'pattern' => '[a-zA-Z0-9]{0,8}',
			'maxlength' => 8,
			'autofocus' => true,
			'autocapitalize' => true,
			'value' => ''
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
	<?php $this->Form->end (); ?>
</div>

