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
			<div class="pull-left h2"><i class="hidden-xs fa fa-credit-card"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<button type="submit" form="form" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i><span class="hidden-xs"> <?= $button_save; ?></span></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs"><li><a href="#tab-general" data-toggle="tab"><?= $tab_general; ?></a></li>
			<?php if ($voucher_id) { ?>
			<li><a href="#tab-history" data-toggle="tab"><?= $tab_voucher_history; ?></a></li>
			<?php } ?>
		</ul>
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div class="tab-content">
				<div class="tab-pane" id="tab-general">
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_code; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="code" value="<?= $code; ?>" class="form-control">
							<?php if ($error_code) { ?>
								<div class="help-block error"><?= $error_code; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_from_name; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="from_name" value="<?= $from_name; ?>" class="form-control">
							<?php if ($error_from_name) { ?>
								<div class="help-block error"><?= $error_from_name; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_from_email; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="from_email" value="<?= $from_email; ?>" class="form-control">
							<?php if ($error_from_email) { ?>
								<div class="help-block error"><?= $error_from_email; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_to_name; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="to_name" value="<?= $to_name; ?>" class="form-control">
							<?php if ($error_to_name) { ?>
								<div class="help-block error"><?= $error_to_name; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_to_email; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="to_email" value="<?= $to_email; ?>" class="form-control">
							<?php if ($error_to_email) { ?>
								<div class="help-block error"><?= $error_to_email; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_theme; ?></label>
						<div class="control-field col-sm-4">
							<select name="voucher_theme_id" class="form-control">
								<?php foreach ($voucher_themes as $voucher_theme) { ?>
									<?php if ($voucher_theme['voucher_theme_id'] == $voucher_theme_id) { ?>
									<option value="<?= $voucher_theme['voucher_theme_id']; ?>" selected><?= $voucher_theme['name']; ?></option>
									<?php } else { ?>
									<option value="<?= $voucher_theme['voucher_theme_id']; ?>"><?= $voucher_theme['name']; ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_message; ?></label>
						<div class="control-field col-sm-4">
							<textarea name="message" class="form-control" rows="3"><?= $message; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_amount; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="amount" value="<?= $amount; ?>" class="form-control">
							<?php if ($error_amount) { ?>
								<div class="help-block error"><?= $error_amount; ?></div>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_status; ?></label>
						<div class="control-field col-sm-4">
							<select name="status" class="form-control">
								<?php if ($status) { ?>
								<option value="1" selected><?= $text_enabled; ?></option>
								<option value="0"><?= $text_disabled; ?></option>
								<?php } else { ?>
									<option value="1"><?= $text_enabled; ?></option>
									<option value="0" selected><?= $text_disabled; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<?php if ($voucher_id) { ?>
				<div class="tab-pane" id="tab-history">
					<div id="history" data-href="index.php?route=sale/voucher/history&token=<?= $token; ?>&voucher_id=<?= $voucher_id; ?>"></div>
				</div>
				<?php } ?>
			</div>
		</form>
	</div>
</div>
<?= $footer; ?>