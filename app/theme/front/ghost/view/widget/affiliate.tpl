<div class="list-group">
	<div class="list-group-item list-group-heading"><?= $heading_title; ?></div>
	<?php if ($logged): ?>
	<a class="list-group-item" href="<?= $account; ?>"><?= $text_account; ?></a>
	<a class="list-group-item" href="<?= $edit; ?>"><?= $text_edit; ?></a>
	<a class="list-group-item" href="<?= $password; ?>"><?= $text_password; ?></a>
	<a class="list-group-item" href="<?= $payment; ?>"><?= $text_payment; ?></a>
	<a class="list-group-item" href="<?= $tracking; ?>"><?= $text_tracking; ?></a>
	<a class="list-group-item" href="<?= $transaction; ?>"><?= $text_transaction; ?></a>
	<a class="list-group-item" href="<?= $logout; ?>"><?= $text_logout; ?></a>
	<?php else: ?>
	<a class="list-group-item" href="<?= $login; ?>"><?= $text_login; ?></a>
	<a class="list-group-item" href="<?= $register; ?>"><?= $text_register; ?></a>
	<a class="list-group-item" href="<?= $forgotten; ?>"><?= $text_forgotten; ?></a>
	<?php endif; ?>
</div>