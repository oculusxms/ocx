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

<?php if(!empty($account_approve)){ ?>
<p class="link" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:5px; margin-bottom:15px;">
	<?= $lang_text_approve; ?><br />
	<span style="line-height:100%; font-size:120%;">&raquo;</span>
	<a href="<?= $account_approve; ?>" style="text-decoration:none;" target="_blank">
		<b><?= $account_approve; ?></b>
	</a>
</p>
<?php } ?>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<strong><?= $lang_text_name; ?></strong> <?= $username; ?>
</p>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:8px;">
	<strong><?= $lang_text_email; ?></strong> <a href="mailto:<?= $email; ?>" style="text-decoration:none; word-wrap:break-word;"><?= $email; ?></a>
</p>

<p class="standard" align="left" style="-ms-text-size-adjust:100%; mso-line-height-rule:exactly; font-family:Helvetica, Arial, sans-serif; font-size:12px; line-height:18px; color:#333333; margin-top:0px; margin-bottom:0;">
	<b><?= $email_server; ?></b>
</p>
