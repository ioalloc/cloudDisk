<?php

namespace App\Controller;

class signup extends \App\Page {

	public function action_index() {
		$this->login_check('signup');
	}

}
