const eType =
{
	DEFAULT: 0,
	SUCCESS: 1,
	FAILURE: 2,
};

function fnMessage(element, type, message)
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

function fnTabHandler(tabid, hidemsg = false)
{
	if (hidemsg)
	{
		fnMessage(tabid, eType.DEFAULT, "");
		$(tabid).find(".alert").hide();
	}

	var user = fnGetCurrentUser();
	var signedin = user != null;

	var social_buttons = $("#social-buttons");
	if (signedin)
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
			.attr("disabled", signedin);

			$("#frm_signin")
			.find("button[type=submit]")
			.attr("disabled", signedin)
			.text(signedin ? `Signed In as [${user.first_name} ${user.last_name}]` : `Sign In`);
		}
		break;

	case "#tab_signout":
		{
			$("#frm_signout")
			.find("button[type=submit]")
			.attr("disabled", !signedin)
			.text("Sign Out" + (!signedin ? "" : ` [${user.first_name} ${user.last_name}]`));
		}
		break;

	default:
		break;
	}
}

function fnGetCurrentUser()
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

	return response.responseJSON;
}

function fnRequestSignUp()
{
	$.ajax(
	{
		url: `${BASE_URL}/signup`,
		type: "POST",
	});
}

function fnRequestSignIn(social, jdata)
{
	$.ajax(
	{
		url: `${BASE_URL}/signin`,
		type: "POST",
		dataType: "json",
		data:
		{
			"social": social,
			"data": jdata,
		}
	})
	.done(function (data, textStatus, jqXHR)
	{
		fnMessage("#msg_signin", data.hasOwnProperty("user") ? eType.SUCCESS : eType.FAILURE, data.message);
		fnTabHandler($("#md_signio * li.active a").attr("href"));
	})
	.fail(function (jqXHR, textStatus, errorThrown)
	{
		fnMessage("#msg_signin", eType.FAILURE, `Sign-in failed '${jqXHR.statusText}'`);
	});
}

function fnRequestSignOut()
{
	$.ajax(
	{
		url: `${BASE_URL}/signout`,
		type: "DELETE",
	});
}