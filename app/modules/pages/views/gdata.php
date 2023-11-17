<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
  <link rel="stylesheet" href="<?=style_url('font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">
</head>
<body>
<?php $this->load->view('partials/nav.php') ?>
	<div class="divider"></div>
<div class="container">
	<div class="row">
		<div class="col s12 m6">
			<form id="form">
				<input type="text" class="inputs" name="fname" id="fname">
				<input type="text" class="inputs" name="lname" id="lname">
				<button type="submit" class="btn">Send</button>
			</form>
			<div id="result"></div>
		</div>
	</div>
</div>

<?php $this->load->view('partials/footer') ?>

<script>
	$(document).ready(function(){

		var $form = $('#form');
		var single = 'https://script.google.com/macros/s/AKfycbz_TB9CKM3M68taPFJp-afB0Q-zTmsBx-l4bbpe331XYK5pqL6d/exec'; // GET
		var bind = 'https://script.google.com/macros/s/AKfycbyqxncUsKnwz2PMXhUfFlHb31RKPS2lssVaTkzoXrAaeDYDQtY/exec';
		var request;
		$form.submit(function(e){
			e.preventDefault();
			if(request)
			{
				request.abort();
			}
			var $inputs = $('.inputs');
			var $result = $('#result');

			$result.html('Sending...');
			// $inputs.attr('disabled', 'disabled');

			request = $.ajax({
				url : single,
				data : $(this).serialize(),
				type : 'post'
			});

			request.done(function(data){
				console.log(data)
				$inputs.val('');
				$result.html('<span>Horrey success</span><br><a href="https://goo.gl/JdWXhp" target="_blank">https://goo.gl/JdWXhp</a>');
				$inputs.removeAttr('disabled');
			});

			request.always(function(){
			});
		});

	});
</script>
</body>
</html>