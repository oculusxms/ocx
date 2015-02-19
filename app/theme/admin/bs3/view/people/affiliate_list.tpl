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
		<div class="pull-left h2"><i class="hidden-xs fa fa-user"></i><?= $lang_heading_title; ?></div>
		<div class="pull-right">
			<button type="submit" form="form" class="btn btn-success btn-spacer"><i class="fa fa-check"></i><span class="hidden-xs"> <?= $lang_button_approve; ?></span></button>
			<a href="<?= $insert; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i><span class="hidden-xs"> <?= $lang_button_insert; ?></span></a>
			<button type="submit" form="form" formaction="<?= $delete; ?>" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $lang_button_delete; ?></span></button>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-inline" action="<?= $approve; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="40" class="text-center"><input type="checkbox" data-toggle="selected"></th>
						<th><a href="<?= $sort_name; ?>"><?= $lang_column_name; echo ($sort == 'name') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
						<th><a href="<?= $sort_email; ?>"><?= $lang_column_email; echo ($sort == 'c.email') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
						<th class="text-right hidden-xs"><?= $lang_column_balance; ?></th>
						<th class="hidden-xs"><a href="<?= $sort_status; ?>"><?= $lang_column_status; echo ($sort == 'c.status') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
						<th><a href="<?= $sort_approved; ?>"><?= $lang_column_approved; echo ($sort == 'c.approved') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
						<th class="hidden-xs"><a href="<?= $sort_date_added; ?>"><?= $lang_column_date_added; echo ($sort == 'c.date_added') ? '<i class="caret caret-' . strtolower($order) . '"></i>' : ''; ?></a></th>
						<th class="text-right"><span class="hidden-xs"><?= $lang_column_action; ?></span></th>
					</tr>
				</thead>
				<tbody data-link="row" class="rowlink">
					<tr id="filter" class="info">
						<td class="text-center"><a class="btn btn-default btn-block" href="index.php?route=people/affiliate&token=<?= $token; ?>" rel="tooltip" title="Reset"><i class="fa fa-power-off fa-fw"></i></a></td>
						<td><input type="text" name="filter_name" value="<?= $filter_name; ?>" class="form-control" data-target="name" data-url="people/affiliate" class="form-control"></td>
						<td><input type="text" name="filter_email" value="<?= $filter_email; ?>" class="form-control"></td>
						<td class="hidden-xs">&nbsp;</td>
						<td class="hidden-xs"><select name="filter_status" class="form-control">
							<option value="*">&ndash;</option>
							<?php if ($filter_status) { ?>
							<option value="1" selected><?= $lang_text_enabled; ?></option>
							<?php } else { ?>
							<option value="1"><?= $lang_text_enabled; ?></option>
							<?php } ?>
							<?php if (!is_null($filter_status) && !$filter_status) { ?>
							<option value="0" selected><?= $lang_text_disabled; ?></option>
							<?php } else { ?>
							<option value="0"><?= $lang_text_disabled; ?></option>
							<?php } ?>
						</select></td>
						<td><select name="filter_approved" class="form-control">
							<option value="*">&ndash;</option>
							<?php if ($filter_approved) { ?>
							<option value="1" selected><?= $lang_text_yes; ?></option>
							<?php } else { ?>
							<option value="1"><?= $lang_text_yes; ?></option>
							<?php } ?>
							<?php if (!is_null($filter_approved) && !$filter_approved) { ?>
							<option value="0" selected><?= $lang_text_no; ?></option>
							<?php } else { ?>
							<option value="0"><?= $lang_text_no; ?></option>
							<?php } ?>
						</select></td>
						<td class="hidden-xs"><label class="input-group">
							<input type="text" name="filter_date_added" value="<?= $filter_date_added; ?>" class="form-control date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</label></td>
						<td class="text-right"><button type="button" onclick="filter();" class="btn btn-info"><i class="fa fa-search"></i><span class="hidden-xs"> <?= $lang_button_filter; ?></span></button></td>
					</tr>
					<?php if ($affiliates) { ?>
					<?php foreach ($affiliates as $affiliate) { ?>
					<tr>
						<td class="rowlink-skip text-center"><?php if ($affiliate['selected']) { ?>
							<input type="checkbox" name="selected[]" value="<?= $affiliate['affiliate_id']; ?>" checked="">
							<?php } else { ?>
							<input type="checkbox" name="selected[]" value="<?= $affiliate['affiliate_id']; ?>">
							<?php } ?></td>
						<td><?= $affiliate['name']; ?></td>
						<td><?= $affiliate['email']; ?></td>
						<td class="text-right hidden-xs"><?= $affiliate['balance']; ?></td>
						<td class="hidden-xs text-<?= strtolower($affiliate['status']); ?>"><?= $affiliate['status']; ?></td>
						<td><?= $affiliate['approved']; ?></td>
						<td class="hidden-xs"><?= $affiliate['date_added']; ?></td>
						<td class="text-right"><?php foreach ($affiliate['action'] as $action) { ?>
							<a class="btn btn-default" href="<?= $action['href']; ?>">
								<i class="fa fa-pencil-square-o"></i><span class="hidden-xs"> <?= $action['text']; ?></span>
							</a>
							<?php } ?></td>
					</tr>
					<?php } ?>
					<?php } else { ?>
					<tr>
						<td class="text-center" colspan="8"><?= $lang_text_no_results; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
		<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
	</div>
</div>
<?= $footer; ?>