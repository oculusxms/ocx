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
		<ul class="nav nav-tabs"><li><a href="#tab-general" data-toggle="tab"><?= $tab_general; ?></a></li>
			<li><a href="#tab-payment" data-toggle="tab"><?= $tab_payment; ?></a></li>
			<?php if ($affiliate_id) { ?>
			<li><a href="#tab-transaction" data-toggle="tab"><?= $tab_transaction; ?></a></li>
			<?php } ?>
		</ul>
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div class="tab-content">
				<div class="tab-pane" id="tab-general">
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_firstname; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="firstname" value="<?= $firstname; ?>" class="form-control" autofocus>
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
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_email; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="email" value="<?= $email; ?>" class="form-control">
							<?php if ($error_email) { ?>
								<div class="help-block error"><?= $error_email; ?></div>
							<?php	} ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_telephone; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="telephone" value="<?= $telephone; ?>" class="form-control">
							<?php if ($error_telephone) { ?>
								<div class="help-block error"><?= $error_telephone; ?></div>
							<?php	} ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_company; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="company" value="<?= $company; ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_address_1; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="address_1" value="<?= $address_1; ?>" class="form-control">
							<?php if ($error_address_1) { ?>
								<div class="help-block error"><?= $error_address_1; ?></div>
							<?php	} ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_address_2; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="address_2" value="<?= $address_2; ?>" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_city; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="city" value="<?= $city; ?>" class="form-control">
							<?php if ($error_city) { ?>
								<div class="help-block error"><?= $error_city ?></div>
							<?php	} ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><span id="postcode-required" class="required">*</span> <?= $entry_postcode; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="postcode" value="<?= $postcode; ?>" class="form-control">
							<?php if ($error_postcode) { ?>
								<div class="help-block error"><?= $error_postcode ?></div>
							<?php	} ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_country; ?></label>
						<div class="control-field col-sm-4">
							<select name="country_id" class="form-control" data-param="<?= htmlentities('{"zone_id":"' . $zone_id . '","select":"' . $text_select . '","none":"' . $text_none . '"}'); ?>">
								<option value=""><?= $text_select; ?></option>
								<?php foreach ($countries as $country) { ?>
									<?php if ($country['country_id'] == $country_id) { ?>
									<option value="<?= $country['country_id']; ?>" selected><?= $country['name']; ?></option>
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
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_zone; ?></label>
						<div class="control-field col-sm-4">
							<select name="zone_id" class="form-control"></select>
							<?php if ($error_zone) { ?>
								<div class="help-block error"><?= $error_zone; ?></div>
							<?php } ?>
						</div>
					</div>
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
				<div class="tab-pane" id="tab-payment">
					<div class="form-group">
						<label class="control-label col-sm-2" for="commission"><?= $entry_commission; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="commission" value="<?= $commission; ?>" id="commission" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="tax"><?= $entry_tax; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="tax" value="<?= $tax; ?>" id="tax" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_payment; ?></label>
						<div class="control-field col-sm-4">
							<?php if ($payment == 'check') { ?>
								<div class="radio"><label><input type="radio" name="payment" value="check" checked=""><?= $text_check; ?></label></div>
							<?php } else { ?>
								<div class="radio"><label><input type="radio" name="payment" value="check"><?= $text_check; ?></label></div>
							<?php } ?>
							<?php if ($payment == 'paypal') { ?>
								<div class="radio"><label><input type="radio" name="payment" value="paypal" checked=""><?= $text_paypal; ?></label></div>
							<?php } else { ?>
								<div class="radio"><label><input type="radio" name="payment" value="paypal"><?= $text_paypal; ?></label></div>
							<?php } ?>
							<?php if ($payment == 'bank') { ?>
								<div class="radio"><label><input type="radio" name="payment" value="bank" checked=""><?= $text_bank; ?></label></div>
							<?php } else { ?>
								<div class="radio"><label><input type="radio" name="payment" value="bank"><?= $text_bank; ?></label></div>
							<?php } ?>
						</div>
					</div>
					<div id="payment-check" class="payment form-group">
						<label class="control-label col-sm-2" for="check"><?= $entry_check; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="check" value="<?= $check; ?>" id="check" class="form-control">
						</div>
					</div>
					<div id="payment-paypal" class="payment form-group">
						<label class="control-label col-sm-2" for="paypal"><?= $entry_paypal; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="paypal" value="<?= $paypal; ?>" id="paypal" class="form-control">
						</div>
					</div>
					<div id="payment-bank" class="payment">
						<div class="form-group">
							<label class="control-label col-sm-2" for="bank_name"><?= $entry_bank_name; ?></label>
							<div class="control-field col-sm-4">
								<input type="text" name="bank_name" value="<?= $bank_name; ?>" id="bank_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="bank_branch_number"><?= $entry_bank_branch_number; ?></label>
							<div class="control-field col-sm-4">
								<input type="text" name="bank_branch_number" value="<?= $bank_branch_number; ?>" id="bank_branch_number" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="bank_swift_code"><?= $entry_bank_swift_code; ?></label>
							<div class="control-field col-sm-4">
								<input type="text" name="bank_swift_code" value="<?= $bank_swift_code; ?>" id="bank_swift_code" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="bank_account_name"><b class="required">*</b> <?= $entry_bank_account_name; ?></label>
							<div class="control-field col-sm-4">
								<input type="text" name="bank_account_name" value="<?= $bank_account_name; ?>" id="bank_account_name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="bank_account_number"><b class="required">*</b> <?= $entry_bank_account_number; ?></label>
							<div class="control-field col-sm-4">
								<input type="text" name="bank_account_number" value="<?= $bank_account_number; ?>" id="bank_account_number" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<?php if ($affiliate_id) { ?>
				<div class="tab-pane" id="tab-transaction">
					<div id="transaction" data-href="index.php?route=people/affiliate/transaction&token=<?= $token; ?>&affiliate_id=<?= $affiliate_id; ?>"></div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_description; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="description" value="" class="form-control" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_amount; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="amount" value="" class="form-control" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<div class="control-field col-sm-4 col-sm-offset-2">
							<a id="button-transaction" class="btn btn-info" data-target="affiliate" data-id="<?= $affiliate_id; ?>"><i class="fa fa-plus-circle"></i> <?= $button_add_transaction; ?></a>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</form>
	</div>
</div>
<?= $footer; ?>