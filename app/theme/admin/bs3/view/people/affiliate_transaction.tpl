<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th><?= $column_date_added; ?></th>
			<th><?= $column_description; ?></th>
			<th class="text-right"><?= $column_amount; ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if ($transactions) { ?>
		<?php foreach ($transactions as $transaction) { ?>
		<tr>
			<td><?= $transaction['date_added']; ?></td>
			<td><?= $transaction['description']; ?></td>
			<td class="text-right"><?= $transaction['amount']; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td>&nbsp;</td>
			<td class="text-right"><b><?= $text_balance; ?></b></td>
			<td class="text-right"><?= $balance; ?></td>
		</tr>
		<?php } else { ?>
		<tr>
			<td class="text-center" colspan="3"><?= $text_no_results; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
<?= $javascript; ?>