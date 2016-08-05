<?php
/*
	debug ($show);die();
*/
?>
<dl class="clearfix admin">
	<?php
		$bands = array();
		foreach ($show['Band'] as $band){
			$bands[] = $this->Html->link($band['name'], '/admin/bands/view/' . $band['id']);
		}
		echo $this->Html->tag('dt', __('Showtime'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($show['Show']['showtime'])));
		echo $this->Html->tag('dt', __('Location'));
		echo $this->Html->tag('dd', $this->Html->link($show['Location']['full_name'], '/admin/locations/view/'.$show['Location']['id']));
		echo $this->Html->tag('dt', __('Bands'));
		echo $this->Html->tag('dd', $this->Text->toList($bands));
		echo $this->Html->tag('dt', __('Rating'));
		echo $this->Html->tag('dd', $this->element('rating', array('plugin' => 'rating', 'model' => 'Show', 'id' => $show['Show']['id'])));
		echo $this->Html->tag('dt', __('Bill'));
		echo $this->Html->tag('dd', $this->Html->image($show['Bill'][0]['icon'], array('class' => 'thumbnail')));
		if (isset($show['Album']['id'])){
			echo $this->Html->tag('dt', __('Album'));
			echo $this->Html->tag('dd', $this->element('albumteaser', array('album' => $show['Album'])));
		}
		if (isset($show['Setlist']['id'])){
			echo $this->Html->tag('dt', __('Setlist'));
			echo $this->Html->tag('dd', $this->element('setlist', array('setlist' => $show['Setlist']['Songlist'])));
			echo $this->Html->tag('dt', __('Setlist public'));
			echo $this->Html->tag('dd', $show['Show']['setlist_public'] ? __('yes') : __('no'));
		}
		echo $this->Html->tag('dt', __('Created'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($show['Show']['created'])));
		echo $this->Html->tag('dt', __('Modified'));
		echo $this->Html->tag('dd', strftime('%x', strtotime($show['Show']['modified'])));
		echo $this->Html->tag('dt', __('User'));
		echo $this->Html->tag('dd', $show['User']['name']);
	?>
</dl>

<ul class="actions">
	<?php
		echo $this->Html->tag('li', $this->Html->link(__('back'), '/admin/shows/index'));
		echo $this->Html->tag('li', $this->Html->link(__('edit'), '/admin/shows/edit/' . $show['Show']['id']));
		echo $this->Html->tag('li', $this->Html->link(__('delete'), '/admin/shows/edit/' . $show['Show']['id'], array(), __('Are you sure?')));
	?>
</ul>
