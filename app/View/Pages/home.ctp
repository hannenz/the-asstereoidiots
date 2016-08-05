<!--h1>Willkommen auf Planet Rock'n'Roll</h1-->

<?php
	// echo $this->Html->tag('div', $this->Html->image('band.jpg'), array('id' => 'bandfoto'));
	//echo $this->Html->tag('div', $this->Html->image('FlyerTram_HP.jpg', array('url' => '/tram')), array('id' => 'tram'));
#	echo $this->Html->tag('div', $this->Html->image('/tram/img/Flyer_Hemp.jpg'), array('id' => 'hemp'));
	echo $this->Html->tag('div', '', array('class' => 'spacer'));
?>

<!--h2>Latest News</h2-->
<ul class="item-list clearfix">
	<?php foreach ($latest_news as $post){
		echo $this->Html->tag('li', $this->element('blogpost', array('post' => $post)));
	}
	?>
</ul>
<?php echo $this->Html->tag('p', $this->Html->link(__('Read all news'), '/blog_posts/'));?>
