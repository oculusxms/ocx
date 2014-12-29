<script>
$('select[name="return_action_id"]').change(function(){
	var a=$(this);
	$.ajax({
		url:'index.php?route=sale/return/action&token=<?= $token; ?>&return_id=<?= $return_id; ?>',
		type:'post',
		dataType:'json',
		data:'return_action_id='+a.val(),
		beforeSend:function(){
			a.blur().button('loading').append($('<i>',{class:'icon-loading'}));
		},
		complete:function(){
			a.button('reset');
		},
		success:function(json){
			if(json['error']){
				alertMessage('danger',json['error']);
			}
			if(json['success']){
				alertMessage('success',json['success']);
			}
		}
	});
});
</script>