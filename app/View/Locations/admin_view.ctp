<h2><?php echo $location['Location']['name']; ?></h2>
<dl class="clearfix admin">
	<?php
		echo $this->Html->tag('dt', __('Address'));
		echo $this->Html->tag('dd',
			$this->Html->tag('p', join('<br>', array(
				$location['Location']['address1'],
				$location['Location']['address2'],
				$location['Location']['full_city']
			)))
		);

		echo $this->Html->tag('dt', __('Contact'));
		echo $this->Html->tag('dd', $location['Location']['contact']);
		echo $this->Html->tag('dt', __('E-Mail'));
		echo $this->Html->tag('dd', $location['Location']['email']);
		echo $this->Html->tag('dt', __('Phone'));
		echo $this->Html->tag('dd',
			$this->Html->tag('p', join('<br>', array(
				$location['Location']['phone1'],
				$location['Location']['phone2']
			)))
		);
		echo $this->Html->tag('dt', __('Created'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($location['Location']['created'])));
		echo $this->Html->tag('dt', __('Modified'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($location['Location']['modified'])));
		echo $this->Html->tag('dt', __('User'));
		echo $this->Html->tag('dd', $location['User']['name']);
	?>
</dl>
<h2><?php echo __('Shows'); ?></h2>
<ul class="item-list clearfix">
	<?php
	foreach ($location['Show'] as $show){
		echo $this->Html->tag('li', $this->element('show', array('show' => $show)));
	}
	?>
</ul>

<ul class="actions">
	<?php
		echo $this->Html->tag('li', $this->Html->link(__('back'), '/admin/locations/index'));
		echo $this->Html->tag('li', $this->Html->link(__('edit'), '/admin/locations/edit/' . $location['Location']['id']));
		echo $this->Html->tag('li', $this->Html->link(__('delete'), '/admin/locations/delete/' . $location['Location']['id'], array(), __('Are you sure?')));
	?>
</ul>
