<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<?php if ($transactions) { ?>
		<div class="alert alert-info"><?= $text_balance; ?> <b><?= $balance; ?></b></div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?= $column_date_added; ?></th>
					<th><?= $column_description; ?></th>
					<th class="text-right"><?= $column_amount; ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($transactions	as $transaction) { ?>
				<tr>
					<td><?= $transaction['date_added']; ?></td>
					<td><?= $transaction['description']; ?></td>
					<td class="text-right"><?= $transaction['amount']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
		<?php } else { ?>
			<div class="alert alert-warning"><?= $text_empty; ?></div>
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