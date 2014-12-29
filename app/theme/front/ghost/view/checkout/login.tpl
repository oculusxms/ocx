<div class="panel-body">
	<div class="row">
		<div class="col-sm-6">
			<fieldset>
				<legend><?= $text_new_customer; ?></legend>
				<p><?= $text_checkout; ?></p>
				<div class="radio radio-inline">
				<?php if ($account == 'register') { ?>
				<label><input type="radio" name="account" value="register" checked> <?= $text_register; ?></label>
				<?php } else { ?>
				<label><input type="radio" name="account" value="register"> <?= $text_register; ?></label>
				<?php } ?>
				</div>
				<?php if ($guest_checkout) { ?>
					<div class="radio radio-inline">
					<?php if ($account == 'guest') { ?>
					<label><input type="radio" name="account" value="guest" checked> <?= $text_guest; ?></label>
					<?php } else { ?>
					<label><input type="radio" name="account" value="guest"> <?= $text_guest; ?></label>
					<?php } ?>
					</div>
				<?php } ?>
				<hr>
				<p><?= $text_register_account; ?></p>
				<button type="button" id="button-account" class="btn btn-primary"><?= $button_continue; ?></button>
			</fieldset>
		</div>
		<div class="col-sm-6">
			<form id="form-login">
				<fieldset>
					<legend><?= $text_returning_customer; ?></legend>
					<p><?= $text_i_am_returning_customer; ?></p>
					<label><?= $entry_user_email; ?></label>
					<div class="form-group">
						<input type="text" name="email" value="" class="form-control" placeholder="<?= $entry_email; ?>" >
					</div>
					<label><?= $entry_password; ?></label>
					<div class="form-group">
						<input type="password" name="password" value="" class="form-control" placeholder="<?= $entry_password; ?>" >
						<div class="help-block"><a href="<?= $forgotten; ?>"><?= $text_forgotten; ?></a></div>
					</div>
					<button type="button" id="button-login" class="btn btn-primary"><?= $button_login; ?></button>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<?= $javascript; ?>