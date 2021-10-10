(function()
{
	gapi.load("auth2", function()
	{
		auth2 = gapi.auth2.init(
		{
			client_id: SOCIAL_GOOGLE_CLIENT_ID,
		});

	    auth2.attachClickHandler
	    (
	    	$("#social-google-signin")[0], {},
	        function(user)
	        {
	        	request_signin("Google", user.Zi);
	        },
	        function(error)
	        {
				console.log(error);
	        }
		);
	});
})();