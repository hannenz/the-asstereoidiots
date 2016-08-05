<?php


?>
<h1><?php echo __('Event'); ?></h1>

<?php
	$sameDay = substr($event['Event']['start'], 0, 10) == substr($event['Event']['end'], 0, 10);
	printf("<h2>%s &ndash; %s</h2>",
		strftime('%x %H:%M', strtotime($event['Event']['start'])),
		$sameDay ? strftime('%H:%M', strtotime($event['Event']['end'])) : strftime('%x %H:%M', strtotime($event['Event']['end']))
	);
?>

<dl>
	<dt><?php echo __('Type'); ?></dt>
	<dd><?php echo $event['EventType']['name']; ?></dd>
	<dt><?php echo __('Title'); ?></dt>
	<dd><?php echo $event['Event']['title']; ?></dd>
	<dt><?php echo __('Details'); ?></dt>
	<dd><?php echo $event['Event']['details']; ?></dd>
	<dt><?php echo __('Start'); ?></dt>
	<dd><?php echo strftime('%x', strtotime($event['Event']['start'])); ?></dd>
	<dt><?php echo __('Time'); ?></dt>
	<dd><?php echo strftime('%H:%M', strtotime($event['Event']['start'])); ?></dd>
	<dt><?php echo __('All Day'); ?></dt>
	<dt><?php echo __('End'); ?></dt>
	<dd><?php echo strftime('%x', strtotime($event['Event']['end'])); ?></dd>
	<dt><?php echo __('EndTime'); ?></dt>
	<dd><?php echo strftime('%H:%M', strtotime($event['Event']['end'])); ?></dd>
	<dt><?php echo __('All Day'); ?></dt>
	<dd><?php echo $event['Event']['all_day'] ? __('yes') : __('no'); ?></dd>
	<dt><?php echo __('Participants'); ?></dt>
	<dd>
		<ul>
		<?php foreach ($parts as $part){
			echo $this->Html->tag('li', $part['username'], array('class' => $part['class']));
		}
		?>
		</ul>
	</dd>
	<dt>self</dt>
	<dd>
		<?php
			$links = array(
				$this->Html->link(__('accept'), '/admin/event_users/confirm/' . $event['Event']['id'] . '/1'),
				$this->Html->link(__('decline'), '/admin/event_users/confirm/' . $event['Event']['id'] . '/2'),

			);
			if ($self == 1){
				$links = array($this->Html->link(__('decline'), '/admin/event_users/confirm/' . $event['Event']['id'] . '/2'));
			}
			else if ($self == 2){
				$links = array($this->Html->link(__('accept'), '/admin/event_users/confirm/' . $event['Event']['id'] . '/1'));
			}

			echo join('<br>', $links);
		?>
	</dd>
</dl>
<div style="clear:both"></div>

<?php echo $this->element('backlink', array('admin' => true)); ?>
