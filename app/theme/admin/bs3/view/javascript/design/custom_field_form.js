<script>
$('select[name=\'type\']').bind('change', function(){
	if (this.value == 'select' || this.value == 'radio' || this.value == 'checkbox') {
		$('#custom-field-value').show();
		$('#display-value').hide();
	} else {
		$('#custom-field-value').hide();
		$('#display-value').show();
	}
	
	$('input[name=\'value\']').removeClass();
	
	if (this.value == 'date') {
		$('input[name=\'value\']').datepicker({dateFormat: 'yy-mm-dd'});
	} else if (this.value == 'time') {
		$('input[name=\'value\']').timepicker({timeFormat: 'h:m'});	
	} else if (this.value == 'datetime') {
		$('input[name=\'value\']').datetimepicker({
			dateFormat: 'yy-mm-dd',
			timeFormat: 'h:m'
		});	
	} else {
		$('input[name=\'value\']').datepicker('remove');
		$('input[name=\'value\']').timepicker('remove');
		$('input[name=\'value\']').datetimepicker('remove');
	}
});
$('select[name=\'type\']').trigger('change');

function addCustomFieldValue() {
	html = '<tbody id="custom-field-value-row'+custom_field_value_row +'">';
	html += '<tr>';	
	html += '<td><input type="hidden" name="custom_field_value['+custom_field_value_row + '][custom_field_value_id]" value="">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="custom_field_value['+custom_field_value_row + '][custom_field_value_description][<?= $language['language_id']; ?>][name]" value=""> <img src="asset/default/img/flags/<?= $language['image']; ?>" title="<?= $language['name']; ?>" class="form-control"><br>';
	<?php } ?>
	html += '</td>';
	html += '<td class="text-right"><input type="text" name="custom_field_value['+custom_field_value_row + '][sort_order]" value="" class="form-control"></td>';
	html += '<td><a onclick="$(\'#custom-field-value-row'+custom_field_value_row + '\').remove();" class="btn btn-default"><?= $lang_button_remove; ?></a></td>';
	html += '</tr>';	
	html += '</tbody>';
	
	$('#custom-field-value tfoot').before(html);
	
	custom_field_value_row++;
}
</script>