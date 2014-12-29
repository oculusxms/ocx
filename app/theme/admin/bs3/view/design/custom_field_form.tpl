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
			<div class="pull-left h2"><i class="hidden-xs fa fa-picture-o"></i><?= $heading_title; ?></div>
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
				<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_name; ?></label>
				<div class="control-field col-sm-4">
					<?php foreach ($languages as $language) { ?>
						<div class="input-group"><input type="text" name="custom_field_description[<?= $language['language_id']; ?>][name]" value="<?= isset($custom_field_description[$language['language_id']]) ? $custom_field_description[$language['language_id']]['name'] :''; ?>" class="form-control">
						<span class="input-group-addon"><i class="lang-<?= str_replace('.png','', $language['image']); ?>" title="<?= $language['name']; ?>"></i></span>
						<?php if (isset($error_name[$language['language_id']])) { ?>
						<div class="help-block error"><?= $error_name[$language['language_id']]; ?></div>
						<?php } ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2"><?= $entry_type; ?></label>
				<div class="control-field col-sm-4">
					<select name="type" class="form-control">
						<optgroup label="<?= $text_choose; ?>">
							<option value="select"<?= ($type == 'select') ? ' selected' : ''; ?>><?= $text_select; ?></option>
							<option value="radio"<?= ($type == 'radio') ? ' selected' : ''; ?>><?= $text_radio; ?></option>
							<option value="checkbox"<?= ($type == 'checkbox') ? ' selected' : ''; ?>><?= $text_checkbox; ?></option>
						</optgroup>
						<optgroup label="<?= $text_input; ?>">
							<option value="text"<?= ($type == 'text') ? ' selected' : ''; ?>><?= $text_text; ?></option>
							<option value="textarea"<?= ($type == 'textarea') ? ' selected' : ''; ?>><?= $text_textarea; ?></option>
						</optgroup>
						<optgroup label="<?= $text_file; ?>">
							<option value="file"<?= ($type == 'file') ? ' selected' : ''; ?>><?= $text_file; ?></option>
						</optgroup>
						<optgroup label="<?= $text_date; ?>">
							<option value="date"<?= ($type == 'date') ? ' selected' : ''; ?>><?= $text_date; ?></option>
							<option value="time"<?= ($type == 'time') ? ' selected' : ''; ?>><?= $text_time; ?></option>
							<option value="datetime"<?= ($type == 'datetime') ? ' selected' : ''; ?>><?= $text_datetime; ?></option>
						</optgroup>
					</select>
				</div>
			</div>
		<table class="form">
			<tr id="display-value">
			<td><?= $entry_value; ?></td>
			<td><input type="text" name="value" value="<?= $value; ?>" class="form-control"></td>
			</tr> 
			<tr>
			<td><?= $entry_required; ?></td>
			<td><?php if ($required) { ?>
				<input type="radio" name="required" value="1" checked="">
				<?= $text_yes; ?>
				<input type="radio" name="required" value="0">
				<?= $text_no; ?>
				<?php } else { ?>
				<input type="radio" name="required" value="1">
				<?= $text_yes; ?>
				<input type="radio" name="required" value="0" checked="">
				<?= $text_no; ?>
				<?php } ?></td>
			</tr>		
			<tr>
			<td><?= $entry_location; ?></td>
			<td><select name="location" class="form-control">
				<?php if ($location == 'customer') { ?>
				<option value="customer" selected><?= $text_customer; ?></option>
				<?php } else { ?>
				<option value="customer"><?= $text_customer; ?></option>
				<?php } ?>
				<?php if ($location == 'address') { ?>
				<option value="address" selected><?= $text_address; ?></option>
				<?php } else { ?>
				<option value="address"><?= $text_address; ?></option>
				<?php } ?>
				<?php if ($location == 'payment_address') { ?>
				<option value="payment_address" selected><?= $text_payment_address; ?></option>
				<?php } else { ?>
				<option value="payment_address"><?= $text_payment_address; ?></option>
				<?php } ?>	
				<?php if ($location == 'shipping_address') { ?>
				<option value="shipping_address" selected><?= $text_shipping_address; ?></option>
				<?php } else { ?>
				<option value="shipping_address"><?= $text_shipping_address; ?></option>
				<?php } ?>						
				</select></td>
			</tr>	
			<tr>
			<td><?= $entry_position; ?></td>
			<td><input type="text" name="position" value="<?= $position; ?>" class="form-control"></td>
			</tr>						
			<tr>
			<td><?= $entry_sort_order; ?></td>
			<td><input type="text" name="sort_order" value="<?= $sort_order; ?>" class="form-control"></td>
			</tr>
		</table>
		<table id="custom-field-value" class="table table-bordered table-striped table-hover">
			<thead>
			<tr>
				<td><b class="required">*</b> <?= $entry_custom_value; ?></td>
				<td class="text-right"><?= $entry_sort_order; ?></td>
				<td></td>
			</tr>
			</thead>
			<?php $custom_field_value_row = 0; ?>
			<?php foreach ($custom_field_values as $custom_field_value) { ?>
			<tbody id="custom-field-value-row<?= $custom_field_value_row; ?>">
			<tr>
				<td><input type="hidden" name="custom_field_value[<?= $custom_field_value_row; ?>][custom_field_value_id]" value="<?= $custom_field_value['custom_field_value_id']; ?>">
				<?php foreach ($languages as $language) { ?>
				<input type="text" name="custom_field_value[<?= $custom_field_value_row; ?>][custom_field_value_description][<?= $language['language_id']; ?>][name]" value="<?= isset($custom_field_value['custom_field_value_description'][$language['language_id']]) ? $custom_field_value['custom_field_value_description'][$language['language_id']]['name'] : ''; ?>" class="form-control">
				<img src="asset/bs3/img/flags/<?= $language['image']; ?>" title="<?= $language['name']; ?>"><br>
				<?php if (isset($error_custom_field_value[$custom_field_value_row][$language['language_id']])) { ?>
				<span class="help-block error"><?= $error_custom_field_value[$custom_field_value_row][$language['language_id']]; ?></span>
				<?php } ?>
				<?php } ?></td>
				<td class="text-right"><input type="text" name="custom_field_value[<?= $custom_field_value_row; ?>][sort_order]" value="<?= $custom_field_value['sort_order']; ?>" class="form-control"></td>
				<td><a onclick="$('#custom-field-value-row<?= $custom_field_value_row; ?>').remove();" class="btn btn-default"><?= $button_remove; ?></a></td>
			</tr>
			</tbody>
			<?php $custom_field_value_row++; ?>
			<?php } ?>
			<tfoot>
			<tr>
				<td colspan="2"></td>
				<td><a onclick="addCustomFieldValue();" class="btn btn-default"><?= $button_add_custom_field_value; ?></a></td>
			</tr>
			</tfoot>
		</table>
		</form>
	</div>
</div>
<script>var custom_field_value_row = <?= $custom_field_value_row; ?>;</script>
<?= $footer; ?>