<?php

namespace IOSocial;

require_once "social.php";
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

		$validid = is_numeric($id);

		$sql  = \Models\User::sql();
		$sql  = "SELECT {$sql} FROM `tbl_user`";
		$sql .= $validid ? " WHERE `id` = $id" : "";

		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");
		if (count($users) == 0)
		{
			return null;
		}

		return a2j($validid ? $users[0] : $users);
	}

	public function Query($jdata)
	{
		if ($jdata == null)
		{
			return null;
		}

		$name = $jdata->name;
		$pass = $jdata->pass;

		if (strlen($name) == 0 or strlen($pass) == 0)
		{
			return null;
		}

		$sql = \Models\User::sql();
		$sql = "SELECT {$sql} FROM `tbl_user` WHERE `name` = \"$name\" AND `pass` = \"$pass\" LIMIT 1";

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

		$user = $this->User($me->first_name, $me->last_name, $me->email);

		return a2j($user);
	}
}

?>