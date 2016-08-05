<ul>
	<? foreach ($locations as $loc): ?>
		<li><?=$loc['Location']['name']?> <?=$loc['Location']['city']?></li>
	<? endforeach ?>
</ul>
