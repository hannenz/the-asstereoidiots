<h1><?php echo $post['BlogPost']['subject']?></h1>
<?php echo $this->Html->image('/img/faces/'.$post['User']['face'], array('class' => 'detailImage'))?>
<div id="postDetailBody">
	<p class="news-body"><?php echo nl2br($post['BlogPost']['body'])?></p>
	<p class="news-meta"><?php echo $post['User']['name']?> | <?php echo $this->TimeL8n->niceShort($post['BlogPost']['created']); ?></p>
</div>

<?php if ($post['User']['id'] == $this->Session->read('Auth.User.id')): ?>
	<?php echo $this->element('editdelete', array('controller' => 'blog_posts', 'name' => $post['User']['name'], 'date' => $post['BlogPost']['created'], 'id' => $post['BlogPost']['id']))?>
<? endif ?>
<div style="clear:both"></div>

<?php echo $this->element('comment', array('comments' => $post['Comment'], 'id' => $post['BlogPost']['id']));?>

<?php echo $this->Html->link('back', '/blog_posts/index')?>
