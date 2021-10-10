<?php

namespace IOSocial;

/**
 * The Social User model.
 */
class User
{
	public $type				= "";
	public $email				= "";
	public $user				= "";
	public $first_name	= "";
	public $last_name		= "";
}

/**
 * The Social interface.
 */
interface ISocial
{
	/**
	 * Gets an user.
	 * @param number/string $id The user id.
	 * @return json The user.
	 */
	public function Get($id);

	/**
	 * Creates an user;
	 * @param json <body> The user information.
	 */
	public function Create();

	/**
	 * Updates an user.
	 * @param number $id The user id.
	 * @param json <body> The user information.
	 */
	public function Update($id);

	/**
	 * Deletes an user.
	 * @param number $id The user id.
	 */
	public function Delete($id);

	/**
	 * Queries an user.
	 * @param json $jdata The user secret information.
	 * @return json The user.
	 */
    public function Query($jdata);
}

/**
 * The Social implementation object.
 */
class Social implements \IOSocial\ISocial
{
	private $m_name;

	public function Name($name)
	{
		$this->m_name = $name;
	}

	public function Basic()
	{
		return strlen($this->m_name) == 0 or $this->m_name == "Basic";
	}

	public function User($email, $user_name, $first_name, $last_name)
	{
		$user = new User;

		$user->type       = $this->m_name;
		$user->email      = $email;
		$user->user       = $user_name;
		$user->first_name = $first_name;
		$user->last_name  = $last_name;

		return (array)$user;
	}

	public function Get($id)
	{
		echo is_null($id) ? "List" : "Get $id";
	}

	public function Create()
	{
		echo "Create";
	}

	public function Update($id)
	{
		echo "Update $id";
	}

	public function Delete($id)
	{
		echo "Delete $id";
	}

	public function Query($jdata)
	{
		echo "Query"; print_r($jdata);
	}
}

?>