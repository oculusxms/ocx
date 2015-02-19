<div class="list-group">
	<div class="list-group-item list-group-heading"><?= $lang_heading_title; ?></div>
	<?php if ($logged): ?>
	<a class="list-group-item" href="<?= $account; ?>"><?= $lang_text_account; ?></a>
	<a class="list-group-item" href="<?= $notification; ?>">
		<?= $lang_text_notification; ?>
		<?php if ($unread): ?>
			<span id="notify-badge" class="badge badge-danger"><?= $unread; ?></span>
		<?php endif; ?>
	</a>
	<a class="list-group-item" href="<?= $edit; ?>"><?= $lang_text_edit; ?></a>
	<a class="list-group-item" href="<?= $password; ?>"><?= $lang_text_password; ?></a>
	<a class="list-group-item" href="<?= $payment; ?>"><?= $lang_text_payment; ?></a>
	<a class="list-group-item" href="<?= $tracking; ?>"><?= $lang_text_tracking; ?></a>
	<a class="list-group-item" href="<?= $transaction; ?>"><?= $lang_text_transaction; ?></a>
	<a class="list-group-item" href="<?= $logout; ?>"><?= $lang_text_logout; ?></a>
	<?php else: ?>
	<a class="list-group-item" href="<?= $login; ?>"><?= $lang_text_login; ?></a>
	<a class="list-group-item" href="<?= $register; ?>"><?= $lang_text_register; ?></a>
	<a class="list-group-item" href="<?= $forgotten; ?>"><?= $lang_text_forgotten; ?></a>
	<?php endif; ?>
</div>