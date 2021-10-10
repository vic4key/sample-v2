<?php

require_once "libraries/Flight/Flight.php";

require_once "commons/configures.php";
require_once "commons/auth.php";
require_once "apis/demo.routes.php";

Flight::route("*", function()
{
	$url = Flight::request()->url;

	if ($url != "/" and substr($url, -1) == "/")
	{
		Flight::redirect(rtrim($url, "/"), 301); # 'Moved Permanently'
	}

	return true;
});

Flight::before("start", function(&$params, &$output)
{
	Flight::middle_ware(Flight::request()->url, "is_url_protected");
});

Flight::route("/(index.php|index.html)?", function()
{
	Flight::render("index.html.php", $GLOBALS);
});

Flight::route("/home", function()
{
	Flight::render_page("home.content.php");
});

Flight::route("/demo", function()
{
	Flight::render_page("demo.content.php");
});

Flight::route("/test", function()
{
	Flight::render("test.php", $GLOBALS);
});

Flight::initialize();
Flight::start();

?>