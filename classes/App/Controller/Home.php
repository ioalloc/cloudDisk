<?php

namespace App\Controller;

class home extends \App\Page {

	public function action_index() {
		$this->login_check('login');
	}

}
