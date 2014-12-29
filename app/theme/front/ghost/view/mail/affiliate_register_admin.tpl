<table style="border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="2"></td>
		<td class="heading2" align="<?= $text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:16px; line-height:20px; color:<?= $body_heading_color; ?>; margin:0; padding: 0; font-weight:bold;"><strong>
			<?= $title; ?>
		</strong></td>
	</tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="3">&nbsp;</td><td height="3">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="1" bgcolor="#cccccc">&nbsp;</td><td height="1" bgcolor="#cccccc">&nbsp;</td></tr>
	<tr style="font-size:1px; line-height:0;"><td width="2" height="10">&nbsp;</td><td height="10">&nbsp;</td></tr>
</table>

<p class="link" align="<?= $text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:5px; margin-bottom:15px;">
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $url_affiliate_login; ?>" style="color:<?= $body_link_color; ?>; text-decoration:none;" target="_blank">
		<b><?= $url_affiliate_login; ?></b>
	</a>
</p>

<p class="standard" align="<?= $text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:8px;">
	<?= $text_services; ?>
</p>

<p class="standard" align="<?= $text_align; ?>" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:<?= $body_font_color; ?>; margin-top:0px; margin-bottom:0px;">
	<?= $text_thanks; ?><br style="line-height:18px;" />
	<a href="<?= $store_url . (strpos($store_url,'?')===false ? '?' : '&amp;').$tracking.'&amp;utm_content=footer_url'; ?>" style="color:#000000; text-decoration:none; font-weight:bold" target="_blank"><?= $store_name; ?></a>
</p>