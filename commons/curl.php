<?php

/**
 * Request a http/https.
 * @param  string  $method  The method (GET / POST / etc)
 * @param  string  $uri     The URI.
 * @param  array   $header  The header.
 * @param  string  $body    The body.
 * @param  number  $timeout The time-out in seconds.
 * @return any	The response.
 */
function cURL($method, $uri, $header = [], $body = [], $timeout = 5)
{
	# https://incarnate.github.io/curl-to-php/

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0");
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);

	curl_setopt($curl, CURLOPT_URL, $uri);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

	if (strtoupper($method) == "POST")
	{
		curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
	}

	$data = curl_exec($curl);

	curl_close($curl);

	return $data;
}

?>