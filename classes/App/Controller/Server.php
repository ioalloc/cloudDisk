<?php

namespace App\Controller;

class server extends \App\Service {

	protected $user;

	public function action_index() {
		if (empty($_POST)) {
			return $this->redirect('/');
		}
	}

	public function action_login()
	{
		if (empty($_POST)) {
			error_log("empty");
			return $this->redirect('/');
		}
		$e = $_POST['e'];
		$p = md5($_POST['p']);
		$user = $this->pixie->orm->get('users')
			 ->where('email',$e)
			 ->find();
		//if login success,and redirect to home
		error_log($e);
		if ($user->loaded()) {
			if ($p === $user->password) {
				session_start();
				$_SESSION['user'] = $e;
				$_SESSION['user_id'] = $user->id;
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

	public function action_signup()
	{
		if (empty($_POST)) {
			return $this->redirect('/signup');
		}else{
			$e = $_POST['e'];
			$p = md5($_POST['p']);
			if ($e === '' || $p === '') {
				return $this->redirect('/signup');
			}
			$user = $this->pixie->orm->get('users')
				 ->where('email',$e)
				 ->find();
			//if the email is exist
			if ($user->loaded()) {
				$this->returns = 'failure';
			}else{
				$user->username = $e;
				$user->password = $p;
				$user->email = $e;
				$user->save();
				session_start();
				$_SESSION['user'] = $e;
				$_SESSION['user_id'] = $user->id;
				$this->returns = 'success';
			}
		}
	}

	public function action_checkemail()
	{
		if (empty($_POST)) {
			return $this->redirect('/');
		}
		$e = $_GET['e'];
	}

	public function action_phpinfo()
	{
		phpinfo();
	}

	public function action_upload()
	{
		session_start();
		$user = array('usernsme' => $_SESSION['user'],
			'user_id' => $_SESSION['user_id']);


		$uploaddir = '/usr/share/nginx/uploads/';
		$uploadfile = $uploaddir . $user['user_id'] . '/' . basename($_FILES['file_upload']['name']);

		echo '<pre>';
		if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadfile)) {
			echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Possible file upload attack!\n";
		}

		echo 'Here is some more debugging info:';
		print_r($_FILES);

		print "</pre>";

	}

}
