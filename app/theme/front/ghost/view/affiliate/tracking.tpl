<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<p><?= $text_description; ?></p>
		<p><?= $text_code; ?></p>
		<div class="form-group">
			<input type="text" value="<?= $code; ?>" class="form-control" placeholder="<?= $text_code; ?>"  id="code">
		</div>
		<p><?= $text_generator; ?></p>
		<div class="form-group">
			<input type="text" name="product" value="" class="form-control" placeholder="<?= $text_generator; ?>"  id="product" autocomplete="off">
		</div>
			<p><?= $text_link; ?></p>
		<div class="form-group">
			<textarea name="link" class="form-control" placeholder="<?= $text_link; ?>"  rows="2" id="link" spellcheck="false"></textarea>
		</div>
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