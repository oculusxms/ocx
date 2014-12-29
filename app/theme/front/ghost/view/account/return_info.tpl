<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<fieldset>
			<legend><?= $text_return_detail; ?></legend>
			<div class="row">
				<div class="col-sm-6">
					<b><?= $text_return_id; ?></b> #<?= $return_id; ?><br>
					<b><?= $text_date_added; ?></b> <?= $date_added; ?>
				</div>
				<div class="col-sm-6">
					<b><?= $text_order_id; ?></b> #<?= $order_id; ?><br>
					<b><?= $text_date_ordered; ?></b> <?= $date_ordered; ?>
				</div>
			</div>
		</fieldset>
		<fieldset>
			<legend><?= $text_product; ?></legend>
			<div class="row">
				<div class="col-sm-6">
					<b><?= $column_product; ?>:</b> <?= $product; ?><br>
					<b><?= $column_model; ?>:</b> <?= $model; ?><br>
					<b><?= $column_quantity; ?>:</b> <?= $quantity; ?>
				</div>
				<div class="col-sm-6">
					<b><?= $column_reason; ?>:</b> <?= $reason; ?><br>
					<b><?= $column_opened; ?>:</b> <?= $opened; ?><br>
					<b><?= $column_action; ?>:</b> <?= $action; ?>
				</div>
			</div>
		</fieldset>
		<?php if ($comment) { ?>
			<fieldset>
				<legend><?= $text_comment; ?></legend>
				<?= $comment; ?>
			</fieldset>
		<?php } ?>
		<?php if ($histories) { ?>
			<fieldset>
				<legend><?= $text_history; ?></legend>
				<table class="table table-striped">
					<thead>
						<tr>
							<th><?= $column_date_added; ?></th>
							<th class="col-sm-3"><?= $column_status; ?></th>
							<th class="col-sm-3"><?= $column_comment; ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($histories as $history) { ?>
						<tr>
							<td><?= $history['date_added']; ?></td>
							<td><?= $history['status']; ?></td>
							<td><?= $history['comment']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</fieldset>
		<?php } ?>
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