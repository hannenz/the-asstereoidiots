<h1><?php echo __('Comments'); ?></h1>
<?php echo $this->element('comment', array('comments' => $comments, 'id' => 0)); ?>

<?php echo $this->element('pagination'); ?>
