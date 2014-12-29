<?= $header; ?>
<?php if ($error_warning) { ?>
<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $error_warning; ?></div>
<?php } ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<div class="alert alert-warning"><?= $text_account_already; ?></div>
		<p><?= $text_signup; ?></p>
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend><?= $text_your_details; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="firstname"><b class="required">*</b> <?= $entry_firstname; ?></label>
					<div class="col-sm-6">
						<input type="text" name="firstname" value="<?= $firstname; ?>" class="form-control" placeholder="<?= $entry_firstname; ?>"  autofocus id="firstname" required>
						<?php if ($error_firstname) { ?>
						<span class="help-block error"><?= $error_firstname; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="lastname"><b class="required">*</b> <?= $entry_lastname; ?></label>
					<div class="col-sm-6">
						<input type="text" name="lastname" value="<?= $lastname; ?>" class="form-control" placeholder="<?= $entry_lastname; ?>"  id="lastname" required>
						<?php if ($error_lastname) { ?>
						<span class="help-block error"><?= $error_lastname; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="email"><b class="required">*</b> <?= $entry_email; ?></label>
					<div class="col-sm-6">
						<input type="text" name="email" value="<?= $email; ?>" class="form-control" placeholder="<?= $entry_email; ?>"  id="email" required>
						<?php if ($error_email) { ?>
						<span class="help-block error"><?= $error_email; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="telephone"><b class="required">*</b> <?= $entry_telephone; ?></label>
					<div class="col-sm-6">
						<input type="text" name="telephone" value="<?= $telephone; ?>" class="form-control" placeholder="<?= $entry_telephone; ?>"  id="telephone" required>
						<?php if ($error_telephone) { ?>
						<span class="help-block error"><?= $error_telephone; ?></span>
						<?php } ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= $text_your_address; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="company"><?= $entry_company; ?></label>
					<div class="col-sm-6">
						<input type="text" name="company" value="<?= $company; ?>" class="form-control" placeholder="<?= $entry_company; ?>"  id="company">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="website"><?= $entry_website; ?></label>
					<div class="col-sm-6">
						<input type="text" name="website" value="<?= $website; ?>" class="form-control" placeholder="<?= $entry_website; ?>"  id="website">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address_1"><b class="required">*</b> <?= $entry_address_1; ?></label>
					<div class="col-sm-6">
						<input type="text" name="address_1" value="<?= $address_1; ?>" class="form-control" placeholder="<?= $entry_address_1; ?>"  id="address_1" required>
						<?php if ($error_address_1) { ?>
						<span class="help-block error"><?= $error_address_1; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="address_2"><?= $entry_address_2; ?></label>
					<div class="col-sm-6">
						<input type="text" name="address_2" value="<?= $address_2; ?>" class="form-control" placeholder="<?= $entry_address_2; ?>"  id="address_2">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="city"><b class="required">*</b> <?= $entry_city; ?></label>
					<div class="col-sm-6">
						<input type="text" name="city" value="<?= $city; ?>" class="form-control" placeholder="<?= $entry_city; ?>"  id="city" required>
						<?php if ($error_city) { ?>
						<span class="help-block error"><?= $error_city; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="postcode"><b id="postcode-required" class="required">*</b> <?= $entry_postcode; ?></label>
					<div class="col-sm-6">
						<input type="text" name="postcode" value="<?= $postcode; ?>" class="form-control" placeholder="<?= $entry_postcode; ?>"  id="postcode">
						<?php if ($error_postcode) { ?>
						<span class="help-block error"><?= $error_postcode; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="country"><b class="required">*</b> <?= $entry_country; ?></label>
					<div class="col-sm-6">
						<select name="country_id" class="form-control" id="country" data-param="<?= htmlentities('{"zone_id":"' . $zone_id . '","select":"' . $text_select . '","none":"' . $text_none . '"}'); ?>" required>
							<option value=""><?= $text_select; ?></option>
							<?php foreach ($countries as $country) { ?>
							<?php if ($country['country_id'] == $country_id) { ?>
							<option value="<?= $country['country_id']; ?>" selected=""><?= $country['name']; ?></option>
							<?php } else { ?>
							<option value="<?= $country['country_id']; ?>"><?= $country['name']; ?></option>
							<?php } ?>
							<?php } ?>
						</select>
						<?php if ($error_country) { ?>
						<span class="help-block error"><?= $error_country; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="zone_id"><b class="required">*</b> <?= $entry_zone; ?></label>
					<div class="col-sm-6">
						<select name="zone_id" class="form-control" id="zone_id" required></select>
						<?php if ($error_zone) { ?>
						<span class="help-block error"><?= $error_zone; ?></span>
						<?php } ?>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= $text_payment; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="tax"><?= $entry_tax; ?></label>
					<div class="col-sm-6">
						<input type="password" name="tax" value="<?= $tax; ?>" class="form-control" placeholder="<?= $entry_tax; ?>"  id="tax">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3"><?= $entry_payment; ?></label>
					<div class="col-sm-6">
						<?php if ($payment == 'check') { ?>
						<div class="radio"><label><input type="radio" name="payment" value="check" checked=""> <?= $text_check; ?></label></div>
						<?php } else { ?>
						<div class="radio"><label><input type="radio" name="payment" value="check"> <?= $text_check; ?></label></div>
						<?php } ?>
						<?php if ($payment == 'paypal') { ?>
						<div class="radio"><label><input type="radio" name="payment" value="paypal" checked=""> <?= $text_paypal; ?></label></div>
						<?php } else { ?>
						<div class="radio"><label><input type="radio" name="payment" value="paypal" > <?= $text_paypal; ?></label></div>
						<?php } ?>
						<?php if ($payment == 'bank') { ?>
						<div class="radio"><label><input type="radio" name="payment" value="bank" checked=""> <?= $text_bank; ?></label></div>
						<?php } else { ?>
						<div class="radio"><label><input type="radio" name="payment" value="bank"> <?= $text_bank; ?></label></div>
						<?php } ?>
					</div>
				</div>
				<div id="payment-check" class="form-group payment">
					<label class="control-label col-sm-3" for="payment_check"><?= $entry_check; ?></label>
					<div class="col-sm-6">
						<input type="text" name="check" value="<?= $check; ?>" class="form-control" placeholder="<?= $entry_check; ?>"  id="payment_check">
					</div>
				</div>
				<div id="payment-paypal" class="form-group payment">
					<label class="control-label col-sm-3" for="payment_paypal"><?= $entry_paypal; ?></label>
					<div class="col-sm-6">
						<input type="text" name="paypal" value="<?= $paypal; ?>" class="form-control" placeholder="<?= $entry_paypal; ?>"  id="payment_paypal">
					</div>
				</div>
				<div id="payment-bank" class="payment">
					<div class="form-group">
						<label class="control-label col-sm-3" for="payment_bank_name"><?= $entry_bank_name; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_name" value="<?= $bank_name; ?>" class="form-control" placeholder="<?= $entry_bank_name; ?>"  id="payment_bank_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="payment_bank_branch_number"><?= $entry_bank_branch_number; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_branch_number" value="<?= $bank_branch_number; ?>" class="form-control" placeholder="<?= $entry_bank_branch_number; ?>"  id="payment_bank_branch_number">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="payment_bank_swift_code"><?= $entry_bank_swift_code; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_swift_code" value="<?= $bank_swift_code; ?>" class="form-control" placeholder="<?= $entry_bank_swift_code; ?>"  id="payment_bank_swift_code">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="payment_bank_account_name"><?= $entry_bank_account_name; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_account_name" value="<?= $bank_account_name; ?>" class="form-control" placeholder="<?= $entry_bank_account_name; ?>"  id="payment_bank_account_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="payment_bank_account_number"><?= $entry_bank_account_number; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_account_number" value="<?= $bank_account_number; ?>" class="form-control" placeholder="<?= $entry_bank_account_number; ?>"  id="payment_bank_account_number">
						</div>
					</div>
				</div>
			</fieldset>
			<fieldset>
				<legend><?= $text_your_password; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="password"><b class="required">*</b> <?= $entry_password; ?></label>
					<div class="col-sm-6">
						<input type="password" name="password" value="<?= $password; ?>" class="form-control" placeholder="<?= $entry_password; ?>"  id="password" required>
						<?php if ($error_password) { ?>
						<span class="help-block error"><?= $error_password; ?></span>
						<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="confirm"><b class="required">*</b> <?= $entry_confirm; ?></label>
					<div class="col-sm-6">
						<input type="password" name="confirm" value="<?= $confirm; ?>" class="form-control" placeholder="<?= $entry_confirm; ?>"  id="confirm" required>
						<?php if ($error_confirm) { ?>
						<span class="help-block error"><?= $error_confirm; ?></span>
						<?php } ?>
					</div>
				</div>
			</fieldset>
			<?php if ($text_agree) { ?>
				<div class="form-group">
					<div class="col-sm-5 col-sm-offset-3">
						<div class="checkbox"><label>
							<input type="checkbox" name="agree" value="1"<?= $agree ? ' checked=""' : ''; ?>><?= $text_agree; ?>
						</label></div>
					</div>
				</div>
			<?php } ?>
			<div class="form-group">
				<div class="col-sm-5 col-sm-offset-3">
					<button type="submit" class="btn btn-primary"><?= $button_continue; ?></button>
				</div>
			</div>
		</form>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>