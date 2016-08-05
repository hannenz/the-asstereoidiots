<?php
	if (!isset($controller)){
		if (isset($this->request->params['controller'])){
			$controller = $this->request->params['controller'];
		}
	}
	echo join ('<br>', array(
//		$this->Html->link(__('view'), array('controller' => $controller, 'action' => 'view', $id, 'admin' => true)),
		$this->Html->link(__('edit'), array('controller' => $controller, 'action' => 'edit', $id, 'admin' => true)),
		$this->Html->link(__('delete'), array('controller' => $controller, 'action' => 'delete', $id, 'admin' => true), array(), __('Are you sure?')),
	));
?>
