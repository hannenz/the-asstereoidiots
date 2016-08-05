<h1><?php echo __('News'); ?></h1>
<?php echo$this->Html->link(__('Add news'), '/admin/blog_posts/add', array('class' => 'button add')); ?>
<?php echo $this->element('pagination'); ?>
<table class="admin-index-table">
	<thead>
		<tr>
			<th><?php echo __('Post'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($posts as $post){
				echo $this->Html->tableCells(
					array(
						$this->Html->tag('h3', $post['BlogPost']['subject']) . $this->Html->tag('p', $this->Text->truncate($post['BlogPost']['body'], 100, array('exact' => false, 'html' => true)), array('class' => 'news-body')) . $this->Html->tag('p', join(' | ', array($this->Time->niceShort($post['BlogPost']['created']), $post['User']['name']))),
						$this->element('actions', array('id' => $post['BlogPost']['id']))
					),
					array('class' => 'odd')
				);
			}
		?>
	</tbody>
</table>
<?php echo $this->element('pagination'); ?>
<?php echo $this->element('backlink', array('admin' => true)); ?>

