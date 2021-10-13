<?php

$HOST_NAME = $_SERVER["SERVER_NAME"];
$PORT_NUM  = $_SERVER["SERVER_PORT"];
$PROTOCOL  = $_SERVER["REQUEST_SCHEME"];

$SUB_PATH = "/";
$HOST_URL = sprintf("%s://%s", $PROTOCOL, $HOST_NAME);
$BASE_URL = sprintf("%s%s", $HOST_URL, $SUB_PATH == "/" ? "" : $SUB_PATH);

$DB_LOCAL = array
(
  "host" => "localhost",
  "name" => "sample",
  "user" => "root",
  "pass" => "mysql",
);

$DB_SERVER = array
(
  "host" => "",
  "name" => "",
  "user" => "",
  "pass" => "",
);

$CF_CONFIG = array
(
  "domain" => "",
  "email"  => "",
  "token"  => "",
  "auth"   => "",
);

$OT_CONFIG = array
(
  "salt"   => "",
);

$DB_CONFIG = in_array($_SERVER["REMOTE_ADDR"], array("127.0.0.1", "::1")) ? $DB_LOCAL : $DB_SERVER;

$GLOBALS = array_merge($GLOBALS, array
(
	"title"  => "Sample",
	"author" => "Vic P.",
  "year"   => date("Y"),
  "mysql"  => $DB_CONFIG,
  "cflare" => $CF_CONFIG,
  "other"  => $OT_CONFIG,
  "server" => array
  (
    "host" => $HOST_NAME,
    "port" => $PORT_NUM,
    "prot" => $PROTOCOL,
    "root" => $HOST_URL,
    "base" => $BASE_URL,
		"cage"		=> 5*60, # minutes
  ),
  "views" => array
  (
    "scripts" => array(),
    "styles"  => array(),
  )
));

?>