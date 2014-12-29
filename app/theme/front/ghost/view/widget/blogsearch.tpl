<div class="panel panel-default">
	<div class="panel-heading">
		<div class="panel-title"><?= $heading_title; ?></div>
	</div>
	<div class="panel-body">
		<div class="input-group input-icon">
			<input type="text" id="blog-search-form" name="filter_name" 
				value="<?= $filter_name; ?>" 
				class="form-control search" 
				data-url="content/search" 
				placeholder="<?= $search_form_placeholder; ?>" >
			<span class="input-group-addon"><em class="fa fa-search fa-fw"></em></span>
		</div>
	</div>
</div>
