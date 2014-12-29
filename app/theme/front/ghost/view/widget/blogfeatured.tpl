<div class="list-group widget">
	<div class="list-group-item list-group-heading"><?= $heading_title; ?></div>
	<?php foreach ($posts as $post): ?>
		<a class="list-group-item clearfix" href="<?= $post['href']; ?>">
			<img class="img-responsive" src="<?php echo $post['thumb']; ?>" title="<?php echo $post['name']; ?>" alt="<?php echo $post['name']; ?>"> 
			<span><?= $post['name']; ?></span>
		</a>
	<?php endforeach; ?>
</div>
