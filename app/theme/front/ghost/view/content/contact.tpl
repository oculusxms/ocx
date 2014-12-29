<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<div class="row">
			<div class="col-sm-9">
				<form title="<?= $text_contact; ?>" class="form-<?= ($span > 6) ? 'horizontal' : 'inline'; ?>" action="<?= $action; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-sm-3" for="name"><?= $entry_name; ?></label>
						<div class="col-sm-8">
							<input type="text" name="name" value="<?= $name; ?>" id="name" class="form-control" placeholder="<?= $entry_name; ?>"  autofocus>
							<?php if ($error_name) { ?>
								<span class="help-block error"><?= $error_name; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="email"><?= $entry_email; ?></label>
						<div class="col-sm-8">
							<input type="email" name="email" value="<?= $email; ?>" id="email" class="form-control" placeholder="<?= $entry_email; ?>" >
							<?php if ($error_email) { ?>
								<span class="help-block error"><?= $error_email; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="enquiry"><?= $entry_enquiry; ?></label>
						<div class="col-sm-8">
							<textarea name="enquiry" class="form-control" placeholder="<?= $entry_enquiry; ?>"  rows="4" id="enquiry"><?= $enquiry; ?></textarea>
							<?php if ($error_enquiry) { ?>
								<span class="help-block error"><?= $error_enquiry; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3" for="captcha"><?= $entry_captcha; ?></label>
						<div class="col-sm-8">
							<input type="text" name="captcha" value="<?= $captcha; ?>" id="captcha" class="form-control">
							<div class="help-block"><img src="tool/captcha" alt=""></div>
							<?php if ($error_captcha) { ?>
								<span class="help-block error"><?= $error_captcha; ?></span>
							<?php } ?>
						</div>
					</div>
					<div class="form-actions">
						<div class="form-actions-inner text-right">
							<button type="submit" class="btn btn-primary"><?= $button_continue; ?></button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-sm-3">
				<div class="thumbnail">
					<?php $map = urlencode(strip_tags(html_entity_decode($address, ENT_QUOTES, 'UTF-8'))); ?>
					<a href="https://maps.google.com/maps?q=<?= $map; ?>" target="_blank"><img src="http://maps.googleapis.com/maps/api/staticmap?zoom=13&size=256x180&center=<?= $map; ?>&sensor=false" alt=""></a>
					<div class="caption">
						<h4><?= $text_location; ?></h4>
						<strong><?= $store; ?></strong><br>
						<abbr title="<?= $text_address; ?>">a:</abbr> <?= $address; ?>
						<?php if ($telephone) { ?>
							<br><abbr title="<?= $text_telephone; ?>">t:</abbr> <?= $telephone; ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>