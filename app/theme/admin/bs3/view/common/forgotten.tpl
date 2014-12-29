<?= $header; ?>
<div class="container">
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
			<form class="form-horizontal" action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="forgotten">
			<div class="well well-lg">
				<p class="lead"><?= $heading_title; ?></p>
				<?php if ($error_warning) { ?>
				<div class="alert alert-danger"><?= $error_warning; ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>
				<?php } ?>
				<p><?= $text_email; ?></p>
				<h5><?= $entry_email; ?></h5>
				<input type="text" name="email" value="<?= $email; ?>" class="form-control" autofocus="">
				<hr><button class="btn btn-primary"><?= $button_reset; ?></button>
				<a class="btn btn-warning" href="<?= $cancel; ?>"><i class="fa fa-ban"></i> <?= $button_cancel; ?></a>
			</div>
			</form>
		</div>
	</div>
</div>
<?= $footer; ?>