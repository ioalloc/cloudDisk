<?php

namespace App\Controller;

use App\Service;

class server extends Service {

    protected $upload_dir = '/usr/share/nginx/uploads/';

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
		if ($user->loaded()) {
			if ($p === $user->password) {
				$_SESSION['user'] = $e;
				$_SESSION['user_id'] = $user->id;
                $_SESSION['user_dir'] = '/';
				$this->returns = 'success';
			}
		}else{
			$this->returns = 'failure';
		}
	}

	public function action_logout()
	{

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
                mkdir($this->upload_dir.$res->id);
				$_SESSION['user'] = $e;
				$_SESSION['user_id'] = $user->id;
                $_SESSION['user_dir'] = '/';
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

    /**
     * @return string|void
     */
    public function action_upload()
	{
        if (empty($_FILES)) {
            return $this->redirect('/');
        }

		$uploadfile = $_SESSION['user_dir'] . basename($_FILES['file_upload']['name']);

        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadfile)) {



            $user_id = $_SESSION['user_id'];
            $file_name = basename($_FILES['file_upload']['name']);
            $file_type = $_FILES['file_upload']['type'];
            $upload_time = date("Y-m-d G:i:s");
            $modify_time = $upload_time;
            $file_path = $_SESSION['user_dir'];
            $file_size = $_FILES['file_upload']['size'];

            $this->user->size_used += $file_size;
            $this->user->save();

            $this->files->user_id = $user_id;
            $this->files->filename = $file_name;
            $this->files->filetype = $file_type;
            $this->files->uploadtime = $upload_time;
            $this->files->modifytime = $modify_time;
            $this->files->path = $file_path;
            $this->files->size = $file_size;
            $result = $this->files->save();
            return "File is valid, and was successfully uploaded.\n";
        } else {
            return "Possible file upload attack!\n";
        }

    }

    public function action_download(){
        if(isset($_SESSION['files'])){
            //download files
            $new_name = $file_name = $_SESSION['files'];
            $download_rate = 10000;  //kb
            if(file_exists($file_name) && is_file($file_name))
            {
                header('Content-Description: File Transfer');//if download file
                header('Cache-control: private');
                header('Content-Type: application/force-download');
                header('Content-Length: '.filesize($file_name));
                header('Content-Disposition: attachment; filename='.$new_name);

                flush();
                $file = fopen($file_name, "r");
                while(!feof($file))
                {
                    // send the current file part to the browser
                    print fread($file, round($download_rate * 1024));
                    // flush the content to the browser
                    flush();
                    // sleep one second
                    sleep(1);
                }
                fclose($file);
            }
            else {
                die('Error: The file '.$file_name.' does not exist!');
            }

            unset($_SESSION['files']);
        }else{
            //get post data and return files ready
            if (empty($_POST)) {
                return $this->redirect('/');
            }
            $files = $_POST['files'];
            $_SESSION['files'] = $_SESSION['user_dir'] . $files[0];
            var_dump($_SESSION);
        }

    }

    public function action_delete(){
        if (empty($_POST)) {
            return $this->redirect('/');
        }
        var_dump($_POST);
    }

    /**
     *
     */
    public function action_getdir(){
        if (empty($_POST)) {
            return $this->redirect('/');
        }
        if(isset($_SESSION['user'])) {
            $_SESSION['user_dir'] = $this->upload_dir . $_SESSION['user_id'] . $_POST['dir'];
            $dir = $_SESSION['user_dir'] . '*';
            $res = glob($dir);
            $filelist = array();
            $fileinfo = array();
            foreach ($res as $file) {
                $fileinfo['name'] = basename($file);
                $fileinfo['type'] = filetype($file);
                $fileinfo['size'] = $this->formatBytes(filesize($file));
                $fileinfo['time'] = date('Y-m-d H:i:s', filectime($file));
                $fileinfo['extension'] = $icon = pathinfo($file, PATHINFO_EXTENSION);
                $icon = '/usr/share/nginx/cloudDisk/web/icon/' . $icon . '.svg';
                $fileinfo['icon'] = (basename(implode(glob($icon))) == '')?'blank.svg':basename(implode(glob($icon)));
                array_push($filelist, $fileinfo);
            }
            echo json_encode($filelist);
            //print_r($filelist);

        }
    }

    public function action_createdir(){
        if(isset($_SESSION['user'])){
            mkdir($_SESSION['user_dir'] . $_POST['dir']);
        }else{
        }
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('', 'k', 'M', 'G', 'T');

        return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
    }

}
