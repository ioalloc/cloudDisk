<?php

namespace App\Controller;

class Login extends \App\Page {

	public function action_index() {
		$this->view->subview = 'login';
		$this->view->message = $this->pixie->orm->get('users');
	}

	public function action_test()
	{
		$this->view->subview = 'hello';
		$this->view->message = 'he';
	}

}
