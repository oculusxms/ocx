<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $lang_heading_title; ?></h1></div>
		<p><?= $text_description; ?></p>
		<p><?= $lang_text_code; ?></p>
		<div class="form-group">
			<input type="text" value="<?= $code; ?>" class="form-control" placeholder="<?= $lang_text_code; ?>"  id="code">
		</div>
		<p><?= $lang_text_generator; ?></p>
		<div class="form-group">
			<input type="text" name="product" value="" class="form-control" placeholder="<?= $lang_text_generator; ?>"  id="product" autocomplete="off">
		</div>
			<p><?= $lang_text_link; ?></p>
		<div class="form-group">
			<textarea name="link" class="form-control" placeholder="<?= $lang_text_link; ?>"  rows="2" id="link" spellcheck="false"></textarea>
		</div>
		<div class="form-actions">
			<div class="form-actions-inner text-right">
				<a href="<?= $continue; ?>" class="btn btn-primary"><?= $lang_button_continue; ?></a>
			</div>
		</div>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>