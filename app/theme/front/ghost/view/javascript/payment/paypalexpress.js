<script>
$(document).on('click', '#button-confirm', function(e){
	e.preventDefault();
	location = '<?= $lang_button_continue_action; ?>';
});
</script>