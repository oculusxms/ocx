<script>

var radios = $('#tab-payment').find('input:radio');

radios.each(function(){
	$(this).on('change', function() {
		$('.payment').hide();
		$('#payment-' + this.value).show();
	});
});

$('input[name="payment_method"]:checked').change();

</script>