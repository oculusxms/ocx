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
			<div class="pull-left h2"><i class="hidden-xs fa fa-leaf"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<button type="submit" form="form" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i><span class="hidden-xs"> <?= $button_save; ?></span></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs">
			<li><a href="#tab-general" data-toggle="tab"><?= $tab_general; ?></a></li>
			<li><a href="#tab-option" data-toggle="tab"><?= $tab_option; ?></a></li>
			<li><a href="#tab-image" data-toggle="tab"><?= $tab_image; ?></a></li>
		</ul>
		<form action="<?= $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="form">
			<div class="tab-content">
				<div class="tab-pane" id="tab-general">
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_name"><b class="required">*</b> <?= $entry_name; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_name" value="<?= $blog_name; ?>" class="form-control">
							<?php if ($error_name): ?>
							<span class="help-block error"><?= $error_name; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_title"><b class="required">*</b> <?= $entry_title; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_title" value="<?= $blog_title; ?>" class="form-control">
							<?php if ($error_title): ?>
							<span class="help-block error"><?= $error_title; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_meta_description"><?= $entry_meta_description; ?></label>
						<div class="control-field col-sm-4">
							<textarea name="blog_meta_description" class="form-control" rows="6"><?= $blog_meta_description; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_email"><b class="required">*</b> <?= $entry_email; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_email" value="<?= $blog_email; ?>" class="form-control">
							<?php if ($error_email): ?>
							<span class="help-block error"><?= $error_email; ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab-option">
					<h4><?= $text_items; ?></h4>
					<hr>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_limit"><b class="required">*</b> <?= $entry_blog_limit; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_limit" value="<?= $blog_limit; ?>" class="form-control">
							<?php if ($error_blog_limit): ?>
							<span class="help-block error"><?= $error_blog_limit; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<h4><?= $text_post; ?></h4>
					<hr>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_posted_by"><b class="required">*</b> <?= $entry_posted_by; ?></label>
						<div class="control-field col-sm-4">
							<select name="blog_posted_by" class="form-control">
								<option value="*"><?= $text_select; ?></option>
							<?php if ($blog_posted_by == 'firstname lastname'): ?>
								<option value="firstname lastname" selected="selected"><?= $text_pb_firstname_lastname; ?></option>
								<option value="lastname firstname"><?= $text_pb_lastname_firstname; ?></option>
								<option value="username"><?= $text_pb_username; ?></option>
							<?php elseif ($blog_posted_by == 'lastname firstname'): ?>
								<option value="firstname lastname"><?= $text_pb_firstname_lastname; ?></option>
								<option value="lastname firstname" selected="selected"><?= $text_pb_lastname_firstname; ?></option>
								<option value="username"><?= $text_pb_username; ?></option>
							<?php elseif($blog_posted_by == 'username'): ?>
								<option value="firstname lastname"><?= $text_pb_firstname_lastname; ?></option>
								<option value="lastname firstname"><?= $text_pb_lastname_firstname; ?></option>
								<option value="username" selected="selected"><?= $text_pb_username; ?></option>
							<?php else: ?>
								<option value="firstname lastname"><?= $text_pb_firstname_lastname; ?></option>
								<option value="lastname firstname"><?= $text_pb_lastname_firstname; ?></option>
								<option value="username"><?= $text_pb_username; ?></option>
							<?php endif; ?>
							</select>
							<?php if ($error_blog_posted_by): ?>
							<span class="help-block error"><?= $error_blog_posted_by; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_comment_status"><?= $entry_comment; ?></label>
						<div class="control-field col-sm-4">
							<?php if ($blog_comment_status): ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_status" value="1" checked="checked"> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_status" value="0"> <?= $text_no; ?>
							</label>
							<?php else: ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_status" value="1"> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_status" value="0" checked="checked"> <?= $text_no; ?>
							</label>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_comment_logged"><?= $entry_comment_anonymous; ?></label>
						<div class="control-field col-sm-4">
							<?php if ($blog_comment_logged): ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_logged" value="1" checked> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_logged" value="0"> <?= $text_no; ?>
							</label>
							<?php else: ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_logged" value="1"> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_logged" value="0" checked> <?= $text_no; ?>
							</label>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_comment_require_approve"><?= $entry_comment_require_approve; ?></label>
						<div class="control-field col-sm-4">
							<?php if ($blog_comment_require_approve): ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_require_approve" value="1" checked="checked"> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_require_approve" value="0"> <?= $text_no; ?>
							</label>
							<?php else: ?>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_require_approve" value="1"> <?= $text_yes; ?>
							</label>
							<label class="radio-inline">
								<input type="radio" name="blog_comment_require_approve" value="0" checked="checked"> <?= $text_no; ?>
							</label>
							<?php endif; ?>
						</div>
					</div>
					<h4><?= $text_account; ?></h4>
					<hr>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_admin_group_id"><b class="required">*</b> <?= $entry_admin_group; ?></label>
						<div class="control-field col-sm-4">
							<select name="blog_admin_group_id" class="form-control">
								<option value="*"><?= $text_select; ?></option>
								<?php foreach($user_groups as $user_group): ?>
								<?php if ($user_group['user_group_id'] == $blog_admin_group_id): ?>
								<option value="<?= $user_group['user_group_id']; ?>" selected="selected"><?= $user_group['name']; ?></option>
								<?php else: ?>
								<option value="<?= $user_group['user_group_id']; ?>"><?= $user_group['name']; ?></option>
								<?php endif; ?>
								<?php endforeach; ?>
							</select>
							<?php if ($error_blog_admin_group_id): ?>
							<span class="help-block error"><?= $error_blog_admin_group_id; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="blog_author_group_id"><b class="required">*</b> <?= $entry_author_group; ?></label>
						<div class="control-field col-sm-4">
							<select name="blog_author_group_id" class="form-control">
								<option value="*"><?= $text_select; ?></option>
								<?php foreach($customer_groups as $customer_group): ?>
								<?php if ($customer_group['customer_group_id'] == $blog_author_group_id): ?> 
								<option value="<?= $customer_group['customer_group_id']; ?>" selected="selected"><?= $customer_group['name']; ?></option>
								<?php else: ?>
								<option value="<?= $customer_group['customer_group_id']; ?>"><?= $customer_group['name']; ?></option>
								<?php endif; ?>
								<?php endforeach; ?>
							</select>
							<?php if ($error_blog_author_group_id): ?>
							<span class="help-block error"><?= $error_blog_author_group_id; ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="tab-image">
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_logo; ?></label>
						<div class="col-sm-1">
							<a onclick="image_upload('logo','thumb-logo');"><img class="img-thumbnail" src="<?= $logo; ?>" width="100" height="100" alt="" id="thumb-logo"></a>
						</div>
						<div class="control-field col-sm-4">
							<input type="hidden" name="blog_logo" value="<?= $blog_logo; ?>" id="logo">
							<a class="btn btn-default" onclick="image_upload('logo','thumb-logo');"><?= $text_browse; ?></a>&nbsp;
							<a class="btn btn-default" onclick="$('#thumb-logo').attr('src', '<?= $no_image; ?>'); $('#logo').val('');"><?= $text_clear; ?></a>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><?= $entry_icon; ?></label>
						<div class="col-sm-1">
							<a onclick="image_upload('icon','thumb-icon');"><img class="img-thumbnail" src="<?= $icon; ?>" width="100" height="100" alt="" id="thumb-icon"></a>
						</div>
						<div class="control-field col-sm-4">
							<input type="hidden" name="blog_icon" value="<?= $blog_icon; ?>" id="icon">
							<a class="btn btn-default" onclick="image_upload('icon','thumb-icon');"><?= $text_browse; ?></a>&nbsp;
							<a class="btn btn-default" onclick="$('#thumb-icon').attr('src', '<?= $no_image; ?>'); $('#icon').val('');"><?= $text_clear; ?></a>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_image_thumb; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_image_thumb_width" value="<?= $blog_image_thumb_width; ?>" class="form-control" placeholder="<?= $text_width; ?>"> 
							<input type="text" name="blog_image_thumb_height" value="<?= $blog_image_thumb_height; ?>" class="form-control" placeholder="<?= $text_height; ?>">
							<?php if ($error_image_thumb): ?>
							<span class="help-block error"><?= $error_image_thumb; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_image_popup; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_image_popup_width" value="<?= $blog_image_popup_width; ?>" class="form-control" placeholder="<?= $text_width; ?>">
							<input type="text" name="blog_image_popup_height" value="<?= $blog_image_popup_height; ?>" class="form-control" placeholder="<?= $text_height; ?>">
							<?php if ($error_image_popup): ?>
							<span class="help-block error"><?= $error_image_popup; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_image_post; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_image_post_width" value="<?= $blog_image_post_width; ?>" class="form-control" placeholder="<?= $text_width; ?>">
							<input type="text" name="blog_image_post_height" value="<?= $blog_image_post_height; ?>" class="form-control" placeholder="<?= $text_height; ?>">
							<?php if ($error_image_post): ?>
							<span class="help-block error"><?= $error_image_post; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_image_additional; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_image_additional_width" value="<?= $blog_image_additional_width; ?>" class="form-control" placeholder="<?= $text_width; ?>">
							<input type="text" name="blog_image_additional_height" value="<?= $blog_image_additional_height; ?>" class="form-control" placeholder="<?= $text_height; ?>">
							<?php if ($error_image_additional): ?>
							<span class="help-block error"><?= $error_image_additional; ?></span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_image_related; ?></label>
						<div class="control-field col-sm-4">
							<input type="text" name="blog_image_related_width" value="<?= $blog_image_related_width; ?>" class="form-control" placeholder="<?= $text_width; ?>">
							<input type="text" name="blog_image_related_height" value="<?= $blog_image_related_height; ?>" class="form-control" placeholder="<?= $text_height; ?>">
							<?php if ($error_image_related): ?>
							<span class="help-block error"><?= $error_image_related; ?></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?= $text_image_manager; ?></h4>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-block" data-dismiss="modal"><?= $button_cancel; ?></button>
			</div>
		</div>
	</div>
</div>
<?= $footer; ?>