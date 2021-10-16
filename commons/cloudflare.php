<?php

require_once("configures.php");

/**
 * Converts an array to a json object.
 * @param	array	$a	The array data.
 * @return json	The json data.
 */
// function a2j($a)
// {
// 	return json_decode(json_encode($a));
// }

/**
 * Cloud Flare
 */
class CloudFlare
{
	private static $m_instance = null;

	private $m_host = "";
	private $m_endpoint = "";
	private $m_domain = "";
	private $m_zone_id = "";
	private $m_headers = [];

	public function zone_id()
	{
		return $this->m_zone_id;
	}

	public function __construct()
	{
		$this->m_host = "api.cloudflare.com";
		$this->m_endpoint = sprintf("https://%s/client/v4/", $this->m_host);
	}

	public static function Instance()
	{
		if (!isset(self::$m_instance))
		{
			self::$m_instance = new CloudFlare();
		}

		return self::$m_instance;
	}

	/**
	 * Initializes the instance.
	 * @param	string	$domain	The domain.
	 * @param	string	$email	The email.
	 * @param	string	$key		The token.
	 * @param	string	$auth		The authentication.
	 */
	public function initialize($domain, $email, $key, $auth)
	{
		if (strlen($domain) == 0 || strlen($email) == 0 || strlen($key) == 0)
		{
			return false;
		}

		$this->m_headers[] = "X-Auth-Key: ".$key;
		$this->m_headers[] = "X-Auth-Email: ".$email;
		$this->m_headers[] = "Authorization: ".$auth;
		$this->m_headers[] = "Content-Type: application/json";

		$zone = $this->get_zone($domain);
		if (!$zone)
		{
			return false;
		}

		$this->m_zone_id = $zone->id;

		return true;
	}

	/**
	 * Requests an URI (HTTP & HTTPS).
	 * @param	string	$method		The method.
	 * @param	string	$uri			The URI.
	 * @param	string	$fnopt		The option callback function.
	 * @param	number	$timeout	The time-out.
	 * @return json		The response data.
	 */
	public function request($method, $uri, $fnopt = null, $timeout = 5)
	{
		# https://incarnate.github.io/curl-to-php/

		$curl = curl_init();

		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0");
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

		curl_setopt($curl, CURLOPT_URL, $uri);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->m_headers);

		if ($fnopt && is_callable($fnopt))
		{
			$fnopt($curl);
		}

		$data = curl_exec($curl);

		curl_setopt($curl, CURLOPT_POSTFIELDS, "");

		curl_close($curl);

		return json_decode($data);
	}

	/**
	 * Gets all zones (the added sites).
	 * @return json	The zones data.
	 */
	public function get_zones()
	{
		return $this->request("GET", $this->m_endpoint."zones");
	}

	/**
	 * Gets a zone (an added site).
	 * @param	string	$domain The added domain.
	 * @return json		The zone data.
	 */
	public function get_zone($domain)
	{
		$result = "";

		$jdata = $this->get_zones();
		if (!$jdata)
		{
			return $result;
		}

		if (!$jdata->success)
		{
			return $result;
		}

		foreach ($jdata->result as $item)
		{
			if ($item->name == $domain)
			{
				$result = $item;
				break;
			}
		}

		return $result;
	}

	/**
	 * Gets an object.
	 * @param	string	$path		The object path.
	 * @param	array		$args		The time-out.
	 * @return json		The object data.
	 */
	public function get_object($path, $args)
	{
		if (strlen($this->m_zone_id) == 0)
		{
			return a2j(array());
		}

		$uri  = $this->m_endpoint;
		$uri .= sprintf("zones/%s/%s", $this->m_zone_id, $path);

		if (!empty($args))
		{
			$uri .= "?";
			$uri .= http_build_query($args);
		}

		return $this->request("GET", $uri);
	}

	public function get_graphql_object($args)
	{
		if (strlen($this->m_zone_id) == 0)
		{
			return a2j(array());
		}

		$uri  = $this->m_endpoint;
		$uri .= "graphql";

		$result = $this->request("POST", $uri, function(&$curl) use($args)
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
		});

		return $result;
	}
}

?>