<?php
	LazyLoadScript("socials/scripts/helper.js");
	LazyLoadScript("socials/scripts/handler.js");
?>

<?php require_once("jsdefines.php"); ?>

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
									<input type="text" name="user_name" class="form-control" placeholder="User Name" required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="text" name="user_pass" class="form-control" placeholder="User Password" required>
								</div>
							</div>

							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</form>

						<?php include_once("social.buttons.php"); ?>
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