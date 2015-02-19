<?= $header; ?>
<?php if ($success) { ?>
<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= $success; ?></div>
<?php } ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $lang_heading_title; ?></h1></div>
		<fieldset>
			<legend><?= $lang_text_my_account; ?></legend>
			<ul>
				<li><a href="<?= $edit; ?>"><?= $lang_text_edit; ?></a></li>
				<li><a href="<?= $password; ?>"><?= $lang_text_password; ?></a></li>
				<li><a href="<?= $payment; ?>"><?= $lang_text_payment; ?></a></li>
			</ul>
		</fieldset>
		<fieldset>
			<legend><?= $lang_text_my_tracking; ?></legend>
			<ul>
				<li><a href="<?= $tracking; ?>"><?= $lang_text_tracking; ?></a></li>
			</ul>
		</fieldset>
		<fieldset>
			<legend><?= $lang_text_my_transactions; ?></legend>
			<ul>
				<li><a href="<?= $transaction; ?>"><?= $lang_text_transaction; ?></a></li>
			</ul>
		</fieldset>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>