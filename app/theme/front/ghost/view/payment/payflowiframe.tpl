<?php if ($checkout_method == 'iframe') { ?>
	<iframe src="<?= $iframe_url ?>" scrolling="no" width="560px" height="540px" frameBorder="0"></iframe>
<?php } else { ?>
	<a href="<?= $iframe_url; ?>" class="btn btn-primary btn-lg btn-block"><?= $lang_button_confirm; ?></a>
<?php } ?>