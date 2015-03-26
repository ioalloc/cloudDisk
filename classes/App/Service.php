<?php

namespace App;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Service extends \PHPixie\Controller {
	//protected $auth;
	protected $returns;

	public function before() {
	}

	public function after() {
		$this->response->body = $this->returns;
	}

}
