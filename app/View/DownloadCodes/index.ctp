<h2>Download that shit</h2>

<div>
	<?php echo $this->Form->create ('DownloadCode');?>
		<?php echo $this->Form->input ('code', [
			'type' => 'text',
			'label' => 'Enter your download code here'
		]);
		?>
	<?php echo $this->Form->submit ('Check if code is dirty enough');?>
	<?php $this->Form->end (); ?>
</div>

<!--
<table>
<?php foreach ($codes as $code): ?>
	<tr>
		<td><span style="font-family:monospace"><?php echo $code['DownloadCode']['hash']; ?></span></td>
	</tr>
<?php endforeach ?>
</table>
-->
