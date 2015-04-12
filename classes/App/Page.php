<?php

namespace App;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Page extends \PHPixie\Controller {
	//protected $auth;
	protected $view;

	public function before() {
		$this->view = $this->pixie->view('main');
	}

	public function after() {
		$this->response->body = $this->view->render();
	}

	public function login_check($action='login')
	{
		session_start();
		if (isset($_SESSION["user"])) {
			$this->view->subview = 'home';
			$this->view->username = $_SESSION["user"];
		}else{
			$this->view->subview = $action;
		}

	}

}
