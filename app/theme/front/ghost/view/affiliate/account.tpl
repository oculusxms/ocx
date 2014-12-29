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
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<fieldset>
			<legend><?= $text_my_account; ?></legend>
			<ul>
				<li><a href="<?= $edit; ?>"><?= $text_edit; ?></a></li>
				<li><a href="<?= $password; ?>"><?= $text_password; ?></a></li>
				<li><a href="<?= $payment; ?>"><?= $text_payment; ?></a></li>
			</ul>
		</fieldset>
		<fieldset>
			<legend><?= $text_my_tracking; ?></legend>
			<ul>
				<li><a href="<?= $tracking; ?>"><?= $text_tracking; ?></a></li>
			</ul>
		</fieldset>
		<fieldset>
			<legend><?= $text_my_transactions; ?></legend>
			<ul>
				<li><a href="<?= $transaction; ?>"><?= $text_transaction; ?></a></li>
			</ul>
		</fieldset>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>