<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $lang_heading_title; ?></h1></div>
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend><?= $lang_text_your_payment; ?></legend>
				<div class="form-group">
					<label class="control-label col-sm-3" for="tax"><?= $lang_entry_tax; ?></label>
					<div class="col-sm-6">
						<input type="text" name="tax" value="<?= $tax; ?>" class="form-control" placeholder="<?= $lang_entry_tax; ?>"  id="tax">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3"><?= $lang_entry_payment; ?></label>
					<div class="col-sm-6">
						<div class="radio"><label for="check"><input type="radio" name="payment" value="check" id="check"<?= ($payment == 'check') ? ' checked=""' : ''; ?>> <?= $lang_text_check; ?></label></div>
						<div class="radio"><label for="paypal"><input type="radio" name="payment" value="paypal" id="paypal"<?= ($payment == 'paypal') ? ' checked=""' : ''; ?>> <?= $lang_text_paypal; ?></label></div>
						<div class="radio"><label for="bank"><input type="radio" name="payment" value="bank" id="bank"<?= ($payment == 'bank') ? ' checked=""' : ''; ?>> <?= $lang_text_bank; ?></label></div>
					</div>
				</div>
				<div class="form-group payment" id="payment-check">
					<label class="control-label col-sm-3" for="check"><?= $lang_entry_check; ?></label>
					<div class="col-sm-6">
						<input type="text" name="check" value="<?= $check; ?>" class="form-control" placeholder="<?= $lang_entry_check; ?>"  id="check">
					</div>
				</div>
				<div class="form-group payment" id="payment-paypal">
					<label class="control-label col-sm-3" for="paypal"><?= $lang_entry_paypal; ?></label>
					<div class="col-sm-6">
						<input type="text" name="paypal" value="<?= $paypal; ?>" class="form-control" placeholder="<?= $lang_entry_paypal; ?>"  id="paypal">
					</div>
				</div>
				<div class="payment" id="payment-bank">
					<div class="form-group">
						<label class="control-label col-sm-3" for="bank_name"><?= $lang_entry_bank_name; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_name" value="<?= $bank_name; ?>" class="form-control" placeholder="<?= $lang_entry_bank_name; ?>"  id="bank_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bank_branch_number"><?= $lang_entry_bank_branch_number; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_branch_number" value="<?= $bank_branch_number; ?>" class="form-control" placeholder="<?= $lang_entry_bank_branch_number; ?>"  id="bank_branch_number">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bank_swift_code"><?= $lang_entry_bank_swift_code; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_swift_code" value="<?= $bank_swift_code; ?>" class="form-control" placeholder="<?= $lang_entry_bank_swift_code; ?>"  id="bank_swift_code">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bank_account_name"><?= $lang_entry_bank_account_name; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_account_name" value="<?= $bank_account_name; ?>" class="form-control" placeholder="<?= $lang_entry_bank_account_name; ?>"  id="bank_account_name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="bank_account_number"><?= $lang_entry_bank_account_number; ?></label>
						<div class="col-sm-6">
							<input type="text" name="bank_account_number" value="<?= $bank_account_number; ?>" class="form-control" placeholder="<?= $lang_entry_bank_account_number; ?>"  id="bank_account_number">
						</div>
					</div>
				</div>
				<div class="form-actions">
					<div class="form-actions-inner text-right">
						<a href="<?= $back; ?>" class="btn btn-default pull-left"><?= $lang_button_back; ?></a>
						<button type="submit" class="btn btn-primary"><?= $lang_button_continue; ?></button>
					</div>
				</div>
			</fieldset>
		</form>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?> 