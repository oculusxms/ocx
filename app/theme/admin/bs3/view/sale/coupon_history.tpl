<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="text-right"><b><?= $lang_column_order_id; ?></b></th>
			<th><?= $lang_column_customer; ?></b></th>
			<th class="text-right"><b><?= $lang_column_amount; ?></b></th>
			<th><?= $lang_column_date_added; ?></b></th>
		</tr>
	</thead>
	<tbody>
		<?php if ($histories) { ?>
		<?php foreach ($histories as $history) { ?>
		<tr>
			<td class="text-right"><?= $history['order_id']; ?></td>
			<td><?= $history['customer']; ?></td>
			<td class="text-right"><?= $history['amount']; ?></td>
			<td><?= $history['date_added']; ?></td>
		</tr>
		<?php } ?>
		<?php } else { ?>
		<tr>
			<td class="text-center" colspan="4"><?= $lang_text_no_results; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
