<?php

# GitHub
# 	https://github.com/settings/developers (OAuth : https://oauth.io/dashboard)
#		Homepage URL => https://domain.ext/	Eg. https://localhost/
#		Authorization callback URL => https://oauth.io/auth
#
# Facebook
# 	https://developers.facebook.com/apps/
# 	App Domains => domain.ext	Eg. localhost
# 	Site URL => https://domain.ext/app	Eg. https://localhost/sample/
#
# Google
# 	https://console.developers.google.com/apis/credentials
# 		Authorized JavaScript origins => https://domain.ext	Eg. https://localhost
# 		Authorized redirect URIs => https://domain.ext	Eg. https://localhost
#
# OAuth
# 	https://oauth.io/dashboard

namespace IOSocial;

$GLOBALS["socials"] = array
(
	"Facebook"	=> array
	(
		"app_id"		=> "",
		"app_secret"	=> "",
	),
	"Google"	=> array
	(
		"client_id"		=> "",
		"client_secret"	=> "",
	),
	"GitHub"	=> array
	(
		"client_id"		=> "",
		"client_secret"	=> "",
	),
	"OAuth"		=> array
	(
		"public_key"	=> "",
		"secret_key"	=> "",
	),
	"Basic"	=> array(),
);

?>