<?= $header; ?>
<?php if ($attention){ ?>
<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $attention; ?></div>
<?php } ?>
<?php if ($success){ ?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $success; ?></div>
<?php } ?>
<?php if ($error_warning){ ?>
<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $error_warning; ?></div>
<?php } ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; echo ($weight) ? '&nbsp;<small>(' . $weight . ')</small>' : ''; ?></h1></div>
		<form class="form-inline" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="table table-striped">
				<thead>
					<tr>
						<th class="hidden-xs text-center"><?= $column_image; ?></th>
						<th><?= $column_name; ?></th>
						<th class="hidden-xs"><?= $column_model; ?></th>
						<th class="text-right"><?= $column_quantity; ?></th>
						<th class="text-right hidden-xs"><?= $column_price; ?></th>
						<th class="text-right col-sm-2"><?= $column_total; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($products as $product){ ?>
					<tr>
						<td class="hidden-xs text-center"><?php if ($product['thumb']){ ?>
							<a href="<?= $product['href']; ?>"><img class="img-thumbnail" src="<?= $product['thumb']; ?>" alt="<?= $product['name']; ?>" title="<?= $product['name']; ?>"></a>
						<?php } ?></td>
						<td><a href="<?= $product['href']; ?>"><?= $product['name']; ?></a>
							<?php if (!$product['stock']){ ?>
								<b class="required">***</b>
							<?php } ?>
							<?php foreach ($product['option'] as $option){ ?>
								<br><div class="help">- <?= $option['name']; ?>: <?= $option['value']; ?></div>
							<?php } ?>
							<?php if ($product['recurring']) { ?>
								<br>
								<div class="help">- <?= $text_recurring_item; ?>: <?= $product['recurring']; ?></div>
							<?php } ?>
							<?php if ($product['reward']){ ?>
								<div class="help"><?= $product['reward']; ?></div>
							<?php } ?></td>
						<td class="hidden-xs"><?= $product['model']; ?></td>
						<td class="text-right">
							<input type="number" name="quantity[<?= $product['key']; ?>]" value="<?= $product['quantity']; ?>" class="form-control" min="1" autocomplete="off">
							<div class="btn-group">
								<a class="btn btn-info" onclick="$('#form').submit();"><i class="fa fa-refresh" data-toggle="tooltip" title="<?= $button_update; ?>"></i></a>
								<a class="btn btn-danger" href="<?= $product['remove']; ?>"><i class="fa fa-times" data-toggle="tooltip" title="<?= $button_remove; ?>"></i></a>
							</div>
						</td>
						<td class="text-right hidden-xs"><?= $product['price']; ?></td>
						<td class="text-right"><?= $product['total']; ?></td>
					</tr>
					<?php } ?>
					<?php foreach ($vouchers as $vouchers){ ?>
					<tr>
						<td class="hidden-xs text-center"><i class="fa fa-gift fa-2x"></i></td>
						<td><?= $vouchers['description']; ?></td>
						<td class="hidden-xs"></td>
						<td class="text-right"><a class="btn btn-danger" href="<?= $vouchers['remove']; ?>"><i class="fa fa-times" data-toggle="tooltip" title="<?= $button_remove; ?>"></i></a></td>
						<td class="text-right hidden-xs"><?= $vouchers['amount']; ?></td>
						<td class="text-right"><?= $vouchers['amount']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
		<?php if ($coupon_status || $voucher_status || $reward_status || $shipping_status){ ?>
			<fieldset>
			<legend><?= $text_next; ?></legend>
			<p><?= $text_next_choice; ?></p>
			<div class="panel-group" id="next-container">
				<?php if ($coupon_status){ ?>
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-collapse"><a data-toggle="collapse" data-parent="#next-container" href="#coupon"><?= $text_use_coupon; ?></a></div>
						<div id="coupon" class="panel-collapse collapse<?= ($next == 'coupon' ? ' in' : ''); ?>">
							<div class="panel-body">
								<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
									<label for="next_coupon"><?= $entry_coupon; ?></label>
									<div class="form-group">
										<div class="col-sm-6">
											<input type="text" name="coupon" value="<?= $coupon; ?>" class="form-control" placeholder="<?= $entry_coupon; ?>"  id="next_coupon">
										</div>
									</div>
									<input type="submit" value="<?= $button_coupon; ?>" class="btn btn-primary">
									<input type="hidden" name="next" value="coupon">
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($voucher_status){ ?>
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-collapse"><a data-toggle="collapse" data-parent="#next-container" href="#voucher"><?= $text_use_voucher; ?></a></div>
						<div id="voucher" class="panel-collapse collapse<?= ($next == 'voucher' ? ' in' : ''); ?>">
							<div class="panel-body">
								<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
									<label for="next_voucher"><?= $entry_voucher; ?></label>
									<div class="form-group">
										<div class="col-sm-6">
											<input type="text" name="voucher" value="<?= $voucher; ?>" class="form-control" placeholder="<?= $entry_voucher; ?>"  id="next_voucher">
										</div>
									</div>
									<input type="hidden" name="next" value="voucher">
									<input type="submit" value="<?= $button_voucher; ?>" class="btn btn-primary">
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($reward_status){ ?>
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-collapse"><a data-toggle="collapse" data-parent="#next-container" href="#reward"><?= $text_use_reward; ?></a></div>
						<div id="reward" class="panel-collapse collapse<?= ($next == 'reward' ? ' in' : ''); ?>">
							<div class="panel-body">
								<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
									<label for="next_reward"><h5><?= $entry_reward; ?></h5></label>
									<input type="text" name="reward" value="<?= $reward; ?>" class="form-control" placeholder="<?= $entry_reward; ?>"  id="next_reward">
									<input type="hidden" name="next" value="reward">
									<input type="submit" value="<?= $button_reward; ?>" class="btn btn-primary">
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($shipping_status){ ?>
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-collapse">
							<a data-toggle="collapse" data-parent="#next-container" href="#shipping"><?= $text_shipping_estimate; ?></a></div>
						<div id="shipping" class="panel-collapse collapse<?= ($next == 'shipping' ? ' in' : ''); ?>">
							<div class="panel-body">
								<form class="form-horizontal" id="form-shipping">
									<h5><?= $text_shipping_detail; ?></h5><hr>
									<div class="form-group">
										<label class="control-label col-sm-3" for="country_id"><b class="required">*</b> <?= $entry_country; ?></label>
										<div class="col-sm-6">
											<select name="country_id" 
												class="form-control" 
												id="country_id" 
												data-param="<?= htmlentities('{"zone_id":"' . $zone_id . '","select":"' . $text_select . '","none":"' . $text_none . '"}'); ?>" required>
											<option value=""><?= $text_select; ?></option>
											<?php foreach ($countries as $country){ ?>
											<?php if ($country['country_id'] == $country_id){ ?>
											<option value="<?= $country['country_id']; ?>" selected=""><?= $country['name']; ?></option>
											<?php } else { ?>
											<option value="<?= $country['country_id']; ?>"><?= $country['name']; ?></option>
											<?php } ?>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="zone_id"><b class="required">*</b> <?= $entry_zone; ?></label>
										<div class="col-sm-6">
											<select name="zone_id" class="form-control" id="zone_id" required></select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="postcode">
										<b id="postcode-required" class="required">*</b> <?= $entry_postcode; ?></label>
										<div class="col-sm-2">
											<input type="text" name="postcode" value="<?= $postcode; ?>" 
												class="form-control" placeholder="<?= $entry_postcode; ?>"  id="postcode">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-6 col-sm-offset-3">
											<button type="button" id="button-quote" 
												class="btn btn-primary" data-loading-text="Loading Quotes"><?= $button_quote; ?></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			</fieldset>
		<?php } ?>
		<table class="table">
			<?php foreach ($totals as $total){ ?>
				<tr>
					<td class="text-right"><?= $total['title']; ?>:</td>
					<td class="text-right col-sm-2"><?= $total['text']; ?></td>
				</tr>
			<?php } ?>
		</table>
		<div class="form-actions">
			<div class="form-actions-inner">
				<div class="form-actions-inner text-right">
					<a href="<?= $continue; ?>" class="hidden-xs btn btn-default pull-left"><?= $button_shopping; ?></a>
					<a href="<?= $checkout; ?>" class="btn btn-warning btn-lg"><i class="fa fa-shopping-cart"></i> <?= $button_checkout; ?></a>
				</div>
			</div>
		</div>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?php if ($shipping_status){ ?>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<form class="modal-dialog" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?= $text_shipping_method; ?></h4>
			</div>
			<div class="modal-body">
				<table id="modal-table" class="table table-striped"></table>
				<input type="hidden" name="next" value="shipping">
			</div>
			<div class="modal-footer">
				<button type="submit" 
					id="button-shipping" 
					class="btn btn-primary"<?= (!$shipping_method) ? ' disabled=""' : ''; ?>><?= $button_shipping; ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</form>
</div>
<?php } ?>
<?= $pre_footer; ?>
<?= $footer; ?>