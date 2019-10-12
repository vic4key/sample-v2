<?php

namespace IOSocial;

require_once "basic.php";
require_once "curl.php";

class Facebook extends \IOSocial\Basic
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

		$access_token = $jdata->accessToken;

		if ($access_token == "")
		{
			return null;
		}

		$me = cURL(
			"GET",
			"https://graph.facebook.com/v4.0/me?fields=id,email,first_name,last_name&access_token={$access_token}"
		);

		$me = json_decode($me);

		if (empty($me))
		{
		  return null;
		}

		$user = $this->User($me->first_name, $me->last_name, $me->email);

		return a2j($user);
	}
}

?>