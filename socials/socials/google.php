<?php

namespace IOSocial;

require_once "basic.php";

class Google extends \IOSocial\Basic
{
	public function __construct($config)
	{
		# DO NOTHING
	}

	public function Query($jdata)
	{
		if ($jdata == null)
		{
			return null;
		}

		$token_type   = $jdata->token_type;
		$access_token = $jdata->access_token;

		if ($token_type == "" or $access_token == "")
		{
			return null;
		}

		$me = cURL(
			"GET",
			"https://www.googleapis.com/oauth2/v3/userinfo",
			array("Authorization: {$token_type} {$access_token}")
		);

		$me = json_decode($me);

		if (empty($me))
		{
		  return null;
		}

		$user = $this->User($me->email, $me->user, $me->given_name, $me->family_name);

		return a2j($user);
	}
}

?>