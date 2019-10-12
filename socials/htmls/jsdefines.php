<?php
	echo "<script type=\"text/javascript\">";
	echo "const OAUTH_PUBLIC_KEY = \"{$socials["OAuth"]["public_key"]}\";";
	echo "const SOCIAL_FACEBOOK_APP_ID  = \"{$socials["Facebook"]["app_id"]}\";";
	echo "const SOCIAL_GOOGLE_CLIENT_ID = \"{$socials["Google"]["client_id"]}\";";
	echo "</script>";
?>