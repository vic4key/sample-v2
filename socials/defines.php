<?php

# GitHub
# 	https://github.com/settings/developers (OAuth : https://oauth.io/dashboard)
#		Homepage URL => https://domain.ext/	Eg. https://localhost/
#		Authorization callback URL => https://oauth.io/auth
#
# Facebook
# 	https://developers.facebook.com/apps/
# 	App Domains => domain.ext	Eg. localhost
# 	Site URL => https://domain.ext/app	Eg. https://localhost/sample-v2/
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
		"enabled" => True,
		"app_id"				=> "",
		"app_secret"		=> "",
	),
	"Google"	=> array # https://console.cloud.google.com/apis/credentials (OAuth 2.0 Client IDs)
	(
		"enabled" => True,
		"client_id"			=> "",
		"client_secret"	=> "",
	),
	"GitHub"	=> array # https://github.com/settings/developers (OAuth Apps)
	(
		"enabled" => True,
		"client_id"			=> "",
		"client_secret"	=> "",
	),
	"OAuth"		=> array
	(
		"enabled" => True,
		"public_key"		=> "",
		"secret_key"		=> "",
	),
	"Basic"		=> array
	(
		# no fields
	),
);

?>