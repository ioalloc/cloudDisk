<?php

namespace App\Controller;

class signup extends \App\Page {

	public function action_index() {
		session_start();
		error_log(implode($_SESSION));
		if (isset($_SESSION["user"])) {
			$this->view->subview = 'home';
			$this->view->username = $_SESSION["user"];
		}else{
			$this->view->subview = 'signup';
		}
	}

}
