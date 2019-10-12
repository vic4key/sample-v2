jQuery(document).ready(function($)
{
	/**
	 * Dialog and Tabs
	 */
	$("#md_signio").on("show.bs.modal", function(e)
	{
		fnTabHandler($("#md_signio * li.active a").attr("href"), true);
	})
	.find("a[data-toggle=\"tab\"]").on("shown.bs.tab", function(e)
	{
		fnTabHandler($(e.target).attr("href"), true);
	});

	/**
	 * Sign In
	 */
	$("#frm_signin").bootstrapValidator(
	{
		feedbackIcons:
		{
			valid: "glyphicon glyphicon-ok",
			invalid: "glyphicon glyphicon-remove",
			validating: "glyphicon glyphicon-refresh",
		}
	})
	.on("success.form.bv", function(e)
	{
		e.preventDefault();

		var jdata = {
			"name": $(this).find("input[name=user_name]").val(),
			"pass": $(this).find("input[name=user_pass]").val(),
		};

		fnRequestSignIn("Basic", jdata);
	});

	/**
	 * Sign Out
	 */
	$("#frm_signout").submit(function(e)
	{
		e.preventDefault();
		$.ajax(
		{
			url: `${BASE_URL}/signout`,
			type: "DELETE",
		})
		.done(function(data, textStatus, jqXHR)
		{
			fnMessage("#msg_signout", eType.SUCCESS, data.message);
			fnTabHandler($("#md_signio * li.active a").attr("href"));
		})
		.fail(function(jqXHR, textStatus, errorThrown)
		{
			fnMessage("#msg_signout", eType.FAILURE, `Sign-out failed '${jqXHR.statusText}'`);
		});
	});
});