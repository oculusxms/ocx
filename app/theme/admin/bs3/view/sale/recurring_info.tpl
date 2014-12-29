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
		<div class="clearfix">
			<div class="pull-left h2"><i class="hidden-xs fa fa-user"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<a class="btn btn-warning" href="<?= $return; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-striped table-bordered">
			<tr>
				<td><?php echo $entry_order_recurring; ?></td>
				<td><?php echo $order_recurring_id; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_order_id; ?></td>
				<td><a href="<?php echo $order_href; ?>"><?php echo $order_id; ?></a></td>
			</tr>
			<tr>
				<td><?php echo $entry_customer; ?></td>
				<td>
					<?php if ($customer_href) { ?>
					<a href="<?php echo $customer_href ?>"><?php echo $customer; ?></a>
					<?php } else { ?>
					<?php echo $customer; ?>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_email; ?></td>
				<td><?php echo $email; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_status; ?></td>
				<td><?php echo $status; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_date_added; ?></td>
				<td><?php echo $date_added; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_reference; ?></td>
				<td><?php echo $reference; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_payment_method; ?></td>
				<td><?php echo $payment_method; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_recurring; ?></td>
				<td>
					<?php if ($recurring) { ?>
					<a href="<?php echo $recurring; ?>"><?php echo $recurring_name; ?></a>
					<?php } else { ?>
					<?php echo $recurring_name; ?>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_description; ?></td>
				<td><?php echo $recurring_description; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_product; ?></td>
				<td><?php echo $product; ?></td>
			</tr>
			<tr>
				<td><?php echo $entry_quantity; ?></td>
				<td><?php echo $quantity; ?></td>
			</tr>
		</table>
		<?php echo $buttons; ?>
		<h2><?php echo $text_transactions; ?></h2>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<td class="text-left"><?php echo $entry_date_added; ?></td>
					<td class="text-left"><?php echo $entry_amount; ?></td>
					<td class="text-left"><?php echo $entry_type; ?></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($transactions as $transaction) { ?>
				<tr>
					<td class="text-left"><?php echo $transaction['date_added']; ?></td>
					<td class="text-left"><?php echo $transaction['amount']; ?></td>
					<td class="text-left"><?php echo $transaction['type']; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?= $footer; ?>