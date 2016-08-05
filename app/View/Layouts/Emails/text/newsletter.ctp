<?php echo $content_for_layout; ?>

ANSTEHENDE SHOWS

<?php foreach ($upcomingShows as $show): ?>

	<?php echo strftime('%a, %d.%B %Y', strtotime($show['Show']['showtime'])); ?>

	<?php echo $show['Location']['full_name']; ?>

	<a style="color:#c00000; text-decoration:none" href="http://<?php echo env('SERVER_NAME'); ?>/shows/<?php echo $show['Show']['slug']; ?>">👉 Details</a>

	

<?php endforeach ?>

--
<?php echo strftime('%F %T'); ?> <?php echo $_SERVER['SERVER_NAME']; ?>