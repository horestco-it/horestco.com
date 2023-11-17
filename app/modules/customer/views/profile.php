<?php $this->load->view('template/default/header') ?>

<title><?=ucwords($customer->name)?> Profile | Horestco</title>

<?php $this->load->view('template/default/nav') ?>



<?php if ($customer->verify->is_verified == 0): ?>

<div class="container">

  <div class="card-panel pink lighten-4 pink-text z-depth-0">

    <div class="row">

      <div class="col s12 m6">

        

        Your email <strong style="text-decoration: underline;"><?=$customer->email?></strong> has not been verified.

        <br>

        Please check on your e-mail inbox!

        <div class="divider grey" style="margin:10px 0"></div>

        Did not get the email? Click the button below to resend.

        <form action="/customer/resend">

          <button type="submit" class="black-text green">Resend</button>

        </form>

      </div>

      </div>

    </div>

<?php endif ?>
</div>

<?php if ($customer->verify->is_reset == 1): ?>

<div class="container">

  <div class="card-panel pink lighten-4 pink-text z-depth-0">

    <div class="row">

      <div class="col s12 m6">

        

        your password has been reset, to continue this action.

        <br>

        Please check on your e-mail inbox!

        <div class="divider grey" style="margin:10px 0"></div>

        or click this botton below to cancel

        <form action="/customer/cancelreset">

          <button type="submit" class="black-text green">Cancel</button>

        </form>

      </div>

      </div>

    </div>

<?php endif ?>
</div>



<main>

  <div class="container">
    <p class="black-text"><?=$this->session->flashdata('message')?></p>

    <h1><?=$customer->name?></h1>
    <span class="red-text text-darken-2"><a href="/customer/editpwd">Change Password</a></span>
  </div>

</main>



<?php $this->load->view('template/default/script') ?>

<?php $this->load->view('template/default/footer') ?>