<h2><?= $text_payment_info; ?></h2>
<table class="form">
	<tr>
		<td><?= $text_capture_status; ?>: </td>
		<td id="capture_status"><?= $paypal_order['capture_status']; ?></td>
	</tr>
	<tr>
		<td><?= $text_amount_auth; ?>: </td>
		<td>
			<?= $paypal_order['total']; ?>
			<?php if ($paypal_order['capture_status'] != 'Complete'){ ?>&nbsp;&nbsp;
				<a onclick="doVoid();" class="button paypal_capture" id="btn_void"><?= $btn_void; ?></a>
				<img src="<?= HTTPS_SERVER; ?>asset/bs3/img/loading.gif" id="img_loading_void" style="display:none;">
			<?php } ?>
		</td>
	</tr>
	<tr>
		<td><?= $text_amount_captured; ?></td>: </td>
		<td id="paypal_captured"><?= $paypal_order['captured']; ?></td>
	</tr>
	<tr>
		<td><?= $text_amount_refunded; ?>: </td>
		<td id="paypal_captured"><?= $paypal_order['refunded']; ?></td>
	</tr>
	<?php if ($paypal_order['capture_status'] != 'Complete'){ ?>
	<tr class="paypal_capture">
		<td><?= $text_capture_amount; ?>: </td>
		<td>
			<p><input type="checkbox" name="paypal_capture_complete" id="paypal_capture_complete" value="1"> <?= $text_complete_capture; ?></p>
			<p>
				<input type="text" id="paypal_capture_amount" value="<?= $paypal_order['remaining']; ?>">
				<a class="btn btn-default" onclick="capture();" id="btn_capture"><?= $btn_capture; ?></a>
				<img src="<?= HTTPS_SERVER; ?>asset/bs3/img/loading.gif" id="img_loading_capture" style="display:none;">
			</p>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td><?= $text_transactions; ?>: </td>
		<td>
			<table class="table table-bordered" id="paypal_transactions">
				<thead>
					<tr>
						<td><strong><?= $column_trans_id; ?></strong></td>
						<td><strong><?= $column_amount; ?></strong></td>
						<td><strong><?= $column_type; ?></strong></td>
						<td><strong><?= $column_status; ?></strong></td>
						<td><strong><?= $column_pend_reason; ?></strong></td>
						<td><strong><?= $column_created; ?></strong></td>
						<td><strong><?= $column_action; ?></strong></td>
					</tr>
				</thead>
				<?php foreach ($paypal_order['transactions'] as $transaction){ ?>
					<tr>
						<td><?= $transaction['transaction_id']; ?></td>
						<td><?= $transaction['amount']; ?></td>
						<td><?= $transaction['payment_type']; ?></td>
						<td><?= $transaction['payment_status']; ?></td>
						<td><?= $transaction['pending_reason']; ?></td>
						<td><?= $transaction['created']; ?></td>
						<td><?php if ($transaction['transaction_id']) { ?>
								<a href="<?= $view_link .'&transaction_id='.$transaction['transaction_id']; ?>"><?= $text_view; ?></a>
								<?php if ($transaction['payment_type'] == 'instant' && ($transaction['payment_status'] == 'Completed'|| $transaction['payment_status'] == 'Partially-Refunded')) { ?>
									&nbsp;<a href="<?= $refund_link .'&transaction_id='.$transaction['transaction_id']; ?>"><?= $text_refund; ?></a>
								<?php } ?>
							<?php } else { ?>
									<a onclick="resendTransaction(this); return false;" href="<?= $resend_link . '&paypal_order_transaction_id=' . $transaction['paypal_order_transaction_id']; ?>"><?= $text_resend; ?></a>
							<?php } ?></td>
					</tr>
				<?php } ?>
			</table>
		</td>
	</tr>
</table>
<?= $javascript; ?>