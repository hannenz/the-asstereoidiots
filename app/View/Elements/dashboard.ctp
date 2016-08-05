
<div class="db-block">
	<h2><?php echo __('Shows'); ?></h2>
	<ul>
		<?php
			echo $this->Html->tag('li', $this->Html->link(__('Shows'), '/admin/shows/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Locations'), '/admin/locations/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Bands'), '/admin/bands/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Setlists'), '/admin/setlists/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Statistics'), '/admin/shows/stats'));
		?>
	</ul>
</div>
<div class="db-block">
	<h2><?php echo __('News'); ?></h2>
	<ul>
		<?php
			echo $this->Html->tag('li', $this->Html->link(__('News'), '/admin/blog_posts/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Send Newsletter'), '/admin/subscribers/compose'));
			echo $this->Html->tag('li', $this->Html->link(__('Newsletter subscribers'), '/admin/subscribers/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Comments'), '/admin/comments/index'));
		?>
	</ul>
</div>
<div class="db-block">
	<h2><?php echo __('Media'); ?></h2>
	<ul>
		<?php
			echo $this->Html->tag('li', $this->Html->link(__('Releases'), '/admin/releases/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Songs'), '/admin/songs/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Tracks'), '/admin/tracks/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Playlist'), '/admin/playlists/edit/1'));
			echo $this->Html->tag('li', $this->Html->link(__('Videos'), '/admin/videos/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Albums'), '/admin/albums/index'));
		?>
	</ul>
</div>
<div class="db-block">
	<h2><?php echo __('Misc'); ?></h2>
	<ul>
		<?php
			echo $this->Html->tag('li', $this->Html->link(__('Messages'), '/messages/inbox'));
			echo $this->Html->tag('li', $this->Html->link(__('Calendar'), '/admin/events/index'));
			echo $this->Html->tag('li', $this->Html->link(__('User Settings'), '/admin/users/settings'));
			echo $this->Html->tag('li', $this->Html->link(__('Website Settings'), '/admin/settings/edit/1'));
			echo $this->Html->tag('li', $this->Html->link(__('Links'), '/admin/links/index'));
			echo $this->Html->tag('li', $this->Html->link(__('Logout'), '/admin/users/logout'));
		?>
	</ul>
</div>
