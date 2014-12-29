<script>
$(document).on('click', '.toggle', function(){
	var obj = $(this).parent().prev();
	
	if ($(this).is(':checked')){
      $(obj).attr('disabled',true).val('');
	} else {
      $(obj).attr('disabled',false).select();
	}
});

function addWidget() {
	html = '<tr id="widget-row'+widget_row+'">';
	html += '<td><input type="text" class="form-control" name="postwall_widget['+widget_row+'][limit]" value="" size="1"></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][span]" class="form-control">';
	<?php foreach (array(1,2,3,4,6) as $span): ?>
	html += '<option value="<?php echo $span; ?>"><?php echo $span; ?></option>';
	<?php endforeach; ?>
	html += '</select></td>';
	html += '<td><input type="text" name="postwall_widget['+widget_row+'][height]" value="" class="form-control" size="1">';
	html += '&nbsp; <label class="checkbox"><input type="checkbox" class="toggle" name="postwall_widget['+widget_row+'][height]" value=""> <?php echo $text_auto; ?></label></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][post_type]" class="form-control">';
	<?php foreach ($post_types as $key => $post_type): ?>
	html += '<option value="<?php echo $key; ?>"><?php echo $post_type; ?></option>';
	<?php endforeach; ?>
	html += '</select></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][description]" class="form-control">';
	html += '<option value="1"><?php echo $text_enabled; ?></option>';
	html += '<option value="0" selected=""><?php echo $text_disabled; ?></option>';
	html += '</select></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][button]" class="form-control">';
	html += '<option value="1"><?php echo $text_enabled; ?></option>';
	html += '<option value="0" selected=""><?php echo $text_disabled; ?></option>';
	html += '</select></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][layout_id]" class="form-control">';
	<?php foreach ($layouts as $layout): ?>
	html += '<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php endforeach; ?>
	html += '</select></td>';
	html += '<td><select name="postwall_widget['+widget_row+'][position]" class="form-control">';
	html += '<option value="content_top"><?= $text_content_top; ?></option>';
	html += '<option value="content_bottom"><?= $text_content_bottom; ?></option>';
	html += '<option value="post_header"><?= $text_post_header; ?></option>';
	html += '<option value="pre_footer"><?= $text_pre_footer; ?></option>';
	html += '<option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '<option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '</select></td>';
	html += '<td><div class="btn-group" data-toggle="buttons"><label class="btn btn-default" title="<?= $text_enabled; ?>">';
	html += '<input type="radio" name="postwall_widget['+widget_row+'][status]" value="1"><i class="fa fa-play"></i></label>';
	html += '<label class="btn btn-default active" title="<?= $text_disabled; ?>">';
	html += '<input type="radio" name="postwall_widget['+widget_row+'][status]" value="0" checked=""><i class="fa fa-pause"></i></label></div></td>';
	html += '<td class="text-right"><input type="text" name="postwall_widget['+widget_row+'][sort_order]" class="form-control" value="" size="3"></td>';
	html += '<td><a onclick="$(\'#widget-row'+widget_row+'\').remove();" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $button_remove; ?></span></a></td>';
	html += '</tr>';
	
	$('#widget tbody').append(html);
	
	widget_row++;
	
}
</script>