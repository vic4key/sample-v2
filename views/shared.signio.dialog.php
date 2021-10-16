<?php
	$socials = $GLOBALS["socials"];
	$any_social_enabled = False;
	foreach ($socials as $name => $social)
	{
		if (is_array($social) and array_key_exists("enabled", $social))
		{
			$any_social_enabled |= $social["enabled"];
		}
	}
?>

<?php
	LazyLoadScript("socials/scripts/helper.js");
	LazyLoadScript("socials/scripts/handler.js");
?>

<?php
	if ($any_social_enabled)
	{
		LazyLoadScript("socials/scripts/facebook.js");

		LazyLoadScript("https://apis.google.com/js/api:client.js");
		LazyLoadScript("socials/scripts/google.js");

		LazyLoadScript("https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js");
		LazyLoadScript("socials/scripts/github.js");

		LazyLoadStyle("libraries/Bootstrap-Social/bootstrap-social.css");
		LazyLoadStyle("socials/styles/style.css");
	}
?>

<?php
	if ($any_social_enabled)
	{
		echo "<script type=\"text/javascript\">";
		echo "const OAUTH_PUBLIC_KEY = \"{$socials["OAuth"]["public_key"]}\";";
		echo "const SOCIAL_FACEBOOK_APP_ID  = \"{$socials["Facebook"]["app_id"]}\";";
		echo "const SOCIAL_GOOGLE_CLIENT_ID = \"{$socials["Google"]["client_id"]}\";";
		echo "</script>";
	}
?>

		<div id="md_signio" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<ul class="nav nav-tabs bg">
						<li class="active">
							<a data-toggle="tab" href="#tab_signin">
								<i class="fa fa-sign-in"></i>
								<span> Sign In</span>
							</a>
						</li>

						<li>
							<a data-toggle="tab" href="#tab_signout">
								<i class="fa fa-sign-out"></i>
								<span> Sign Out</span>
							</a>
						</li>
					</ul>

					<div class="tab-content bg">
						<div id="tab_signin" class="tab-pane fade in active">
							<div class="modal-body mb-1">
								<div id="msg_signin" class="alert alert-default display-none">
									<p></p>
								</div>

								<form id="frm_signin" role="form">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input type="text" name="frm_signin_user" class="form-control" placeholder="User Name" required>
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input type="password" name="frm_signin_pass" class="form-control" placeholder="User Password" required>
										</div>
									</div>

									<button type="submit" class="btn btn-primary btn-block">Sign In</button>

									<?php if ($any_social_enabled) { ?>
									<div id="social-buttons">
										<div class="social-button">
											<span>OR</span>
										</div>

										<?php if ($socials["Facebook"]["enabled"]) { ?>
										<div class="social-button">
											<a id="social-facebook-signin" class="btn btn-block btn-social btn-facebook">
												<span class="fa fa-facebook"></span>Sign in with Facebook
											</a>
										</div>
										<?php } ?>

										<?php if ($socials["Google"]["enabled"]) { ?>
										<div class="social-button">
											<meta name="google-signin-client_id" content="<?php echo "{$socials["Google"]["client_id"]}" ?>">
											<a id="social-google-signin" class="btn btn-block btn-social btn-google">
												<span class="fa fa-google"></span>Sign in with Google
											</a>
										</div>
										<?php } ?>

										<?php if ($socials["GitHub"]["enabled"]) { ?>
										<div class="social-button">
											<a id="social-github-signin" class="btn btn-block btn-social btn-github">
												<span class="fa fa-github"></span>Sign in with GitHub
											</a>
										</div>
										<?php } ?>
									</div>
									<?php } ?>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>

						<div id="tab_signout" class="tab-pane fade">
							<div class="modal-body mb-1">
								<div id="msg_signout" class="alert alert-default display-none">
									<p></p>
								</div>

								<form id="frm_signout" role="form">
									<button type="submit" class="btn btn-primary btn-block">Sign Out</button>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<center>
			<button
				type="button"
				id="btn_signio"
				class="btn btn-default"
				data-toggle="modal"
				data-target="#md_signio">
				Sign In / Sign Out
			</button>
		</center>