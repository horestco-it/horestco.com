<!DOCTYPE html>
<html>
<head>
	<title>Admin - template default</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  
	<link rel="stylesheet" href="<?=style_url('materialize.css') ?>">
	<?php $this->load->view('assets/css/admin') ?>
	<link rel="stylesheet" href="<?=assets_url('/vendor/select2/select2.min.css') ?>">
	<link rel="stylesheet" href="<?=style_url('jquery.fileupload-ui.css') ?>">

	<script src="<?=script_url('jquery.min.js')?>"></script>
	<script src="<?=script_url('jquery-ui.min.js')?>"></script>
	<script src="<?=script_url('materialize.min.js')?>"></script>
	<script src="<?=assets_url('/vendor/select2/select2.min.js')?>"></script>

</head>

<body id="app">

<?php $this->load->view('partials/header') ?>

<main>
	<div class="progress" id="top-progress">
		<div class="indeterminate"></div>
	</div>

	<?php $this->load->view('pages/'.$page) ?>
</main>

</body>
</html>