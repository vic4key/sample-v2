$("#social-github-signin").click(function(e)
{
	OAuth.initialize(OAUTH_PUBLIC_KEY);
	OAuth.popup("github").done(github =>
	{
		fnRequestSignIn(
			"GitHub",
			{
				"token_type": github.token_type,
				"access_token": github.access_token,
			}
		);
	}).fail(error =>
	{
    	console.log(error)
	});
});