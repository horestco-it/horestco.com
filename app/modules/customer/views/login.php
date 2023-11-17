<?php $this->load->view('template/default/header') ?>



<title>Horestco | Login</title>

<style>

  .panel-login{

    border-right:1px solid #ededed;

  }

</style>





<?php $this->load->view('template/default/nav') ?>



<div class="divider"></div>

<main>

	

	<div class="container">

		<div class="row">

			<div class="col s12 m1 transparent-text">&nbsp;</div>

			<div class="col s12 m5 panel-login">

				<h4>ALREADY REGISTERED ?</h4>

				<p class="grey-text">If you have an account with us, please log in.</p>
				 <p class="black-text"><?=$this->session->flashdata('message')?></p>

				<p><?php echo validation_errors(); ?></p>
			
				<div class="card-panel grey lighten-5 bordered">

					<form action="/customer/validate" method="post">

						<input type="hidden" name="referrer" value="<?=$this->agent->referrer()?>">

						<div class="input-field">

							<label for="email">Email:</label>

							<input type="text" id="email" name="email" class="validate" required>

						</div>

						<div class="input-field">

							<label for="password">Password:</label>

							<input type="password" id="password" name="password" class="validate" required>

						</div>

						<div class="input-field">

							<button class="btn btn-full" type="submit">login</button>

						</div>
						
      				<span class="red-text text-darken-2"><a href="/customer/resetpwd">Forgot Password?</a></span>
   						 
					</form>

				</div>

			</div>

			<div class="col s12 m1 transparent-text">&nbsp;</div>

			<div class="col s12 m4">

				<h4>NEW HERE ?</h4>

				<p>Registration is <span class="orange-text">free</span> and easy!</p>

				<a href="/customer/register" class="btn orange">create new account</a>

			</div>

			<div class="col s12 m2 transparent-text">&nbsp;</div>

		</div>

	</div>

</main>



<?php $this->load->view('template/default/script') ?>



<?php $this->load->view('template/default/footer') ?>