<?php

require_once "controllers/signing.handler.php";

/**
 * Sign Up/In/Out
 */

$signing = new \Controller\Signing;

Flight::route("POST /signup", array($signing, "SignUp"));
Flight::route("POST /signin", array($signing, "SignIn"));
Flight::route("DELETE /signout", array($signing, "SignOut"));

?>