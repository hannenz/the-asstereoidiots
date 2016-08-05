<?php
	echo $this->Html->script('fullcalendar-1.5/fullcalendar/fullcalendar.min.js', array('inline' => false));
	echo $this->Html->css('fullcalendar.css');
	echo $this->Session->flash('email');
?>

<div id="calendar"></div>

<?php
echo $this->Html->link(__('Add event'), '/admin/events/add', array('class' => 'button add'));
echo $this->Html->tag('h3', __('Upcoming events'));
echo $this->element('pagination');
?>
<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(array(
			__('Type'),
			__('Start'),
			__('End'),
			__('Title'),
			__('Status'),
			__('Actions')
		));
		?>
	</thead>
	<tbody>
		<?php foreach ($futureEvents as $event){
			$idiots = '';
			foreach ($event['EventUser'] as $user){
				$idiots .= $this->Html->image(DS . 'files' . DS . 'Portraits' . DS . $user['User']['Portrait'][0]['filename'], array('class' => join(' ', array('miniThumb', $user['status'] == 1 ? 'bgreen' : 'bred'))));
			}
			echo $this->Html->tableCells(array(
				$this->Html->tag('span' ,$event['EventType']['name'], array('style' => 'color:'.$event['EventType']['color'])),
				$this->Html->div('dtstart', strftime('%a, %d.%m.%Y %H:%M', strtotime($event['Event']['start'])), array('title' => $event['Event']['start'])),
				$this->Html->div('dtend', strftime('%a, %d.%m.%Y %H:%M', strtotime($event['Event']['end'])), array('title' => $event['Event']['end'])),
				$this->Html->div('summary', $event['Event']['title']),
				$this->Html->div('participating-idiots', $idiots),
				join('<br>', array(
					$this->Html->link(__('view'), '/admin/events/view/' . $event['Event']['id']),
					$this->Html->link(__('edit'), '/admin/events/edit/' . $event['Event']['id']),
					$this->Html->link(__('push'), '/admin/events/push/' . $event['Event']['id']),
					$this->Html->link(__('delete'), '/admin/events/delete/'. $event['Event']['id'], array('class' => ($this->Session->read('Auth.User.id') == $event['Event']['user_id']) ? '' : 'disabled'), __('Are you sure?'))
				))
			), array('class' => 'odd vevent'), 	array('class' => 'vevent'));
		}?>
	</tbody>
</table>
<?php
echo $this->element('pagination');
echo $this->element('backlink');
?>
<?php ob_start(); ?>
<script type="text/javascript">
function on_day_click(date, allDay, jsEvent, view){
	$.get('/admin/events/add/' + date.getTime() / 1000, function(response){
		$(response).dialog({
			width : 500,
			open : function(){
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
			}
		});
	});
}

$(document).ready(function(){
	$('#calendar').fullCalendar({
		firstDay : 1,
		events : '/admin/events/feed',
		dayClick : on_day_click

	});
	$('#calendar td').css({ cursor : 'pointer' });
});
</script>
<?php
$this->addScript(ob_get_contents(), false);
ob_end_clean();
?>
