<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<?php if ($recurrings) { ?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="text-right hidden-xs"><?= $column_recurring_id; ?></th>
						<th><?= $column_date_added; ?></th>
						<th><?= $column_status; ?></th>
						<th class="text-right"><?= $column_product; ?></th>
						<th class="text-right"><?= $column_action; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($recurrings as $recurring) { ?>
						<tr>
							<td class="text-right hidden-xs">#<?= $recurring['id']; ?></td>
							<td><?= $recurring['date_added']; ?></td>
							<td><?= $status_types[$recurring['status']]; ?></td>
							<td class="text-right"><?= $recurring['name']; ?></td>
							<td class="text-right">
								<a class="btn btn-default" href="<?= $recurring['href']; ?>"><i class="fa fa-search-plus"></i> <?= $button_view; ?></a>
							</td>
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