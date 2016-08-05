<h1><?php echo __('Blog\'n\'Roll'); ?></h1>
<p><?php ('Read what\'s new with the Idiots. Feel free to leave comments!'); ?></p>
<ul class="item-list clearfix">
	<?php foreach ($posts as $post): ?>
		<li>
			<?php echo $this->element('blogpost', array('post' => $post)); ?>
		</li>
	<?php endforeach ?>
</ul>

<?php echo $this->element('pagination', array('name' => 'posts'))?>
