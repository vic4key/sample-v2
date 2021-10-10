<?php

namespace IOSocial;

require_once "basic.php";

class GitHub extends \IOSocial\Basic
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

		# curl https://api.github.com/user -H "Authorization: <token_type> <access_token>"
		# Eg. curl https://api.github.com/user -H "Authorization: bearer gho_..."

		$me = cURL(
			"GET",
			"https://api.github.com/user",
			array("Authorization: {$token_type} {$access_token}")
		);

		$me = json_decode($me);

		if (empty($me))
		{
		  return null;
		}

		$parts  = explode(' ', $me->name);
		$nparts = count($parts);
		if ($nparts < 2)
		{
		    $me->first_name = $name;
		    $me->last_name  = "";
		}
		else
		{
		    $me->first_name = $parts[0];
		    $me->last_name  = $parts[$nparts - 1];
		}

		$user = $this->User($me->email, $me->login, $me->first_name, $me->last_name);

		return a2j($user);
	}
}

?>