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
			<div class="pull-left h2"><i class="hidden-xs fa fa-puzzle-piece"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<button type="submit" form="form" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i><span class="hidden-xs"> <?= $button_save; ?></span></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div class="form-group">
				<label class="control-label col-sm-3 col-md-2"><?= $entry_product; ?></label>
				<div class="control-field col-sm-6 col-md-4">
					<p><input type="text" name="product" value="" class="form-control" autocomplete="off"></p>
					<div class="panel panel-default panel-scrollable">
						<div id="featured-product" class="list-group">
						<?php foreach ($products as $product) { ?>
							<div class="list-group-item" id="featured-product<?= $product['product_id']; ?>">
								<a class="label label-danger label-trash"><i class="fa fa-trash-o fa-lg"></i></a><?= $product['name']; ?>
								<input type="hidden" value="<?= $product['product_id']; ?>">
							</div>
						<?php } ?>
						</div>
					</div>
					<input type="hidden" name="featured_product" value="<?= $featured_product; ?>">
				</div>
			</div>
			<table id="widget" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><?= $entry_limit; ?></th>
						<th><?= $entry_image; ?></th>
						<th><?= $entry_layout; ?></th>
						<th><?= $entry_position; ?></th>
						<th><?= $entry_status; ?></th>
						<th class="text-right"><?= $entry_sort_order; ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php $widget_row = 0; ?>
				<?php foreach ($widgets as $widget) { ?>
					<tr id="widget-row<?= $widget_row; ?>">
						<td><input type="text" name="featured_widget[<?= $widget_row; ?>][limit]" value="<?= $widget['limit']; ?>" class="form-control"></td>
						<td><input type="text" name="featured_widget[<?= $widget_row; ?>][image_width]" value="<?= $widget['image_width']; ?>" class="form-control">
							<input type="text" name="featured_widget[<?= $widget_row; ?>][image_height]" value="<?= $widget['image_height']; ?>" class="form-control">
							<?php if (isset($error_image[$widget_row])) { ?>
							<div class="text-danger"><?= $error_image[$widget_row]; ?></div>
							<?php } ?></td>
						<td><select name="featured_widget[<?= $widget_row; ?>][layout_id]" class="form-control">
							<?php foreach ($layouts as $layout) { ?>
							<?php if ($layout['layout_id'] == $widget['layout_id']) { ?>
							<option value="<?= $layout['layout_id']; ?>" selected><?= $layout['name']; ?></option>
							<?php } else { ?>
							<option value="<?= $layout['layout_id']; ?>"><?= $layout['name']; ?></option>
							<?php } ?>
							<?php } ?>
						</select></td>
						<td><select name="featured_widget[<?= $widget_row; ?>][position]" class="form-control">
							<?php if ($widget['position'] == 'content_top'): ?>
							<option value="content_top" selected><?= $text_content_top; ?></option>
							<?php else: ?>
							<option value="content_top"><?= $text_content_top; ?></option>
							<?php endif; ?>
							<?php if ($widget['position'] == 'content_bottom'): ?>
							<option value="content_bottom" selected><?= $text_content_bottom; ?></option>
							<?php else: ?>
							<option value="content_bottom"><?= $text_content_bottom; ?></option>
							<?php endif; ?>
							<?php if ($widget['position'] == 'post_header'): ?>
							<option value="post_header" selected><?= $text_post_header; ?></option>
							<?php else: ?>
							<option value="post_header"><?= $text_post_header; ?></option>
							<?php endif; ?>
							<?php if ($widget['position'] == 'pre_footer'): ?>
							<option value="pre_footer" selected><?= $text_pre_footer; ?></option>
							<?php else: ?>
							<option value="pre_footer"><?= $text_pre_footer; ?></option>
							<?php endif; ?>
							<?php if ($widget['position'] == 'column_left'): ?>
							<option value="column_left" selected><?= $text_column_left; ?></option>
							<?php else: ?>
							<option value="column_left"><?= $text_column_left; ?></option>
							<?php endif; ?>
							<?php if ($widget['position'] == 'column_right'): ?>
							<option value="column_right" selected><?= $text_column_right; ?></option>
							<?php else: ?>
							<option value="column_right"><?= $text_column_right; ?></option>
							<?php endif; ?>
						</select></td>
						<td><div class="btn-group" data-toggle="buttons">
							<?php if ($widget['status']){ ?>
							<label class="btn btn-default active" title="<?= $text_enabled; ?>"><input type="radio" name="featured_widget[<?= $widget_row; ?>][status]" value="1" checked=""><i class="fa fa-play"></i></label>
							<label class="btn btn-default" title="<?= $text_disabled; ?>"><input type="radio" name="featured_widget[<?= $widget_row; ?>][status]" value="0"><i class="fa fa-pause"></i></label>
							<?php } else { ?>
							<label class="btn btn-default" title="<?= $text_enabled; ?>"><input type="radio" name="featured_widget[<?= $widget_row; ?>][status]" value="1"><i class="fa fa-play"></i></label>
							<label class="btn btn-default active" title="<?= $text_disabled; ?>"><input type="radio" name="featured_widget[<?= $widget_row; ?>][status]" value="0" checked=""><i class="fa fa-pause"></i></label>
							<?php } ?>
						</div></td>
						<td class="text-right"><input type="text" name="featured_widget[<?= $widget_row; ?>][sort_order]" value="<?= $widget['sort_order']; ?>" class="form-control"></td>
						<td><a onclick="$('#widget-row<?= $widget_row; ?>').remove();" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $button_remove; ?></span></a></td>
					</tr>
				<?php $widget_row++; ?>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6"></td>
						<td><a onclick="addWidget();" class="btn btn-info"><i class="fa fa-plus-circle"></i><span class="hidden-xs"> <?= $button_add_widget; ?></span></a></td>
					</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>
<script>var widget_row=<?= $widget_row; ?>;</script>
<?= $footer; ?>