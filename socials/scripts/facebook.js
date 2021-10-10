(function (d, s, id)
{
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "https://connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));

window.fbAsyncInit = function ()
{
	FB.init(
	{
		appId:   SOCIAL_FACEBOOK_APP_ID,
		cookie:  true,
		xfbml:   true,
		version: "v4.0",
	});

	FB.getLoginStatus(function (response)
	{
		var user = get_current_user();
		if (user != null)
		{
			console.log(`Signed In as ${user.type}`);
		}
		else if (response.status === "connected")
		{
			console.log(response.status);
		}
		else
		{
			request_signout();
		}
	});
};

$("#social-facebook-signin").click(function(e)
{
	FB.getLoginStatus(function (response)
	{
		if (response.status === "connected")
		{
			request_signin("Facebook", response.authResponse);
		}
		else
		{
			FB.login(function(response)
			{
				if (response.status === "connected")
				{
					request_signin("Facebook", response.authResponse);
				}
				else
				{
					console.log(response.status);
				}
			});
		}
	});
});