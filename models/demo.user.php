<?php

namespace Models;

class User
{
	public $id  				= -1;
	public $social			= "";
	public $user				= "";
	public $pass				= "";
	public $email				= "";
	public $first_name	= "";
	public $last_name		= "";
	public $age					= -1;

	public static function serialize()
	{
		return "`id`, `social`, `user`, `email`, `first_name`, `last_name`, `age`";
	}
}

?>