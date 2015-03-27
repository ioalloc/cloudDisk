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
			if ($p === $user->password) {
				session_start();
				$_SESSION['user'] = $u;
				$this->returns = 'success';
			}
		}else{
			$this->returns = 'failure';
		}
	}

	public function action_logout()
	{
		session_start();
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
			$this->returns = 'success';
		}
	}

	public function action_checkname()
	{
		$u = $_GET['u'];
	}

}
