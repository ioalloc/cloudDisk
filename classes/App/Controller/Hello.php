<?php

namespace App\Controller;

class Hello extends \App\Page {

	public function action_index() {
		$this->view->subview = 'hello';
		//$this->view->message = $this->pixie->orm->get('users')->where('username','wxw')->find()->username;
	}

	public function action_test()
	{
		$this->view->subview = 'hello';
		$this->view->message = 'he';
	}

}
