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
		$id = strtolower($id);

		if ($id === "me")
		{
			$auth = \Auth\Authorization();
			if (strlen($auth) == 0)
			{
				return \Flight::status(401); # 'Unauthorized'
			}

			$payload = \Auth\Decode($auth);
			if ($payload == null)
			{
				return \Flight::status(401); # 'Unauthorized'
			}

			return \Flight::json($payload);
		}

		$has_valid_user_id = is_numeric($id);

		$sql  = \Models\User::serialize();
		$sql  = "SELECT {$sql} FROM `tbl_user`";
		$sql .= $has_valid_user_id ? " WHERE `id` = $id" : "";

		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");
		if (count($users) == 0)
		{
			return \Flight::status(204); # 'No Content'
		}

		return \Flight::json($has_valid_user_id ? $users[0] : $users);
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

	public function Signup()
	{
		$data = \Flight::request()->getBody();
		echo "Sign Up <$data>";
	}

	public function Signin($name = null, $pass = null)
	{
		$auth = \Auth\Authorization();
		if (strlen($auth) != 0)
		{
			return \Flight::status(208); # 'Already Reported'
		}

		$result = array();

		$result["message"] = "Incorrect sign-in information";

		$social = \Flight::request()->data->social;
		$data   = \Flight::request()->data->data;
		$jdata  = a2j($data);

		$signer = \IOSocial\Socials::Instance()->Create($social);
		$juser = $signer->Query($jdata);

		if ($juser == null)
		{
			return \Flight::json($result);
		}

		$result["user"] = $juser;

		$auth = \Auth\Authorize($result["user"]);
		$cage = $GLOBALS["server"]["cage"];
		header("Set-Cookie: Authorization=$auth; Max-Age=$cage; path=/; httpOnly");

		$result["message"] = "Signed-in Successfully";

		\Flight::json($result);
	}

	public function Signout()
	{
		$result = array();

		$auth = \Auth\Authorization();
		if (strlen($auth) == 0)
		{
			return \Flight::status(401); # 'Unauthorized'
		}

		$payload = \Auth\Decode($auth);
		if ($payload == null)
		{
			return \Flight::status(401); # 'Unauthorized'
		}

		header("Set-Cookie: Authorization=\"\"; Max-Age=0; path=/; httpOnly");

		$result["message"] = "Signed-out Successfully";

		\Flight::json($result);
	}
}

?>