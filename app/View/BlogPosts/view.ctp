<h2><?php echo $post['BlogPost']['subject']?></h2>
<div id="postDetailBody">
	<p class="news-body"><?php echo ($post['BlogPost']['body'])?></p>
	<p class="news-meta">
		<?php echo $this->Html->image(DS . 'files' . DS . 'Portraits' . DS . $post['User']['Portrait'][0]['filename']);?>
		<?php echo $post['User']['name']?><br><?php echo $this->TimeL8n->niceShort($post['BlogPost']['created']); ?>
	</p>
</div>

<?php if ($post['User']['id'] == $this->Session->read('Auth.User.id')): ?>
	<?php echo $this->element('editdelete', array('controller' => 'blog_posts', 'name' => $post['User']['name'], 'date' => $post['BlogPost']['created'], 'id' => $post['BlogPost']['id']))?>
<?php endif ?>
<div style="clear:both"></div>
<div id="socialshareprivacy"></div>

<?php echo $this->element('comment', array('comments' => $post['Comment'], 'id' => $post['BlogPost']['id']));?>

<?php echo $this->Html->link('back', '/blog_posts/index')?>
