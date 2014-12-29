<div class="list-group">
	<div class="list-group-item list-group-heading"><?= $heading_title; ?></div>
	<?php foreach ($pages as $page) { ?>
		<a class="list-group-item" href="<?= $page['href']; ?>"><?= $page['title']; ?></a>
	<?php } ?>
	<a class="list-group-item" href="<?= $contact; ?>"><?= $text_contact; ?></a>
	<a class="list-group-item" href="<?= $sitemap; ?>"><?= $text_sitemap; ?></a>
</div>
