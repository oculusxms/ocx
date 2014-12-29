<?= $header; ?>
<?= $post_header; ?>
	<div class="row blog">
		<?= $column_left; ?>
		<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
			<?= $breadcrumb; ?>
			<?= $content_top; ?>
			
			<h2><?= $heading_title; ?></h2>
			<?php if ($thumb): ?>
			<img class="img-responsive" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>">
			<br>
			<?php endif; ?>
			
			<?php if ($description): ?>
			<?php echo $description; ?>
			<?php endif; ?>
			
			<hr>
			
			<?php if ($categories): ?>
			<h4><?= $text_refine; ?></h4> 
			<div class="row">
				<?php foreach ($categories as $category): ?>
				<div class="col-sm-3 category-list">
					<div class="panel panel-default">
						<?php if ($category['pic']): ?>
						<a href="<?php echo $category['href']; ?>">
							<img class="img-responsive" src="<?php echo $category['pic']; ?>" title="<?php echo $category['name']; ?>" alt="<?php echo $category['name']; ?>">
						</a>
						<?php endif; ?>
						<div class="panel-body">
							<div class="valign">
								<div class="text-center">
									<a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<hr>
			<?php endif; ?>
			
			<h2><?= $text_all_posts; ?> <?= $heading_title; ?></h2>
			
			<?php if ($posts): ?>
			<?php foreach ($posts as $post): ?>
			<h2><a href="<?= $post['href']; ?>"><?= $post['name']; ?></a></h2>
			<div class="meta">
				<p>
					<span class="fa fa-user"></span> 
						<?= $text_by; ?> <a href="<?= $post['author_href']; ?>" 
							data-toggle="tooltip" title="<?= $text_all_by; ?> <?= $post['author_name']; ?>"><?= $post['author_name']; ?></a> | 
					<span class="fa fa-clock-o"></span> <?= $post['date_added']; ?> | 
					<?php if ($post['categories']): ?>
					<span class="fa fa-folder-open"></span> 
						<?= $text_in; ?> <?= $post['categories']; ?> | 
					<?php endif; ?>
					<span class="fa fa-comments-o"></span> <?= $post['comments']; ?> | 
					<span class="fa fa-eye"></span> <?= $post['views']; ?>
				</p>
			</div>
			<hr>
			<a href="<?= $post['href']; ?>"><img class="img-responsive" src="<?= $post['thumb']; ?>" title="<?= $post['name']; ?>" alt="<?= $post['name']; ?>"></a>
			<hr>
			<p><?= $post['blurb']; ?></p>
			<a class="btn btn-primary" href="<?= $post['href']; ?>"><?= $text_read_more; ?> <span class="fa fa-chevron-right"></span></a>
			<hr>
			<?php endforeach; ?>
			
			<div class="pagination"><?= str_replace('....','',$pagination); ?></div>
			
			<?php else: ?>
			<p><?= $text_empty; ?></p>
			<?php endif; ?>
			
			<?= $content_bottom; ?>
		</div>
		<?= $column_right; ?>
	</div>
<?= $pre_footer; ?>
<?= $footer; ?>