<ul>
<?php
foreach ($songs as $song){
	echo $this->Html->tag('li', $this->Html->link($song['Song']['title'], '/songs/view/' . $song['Song']['id']));
}
?>
</ul>
