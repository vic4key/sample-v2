<?php

require_once "controllers/demo.user.php";
require_once "controllers/others.php";

/**
 * User APIs / User Sign Up/In/Out
 */

$users = new \Controller\Users;

# User Sign Up/In/Out

Flight::route("POST /users", array($users, "Signup"));
Flight::route("POST /users/signin", array($users, "Signin"));
Flight::route("POST /users/signout", array($users, "Signout"));

# User APIs

Flight::route("GET /api/users(/?@id:[me\d]+)", array($users, "Get"));
Flight::route("PATCH /api/users/@id:[\d]+", array($users, "Update"));
Flight::route("DELETE /api/users/@id:[\d]+", array($users, "Delete"));

/**
 * Others
 */

$others = new \Controller\Others;

Flight::route("GET /api/statistics/timeseries(/@time:day|week|month)", array($others, "cf_time_series"));

?>