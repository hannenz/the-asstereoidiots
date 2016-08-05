<?php
$settings = Configure::read('settings');
if (!isset($model)) {
	$model = Inflector::singularize($this->name);
}
if (in_array($model, $settings['Setting']['enable_comments']) || $model == 'Comment'):
?>

<ul class="item-list">
	<?php foreach ($comments as $comment): ?>
		<li>
			<div class="list-item-image"><?php echo $this->Html->image('comment.png'); ?></div>
			<div class="list-item-content">
				<p class="news-body"><?php echo $comment['body']; ?></p>
				<p class="news-meta"><?php echo $this->TimeL8n->niceShort($comment['created']); ?> | <?php echo $comment['name']; ?></p>
				<?php echo $this->element('editdelete', array('controller' => 'comments', 'id' => $comment['id'], 'date' => $comment['created'], 'name' => $comment['name']));?>
			</div>
		</li>
	<?php endforeach ?>

</ul>

	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Session->flash('email'); ?>

	<?php
		$form_id = 'CommentAddForm_' . $id;
//		echo $validation->bind('Comment', array('formId' => $form_id));
		echo $this->Form->create('Comment', array('action' => 'add', 'id' => $form_id));
	?>
	<fieldset>
		<legend><?php echo __('Leave a comment'); ?></legend>
		<?php echo $this->Form->input('model', array('type' => 'hidden', 'value' => $model)); ?>
		<?php echo $this->Form->input('foreign_key', array('type' => 'hidden', 'value' => $id)); ?>
		<?php
			$name = '';
			$email = '';
			$captcha = '';
			if ($this->Session->check('Auth.User.id')){
				$name = $this->Session->read('Auth.User.name');
				$email = $this->Session->read('Auth.User.email');
				$captcha = 'The Asstereoidiots';
			}
			echo $this->Form->input('name', array('label' => __('Your name'), 'value' => $name));
			echo $this->Form->input('email', array('label' => __('Your E-Mail'), 'value' => $email));
			echo $this->Form->input('body', array('label' => __('Your Comment')));
			echo $this->Recaptcha->show(array(
				'theme' => 'white',
				'lang' => substr(Configure::read('Config.language'), 0, 2)
			));
		?>
		<?php echo $this->Form->submit(__('submit')); ?>
	</fieldset>
	<?php echo $this->Form->end(); ?>
<?php endif; ?>
