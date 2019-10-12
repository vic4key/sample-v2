<?php

namespace Controller;

require_once "socials/socials.php";

/**
 * User APIs
 */
class Users
{
	public function Get($id)
	{
		$auth = \Auth\Authorization();
		$payload = \Auth\Decode($auth);

		$user = \IOSocial\Socials::Instance()->Create($payload->data->social)->Get($id);
		if ($user == null)
		{
			return \Flight::status(204);
		}

		return \Flight::json($user);
	}

	public function Update($id)
	{
		$result = array();

		$result["message"] = "Users -> Update $id";

		\Flight::json($result);
	}

	public function Delete($id)
	{
		$result = array();

		$result["message"] = "Users -> Delete $id";

		\Flight::json($result);
	}
}

?>