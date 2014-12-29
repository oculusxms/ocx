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
		<div class="pull-left h2"><i class="hidden-xs fa fa-credit-card"></i><?= $heading_title; ?></div>
		<div class="pull-right">
			<a class="btn btn-default" onclick="editSearch();" id="btn_edit" style="display:none;"><?= $btn_edit_search; ?></a>
			<a class="btn btn-default" onclick="doSearch();" id="btn_search"><?= $btn_search; ?></a>
		</div>
	</div>
	<div class="panel-body">
		<form id="form" class="form-horizontal">
			<div id="search_input">
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_date_start; ?>:</label>
					<div class="col-sm-4">
						<label class="input-group">
							<input type="text" id="date_start" name="date_start" value="<?= $date_start; ?>" class="form-control date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_date_end; ?>:</label>
					<div class="col-sm-4">
						<label class="input-group">
							<input type="text" name="date_end" class="form-control date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</label>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_transaction_type; ?>:</label>
					<div class="col-sm-4">
						<select name="transaction_class" class="form-control">
							<option value="All"><?= $entry_trans_all;?></option>
							<option value="Sent"><?= $entry_trans_sent;?></option>
							<option value="Received"><?= $entry_trans_received;?></option>
							<option value="MassPay"><?= $entry_trans_masspay;?></option>
							<option value="MoneyRequest"><?= $entry_trans_money_req;?></option>
							<option value="FundsAdded"><?= $entry_trans_funds_add;?></option>
							<option value="FundsWithdrawn"><?= $entry_trans_funds_with;?></option>
							<option value="Referral"><?= $entry_trans_referral;?></option>
							<option value="Fee"><?= $entry_trans_fee;?></option>
							<option value="Subscription"><?= $entry_trans_subscription;?></option>
							<option value="Dividend"><?= $entry_trans_dividend;?></option>
							<option value="Billpay"><?= $entry_trans_billpay;?></option>
							<option value="Refund"><?= $entry_trans_refund;?></option>
							<option value="CurrencyConversions"><?= $entry_trans_conv;?></option>
							<option value="BalanceTransfer"><?= $entry_trans_bal_trans;?></option>
							<option value="Reversal"><?= $entry_trans_reversal;?></option>
							<option value="Shipping"><?= $entry_trans_shipping;?></option>
							<option value="BalanceAffecting"><?= $entry_trans_bal_affect;?></option>
							<option value="ECheck"><?= $entry_trans_echeck;?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_transaction_status; ?>:</label>
					<div class="col-sm-4">
						<select name="status" class="form-control">
							<option value=""><?= $entry_status_all; ?></option>
							<option value="Pending"><?= $entry_status_pending; ?></option>
							<option value="Processing"><?= $entry_status_processing; ?></option>
							<option value="Success"><?= $entry_status_success; ?></option>
							<option value="Denied"><?= $entry_status_denied; ?></option>
							<option value="Reversed"><?= $entry_status_reversed; ?></option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_email; ?>:</label>
					<div class="col-sm-4">
						<input maxlength="127" type="text" name="buyer_email" value="" placeholder="<?= $entry_email_buyer; ?>" class="form-control">
						<br>
						<input maxlength="127" type="text" name="merchant_email" value="" placeholder="<?= $entry_email_merchant; ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_receipt; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="receipt_id" value="" maxlength="100" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_transaction_id; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="transaction_id" value="" maxlength="19" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_invoice_no; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="invoice_number" value="" maxlength="127" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_auction; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="auction_item_number" value="" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_amount; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="amount" value="" size="6" class="form-control">&nbsp;
						<select name="currency_code" class="form-control">
							<?php foreach ($currency_codes as $code): ?>
								<option <?php if ($code == $default_currency){ echo 'selected'; } ?>><?= $code; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $entry_profile_id; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="profile_id" value="" class="form-control">
					</div>
				</div>

				<hr>

				<h3><?= $text_buyer_info; ?></h3>

				<div class="form-group">
					<label class="col-sm-2 control-label"><?= $text_name; ?>:</label>
					<div class="col-sm-4">
						<input type="text" name="name_salutation" value="" placeholder="<?= $entry_salutation; ?>" class="form-control"><br>
						<input type="text" name="name_first" value="" placeholder="<?= $entry_firstname; ?>" class="form-control"><br>
						<input type="text" name="name_middle" value="" placeholder="<?= $entry_middlename; ?>" class="form-control"><br>
						<input type="text" name="name_last" value="" placeholder="<?= $entry_lastname; ?>" class="form-control"><br>
						<input type="text" name="name_suffix" value="" placeholder="<?= $entry_suffix; ?>" class="form-control">
					</div>
				</div>
			</div>
		</form>
		<div id="search_box" style="display:none;">
			<div id="searching"><i class="fa fa-spinner"></i> <?= $text_searching; ?></div>
			<div id="error" class="warning" style="display:none;"></div>
			<table id="search_results" style="display:none;" class="table table-bordered table-striped"></table>
		</div>
	</div>
</div>
<?= $footer; ?>