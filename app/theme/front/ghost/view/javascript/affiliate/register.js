<script>

$('#email').on('blur', function (e) {
	$email 		= this.value;
	$this 		= $(this)
	$container 	= $this.parent();
	$.ajax({
		url: 'affiliate/register/email&email=' + $email,
		type: 'get',
		dataType: 'json',
		beforeSend: function() {
			$container.find('.form-control-feedback').remove();
			$container.find('.help-block').remove();
			$this.closest('.form-group').removeClass('has-feedback');
		},
		success: function (json) {
			if (json['error']) {
				$this
					.after('<span class="help-block" style="color:#d94d3f !important;">' + json['error'] + '</span>')
					.css('border-color', '#d94d3f')
					.closest('.form-group')
					.addClass('has-feedback');
				$this.after('<span class="fa fa-times fa-lg text-danger form-control-feedback"></span>');
			} else {
				$this
					.after('<span class="fa fa-check fa-lg text-success form-control-feedback"></span>')
					.css('border-color', '#9fbb58')
					.closest('.form-group')
					.addClass('has-feedback');
			}
		}
	});
});

$('#password').on('blur', function (e) {
	$password 	= this.value;
	$this 		= $(this)
	$container 	= $this.parent();
	$.ajax({
		url: 'affiliate/register/password&password=' + $password,
		type: 'get',
		dataType: 'json',
		beforeSend: function() {
			$container.find('.form-control-feedback').remove();
			$container.find('.help-block').remove();
			$this.closest('.form-group').removeClass('has-feedback');
		},
		success: function (json) {
			if (json['error']) {
				$this
					.after('<span class="help-block" style="color:#d94d3f !important;">' + json['error'] + '</span>')
					.css('border-color', '#d94d3f')
					.closest('.form-group')
					.addClass('has-feedback');
				$this.after('<span class="fa fa-times fa-lg text-danger form-control-feedback"></span>');
			} else {
				$this
					.after('<span class="fa fa-check fa-lg text-success form-control-feedback"></span>')
					.css('border-color', '#9fbb58')
					.closest('.form-group')
					.addClass('has-feedback');
			}
		}
	});
});

$('#confirm').on('blur', function (e) {
	$confirm 	= this.value;
	$this 		= $(this)
	$container 	= $this.parent();

	$container.find('.form-control-feedback').remove();
	$container.find('.help-block').remove();
	$this.closest('.form-group').removeClass('has-feedback');
	
	if ($confirm != $('#password').val() || $confirm == '') {
		$this
			.after('<span class="help-block" style="color:#d94d3f !important;"><?= $lang_error_confirm; ?></span>')
			.css('border-color', '#d94d3f')
			.closest('.form-group')
			.addClass('has-feedback');
		$this.after('<span class="fa fa-times fa-lg text-danger form-control-feedback"></span>');
	} else {
		$this
			.after('<span class="fa fa-check fa-lg text-success form-control-feedback"></span>')
			.css('border-color', '#9fbb58')
			.closest('.form-group')
			.addClass('has-feedback');
	}
});

</script>