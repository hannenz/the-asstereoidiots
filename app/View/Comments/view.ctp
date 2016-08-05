<h1><?php echo __('Comment'); ?></h1>
<p class="news-body"><?php echo nl2br($comment['Comment']['body']); ?></p>
<p class="news-meta"><?php echo $comment['Comment']['name']; ?> <?php if ($this->Session->check('Auth.User.id')) echo '(' . $this->Html->link($comment['Comment']['email'], 'mailto:' . $comment['Comment']['email']) . ')'; ?>| <?php echo $this->TimeL8n->niceShort($comment['Comment']['created']); ?></p>

<?php echo $this->element('editdelete', array('controller' => 'comments', 'id' => $comment['Comment']['id'], 'name' => $comment['Comment']['name'], 'date' => $comment['Comment']['created'])); ?>

<?php echo $this->element('backlink'); ?>
