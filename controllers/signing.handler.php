<?php

namespace Controller;

require_once "socials/socials.php";

/**
 * Signing Up/In/Out APIs
 */
class Signing
{
	public function SignUp()
	{
		$result = array();

		$result["message"] = "Sign Up Unavailable";

		\Flight::json($result);
	}

	public function SignIn($name = null, $pass = null)
	{
		$auth = \Auth\Authorization();
		if (strlen($auth) != 0)
		{
			return \Flight::status(208);
		}

		$result = array();

		$result["message"] = "Incorrect sign-in information";

		$social = \Flight::request()->data->social;
		$data   = \Flight::request()->data->data;
		$jdata  = a2j($data);

		$signer = \IOSocial\Socials::Instance()->Create($social);
		$user = $signer->Query($jdata);

		if ($user == null)
		{
			return \Flight::json($result);
		}

		$result["user"] = $user;

		$auth = \Auth\Authorize($result["user"]);
		$cage = $GLOBALS["server"]["cage"];
		header("Set-Cookie: Authorization=$auth; Max-Age=$cage; path=/; httpOnly");

		$result["message"] = "Signed-in Successfully";

		\Flight::json($result);
	}

	public function SignOut()
	{
		$result = array();

		$auth = \Auth\Authorization();
		if (strlen($auth) == 0)
		{
			return \Flight::status(401);
		}

		$payload = \Auth\Decode($auth);
		if ($payload == null)
		{
			return \Flight::status(401);
		}

		header("Set-Cookie: Authorization=\"\"; Max-Age=0; path=/; httpOnly");

		$result["message"] = "Signed-out Successfully";

		\Flight::json($result);
	}
}

?>