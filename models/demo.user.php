<?php

namespace Models;

class User
{
	public $id  		= -1;
	public $social		= "";
	public $name		= "";
	# public $pass		= "";
	public $email		= "";
	public $first_name	= "";
	public $last_name	= "";
	public $age			= -1;

	public static function sql()
	{
		return "`id`, `social`, `name`, `email`, `first_name`, `last_name`, `age`";
	}
}

?>