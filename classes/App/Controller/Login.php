<?php

namespace App\Controller;

class login extends \App\Page {

	public function action_index() {
		session_start();
		if (isset($_SESSION["user"])) {
			$this->view->subview = 'home';
			$this->view->username = $_SESSION["user"];
		}else{
			$this->view->subview = 'login';
		}
	}

}
