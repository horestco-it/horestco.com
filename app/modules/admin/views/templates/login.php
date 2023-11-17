<!DOCTYPE html>

<html>

<head>

	<title>Admin</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link rel="stylesheet" href="<?=style_url('materialize.min.css') ?>">

	<style>

	#form-wrapper{

		margin: auto;

		width: 500px;

		padding: 0 30px;

	}

	.valign-wrapper{

		height: 600px;

	}

	@media only screen and (max-width: 480px) {

			#form-wrapper{

				width: 300px;

				margin-top: 30px;

			}



			.valign-wrapper{

				height: auto;

			}

		}

	</style>



</head>



<body>

<div class="container">

	<div class="row">

		<div class="col s12">



			<div class="row">

				<div class="valign-wrapper">

					<div id="form-wrapper" class="valign">

						<?php $this->load->view('forms/login'); ?>

					</div>

				</div>

			</div>



		</div>

	</div>

</div>



<script src="<?=script_url('vue.js')?>"></script>

<script src="<?=script_url('jquery.min.js')?>"></script>

<script src="<?=script_url('materialize.min.js')?>"></script>



</body>



</html>