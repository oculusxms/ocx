<?= $header; ?>
<?= $post_header; ?>
<div class="row">
	<?= $column_left; ?>
	<div class="col-sm-<?php $span = trim($column_left) ? 9 : 12; $span = trim($column_right) ? $span - 3 : $span; echo $span; ?>">
		<?= $breadcrumb; ?>
		<?= $content_top; ?>
		<div class="page-header"><h1><?= $heading_title; ?></h1></div>
		<div id="calendar-nav" class="clearfix">
			<div class="pull-right form-inline">
				<div class="btn-group navigator">
					<button class="btn btn-info" data-calendar-nav="prev"><i class="fa fa-angle-double-left fa-lg"></i> &nbsp; <?= $text_prev; ?></button>
					<button class="btn btn-info" data-calendar-nav="today"><?= $text_today; ?></button>
					<button class="btn btn-info" data-calendar-nav="next"><?= $text_next; ?> &nbsp; <i class="fa fa-angle-double-right fa-lg"></i></button>
				</div>
				<div class="btn-group">
					<button class="btn btn-warning" data-calendar-view="year"><?= $text_year; ?></button>
					<button class="btn btn-warning active" data-calendar-view="month"><?= $text_month; ?></button>
					<button class="btn btn-warning" data-calendar-view="week"><?= $text_week; ?></button>
					<button class="btn btn-warning" data-calendar-view="day"><?= $text_day; ?></button>
				</div>
			</div>
			<h3></h3>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="calendar"></div>
			</div>
		</div>
		
		<div class="form-actions">
			<div class="form-actions-inner text-right">
				<a href="<?= $continue; ?>" class="btn btn-primary"><?= $button_continue; ?></a>
			</div>
		</div>

		<div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title">Event</h3>
					</div>
					<div class="modal-body" style="height: 400px">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<?= $content_bottom; ?>
	</div>
	<?= $column_right; ?>
</div>
<?= $pre_footer; ?>
<?= $footer; ?>