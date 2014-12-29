<?= $header; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<?php if ($success) { ?>
			<div class="alert alert-success"><?= $success; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
			<?php } ?>
			<?php if ($error_warning) { ?>
			<div class="alert alert-danger"><?= $error_warning; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
			<?php } ?>
			<form action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div class="well well-lg">
				<p class="lead"><?= $text_login; ?></p>
				<div class="form-group">
					<label><?= $entry_username; ?></label>
					<input type="text" name="username" value="<?= $username; ?>" class="form-control" autofocus="">
				</div>
				<div class="form-group">
					<label><?= $entry_password; ?></label>
					<input type="password" name="password" value="<?= $password; ?>" class="form-control">
				</div>
				<div class="help-block"><a href="<?= $forgotten; ?>"><?= $text_forgotten; ?></a></div>
				<hr>
				<button type="submit" class="btn btn-primary btn-block"><?= $button_login; ?></button>
				<?php if ($redirect) { ?>
				<input type="hidden" name="redirect" value="<?= $redirect; ?>">
				<?php } ?>
			</div>
			</form>
		</div>
	</div>
</div>
<?= $footer; ?>