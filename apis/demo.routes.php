<?php

require_once "controllers/demo.user.php";

/**
 * User APIs
 */

$users = new \Controller\Users;

Flight::route("GET /api/users(/?@id:[me\d]+)", array($users, "Get"));
Flight::route("PATCH /api/users/@id:[\d]+", array($users, "Update"));
Flight::route("DELETE /api/users/@id:[\d]+", array($users, "Delete"));

?>