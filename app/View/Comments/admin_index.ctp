<?php
	echo $this->Html->tag('h1', __('Comments'));
	echo $this->element('pagination');
?>
<table class="admin-index-table">
	<thead>
		<?php echo $this->Html->tableHeaders(
			array(
				__('Comment'),
				$this->Paginator->sort(__('Model'), 'Comment.model'),
				$this->Paginator->sort(__('Approved'), 'Comment.approved'),
				__('Actions')
			)
		);
		?>
	</thead>
	<tbody>
		<?php foreach ($comments as $comment){
			echo $this->Html->tableCells(
				array(
					$this->Html->tag('p', $this->Text->truncate(nl2br($comment['Comment']['body'])), array('class' => 'news-body')) . $this->Html->tag('p', join(' | ', array($this->TimeL8n->niceShort($comment['Comment']['created']), $comment['Comment']['name'])), array('class' => 'news-meta')),
					$comment['Comment']['model'],
					$this->Html->link($comment['Comment']['approved'] ? __('yes') : __('no'), '/admin/comments/toggle_approved/' . $comment['Comment']['id']),
					$this->element('actions', array('id' => $comment['Comment']['id']))
				),
				array('class' => 'odd')
			);
		}
		?>
	</tbody>
</table>
<?php
	echo $this->element('pagination');
	echo $this->element('backlink', array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
?>
