<?php
	LazyLoadScript("socials/scripts/facebook.js");

	LazyLoadScript("https://apis.google.com/js/api:client.js");
	LazyLoadScript("socials/scripts/google.js");

	LazyLoadScript("https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js");
	LazyLoadScript("socials/scripts/github.js");

	LazyLoadStyle("libraries/Bootstrap-Social/bootstrap-social.css");
	LazyLoadStyle("socials/styles/style.css");
?>

<div id="social-buttons">
	<div class="social-button">
		<span>OR</span>
	</div>

	<div class="social-button">
		<a id="social-facebook-signin" class="btn btn-block btn-social btn-facebook">
			<span class="fa fa-facebook"></span>Sign in with Facebook
		</a>
	</div>

	<div class="social-button">
		<meta name="google-signin-client_id" content="<?php echo "{$socials["Google"]["client_id"]}" ?>">
		<a id="social-google-signin" class="btn btn-block btn-social btn-google">
			<span class="fa fa-google"></span>Sign in with Google
		</a>
	</div>

	<div class="social-button">
		<a id="social-github-signin" class="btn btn-block btn-social btn-github">
			<span class="fa fa-github"></span>Sign in with GitHub
		</a>
	</div>
</div>