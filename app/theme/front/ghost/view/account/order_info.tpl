<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				<fieldset class="spacer">
					<legend><?= $text_order_detail; ?></legend>
					<?php if ($invoice_no) { ?>
						<b><?= $text_invoice_no; ?></b> <?= $invoice_no; ?><br>
					<?php } ?>
					<b><?= $text_order_id; ?></b> #<?= $order_id; ?><br>
					<b><?= $text_date_added; ?></b> <?= $date_added; ?><br>
					<?php if ($payment_method) { ?>
						<b><?= $text_payment_method; ?></b> <?= $payment_method; ?><br>
					<?php } ?>
					<?php if ($shipping_method) { ?>
						<b><?= $text_shipping_method; ?></b> <?= $shipping_method; ?>
					<?php } ?>
				</fieldset>
			</div>
			<div class="col-sm-6 col-md-4">
				<fieldset class="spacer">
					<legend><?= $text_payment_address; ?></legend>
					<?= $payment_address; ?>
				</fieldset>
			</div>
			<?php if ($shipping_address) { ?>
				<div class="col-sm-6 col-md-4">
					<fieldset class="spacer">
						<legend><?= $text_shipping_address; ?></legend>
						<?= $shipping_address; ?>
					</fieldset>
				</div>
			<?php } ?>
		</div>
		<table class="table table-bordered">
			<thead>
				<tr class="active">
					<th class="col-sm-4"><?= $column_name; ?></th>
					<?php if ($products) { ?>
					<th class="hidden-xs"><?= $column_model; ?></th>
					<?php } ?>
					<th class="text-right"><?= $column_quantity; ?></th>
					<th class="hidden-xs text-right"><?= $column_price; ?></th>
					<th class="text-right"><?= $column_total; ?></th>
					<th class="col-sm-1 hidden-xs"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($products as $product) { ?>
					<tr>
						<td><?= $product['name']; ?>
						<?php foreach ($product['option'] as $option) { ?>
							<div class="help"><?= $option['name']; ?>: <?= $option['value']; ?></div>
						<?php } ?></td>
						<td class="hidden-xs"><?= $product['model']; ?></td>
						<td class="text-right"><?= $product['quantity']; ?></td>
						<td class="hidden-xs text-right"><?= $product['price']; ?></td>
						<td class="text-right"><?= $product['total']; ?></td>
						<td class="text-center hidden-xs"><a class="btn btn-warning btn-sm" href="<?= $product['return']; ?>" data-toggle="tooltip" title="<?= $button_return; ?>"><i class="fa fa-reply fa-lg"></i></a></td>
					</tr>
				<?php } ?>
				<?php foreach ($vouchers as $voucher) { ?>
					<tr>
						<td><?= $voucher['description']; ?></td>
						<?php if ($products) { ?>
						<td class="hidden-xs"></td>
						<?php } ?>
						<td class="text-right">1</td>
						<td class="hidden-xs text-right"><?= $voucher['amount']; ?></td>
						<td class="text-right"><?= $voucher['amount']; ?></td>
						<td class="hidden-xs"></td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<?php foreach ($totals as $total) { ?>
					<tr>
						<td class="hidden-xs"></td>
						<?php if ($products) { ?>
						<td class="hidden-xs"></td>
						<?php } ?>
						<td colspan="2" class="text-right"><?= $total['title']; ?>:</td>
						<td class="text-right"><strong><?= $total['text']; ?></strong></td>
						<td class="hidden-xs"></td>
					</tr>
				<?php } ?>
			</tfoot>
		</table>
		<?php if ($comment) { ?>
			<fieldset>
				<legend><?= $text_comment; ?></legend>
				<?= $comment; ?>
			</fieldset>
		<?php } ?>
		<?php if ($histories) { ?>
			<fieldset>
				<legend><?= $text_history; ?></legend>
				<?php foreach ($histories as $history) { ?>
					<ul class="unstyled">
						<li><b><?= $column_date_added; ?>:</b> <?= $history['date_added']; ?></li>
						<li><b><?= $column_status; ?>:</b> <?= $history['status']; ?></li>
						<?php if ($history['comment']) { ?>
							<li><b><?= $column_comment; ?>:</b> <?= $history['comment']; ?></li>
						<?php } ?>
					</ul>
				<?php } ?>
			</fieldset>
		<?php } ?>
		<div class="form-actions">
			<div class="form-actions-inner text-right">
				<a href="<?= $continue; ?>" class="btn btn-primary"><?= $button_continue; ?></a>
			</div>
		</div>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?> 