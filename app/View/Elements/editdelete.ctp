<?php
	if (!isset($controller)){
		if (isset($this->request->params['controller'])){
			$controller = $this->request->params['controller'];
		}
	}
	if (!isset($controller) || empty($controller)){
		$controller = '';
	}
?>


<?php if ($this->Session->check('Auth.User.id')): ?>
	<p class="editDelete">
		<?php echo __('Created by')?> <?php echo $name?>, <?php echo $this->TimeL8n->niceShort(strtotime($date))?> | id=<?php echo $id; ?> &gt;&gt; 
		<?php echo $this->Html->link("edit", array('controller' => $controller, 'action' => 'edit', $id, 'admin' => true), array('class' => 'adminLink'))?> | <?=$this->Html->link("delete", array('controller' => $controller, 'action' => 'delete', $id, 'admin' => true), array('class' => 'adminLink'), "Are you sure?")?>
	</p>
<?php endif ?>
