<?= $header; ?>
<?php if ($error_warning): ?>
<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $error_warning; ?></div>
<?php endif; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $lang_heading_title; ?></h1></div>
		<div class="alert alert-warning"><?= $text_account_already; ?></div>
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend><?= $lang_text_your_details; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="username"><b class="required">*</b> <?= $lang_entry_username; ?></label>
					<div class="col-sm-6">
						<input type="text" name="username" value="<?= $username; ?>" class="form-control" placeholder="<?= $lang_entry_username; ?>" autofocus id="username" required>
						<?php if ($error_username) { ?>
						<span class="help-block error"><?= $error_username; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><b class="required">*</b> <?= $lang_entry_email; ?></label>
					<div class="col-sm-6">
						<input type="text" name="email" value="<?= $email; ?>" class="form-control" placeholder="<?= $lang_entry_email; ?>"  id="email" required>
						<?php if ($error_email) { ?>
						<span class="help-block error"><?= $error_email; ?></span>
						<?php } ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= $lang_text_your_password; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="password"><b class="required">*</b> <?= $lang_entry_password; ?></label>
					<div class="col-sm-6">
						<input type="password" name="password" value="<?= $password; ?>" class="form-control" placeholder="<?= $lang_entry_password; ?>"  id="password" required>
						<?php if ($error_password) { ?>
						<span class="help-block error"><?= $error_password; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="confirm"><b class="required">*</b> <?= $lang_entry_confirm; ?></label>
					<div class="col-sm-6">
						<input type="password" name="confirm" value="<?= $confirm; ?>" class="form-control" placeholder="<?= $lang_entry_confirm; ?>"  id="confirm" required>
						<?php if ($error_confirm) { ?>
						<span class="help-block error"><?= $error_password; ?></span>
						<?php } ?>
					</div>
				</div>
			</fieldset>
			<?php if ($text_agree) { ?>
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="agree" value="1"<?= $agree ? ' checked=""' : ''; ?>><?= $text_agree; ?>
							</label>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="form-group">
				<div class="col-sm-6 col-sm-offset-3">
					<button type="submit" class="btn btn-primary"><?= $lang_button_continue; ?></button>
				</div>
			</div>
		</form>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>