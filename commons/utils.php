<?php

/**
 * The assert version for JSON.
 * @param	$obj The JSON object.
 */
function jassert($obj)
{
	assert(!empty($obj));
}

/**
 * Converts an array to a json object.
 * @param	array	$a	The array data.
 * @return json	The json data.
 */
function a2j($a)
{
	return json_decode(json_encode($a));
}

/**
 * Checks if a string starts with a given substring.
 * @param	string	$haystack	The string to search in.
 * @param	string	$needle	The substring to search for in the haystack.
 * @return true if haystack begins with needle, otherwise return false.
 */
function starts_with($haystack, $needle, $ignore_case = false)
{
	if ($ignore_case)
	{
		$haystack = strtolower($haystack);
		$needle = strtolower($needle);
	}

	return substr($haystack, 0, strlen($needle)) === $needle;
}

/**
 * Lazy load a JavaScript file.
 * @param  string $file The JavaScript file name.
 */
function LazyLoadScript($file)
{
	$GLOBALS["views"]["scripts"][] = $file;
}

/**
 * Lazy load a Cascading Style Sheets file.
 * @param  string $file The Cascading Style Sheets file name.
 */
function LazyLoadStyle($file)
{
	$GLOBALS["views"]["styles"][] = $file;
}

/**
 * Gets the HTTP status message by its status code.
 * @param number $code The status code.
 * @return The HTTP status message.
 */
function GetHTTPStatusMessage($code)
{
    $codes = \flight\net\Response::$codes;
    return (array_key_exists($code, $codes) ? $codes[$code] : "Unknown");
}

?>