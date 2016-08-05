<h2><?php echo $band['Band']['name']; ?></h2>
<dl class="clearfix admin">
	<?php
		echo $this->Html->tag('dt', __('Website'));
		echo $this->Html->tag('dd', $this->Html->link($band['Band']['url'], $band['Band']['url']));
		echo $this->Html->tag('dt', __('Contact'));
		echo $this->Html->tag('dd', $band['Band']['contact']);
		echo $this->Html->tag('dt', __('E-Mail'));
		echo $this->Html->tag('dd', $band['Band']['email']);
		echo $this->Html->tag('dt', __('Phone'));
		echo $this->Html->tag('dd', $band['Band']['phone']);
		echo $this->Html->tag('dt', __('Genre'));
		echo $this->Html->tag('dd', $band['Band']['genre']);
		echo $this->Html->tag('dt', __('Comment'));
		echo $this->Html->tag('dd', $band['Band']['comment']);

		echo $this->Html->tag('dt', __('Created'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($band['Band']['created'])));
		echo $this->Html->tag('dt', __('Modified'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($band['Band']['modified'])));
		echo $this->Html->tag('dt', __('User'));
		echo $this->Html->tag('dd', $band['User']['name']);
	?>
</dl>
<?php if (count($band['Show']) > 0):?>
	<h2><?php echo __('Shows'); ?></h2>
	<ul class="item-list clearfix">
		<?php
		foreach ($band['Show'] as $show){
			echo $this->Html->tag('li', $this->element('show', array('show' => $show)));
		}
		?>
	</ul>
<?php endif ?>

<ul class="actions">
	<?php
		echo $this->Html->tag('li', $this->Html->link(__('back'), '/admin/bands/index'));
		echo $this->Html->tag('li', $this->Html->link(__('edit'), '/admin/bands/edit/' . $band['Band']['id']));
		echo $this->Html->tag('li', $this->Html->link(__('delete'), '/admin/bands/edit/' . $band['Band']['id'], array(), __('Are you sure?')));
	?>
</ul>
