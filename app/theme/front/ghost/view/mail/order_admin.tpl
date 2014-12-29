<table style="border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="2"></td>
		<td class="heading2" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:20px; margin:0; padding: 0; font-weight:bold;"><strong>
			<?= $title; ?>
		</strong></td>
	</tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="3">&nbsp;</td><td height="3">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="1" bgcolor="#cccccc">&nbsp;</td><td height="1" bgcolor="#cccccc">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="10">&nbsp;</td><td height="10">&nbsp;</td></tr>
</table>

<p class="heading1" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; line-height:22px; color:#333333; margin-top:0px; margin-bottom:10px;">
	<strong><?= $text_new_received; ?></strong>
</p>

<?php if($comment){ ?>
<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<b><?= $text_new_comment; ?></b><br />
	<?= $comment; ?>
</p>
<?php } ?>

<table cellpadding="5" cellspacing="0" width="100%" style="table-layout:fixed; margin:0; color:#666; border-collapse:separate; -moz-border-radius:3px; -moz-box-shadow:0 1px 2px #d1d1d1; -webkit-border-radius:3px; -webkit-box-shadow:0 1px 2px #d1d1d1; border:1px solid #e0e0e0; border-radius:3px; box-shadow:0 1px 2px #d1d1d1; text-shadow:1px 1px 0px #fff;">
<thead>
	<tr>
    	<th bgcolor="#ededed" colspan="2" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:bold;"><?= $text_order_detail; ?></th>
   	</tr>
</thead>
<tbody>
	<tr>
    	<td bgcolor="#fafafa" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-bottom:1px solid #e0e0e0; word-wrap:normal;">
          	<?php if(isset($order_id)){ ?>
          		<b><?= $text_order_id; ?></b> <?= $order_id; ?><br />
          	<?php } ?>
    		<?php if(isset($invoice_no)){?>
    			<b><?= $text_invoice_no; ?></b> <?= $invoice_no; ?><br />
    		<?php } ?>
          	<b><?= $text_date_added; ?></b> <?= $date_added; ?><br />
          	<b><?= $text_new_order_status; ?></b> <?= $new_order_status; ?><br />
          	<?php if(isset($order_weight) && $order_weight > 0){ ?><b><?= $text_weight; ?></b> <?= $order_weight_fvalue; ?><br /><?php } ?>
			<b><?= $text_payment_method; ?></b> <?= $payment_method; ?><br />
          	<?php if ($shipping_method) { ?>
          		<b><?= $text_shipping_method; ?></b> <?= $shipping_method; ?>
          	<?php } ?>
        </td>
        <td bgcolor="#fafafa" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0; word-wrap:normal;">
        	<b><?= $text_email; ?></b> <a href="mailto:<?= $email; ?>" style="text-decoration:none; word-wrap:normal;"><?= $email; ?></a><br />
          	<b><?= $text_telephone; ?></b> <?= $telephone; ?><br />
          	<b><?= $text_ip; ?></b> <?= $ip; ?>
          	<?php if($customer_group){ ?>
          		<br /><b><?= $text_customer_group; ?></b> <?= $customer_group; ?>
          	<?php } ?>
          	<?php if($affiliate){ ?>
          		<br /><b><?= $text_affiliate; ?></b> [#<?= $affiliate['affiliate_id']; ?>]
          		<a href="mailto:<?= $affiliate['email']; ?>"><?= $affiliate['firstname'].' '.$affiliate['lastname']; ?></a>
          	<?php } ?>
        </td>
	</tr>
	<tr>
    	<td bgcolor="#f6f6f6" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-bottom:1px solid #e0e0e0; word-wrap:normal;">
    		<strong><?= $text_payment_address; ?></strong><br />
    		<span style="line-height:14px"><?= $payment_address; ?></span>
    	</td>
        <td bgcolor="#f6f6f6" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0; word-wrap:normal;">
        	<?php if ($shipping_address) { ?>
	        	<strong><?= $text_shipping_address; ?></strong><br />
	        	<span style="line-height:14px"><?= $shipping_address; ?></span>
        	<?php } else { echo "&nbsp;"; }?>
        </td>
	</tr>
</tbody>
</table>

<table class="emailSpacer" cellpadding="0" cellspacing="0" width="100%" style="width:100%; table-layout:fixed; border-collapse:separate;">
<tr><td style="line-height: 0; font-size: 0;" height="15">&nbsp;</td></tr>
</table>

<table cellpadding="5" cellspacing="0" width="100%" style="table-layout:fixed; margin:0; color:#666; border-collapse:separate; -moz-border-radius:3px; -moz-box-shadow:0 1px 2px #d1d1d1; -webkit-border-radius:3px; -webkit-box-shadow:0 1px 2px #d1d1d1; background:#eaebec; border:1px solid #e0e0e0; border-radius:3px; box-shadow:0 1px 2px #d1d1d1; text-shadow:1px 1px 0px #fff;">
<thead>
	<tr>
        <th width="50%" bgcolor="#ededed" align="left" style="-ms-text-size-adjust:100%; text-align: left; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; word-wrap:normal;">
        	<b><?= $text_product; ?></b>
        </th>
		<th width="10%" bgcolor="#ededed" align="left" style="-ms-text-size-adjust:100%; text-align: left; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; word-wrap:normal;">
        	<b><?= $text_quantity; ?></b>
        </th>
        <th width="20%" bgcolor="#ededed" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; text-align:right; font-size:14px; word-wrap:normal;">
        	<b><?= $text_price; ?></b>
        </th>
        <th width="20%" bgcolor="#ededed" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; text-align:right; font-size:14px; word-wrap:normal;">
        	<b><?= $text_total; ?></b>
        </th>
	</tr>
</thead>
<tbody>
	<?php $i = 0;
	foreach ($products as $product) {
		if(($i++ % 2)){
			$row_style_background = "#f6f6f6";
		} else {
			$row_style_background = "#fafafa";
		}
	?>
    <tr>
		<td bgcolor="<?= $row_style_background; ?>" align="left" style="word-wrap:normal; text-align: left; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0;">
			<?php if(isset($product['url_admin'])): ?>
				<?php if($product['image']){ ?>
					<a href="<?= $product['url_admin']; ?>">
						<img src="<?= $product['image']; ?>" alt="" style="border:none; float: left; display: inline; margin-right: 5px;" />
					</a>
				<?php } ?>
			
				<a href="<?= $product['url_admin']; ?>" style="text-decoration:none; color:inherit">
					<?= $product['name']; ?>
				</a>
			<?php else: ?>
				<?php if($product['image']){ ?>
					<img src="<?= $product['image']; ?>" alt="" style="border:none; float: left; display: inline; margin-right: 5px;" />
				<?php } ?>
				
				<?= $product['name']; ?>
			<?php endif; ?>
			
			<?php if(isset($product['model']) && $product['model']){ ?><br /><b><?= $text_model; ?>:</b> <?= $product['model']; ?><?php } ?>
			<?php if(isset($product['weight']) && $product['weight'] > 0){ ?><br /><b><?= $text_product_weight; ?>:</b> <?= $product['weight_fvalue']; ?><?php } ?>
			<?php if(isset($product['sku']) && $product['sku']){ ?><br /><b><?= $text_sku; ?>:</b> <?= $product['sku']; ?><?php } ?>
			<?php if(isset($product['product_id'])){ ?><br /><b><?= $text_id; ?>:</b> <?= $product['product_id']; ?><?php } ?>
			<?php if(isset($product['stock_quantity'])){ ?><br /><b><?= $text_stock_quantity; ?></b> <span style="color: <?php if($product['stock_quantity'] <= 0) { echo '#FF0000'; } elseif($product['stock_quantity'] <= 5) { echo '#FFA500'; } else { echo '#008000'; }?>"><?= $product['stock_quantity']; ?></span><?php } ?>
			
			<?php if(!empty($product['option'])){ ?>
			<br style="clear:both" />
			<b><?= $text_product_options; ?></b>
			<ul style="margin:5px 0 0 0; padding:0 0 0 15px; font-size:<?= $body_product_option_size; ?>px; line-height:1;">
			<?php foreach ($product['option'] as $option) { ?>
				<li style="margin: 0 0 4px 0; padding:0;">
				    <strong><?= $option['name']; ?>:</strong>&nbsp;<?= $option['value']; ?><?php if($option['price']) echo "&nbsp;(".$option['price'].")" ?>
			    </li>
			<?php } ?>
			</ul>
			<?php } ?>
		</td>
		<td bgcolor="<?= $row_style_background; ?>" align="left" style="text-align: left; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;">
			<?= $product['quantity']; ?>
		</td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;">
			<?= $product['price']; ?>
		</td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;"><?= $product['total']; ?></td>
	</tr>
	<?php } ?>
	<?php
	if(isset($vouchers)){
		foreach ($vouchers as $voucher) {
			if(($i++ % 2)){
				$row_style_background = "#f6f6f6";
			} else {
				$row_style_background = "#fafafa";
			}
	?>
	<tr>
        <td colspan="3" bgcolor="<?= $row_style_background; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; word-wrap:normal;"><?= $voucher['description']; ?></td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;"><?= $voucher['amount']; ?></td>
	</tr>
	<?php }
	} ?>
</tbody>
<tfoot>
	<?php foreach ($totals as $total) {
		if(($i++ % 2)){
			$row_style_background = "#f6f6f6";
		} else {
			$row_style_background = "#fafafa";
		}
	?>
	<tr>
		<td bgcolor="<?= $row_style_background; ?>" colspan="3" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; word-wrap:normal;"><b><?= $total['title']; ?></b></td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-left:1px solid #e0e0e0;"><?= $total['text']; ?></td>
	</tr>
	<?php } ?>
</tfoot>
</table>

<table class="emailSpacer" cellpadding="0" cellspacing="0" width="100%" style="width:100%; table-layout:fixed; border-collapse:separate;">
<tr><td style="line-height: 0; font-size: 0;" height="15">&nbsp;</td></tr>
</table>

<?php if ($order_link) { ?>
<p class="link" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:5px; margin-bottom:15px;">
	<b><?= $text_order_link; ?></b><br />
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $order_link; ?>" style="text-decoration:none;" target="_blank">
		<b><?= $order_link; ?></b>
	</a>
</p>
<?php } ?>

<?php if($instruction){ ?>
<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0px;">
	<strong><?= $text_new_instruction; ?></strong><br />
	<?= $instruction; ?>
</p>
<?php } ?>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0;">
	<b><?= $email_server; ?></b>
</p>