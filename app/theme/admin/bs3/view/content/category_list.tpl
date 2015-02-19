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
			<div class="pull-left h2"><i class="hidden-xs fa fa-leaf"></i><?= $lang_heading_title; ?></div>
			<div class="pull-right">
				<a href="<?= $insert; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i><span class="hidden-xs"> <?= $lang_button_insert; ?></span></a>
				<button type="submit" form="form" formaction="<?= $delete; ?>" id="btn-delete" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $lang_button_delete; ?></span></button>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-inline" action="<?= $delete; ?>" method="post" enctype="multipart/form-data" id="form">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="40" class="text-center"><input type="checkbox" data-toggle="selected"></th>
						<th><?= $lang_column_name; ?></th>
						<th class="text-right"><?= $lang_column_sort_order; ?></th>
						<th class="text-right"><?= $lang_column_action; ?></th>
					</tr>
				</thead>
				<tbody data-link="row" class="rowlink">
					<?php if ($categories): ?>
            		<?php foreach ($categories as $category): ?>
					<tr>
						<td class="rowlink-skip text-center">
							<?php if ($category['selected']): ?>
							<input type="checkbox" name="selected[]" value="<?= $category['category_id']; ?>" checked="">
							<?php else: ?>
							<input type="checkbox" name="selected[]" value="<?= $category['category_id']; ?>">
							<?php endif; ?></td>
						<td><?= $category['name']; ?></td>
						<td class="text-right"><?= $category['sort_order']; ?></td>
						<td class="text-right"><?php foreach ($category['action'] as $action): ?>
							<a class="btn btn-default" href="<?= $action['href']; ?>">
								<i class="fa fa-pencil-square-o"></i><span class="hidden-xs"> <?= $action['text']; ?></span>
							</a>
							<?php endforeach; ?></td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
						<td class="text-center" colspan="4"><?= $lang_text_no_results; ?></td>
					</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</form>
	</div>
</div>
<?= $footer; ?>