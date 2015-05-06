<?php

namespace App;
use PHPixie\Controller;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Service extends Controller {
	//protected $auth;
	protected $returns;

	public function before() {
        session_start();
        if(!isset($_SESSION)){
            $this->redirect('/');
        }
	}

	public function after() {
		$this->response->body = $this->returns;
	}

}
