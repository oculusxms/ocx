<?= $header; ?>
<?php if ($attention) { ?>
	<div class="attention"><?= $attention; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close"></div>
<?php } ?>
<?php if ($success) { ?>
	<div class="success"><?= $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close"></div>
<?php } ?>
<?php if ($error_warning) { ?>
	<div class="alert alert-danger"><?= $error_warning; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close"></div>
<?php } ?>
<?= $post_header; ?>
<?= $column_left; ?>
<?= $column_right; ?>
<div id="content">
	<?= $content_top; ?>
	<h1><?= $text_title; ?></h1>
	<?php if ($coupon_status || $voucher_status || $reward_status) { ?>
		<h2><?= $text_next; ?></h2>
		<div class="content">
			<p><?= $text_next_choice; ?></p>
			<table class="radio">
				<?php if ($coupon_status) { ?>
					<tr class="highlight">
						<td>
							<div class="radio radio-inline">
							<?php if ($next == 'coupon') { ?>
								<input type="radio" name="next" value="coupon" id="use_coupon" checked="">
							<?php } else { ?>
								<input type="radio" name="next" value="coupon" id="use_coupon">
							<?php } ?>
							</div>	
						</td>
						<td><label for="use_coupon"><?= $text_use_coupon; ?></label></td>
					</tr>
				<?php } ?>
				<?php if ($voucher_status) { ?>
					<tr class="highlight">
						<td>
							<div class="radio radio-inline">
							<?php if ($next == 'voucher') { ?>
								<input type="radio" name="next" value="voucher" id="use_voucher" checked="">
							<?php } else { ?>
								<input type="radio" name="next" value="voucher" id="use_voucher">
							<?php } ?>
							</div>
						</td>
						<td><label for="use_voucher"><?= $text_use_voucher; ?></label></td>
					</tr>
				<?php } ?>
				<?php if ($reward_status) { ?>
					<tr class="highlight">
						<td>
							<div class="radio radio-inline">
							<?php if ($next == 'reward') { ?>
								<input type="radio" name="next" value="reward" id="use_reward" checked="">
							<?php } else { ?>
								<input type="radio" name="next" value="reward" id="use_reward">
							<?php } ?>
							</div>
						</td>
						<td><label for="use_reward"><?= $text_use_reward; ?></label></td>
					</tr>
				<?php } ?>
			</table>
		</div>
		<div class="cart-discounts">
			<div id="coupon" class="content" style="display: <?= ($next == 'coupon' ? 'block' : 'none'); ?>;">
				<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
					<?= $entry_coupon; ?>&nbsp;
					<input type="text" name="coupon" value="<?= $coupon; ?>">
					<input type="hidden" name="next" value="coupon">
					&nbsp;
					<input type="submit" value="<?= $button_coupon; ?>" class="btn btn-default">
				</form>
			</div>
			<div id="voucher" class="content" style="display: <?= ($next == 'voucher' ? 'block' : 'none'); ?>;">
				<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
					<?= $entry_voucher; ?>&nbsp;
					<input type="text" name="voucher" value="<?= $voucher; ?>">
					<input type="hidden" name="next" value="voucher">
					&nbsp;
					<input type="submit" value="<?= $button_voucher; ?>" class="btn btn-default">
				</form>
			</div>
			<div id="reward" class="content" style="display: <?= ($next == 'reward' ? 'block' : 'none'); ?>;">
				<form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
					<?= $entry_reward; ?>&nbsp;
					<input type="text" name="reward" value="<?= $reward; ?>">
					<input type="hidden" name="next" value="reward">
					&nbsp;
					<input type="submit" value="<?= $button_reward; ?>" class="btn btn-default">
				</form>
			</div>
		</div>
	<?php } ?>
<?php if ($has_shipping) { ?>
	<?php if (!isset($shipping_methods)) { ?>
		<div class="alert alert-danger"><?= $error_no_shipping ?></div>
	<?php } else { ?>
		<div class="cart-module">
			<div id="shipping" class="content" style="display: block;">
				<form action="<?= $action_shipping; ?>" method="post" id="shipping_form">
					<table class="radio">
					<?php foreach ($shipping_methods as $shipping_method) { ?>
						<tr>
							<td colspan="3"><b><?= $shipping_method['title']; ?></b></td>
						</tr>
						<?php if (!$shipping_method['error']) { ?>
							<?php foreach ($shipping_method['quote'] as $quote) { ?>
							<tr class="highlight">
								<td>
									<div class="radio radio-inline">
									<?php if ($quote['code'] == $code || !$code) { ?>
									<?php $code = $quote['code']; ?>
									<input type="radio" name="shipping_method" value="<?= $quote['code']; ?>" id="<?= $quote['code']; ?>" checked="">
									<?php } else { ?>
									<input type="radio" name="shipping_method" value="<?= $quote['code']; ?>" id="<?= $quote['code']; ?>">
									<?php } ?>
									</div>
								</td>
								<td><label for="<?= $quote['code']; ?>"><?= $quote['title']; ?></label></td>
								<td style="text-align: right;"><label for="<?= $quote['code']; ?>"><?= $quote['text']; ?></label></td>
							</tr>
							<?php } ?>
						<?php } else { ?>
						<tr>
							<td colspan="3"><div class="error"><?= $shipping_method['error']; ?></div></td>
						</tr>
						<?php } ?>
					<?php } ?>
					</table>
				</form>
			</div>
		</div>
	<?php } ?>
<?php } ?>

	<div class="checkout-product">
		<table>
			<thead>
			<tr>
				<td class="name"><?= $column_name; ?></td>
				<td class="model"><?= $column_model; ?></td>
				<td class="quantity"><?= $column_quantity; ?></td>
				<td class="price"><?= $column_price; ?></td>
				<td class="total"><?= $column_total; ?></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($products as $product) { ?>
				<?php if ($product['recurring']): ?>
					<tr>
						<td colspan="5" style="border:none;">
							<image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;"><span style="float:left;line-height:18px; margin-left:10px;">
							<strong><?= $text_recurring_item ?></strong>
							<?= $product['profile_description'] ?>
						</td>
					</tr>
				<?php endif; ?>
			<tr>
				<td class="name"><a href="<?= $product['href']; ?>"><?= $product['name']; ?></a>
					<?php foreach ($product['option'] as $option) { ?>
					<br>
					<small> - <?= $option['name']; ?>: <?= $option['value']; ?></small>
					<?php } ?>
					<?php if ($product['recurring']): ?>
					<br>
					<small> - <?= $text_payment_profile ?>: <?= $product['profile_name'] ?></small>
					<?php endif; ?>
				</td>
				<td class="model"><?= $product['model']; ?></td>
				<td class="quantity"><?= $product['quantity']; ?></td>
				<td class="price"><?= $product['price']; ?></td>
				<td class="total"><?= $product['total']; ?></td>
			</tr>
			<?php } ?>
			<?php foreach ($vouchers as $voucher) { ?>
			<tr>
				<td class="name"><?= $voucher['description']; ?></td>
				<td class="model"></td>
				<td class="quantity">1</td>
				<td class="price"><?= $voucher['amount']; ?></td>
				<td class="total"><?= $voucher['amount']; ?></td>
			</tr>
			<?php } ?>
			</tbody>
			<tfoot>
			<?php foreach ($totals as $total) { ?>
			<tr>
				<td colspan="4" class="price"><b><?= $total['title']; ?>:</b></td>
				<td class="total"><?= $total['text']; ?></td>
			</tr>
			<?php } ?>
			</tfoot>
		</table>
	</div>
	<div class="well">
		<div class="text-right"><a href="<?= $action_confirm; ?>" class="btn btn-default"><?= $button_confirm; ?></a></div>
	</div>
	<?= $content_bottom; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>