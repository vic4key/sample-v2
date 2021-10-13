<?php

namespace IOSocial;

require_once "social.php";
require_once "commons/curl.php";
include_once "commons/defines.php";
require_once "models/demo.user.php";

class Basic extends \IOSocial\Social
{
	public function Get($id)
	{
		if ($id === "me")
		{
			$auth = \Auth\Authorization();
			if (strlen($auth) == 0)
			{
				return null;
			}

			$payload = \Auth\Decode($auth);
			if ($payload == null)
			{
				return null;
			}

			return $payload->data;
		}

		if (!is_null($id) and !is_numeric($id))
		{
			return null;
		}

		$valid_user_id = is_numeric($id);

		$sql  = \Models\User::serialize();
		$sql  = "SELECT {$sql} FROM `tbl_user`";
		$sql .= $valid_user_id ? " WHERE `id` = $id" : "";

		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");
		if (count($users) == 0)
		{
			return null;
		}

		return a2j($valid_user_id ? $users[0] : $users);
	}

	public function Query($jdata)
	{
		if (!$this->Basic()) # only accept `Basic` or alias `<empty>`
		{
			return null;
		}

		if ($jdata == null)
		{
			return null;
		}

		$user_name = $jdata->user;
		$user_pass = $jdata->pass;

		if (strlen($user_name) == 0 or strlen($user_pass) == 0)
		{
			return null;
		}

		$salt = $GLOBALS["other"]["salt"];
		$pass_hash = md5("{$salt}{$user_pass}");

		$sql = \Models\User::serialize();
		$sql = "SELECT {$sql} FROM `tbl_user` WHERE `user` = \"$user_name\" AND `pass` = \"$pass_hash\" LIMIT 1";

		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");

		if (count($users) == 0)
		{
			return null;
		}

		$me = $users[0];

		if (empty($me))
		{
		  return null;
		}

		$user = $this->User($me->email, $me->user, $me->first_name, $me->last_name);

		return a2j($user);
	}
}

?>