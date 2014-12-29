<script>
$('input[name="payment"]').change(function(){
	$('.payment').hide();
	$('#payment-'+this.value).show();
});
$('input[name="payment"]:checked').change();
</script>