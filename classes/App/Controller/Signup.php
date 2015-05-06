<?php

namespace App\Controller;

use App\Page;

class signup extends Page {

	public function action_index() {
		$this->login_check('signup');
	}

}
