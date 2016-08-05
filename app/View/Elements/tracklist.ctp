<table class="tracklist">
	<?php foreach ($tracklist as $track):?>
	<tr id="songs_<?php echo $track['Track']['id']; ?>">
		<td class="trackPos"><?php echo $track['Tracklist']['pos']; ?></td>
		<td class="trackTitle"><?php echo $track['Track']['Song']['title']; ?></td>
	</tr>
	<?php endforeach ?>
</table>
