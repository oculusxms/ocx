<?= $header; ?>
<?= $breadcrumb; ?>
<?php if (!empty($error)): ?>
<div class="alert alert-danger"><?= $error; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<?php if (!empty($error_warning)): ?>
<div class="alert alert-danger"><?= $error_warning; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<?php if (!empty($success)): ?>
<div class="alert alert-success"><?= $success; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
<?php endif; ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="h2"><i class="fa fa-bar-chart-o"></i><?= $heading_title; ?></div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th><?= $column_customer; ?></th>
					<th class="hidden-xs"><?= $column_email; ?></th>
					<th><?= $column_customer_group; ?></th>
					<th class="hidden-xs"><?= $column_status; ?></th>
					<th class="text-right"><?= $column_total; ?></th>
					<th class="text-right"><span class="hidden-xs"><?= $column_action; ?></span></th>
				</tr>
			</thead>
			<tbody data-link="row" class="rowlink">
				<?php if ($customers) { ?>
				<?php foreach ($customers as $customer) { ?>
				<tr>
					<td><?= $customer['customer']; ?></td>
					<td class="hidden-xs"><?= $customer['email']; ?></td>
					<td><?= $customer['customer_group']; ?></td>
					<td class="hidden-xs text-<?= strtolower($customer['status']); ?>"><?= $customer['status']; ?></td>
					<td class="text-right"><?= $customer['total']; ?></td>
					<td class="text-right"><?php foreach ($customer['action'] as $action) { ?>
						<a class="btn btn-default" href="<?= $action['href']; ?>">
							<i class="fa fa-pencil-square-o"></i><span class="hidden-xs"> <?= $action['text']; ?></span>
						</a>
						<?php } ?></td>
				</tr>
				<?php } ?>
				<?php } else { ?>
				<tr>
					<td class="text-center" colspan="6"><?= $text_no_results; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
		<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
	</div>
</div>
<?= $footer; ?>