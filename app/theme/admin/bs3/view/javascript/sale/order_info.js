<script>
$('#credit').on('click',function(){
	var a=$(this),b=a.data('action');
	$.ajax({
		url:'index.php?route=sale/order/'+b+'credit&token=<?= $token; ?>&order_id=<?= $order_id; ?>',
		type:'post',
		dataType:'json',
		beforeSend:function(){
			a.button('loading').append($('<i>',{class:'icon-loading'}));		
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
				if(b=='add'){
					a.data('action','remove').find('span').html('<?= $lang_text_credit_remove; ?>');
				}else{
					a.data('action','add').find('span').html('<?= $lang_text_credit_add; ?>');
				}
			}
		}
	});
});

$('#reward').on('click',function(){
	var a=$(this),b=a.data('action');
	$.ajax({
		url:'index.php?route=sale/order/'+b+'reward&token=<?= $token; ?>&order_id=<?= $order_id; ?>',
		type:'post',
		dataType:'json',
		beforeSend:function(){
			a.button('loading').append($('<i>',{class:'icon-loading'}));		
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
				if(b=='add'){
					a.data('action','remove').find('span').html('<?= $lang_text_reward_remove; ?>');
				}else{
					a.data('action','add').find('span').html('<?= $lang_text_reward_add; ?>');
				}
			}
		}
	});
});

$('#commission').on('click',function(){
	var a=$(this),b=a.data('action');
	$.ajax({
		url:'index.php?route=sale/order/'+b+'commission&token=<?= $token; ?>&order_id=<?= $order_id; ?>',
		type:'post',
		dataType:'json',
		beforeSend:function(){
			a.button('loading').append($('<i>',{class:'icon-loading'}));		
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
				if(b=='add'){
					a.data('action','remove').find('span').html('<?= $lang_text_commission_remove; ?>');
				}else{
					a.data('action','add').find('span').html('<?= $lang_text_commission_add; ?>');
				}
			}
		}
	});
});
</script>