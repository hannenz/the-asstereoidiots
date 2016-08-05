<?php
	if (!isset($controller)){
		if (isset($this->request->params['controller'])){
			$controller = $this->request->params['controller'];
		}
	}
	if (!isset($admin)){
		$admin = false;
	}
	if (!isset($action)){
		$action = 'index';
	}
	echo $this->Html->link(__('back'), array(
			'controller' => $controller,
			'action' => $action,
			'admin' => $admin
		), array('class' => 'button back')
	);
?>
