jQuery(document).ready(function($)
{
	/**
	 * Dialog and Tabs
	 */
	$("#md_signio").on("show.bs.modal", function(e)
	{
		handle_signing_tab($("#md_signio * li.active a").attr("href"), true);
	})
	.find("a[data-toggle=\"tab\"]").on("shown.bs.tab", function(e)
	{
		handle_signing_tab($(e.target).attr("href"), true);
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
			"user": $(this).find("input[name=frm_signin_user]").val(),
			"pass": $(this).find("input[name=frm_signin_pass]").val(),
		};

		request_signin("Basic", jdata);
	});

	/**
	 * Sign Out
	 */
	$("#frm_signout").submit(function(e)
	{
		e.preventDefault();
		request_signout();
	});
});