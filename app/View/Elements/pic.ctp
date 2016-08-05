<div id="pic-wrap">
	<?php echo $this->Html->image('gallery' . DS . $pic['Pic']['filename']); ?>
	<?php if ($prev['Pic']['id'] > 0) echo $this->Html->link(__('previous'), '/pics/view/'.$prev['Pic']['id'], array('id' => 'prev-pic', 'class' => 'pic-nav')); ?>
	<?php if ($next['Pic']['id'] > 0) echo $this->Html->link(__('next'), '/pics/view/'.$next['Pic']['id'], array('id' => 'next-pic', 'class' => 'pic-nav')); ?>
</div>
<?php echo $this->element('editdelete', array('id' => $pic['Pic']['id'], 'name' => $pic['User']['name'], 'date' => $pic['Pic']['created'])); ?>
<?php echo $this->element('comment', array('comments' => $pic['Comment'], 'id' => $pic['Pic']['id'])); ?>
