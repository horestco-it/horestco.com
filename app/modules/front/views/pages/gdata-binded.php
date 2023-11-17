<!DOCTYPE html>
<html>
<head>
	<title>TEst set data to gdrive</title>
</head>
<body>


<form method="post" id="form" action="https://script.google.com/macros/s/AKfycbyqxncUsKnwz2PMXhUfFlHb31RKPS2lssVaTkzoXrAaeDYDQtY/exec">
	<input type="text" name="fname" id="fname">
	<input type="text" name="lname" id="lname">
	<input type="submit" value="submit">
</form>

<script src="<?=script_url('jquery.min.js')?>"></script>
<script>
	$(document).ready(function() {
	// 	$('#form').submit(function(e){
	// 		e.preventDefault();
	// 		$.get(api, {fname:$('#fname').val(), lname: $('#lname').val()}, function(data){
	// 			console.log(data)
	// 		})
	// 	})
	})
</script>
</body>
</html>