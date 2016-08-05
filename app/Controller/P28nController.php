<?php
class P28nController extends AppController {
    var $name = 'P28n';
    var $uses = null;

	function foo($bar){
		$this->Cookie->write('foo', $bar, false, '3 hours');
		$this->redirect('/');
	}

    function change($lang = null) {
		if ($lang != null && strlen($lang) == 3){
			Configure::write('Config.language', $lang);
			$this->Cookie->write('the-language', $lang, false);
	        $this->redirect($this->referer(null, true));
		}
    }

    function shuntRequest() {
        $this->P28n->change($this->request->params['lang']);
        $args = func_get_args();
        $this->redirect("/" . implode("/", $args));
    }
}
?>
