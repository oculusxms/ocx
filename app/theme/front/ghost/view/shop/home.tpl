<?= $header; ?>
<?= $post_header; ?>
	<div class="row">
		<?= $column_left; ?>
		<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
			<?= $content_top; ?>
			<h1 class="hide"><?= $heading_title; ?></h1>
			<?= $content_bottom; ?>
		</div>
		<?= $column_right; ?>
	</div>
<?= $pre_footer; ?>
<?= $footer; ?>