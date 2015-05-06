<?php

namespace App;
use PHPixie\Controller;

/**
 * Base controller
 *
 * @property-read \App\Pixie $pixie Pixie dependency container
 */
class Service extends Controller {
	//protected $auth;
	protected $returns;
    protected $user;
    protected $files;

    public function before() {
        session_start();
        if(!isset($_SESSION)){
            $this->redirect('/');
        }
        $this->user = $this->pixie->orm->get('users')
            ->where('id',$_SESSION['user_id'])
            ->find();
        $this->files = $this->pixie->orm->get('files');
    }

	public function after() {
		$this->response->body = $this->returns;
	}

}
