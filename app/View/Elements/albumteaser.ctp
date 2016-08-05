<div>
	<h3><?php echo $this->Html->link($album['Album']['name'], '/albums/view/'.$album['Album']['id'])?></h3>
	<p>
		<? if (isset($album['Show']['showtime'])){
			echo strftime('%x', strtotime($album['Show']['showtime']));
			echo " ";
			echo $album['Show']['Location']['full_name'];
		}
		?>
	</p>

	<ul class="hgallery">
	<?php
		foreach ($album['Picture'] as $picture){
			echo $this->Html->tag('li',
				$this->Html->image($picture['files']['thumb'], array(
					'url' => $picture['files']['full'],
					//~ 'title' => $picture['name'],
				))
			);
		}
		?>
	</ul>

</div>
