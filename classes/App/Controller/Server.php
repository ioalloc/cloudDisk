<?php

namespace App\Controller;

use App\Service;

class server extends Service {

	protected $user;
    protected $uploaddir = '/usr/share/nginx/uploads/';

	public function action_index() {
		if (empty($_POST)) {
			return $this->redirect('/');
		}
	}

	public function action_login()
	{
		if (empty($_POST)) {
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

    /**
     *
     */
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
				$res=$user->save();
                mkdir($this->uploaddir.$res->id);
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
        return 'ee';
	}

	public function action_phpinfo()
	{
		phpinfo();
	}

	public function action_upload()
	{
		session_start();
		$user = array('username' => $_SESSION['user'],
			'user_id' => $_SESSION['user_id']);


		$uploadfile = $this->uploaddir . $user['user_id'] . '/' . basename($_FILES['file_upload']['name']);

		echo '<pre>';
		if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadfile)) {
			echo "File is valid, and was successfully uploaded.\n";
		} else {
			echo "Possible file upload attack!\n";
		}

		echo 'Here is some more debugging info:';
		print_r($_FILES);

		echo "</pre>";

	}

    /**
     *
     */
    public function action_getdir(){
        session_start();
        if(isset($_SESSION['user'])) {
            $dir = $this->uploaddir . $_SESSION['user_id'] . $_POST['dir'] . '*';
            $res = glob($dir);
            $filelist = array();
            $fileinfo = array();
            foreach ($res as $file) {
                $fileinfo['name'] = basename($file);
                $fileinfo['type'] = filetype($file);
                $fileinfo['size'] = $this->formatBytes(filesize($file));
                $fileinfo['time'] = date('Y-m-d H:i:s', filectime($file));
                $fileinfo['extension'] = pathinfo($file, PATHINFO_EXTENSION);
                array_push($filelist, $fileinfo);
            }
            echo json_encode($filelist);
            //print_r($filelist);
        }
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

}
