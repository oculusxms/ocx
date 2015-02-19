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

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<?= $lang_text_greeting; ?>
</p>

<?php if ($customer_id) { ?>
<p class="link" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:5px; margin-bottom:15px;">
	<b><?= $lang_text_link; ?></b><br />
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $link; ?>" style="text-decoration:none;" target="_blank">
		<b><?= $link; ?></b>
	</a>
</p>
<?php } ?>

<?php if ($download) { ?>
<p class="link" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:5px; margin-bottom:15px;">
	<b><?= $lang_text_download; ?></b><br />
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $download; ?>" style="text-decoration:none;" target="_blank">
		<b><?= $download; ?></b>
	</a>
</p>
<?php } ?>

<?php if($instruction){ ?>
<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<b><?= $lang_text_new_instruction; ?></b><br />
	<?= $instruction; ?>
</p>
<?php } ?>

<table cellpadding="5" cellspacing="0" width="100%" style="table-layout:fixed; margin:0; color:#666; border-collapse:separate; -moz-border-radius:3px; -moz-box-shadow:0 1px 2px #d1d1d1; -webkit-border-radius:3px; -webkit-box-shadow:0 1px 2px #d1d1d1; border:1px solid #e0e0e0; border-radius:3px; box-shadow:0 1px 2px #d1d1d1; text-shadow:1px 1px 0px #fff;">
<thead>
	<tr>
    	<th bgcolor="#ededed" align="center" style="text-align:center; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:bold"><?= $lang_text_order_detail; ?></th>
   	</tr>
</thead>
<tbody>
	<tr>
		<td bgcolor="#fafafa" width="100%" style="padding:0; border-bottom:1px solid #e0e0e0">
			<table cellpadding="0" cellspacing="0" width="100%" class="tableStack" style="table-layout:fixed; margin:0; border-collapse:separate">
			<tbody>
				<tr>
			    	<td width="50%" bgcolor="#fafafa" style="padding:10px; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; word-wrap:normal;">
			          	<?php if(isset($order_id)){ ?><b><?= $lang_text_order_id; ?></b> <?= $order_id; ?><br /><?php } ?>
			    		<?php if(isset($invoice_no)){?><b><?= $lang_text_invoice_no; ?></b> <?= $invoice_no; ?><br /><?php } ?>
			          	<b><?= $lang_text_date_added; ?></b> <?= $date_added; ?><br />
			          	<b><?= $lang_text_new_order_status; ?></b> <?= $new_order_status; ?><br />
						<b><?= $lang_text_payment_method; ?></b> <?= $payment_method; ?><br />
			          	<?php if ($shipping_method) { ?><b><?= $lang_text_shipping_method; ?></b> <?= $shipping_method; ?><?php } ?>
			        </td>
			        <td class="last-child" width="50%" bgcolor="#fafafa" style="padding:10px; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-left:1px solid #e0e0e0; word-wrap:normal;">
			        	<b><?= $lang_text_email; ?></b> <a href="mailto:<?= $email; ?>" style="text-decoration:none; word-wrap:normal;"><?= $email; ?></a><br />
			          	<b><?= $lang_text_telephone; ?></b> <?= $telephone; ?>
			        </td>
		        </tr>
	        </tbody>
			</table>
		</td>
    </tr>
    <tr class="last-child">
		<td bgcolor="#f6f6f6" width="100%" style="padding:0;">
			<table cellpadding="0" cellspacing="0" width="100%" class="tableStack" style="table-layout:fixed; margin:0; border-collapse:separate">
			<tbody>				
				<tr>
			    	<td width="50%" bgcolor="#f6f6f6" style="padding:10px; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; word-wrap:normal;">
			    		<strong><?= $lang_text_payment_address; ?></strong><br />
			    		<?= $payment_address; ?>
			    	</td>
			        <td class="last-child" width="50%" bgcolor="#f6f6f6" style="padding:10px; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; border-left:1px solid #e0e0e0; word-wrap:normal;">
			        	<?php if ($shipping_address) { ?>
			        	<strong><?= $lang_text_shipping_address; ?></strong><br />
			        	<?= $shipping_address; ?>
			        	<?php } else { echo "&nbsp;"; }?>
			        </td>
		        </tr>
	        </tbody>
	        </table>
        </td>
	</tr>
</tbody>
</table>

<table class="emailSpacer" cellpadding="0" cellspacing="0" width="100%" style="width:100%; table-layout:fixed; border-collapse:separate;">
<tr><td style="line-height: 0; font-size: 0;" height="15">&nbsp;</td></tr>
</table>

<?php if(!empty($products) || !empty($vouchers) || !empty($totals)){ ?>
<table cellpadding="5" cellspacing="0" width="100%" style="table-layout:fixed; margin:0; color:#666; border-collapse:separate; -moz-border-radius:3px; -moz-box-shadow:0 1px 2px #d1d1d1; -webkit-border-radius:3px; -webkit-box-shadow:0 1px 2px #d1d1d1; background:#eaebec; border:1px solid #e0e0e0; border-radius:3px; box-shadow:0 1px 2px #d1d1d1; text-shadow:1px 1px 0px #fff;">
<thead>
	<tr>
        <th width="50%" bgcolor="#ededed" align="left" style="text-align:left; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:bold; word-wrap:normal;">
        	<?= $lang_text_product; ?>
        </th>
        <?php if($table_quantity){ ?>
        <th width="10%" bgcolor="#ededed" align="left" style="text-align:left; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; word-wrap:normal;">
        	<?= $lang_text_quantity; ?>
        </th>
        <?php } ?>
        <th width="<?php if($table_quantity){ ?>20<?php } else { ?>25<?php } ?>%" bgcolor="#ededed" align="right" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:bold; word-wrap:normal;">
        	<?= $lang_text_price; ?>
        </th>
        <th width="<?php if($table_quantity){ ?>20<?php } else { ?>25<?php } ?>%" bgcolor="#ededed" align="right" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:14px; font-weight:bold; word-wrap:normal;">
        	<?= $lang_text_total; ?>
        </th>
	</tr>
</thead>
<tbody>
	<?php 
	$colspan = ($table_quantity) ? 3 : 2;
	$i = 0;
	foreach ($products as $product) {
		if(($i++ % 2)){
			$row_style_background = "#f6f6f6";
		} else {
			$row_style_background = "#fafafa";
		}
	?>
    <tr>
		<td bgcolor="<?= $row_style_background; ?>" align="left" style="word-wrap:normal; text-align: left; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0;">
			
			<?php if($product['image']){ ?>
				<?php if(!empty($product['url'])){ ?>
					<a href="<?= $product['url']; ?>" style="text-decoration:none; color:inherit">
						<img class="productImage" src="<?= $product['image']; ?>" width="50" height="50" alt="" style="float: left; margin-right: 5px;" />
					</a>
				<?php } else { ?>
					<img class="productImage" src="<?= $product['image']; ?>" width="50" height="50" alt="" style="float: left; margin-right: 5px;" />
				<?php } ?>				
			<?php } ?>
			
			<?php if(!empty($product['url'])){ ?>
				<a href="<?= $product['url']; ?>" style="text-decoration:none; color:inherit">
					<?= $product['name']; ?>
				</a>
			<?php } else { ?>
				<?= $product['name']; ?>
			<?php } ?>
			
			<?php if($product['model'] || !empty($product['option'])){ ?>
				<br class="clearMobile" />
			<?php } ?>
			
			<?php if($product['model']){ ?><span style="font-size:11px; line-height: 16px;"><b><?= $lang_text_model; ?>:</b>&nbsp;<?= $product['model']; ?></span><?php } ?>

			<?php if($product['hangout']){ ?>
				<br class="clearMobile" />
				<span style="font-size:11px; line-height: 16px;"><b><?= $lang_text_google; ?>:</b>&nbsp;<?= $product['hangout']; ?></span>
			<?php } ?>
					
			<?php if(!empty($product['option'])){ ?>
			<br style="clear:both" />
			<ul style="margin:5px 0 0 0; padding:0 0 0 15px; font-size:<?= $body_product_option_size; ?>px; line-height:16px;">
			<?php foreach ($product['option'] as $option) { ?>
				<li style="margin: 0 0 4px 0; padding: 0;"><strong><?= $option['name']; ?>:</strong>&nbsp;<?= $option['value']; ?></li>
			<?php } ?>
			</ul>
			<?php } ?>
		</td>
		<?php if($table_quantity){ ?>
			<td bgcolor="<?= $row_style_background; ?>" align="left" style="-ms-text-size-adjust:100%; text-align: left; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;">
				<?= $product['quantity']; ?>
			</td>
			<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;">
				<?= $product['price']; ?>
			</td>
		<?php } else { ?>
			<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;">
				<?php if($product['quantity'] > 1) { echo $product['quantity']; ?> <b>x</b> <?php } echo $product['price']; ?>
			</td>
		<?php } ?>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; font-family:Helvetica, Arial, sans-serif; font-size:11px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;"><?= $product['total']; ?></td>
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
        <td colspan="<?= $colspan; ?>" bgcolor="<?= $row_style_background; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-bottom:1px solid #e0e0e0; word-wrap:normal;"><?= $voucher['description']; ?></td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; font-size:12px; border-bottom:1px solid #e0e0e0; border-left:1px solid #e0e0e0;"><?= $voucher['amount']; ?></td>
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
		<td bgcolor="<?= $row_style_background; ?>" colspan="<?= $colspan; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; word-wrap:normal;"><b><?= $total['title']; ?></b></td>
		<td bgcolor="<?= $row_style_background; ?>" style="text-align:right; -ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; border-left:1px solid #e0e0e0;"><?= $total['text']; ?></td>
	</tr>
	<?php } ?>
</tfoot>
</table>

<table class="emailSpacer" cellpadding="0" cellspacing="0" width="100%" style="width:100%; table-layout:fixed; border-collapse:separate;">
<tr><td style="line-height: 0; font-size: 0;" height="15">&nbsp;</td></tr>
</table>
<?php } ?>

<?php if($comment){ ?>
<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<b><?= $lang_text_new_comment; ?></b><br />
	<?= $comment; ?>
</p>
<?php } ?>

<?php if ($has_hangout) { ?>
<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0px;">
	<?= $lang_text_hangout_alert; ?><br><br>
</p>
<?php } ?>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0px;">
	<?= $lang_text_footer; ?><br><br>
</p>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0;">
	<a href="<?= $email_store_url; ?>" style="color:#000000; text-decoration:none; font-weight:bold" target="_blank"><?= $email_store_name; ?></a>
</p>