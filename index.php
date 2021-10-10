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
		Flight::redirect(rtrim($url, "/"), 301);
	}

	return true;
});

Flight::before("start", function(&$params, &$output)
{
	Flight::protectUrl(Flight::request()->url, "IsUrlProtected");
});

Flight::route("/(index.php|index.html)?", function()
{
	Flight::render("index.html.php", $GLOBALS);
});

Flight::route("/home", function()
{
	Flight::renderPage("home.content.php");
});

Flight::route("/demo", function()
{
	Flight::renderPage("demo.content.php");
});

Flight::route("/test", function()
{
	Flight::render("test.php", $GLOBALS);
});

Flight::initialize();
Flight::start();

?>