<?php
	$a = array();
	foreach ($location['Show'] as $show){
		$a[] = $this->Html->link(date('d.m.Y', strtotime($show['showtime'])), '/shows/detail/'.$show['id']);
	}
?>
<h1><?=$location['Location']['name']?></h1>
<table>
	<tr><th>Address</th><td><?=$location['Location']['address1']?><br /><?=$location['Location']['address2']?></td></tr>
	<tr><th>City</th><td><?=$location['Location']['country']?>-<?=$location['Location']['zip']?> <?=$location['Location']['city']?></td></tr>
	<tr><th>Homepage</th><td><?=$this->Html->link($location['Location']['url'], $location['Location']['url'])?></td></tr>
	<tr><th>Contact</th><td><?=$location['Location']['contact']?></td></tr>
	<tr><th>E-Mail</th><td><?=$this->Html->link($location['Location']['email'], 'mailto:'.$location['Location']['email'])?></td></tr>
	<tr><th>Phone</th><td><?=$location['Location']['phone1']?><br /><?=$location['Location']['phone2']?></td></tr>
	<tr><th>Shows</th>
		<td>
			<ul>
				<? foreach ($a as $b): ?>
					<li><?=$b?></li>
				<? endforeach ?>
			</ul>
		</td>
	</tr>
</table>

<?=$this->element('editdelete', array('controller' => 'locations', 'name' => $location['User']['username'], 'date' => $location['Location']['created'], 'id' => $location['Location']['id']))?>
