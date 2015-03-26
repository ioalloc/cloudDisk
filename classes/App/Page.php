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

}
