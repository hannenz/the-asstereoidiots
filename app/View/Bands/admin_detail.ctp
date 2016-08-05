<?php
	$a = array();
	foreach ($band['Show'] as $show){
		$a[] = $this->Html->link(strftime('%x', strtotime($show['showtime'])), '/shows/detail/'.$show['id']);
	}
?>

<h1><?php echo $band['Band']['name']?></h1>
<table>
	<tr><td>URL</td><td><?php echo $this->Html->link($band['Band']['url'], $band['Band']['url'])?></td></tr>
	<tr><td>Contact</td><td><?php echo $band['Band']['contact']?></td></tr>
	<tr><td>E-Mail</td><td><?php echo $band['Band']['email']?></td></tr>
	<tr><td>Phone</td><td><?php echo $band['Band']['phone']?></td></tr>
	<tr><td>Plays</td>
		<td>
			<ul>
				<?php foreach ($a as $b): ?>
					<li><?php echo $b; ?></li>
				<?php endforeach ?>
			</ul>
</table>

<?php echo $this->element('editdelete', array('controller' => 'bands', 'name' => $band['User']['username'], 'date' => $band['Band']['created'], 'id' => $band['Band']['id']))?>

