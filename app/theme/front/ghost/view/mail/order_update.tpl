<table style="border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="2"></td>
		<td class="heading2" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:20px; color:<?= $body_heading_color; ?>; margin:0; padding: 0; font-weight:bold;"><strong>
			<?= $title; ?>
		</strong></td>
	</tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="3">&nbsp;</td><td height="3">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="1" bgcolor="#cccccc">&nbsp;</td><td height="1" bgcolor="#cccccc">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="10">&nbsp;</td><td height="10">&nbsp;</td></tr>
</table>

<p class="standard" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:8px;">
	<?php if(isset($order_id)){ ?><?= $lang_text_update_order; ?><strong> <?= $order_id; ?></strong><?php } ?>
	<?php if(isset($date_added)){ ?><br /><?= $lang_text_update_date_added; ?><strong> <?= $date_added; ?></strong><?php } ?>
</p>

<?php if(isset($order_status)){ ?>
<p class="standard" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:8px;">
	<?= $lang_text_update_order_status; ?><strong> <?= $order_status; ?></strong>
</p>
<?php } ?>

<?php if (isset($customer_id) && isset($order_url)) { ?>
<p class="link" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:5px; margin-bottom:15px;">
	<b><?= $lang_text_update_link; ?></b><br />
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $order_url.(strpos($order_url,'?')===false ? '?' : '&amp;').$tracking.'&amp;utm_content=order_account'; ?>" style="color:<?= $body_link_color; ?>; text-decoration:none;" target="_blank">
		<b><?= $order_url; ?></b>
	</a>
</p>
<?php } ?>

<?php if(!empty($comment)){ ?>
<p class="standard" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:0px;">
	<?= $lang_text_update_comment; ?>
</p>
<div style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-bottom:15px;"><?= $comment; ?></div>
<?php } ?>

<p class="standard" align="<?= $lang_text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:0px;">
	<?php if(isset($text_update_footer)){ ?><?= $lang_text_update_footer; ?><br style="line-height:18px;" /><?php } ?>
	<a href="<?= $store_url . (strpos($store_url,'?')===false ? '?' : '&amp;').$tracking.'&amp;utm_content=footer_url'; ?>" style="color:#000000; text-decoration:none; font-weight:bold" target="_blank"><?= $store_name; ?></a>
</p>