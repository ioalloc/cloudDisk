<?php

namespace App\Controller;

class server extends \App\Service {

	public function action_index() {
	}

	public function action_login()
	{
		$u = $_POST['u'];
		$p = md5($_POST['p']);
		$user = $this->pixie->orm->get('users')
			 ->where('username',$u)
			 ->find();
		//if login success,and redirect to home
		if ($user->loaded()) {
			if ($p == $user->password) {
				$this->returns = 'success';
				session_start();
				$_SESSION['user'] = $u;
				error_log(implode($_SESSION));
			}
		}
	}

	public function action_checkname()
	{
		$u = $_GET['u'];
	}

}
