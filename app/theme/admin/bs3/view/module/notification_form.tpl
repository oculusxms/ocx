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
			<div class="pull-left h2"><i class="hidden-xs fa fa-info-circle"></i><?= $heading_title; ?></div>
			<div class="pull-right">
				<button type="submit" id="notification-submit" form="form" class="btn btn-primary">
				<i class="fa fa-floppy-o"></i><span class="hidden-xs"> <?= $button_save; ?></span></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>">
				<i class="fa fa-ban"></i><span class="hidden-xs"> <?= $button_cancel; ?></span></a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		
		<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="form">
			<div id="language-tabs">
				<ul class="nav nav-tabs">
					<?php foreach ($languages as $language): ?>
						<li><a href="#language<?= $language['language_id']; ?>" data-toggle="tab">
							<i class="lang-<?= str_replace('.png','', $language['image']); ?>" title="<?= $language['name']; ?>"></i> <?= $language['name']; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				<div class="tab-content">
					<?php foreach ($languages as $language): ?>
					<div class="tab-pane" id="language<?= $language['language_id']; ?>">
						<div class="form-group">
							<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_html; ?></label>
							<div class="control-field col-sm-8">
								<textarea id="html_<?= $language['language_id']; ?>" name="email_content[<?= $language['language_id']; ?>][html]" class="summernote form-control" rows="10" spellcheck="false"><?= isset($email_content[$language['language_id']]) ? $email_content[$language['language_id']]['html'] :''; ?></textarea>
								<?php if (isset($error_html[$language['language_id']])): ?>
								<span class="help-block error"><?= $error_html[$language['language_id']]; ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2"><b class="required">*</b> <?= $entry_text; ?></label>
							<div class="col-sm-6">
								<textarea name="email_content[<?= $language['language_id']; ?>][text]" class="form-control" rows="6"><?= isset($email_content[$language['language_id']]) ? $email_content[$language['language_id']]['text'] : ''; ?></textarea>
								<?php if (isset($error_text[$language['language_id']])): ?>
								<span class="help-block error"><?= $error_text[$language['language_id']]; ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2" for="email_slug"><b class="required">*</b> <?= $entry_email_slug; ?></label>
				<div class="control-field col-sm-4">
					<?php if ($is_system): ?>
					<p class="form-control-static"><?= $email_slug; ?></p>
					<input type="hidden" name="email_slug" value="<?= $email_slug; ?>">
					<input type="hidden" name="is_system" value="1">
					<?php else: ?>
					<input type="text" name="email_slug" value="<?= $email_slug; ?>" class="form-control">
					<input type="hidden" name="is_system" value="0">
					<?php endif; ?>
					<?php if ($error_email_slug): ?>
					<span class="help-block error"><?= $error_email_slug; ?></span>
					<?php endif; ?>
				</div>
			</div>
		</form>
	</div>
</div>
<?= $footer; ?>