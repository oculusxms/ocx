<?= $header; ?>
<?= $breadcrumb; ?>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= $error; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<?php if (!empty($error_warning)): ?>
<div class="alert alert-danger"><?= $error_warning; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<?php if (!empty($success)): ?>
<div class="alert alert-success"><?= $success; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="clearfix">
			<div class="pull-left h2"><i class="hidden-xs fa fa-user"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<button type="submit" form="form" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i><span class="hidden-xs"> <?= $button_save; ?></span></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div class="form-group">
				<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_username; ?></label>
				<div class="control-field col-sm-4">
					<input type="text" name="username" value="<?= $username; ?>" class="form-control" autofocus>
					<?php if ($error_username) { ?>
						<div class="help-block error"><?= $error_username; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_firstname; ?></label>
				<div class="control-field col-sm-4">
					<input type="text" name="firstname" value="<?= $firstname; ?>" class="form-control">
					<?php if ($error_firstname) { ?>
						<div class="help-block error"><?= $error_firstname; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_lastname; ?></label>
				<div class="control-field col-sm-4">
					<input type="text" name="lastname" value="<?= $lastname; ?>" class="form-control">
					<?php if ($error_lastname) { ?>
						<div class="help-block error"><?= $error_lastname; ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_email; ?></label>
				<div class="control-field col-sm-4">
					<input type="text" name="email" value="<?= $email; ?>" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_user_group; ?></label>
				<div class="control-field col-sm-4">
					<select name="user_group_id" class="form-control">
						<?php foreach ($user_groups as $user_group) { ?>
						<?php if ($user_group['user_group_id'] == $user_group_id) { ?>
						<option value="<?= $user_group['user_group_id']; ?>" selected><?= $user_group['name']; ?></option>
						<?php } else { ?>
						<option value="<?= $user_group['user_group_id']; ?>"><?= $user_group['name']; ?></option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_password; ?></label>
				<div class="control-field col-sm-4">
					<input type="password" name="password" value="<?= $password; ?>" class="form-control">
					<?php if ($error_password) { ?>
						<div class="help-block error"><?= $error_password; ?></div>
						<?php	} ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_confirm; ?></label>
				<div class="control-field col-sm-4">
					<input type="password" name="confirm" value="<?= $confirm; ?>" class="form-control">
					<?php if ($error_confirm) { ?>
						<div class="help-block error"><?= $error_confirm; ?></div>
						<?php	} ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_status; ?></label>
				<div class="control-field col-sm-4">
					<select name="status" class="form-control">
						<?php if ($status) { ?>
						<option value="0"><?= $text_disabled; ?></option>
						<option value="1" selected><?= $text_enabled; ?></option>
						<?php } else { ?>
						<option value="0" selected><?= $text_disabled; ?></option>
						<option value="1"><?= $text_enabled; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</form>
	</div>
</div>
<?= $footer; ?> 