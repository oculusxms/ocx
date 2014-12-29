<div class="col-sm-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?= $heading_title; ?></h3>
		</div>
		<div class="panel-body">
			
			<?php if ($events): ?>
			<?php foreach ($events as $event): ?>
			<div class="col-sm-4">
				<strong><?= $event['name']; ?></strong><br>
				<?= $text_date; ?> <?= $event['start_date']; ?><br>
				<?= $text_starts; ?> <?= $event['start_time']; ?><br>
				<?= $text_days; ?> <?= $event['event_days']; ?><br>
				<?php if ($event['online']): ?>
				<?= $text_location; ?> <a href="<?= $event['hangout']; ?>">Google Hangout</a>
				<?php else: ?>
				<?= $text_location; ?> <?= $event['location']; ?><br>
				<?php endif; ?>
				<?= $text_telephone; ?> <?= $event['telephone']; ?><br>
			</div>
			<?php endforeach; ?>
			<?php else: ?>
			<div class="text-center">
				<?= $text_no_upcoming; ?>
			</div>
			<?php endif; ?>
			
		</div>
	</div>
</div>