<?php

namespace App\Controller;

use App\Page;

class login extends Page {

	public function action_index() {
		$this->login_check('login');
	}

}
