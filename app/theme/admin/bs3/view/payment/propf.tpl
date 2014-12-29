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
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<table class="form">
			<tr>
			<td><b class="required">*</b> <?= $entry_vendor; ?></td>
			<td><input type="text" name="propf_vendor" value="<?= $propf_vendor; ?>" class="form-control" autofocus>
				<?php if ($error_vendor) { ?>
				<span class="help-block error"><?= $error_vendor; ?></span>
				<?php } ?></td>
			</tr>
			<tr>
			<td><b class="required">*</b> <?= $entry_user; ?></td>
			<td><input type="text" name="propf_user" value="<?= $propf_user; ?>" class="form-control">
				<?php if ($error_user) { ?>
				<span class="help-block error"><?= $error_user; ?></span>
				<?php } ?></td>
			</tr>
			<tr>
			<td><b class="required">*</b> <?= $entry_password; ?></td>
			<td><input type="text" name="propf_password" value="<?= $propf_password; ?>" class="form-control">
				<?php if ($error_password) { ?>
				<span class="help-block error"><?= $error_password; ?></span>
				<?php } ?></td>
			</tr>
			<tr>
			<td><b class="required">*</b> <?= $entry_partner; ?></td>
			<td><input type="text" name="propf_partner" value="<?= $propf_partner; ?>" class="form-control">
				<?php if ($error_partner) { ?>
				<span class="help-block error"><?= $error_partner; ?></span>
				<?php } ?></td>
			</tr>
			<tr>
			<td><?= $entry_test; ?></td>
			<td><?php if ($propf_test) { ?>
				<input type="radio" name="propf_test" value="1" checked="">
				<?= $text_yes; ?>
				<input type="radio" name="propf_test" value="0">
				<?= $text_no; ?>
				<?php } else { ?>
				<input type="radio" name="propf_test" value="1">
				<?= $text_yes; ?>
				<input type="radio" name="propf_test" value="0" checked="">
				<?= $text_no; ?>
				<?php } ?></td>
			</tr>
			<tr>
			<td><?= $entry_transaction; ?></td>
			<td><select name="propf_transaction" class="form-control">
				<?php if (!$propf_transaction) { ?>
				<option value="0" selected><?= $text_authorization; ?></option>
				<?php } else { ?>
				<option value="0"><?= $text_authorization; ?></option>
				<?php } ?>
				<?php if ($propf_transaction) { ?>
				<option value="1" selected><?= $text_sale; ?></option>
				<?php } else { ?>
				<option value="1"><?= $text_sale; ?></option>
				<?php } ?>
				</select></td>
			</tr>
			<tr>
			<td><?= $entry_total; ?></td>
			<td><input type="text" name="propf_total" value="<?= $propf_total; ?>" class="form-control"></td>
			</tr>	
			<tr>
			<td><?= $entry_order_status; ?></td>
			<td><select name="propf_order_status_id" class="form-control">
				<?php foreach ($order_statuses as $order_status) { ?>
				<?php if ($order_status['order_status_id'] == $propf_order_status_id) { ?>
				<option value="<?= $order_status['order_status_id']; ?>" selected><?= $order_status['name']; ?></option>
				<?php } else { ?>
				<option value="<?= $order_status['order_status_id']; ?>"><?= $order_status['name']; ?></option>
				<?php } ?>
				<?php } ?>
				</select></td>
			</tr>
			<tr>
			<td><?= $entry_geo_zone; ?></td>
			<td><select name="propf_geo_zone_id" class="form-control">
				<option value="0"><?= $text_all_zones; ?></option>
				<?php foreach ($geo_zones as $geo_zone) { ?>
				<?php if ($geo_zone['geo_zone_id'] == $propf_geo_zone_id) { ?>
				<option value="<?= $geo_zone['geo_zone_id']; ?>" selected><?= $geo_zone['name']; ?></option>
				<?php } else { ?>
				<option value="<?= $geo_zone['geo_zone_id']; ?>"><?= $geo_zone['name']; ?></option>
				<?php } ?>
				<?php } ?>
				</select></td>
			</tr>
			<tr>
			<td><?= $entry_status; ?></td>
			<td><select name="propf_status" class="form-control">
				<?php if ($propf_status) { ?>
				<option value="1" selected><?= $text_enabled; ?></option>
				<option value="0"><?= $text_disabled; ?></option>
				<?php } else { ?>
				<option value="1"><?= $text_enabled; ?></option>
				<option value="0" selected><?= $text_disabled; ?></option>
				<?php } ?>
				</select></td>
			</tr>
			<tr>
			<td><?= $entry_sort_order; ?></td>
			<td><input type="text" name="propf_sort_order" value="<?= $propf_sort_order; ?>" class="form-control"></td>
			</tr>
		</table>
		</form>
	</div>
</div>
<?= $footer; ?>