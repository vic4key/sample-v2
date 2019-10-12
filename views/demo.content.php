<?php
	LazyLoadStyle ("libraries/BootstrapValidator-0.5.2/css/bootstrapValidator.min.css");
	LazyLoadScript("libraries/BootstrapValidator-0.5.2/js/bootstrapValidator.min.js");

	LazyLoadStyle ("libraries/Swagger-UI-3.23.8/swagger-ui.css");
	LazyLoadScript("libraries/Swagger-UI-3.23.8/swagger-ui-bundle.js");
	LazyLoadScript("libraries/Swagger-UI-3.23.8/swagger-ui-standalone-preset.js");

	LazyLoadScript("views/scripts/demo.swagger.js");
?>

<div class="row padding-bottom padding-top">
	<div class="col-sm-12">
		<h1><center>DEMO</center></h1>

		<?php include_once("socials/htmls/signing.ui.php"); ?>

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
	</div>
</div>

<div class="row padding-bottom">
	<div class="col-sm-12">
		<div id="swagger-ui" style="background-color: white; padding-bottom: 1px; margin-bottom: 10px;"></div>
	</div>
</div>

<div class="row padding-bottom"></div><!-- padding for dynamic footer -->