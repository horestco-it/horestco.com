<?php $this->load->view('template/default/header') ?>
<?php $this->load->view('template/default/nav') ?>

<main>
	<div class="container">
		<div class="row valign-wrapper">
			<div class="col s12 m6 valign">
        <h5 class="valign">Verify Your Email Address</h5>

        <p class="valign">We now need to verify your email address. We've sent an email to <strong><?php echo $email ?></strong> to verify your address. Please click the link in that email to continue</p>
        <div class="divider"></div>
        <p class="transparent-text">
          Need to resend the eamil, change your address, or get help?
        </p>
      </div>
		</div>
	</div>
</main>

<?php $this->load->view('template/default/script') ?>
<?php $this->load->view('template/default/footer') ?>