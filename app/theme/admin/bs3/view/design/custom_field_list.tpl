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
			<div class="pull-left h2"><i class="hidden-xs fa fa-picture-o"></i><?= $lang_heading_title; ?></div>
			<div class="pull-right">
				<a href="<?= $insert; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i><span class="hidden-xs"> <?= $lang_button_insert; ?></span></a>
				<button type="submit" form="form" formaction="<?= $delete; ?>" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $lang_button_delete; ?></span></button>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form action="<?= $delete; ?>" method="post" enctype="multipart/form-data" id="form">
		<table class="table table-bordered table-striped table-hover">
			<thead>
			<tr>
				<th width="40" class="text-center"><input type="checkbox" data-toggle="selected"></th>
				<th><a href="<?= $sort_name; ?>"><?= $lang_column_name; echo ($sort == 'cfd.name') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
				<th><a href="<?= $sort_type; ?>"><?= $lang_column_type; echo ($sort == 'cf.type') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
				<th><a href="<?= $sort_location; ?>"><?= $lang_column_location; echo ($sort == 'cf.location') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
				<th class="text-right"><a href="<?= $sort_sort_order; ?>"><?= $lang_column_sort_order; echo ($sort == 'cf.sort_order') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
				<th class="text-right"><?= $lang_column_action; ?></th>
			</tr>
			</thead>
			<tbody>
			<?php if ($custom_fields) { ?>
			<?php foreach ($custom_fields as $custom_field) { ?>
			<tr>
				<td class="text-center"><?php if ($custom_field['selected']) { ?>
				<input type="checkbox" name="selected[]" value="<?= $custom_field['custom_field_id']; ?>" checked="">
				<?php } else { ?>
				<input type="checkbox" name="selected[]" value="<?= $custom_field['custom_field_id']; ?>">
				<?php } ?></td>
				<td><?= $custom_field['name']; ?></td>
				<td><?= $custom_field['type']; ?></td>
				<td><?= $custom_field['location']; ?></td>
				<td class="text-right"><?= $custom_field['sort_order']; ?></td>
				<td class="text-right"><?php foreach ($custom_field['action'] as $action) { ?>
				<a class="btn btn-default" href="<?= $action['href']; ?>">
					<i class="fa fa-pencil-square-o"></i><span class="hidden-xs"> <?= $action['text']; ?></span>
				</a>
				<?php } ?></td>
			</tr>
			<?php } ?>
			<?php } else { ?>
			<tr>
				<td class="text-center" colspan="6"><?= $lang_text_no_results; ?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		</form>
		<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
	</div>
</div>
<?= $footer; ?>