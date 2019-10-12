<?php

namespace IOSocial;

require_once "defines.php";
require_once "socials/socials/basic.php";
require_once "socials/socials/facebook.php";
require_once "socials/socials/google.php";
require_once "socials/socials/github.php";

class Socials
{
	private static $m_Instance = null;

	private $m_socials;
	private $m_configures;

	public function __construct()
	{
		$this->m_socials = array();
		$this->m_configures = $GLOBALS["socials"];
	}

	public static function Instance()
	{
		if (!isset(self::$m_Instance))
		{
			self::$m_Instance = new Socials();
		}

		return self::$m_Instance;
	}

	public function Create(&$type)
	{
		$social = null;

		if ($type == "")
		{
			$type = "Basic";
		}

		if (array_key_exists($type, $this->m_socials))
		{
			$social = $this->m_socials[$type];
		}
		else
		{
			switch ($type)
			{
			case "Facebook":
				{
					$social = new \IOSocial\Facebook($this->m_configures[$type]);
				}
				break;

			case "Google":
				{
					$social = new \IOSocial\Google($this->m_configures[$type]);
				}
				break;

			case "GitHub":
				{
					$social = new \IOSocial\GitHub($this->m_configures[$type]);
				}
				break;

			default:
				{
					$social = new \IOSocial\Basic($this->m_configures[$type]);
				}
				break;
			}

			$this->m_socials[$type] = $social;
		}

		if ($social != null)
		{
			$social->Name($type);
		}

		return $social;
	}
}

?>