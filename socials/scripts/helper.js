const eType =
{
	DEFAULT: 0,
	SUCCESS: 1,
	FAILURE: 2,
};

function set_message(element, type, message)
{
	var addClass = "alert-default";

	if (type == eType.FAILURE)
	{
		addClass = "alert-danger";
	}
	else if (type == eType.SUCCESS)
	{
		addClass = "alert-success";
	}

	$(element)
	.removeClass("alert-default")
	.removeClass("alert-success")
	.removeClass("alert-danger")
	.addClass(addClass)
	.show()
	.find("p").text(message);
};

function handle_signing_tab(tabid, hidemsg = false)
{
	if (hidemsg)
	{
		set_message(tabid, eType.DEFAULT, "");
		$(tabid).find(".alert").hide();
	}

	var juser = get_current_user();
	var signed_in = juser != null;

	var social_buttons = $("#social-buttons");
	if (signed_in)
	{
		social_buttons.hide();
	}
	else
	{
		social_buttons.show();
	}

	switch (tabid)
	{
	case "#tab_signin":
		{
			$("#frm_signin")
			.find("input")
			.attr("disabled", signed_in);

			$("#frm_signin")
			.find("button[type=submit]")
			.attr("disabled", signed_in)
			.text(signed_in ? `Signed In as ${juser.type} [${juser.first_name} ${juser.last_name}]` : `Sign In`);
		}
		break;

	case "#tab_signout":
		{
			$("#frm_signout")
			.find("button[type=submit]")
			.attr("disabled", !signed_in)
			.text("Sign Out" + (!signed_in ? "" : ` ${juser.type} [${juser.first_name} ${juser.last_name}]`));
		}
		break;

	default:
		break;
	}
}

function get_current_user()
{
	var response = $.ajax(
	{
		url: `${BASE_URL}/api/users/me`,
		type: "GET",
		async: false,
	});

	if (response.status != 200)
	{
		return null;
	}

	if (!response.responseJSON.hasOwnProperty("data"))
	{
		return null;
	}

	return response.responseJSON.data;
}

function request_signup()
{
	$.ajax(
	{
		url: `${BASE_URL}/users/signup`,
		type: "POST",
	});
}

function request_signin(social, juser)
{
	$.ajax(
	{
		url: `${BASE_URL}/users/signin`,
		type: "POST",
		dataType: "json",
		data:
		{
			"social": social,
			"data": juser,
		}
	})
	.done(function (data, textStatus, jqXHR)
	{
		set_message("#msg_signin", data.hasOwnProperty("user") ? eType.SUCCESS : eType.FAILURE, data.message);
		handle_signing_tab($("#md_signio * li.active a").attr("href"));
	})
	.fail(function (jqXHR, textStatus, errorThrown)
	{
		set_message("#msg_signin", eType.FAILURE, `Sign-in failed '${jqXHR.statusText}'`);
	});
}

function request_signout()
{
	$.ajax(
	{
		url: `${BASE_URL}/users/signout`,
		type: "POST",
	})
	.done(function(data, textStatus, jqXHR)
	{
		set_message("#msg_signout", eType.SUCCESS, data.message);
		handle_signing_tab($("#md_signio * li.active a").attr("href"));
		window.location.reload();
	})
	.fail(function(jqXHR, textStatus, errorThrown)
	{
		set_message("#msg_signout", eType.FAILURE, `Sign-out failed '${jqXHR.statusText}'`);
	});
}