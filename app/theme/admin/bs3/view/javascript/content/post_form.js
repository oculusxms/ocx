<script>
function addImage(){
	html = '<tr id="image-row'+image_row+'">';
	html += '<td><div class="media"><a class="pull-left" onclick="image_upload(\'image'+image_row+'\',\'thumb'+image_row+'\');"><img class="img-thumbnail" src="<?= $no_image; ?>" width="100" height="100" alt="" id="thumb'+image_row+'"></a>';
	html += '<input type="hidden" name="post_image['+image_row+'][image]" value="" id="image'+image_row+'">';
	html += '<div class="media-body hidden-xs">';
	html += '<a class="btn btn-default" onclick="image_upload(\'image'+image_row+'\',\'thumb'+image_row+'\');"><?= $text_browse; ?></a>&nbsp;';
	html += '<a class="btn btn-default" onclick="$(\'#thumb'+image_row+'\').attr(\'src\',\'<?= $no_image; ?>\'); $(\'#image'+image_row+'\').attr(\'value\',\'\');"><?= $text_clear; ?></a>';
	html += '</div></div></td>';
	html += '<td class="text-right"><input type="text" name="post_image['+image_row+'][sort_order]" value="" class="form-control"></td>';
	html += '<td><a onclick="$(\'#image-row'+image_row+'\').remove();" class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i><span class="hidden-xs"> <?= $button_remove; ?></span></a></td>';
	html += '</tr>';
	
	$('#images tbody').append(html);
	
	image_row++;
}
</script>