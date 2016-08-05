<div title="<?php echo __('Edit event'); ?>">

	<?php
		echo $this->Form->create('Event', array('action' => 'admin_edit'));
	?>
	<fieldset><legend><?php echo __('Edit event'); ?></legend>
	<?php
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->input('user_id', array('type' => 'hidden'));
		echo $this->Form->input('event_type_id', array('type' => 'select'));

		echo $this->Form->input('start', array('type' => 'text', 'class' => 'date', 'label' => __('Date')));
		$time_options = array();
		for ($i = 0; $i < (24 * 60 * 60) ; $i += (30 * 60)){
			$t = sprintf("%02u:%02u", ($i / 3600), ($i / 60 % 60));
			$time_options[$t] = $t;
		}
		echo $this->Form->input('time', array('value' => strftime('%H:%M', strtotime($this->request->data['Event']['start']))));
		echo $this->Form->input('end', array('type' => 'text', 'class' => 'date', 'label' => __('Date')));
		$time_options = array();
		for ($i = 0; $i < (24 * 60 * 60) ; $i += (30 * 60)){
			$t = sprintf("%02u:%02u", ($i / 3600), ($i / 60 % 60));
			$time_options[$t] = $t;
		}
		echo $this->Form->input('endtime', array('value' => strftime('%H:%M', strtotime($this->request->data['Event']['start']))));





		echo $this->Form->input('all_day', array('type' => 'checkbox', 'value' => 0));


		echo $this->Form->input('title');
		echo $this->Form->input('details');
		echo $this->Form->submit(__('save'));
	?>
	</fieldset>
	<?php
		echo $this->Form->end();
	?>
</div>

<script type="text/javascript">
$('.date').datepicker({
	dateFormat : 'yy-mm-dd',
	firstDay : 1
});

$('#EventAllDay').change(function(){
	console.log("changed: " + $(this).attr('checked'));
	if ($(this).attr('checked')){
		$('#EventTime').parent().hide();
	}
	else {
		$('#EventTime').parent().show();
	}
});
</script>
