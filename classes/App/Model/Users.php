<?php

namespace App\Model;

class Users extends \PHPixie\ORM\Model{
	public $table = 'users';
	public $id_field = 'id';

	public function get($value='')
	{
		return $value;
	}
}

?>