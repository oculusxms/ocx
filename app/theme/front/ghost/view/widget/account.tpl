<div class="list-group">
	<div class="list-group-item list-group-heading"><?= $heading_title; ?></div>
	<?php if ($logged): ?>
	<a class="list-group-item" href="<?= $account; ?>"><?= $text_account; ?></a>
	<?php if ($product): ?>
	<a class="list-group-item" href="<?= $product; ?>"><?= $text_product; ?></a>
	<?php endif; ?>
	<?php if ($reward): ?>
	<a class="list-group-item" href="<?= $reward; ?>"><?= $text_reward; ?></a>
	<?php endif; ?>
	<?php if ($download): ?>
	<a class="list-group-item" href="<?= $download; ?>"><?= $text_download; ?></a>
	<?php endif; ?>
	<a class="list-group-item" href="<?= $wishlist; ?>"><?= $text_wishlist; ?></a>
	<a class="list-group-item" href="<?= $order; ?>"><?= $text_order; ?></a>
	<a class="list-group-item" href="<?= $return; ?>"><?= $text_return; ?></a>
	<a class="list-group-item" href="<?= $recurring; ?>"><?= $text_recurring; ?></a>
	<a class="list-group-item" href="<?= $transaction; ?>"><?= $text_transaction; ?></a>
	<a class="list-group-item" href="<?= $edit; ?>"><?= $text_edit; ?></a>
	<a class="list-group-item" href="<?= $password; ?>"><?= $text_password; ?></a>
	<a class="list-group-item" href="<?= $address; ?>"><?= $text_address; ?></a>
	<a class="list-group-item" href="<?= $newsletter; ?>"><?= $text_newsletter; ?></a>
	<a class="list-group-item" href="<?= $logout; ?>"><?= $text_logout; ?></a>
	<?php else: ?>
	<a class="list-group-item" href="<?= $login; ?>"><?= $text_login; ?></a>
	<a class="list-group-item" href="<?= $register; ?>"><?= $text_register; ?></a>
	<a class="list-group-item" href="<?= $forgotten; ?>"><?= $text_forgotten; ?></a>
	<?php endif; ?>
</div>