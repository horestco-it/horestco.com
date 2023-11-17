<?php $this->load->view('template/default/header') ?>

<title>Horestco | Reset Password</title>

<?php $this->load->view('template/default/nav') ?>



<div class="divider"></div>



<main>

<div class="container">

    <div class="row center">

      <div class="col s12">

        <h3 class="lead-heading">Reset Your Password</h3>

        <p>Use This Form Below to Renew Your Password</p>
        <p> <?php echo $this->session->flashdata('errors') ?></p>

      </div>
     </div>
    
   <div class="row">

      <div class="col s12 m3 l4 transparent-text hide-on-small-only">&nbsp;</div>

         <div class="col s12 m6 l4">

             <div class="card-panel bordered">

                <form action="/customer/validateres" method="post">
                
                        <div class="input-field">
                          <input  type="email" name="email" id="email" value="<?=set_value('email')?>" class="validateres" required>
                          <label for="email">Email</label>
                        </div>

                   
                        <div class="input-field">
                          <input  type="password" name="newpassword" id="newpassword" value="" class="validateres" required>
                          <label for="newpassword">New Password</label>
                        </div>

                        <div class="input-field ">
                            <input  type="password" name="confirmpassword" id="confirmpassword" value="" class="validateres"  onchange="isPasswordMatch();" required>
                            <label for="confirmpassword">Confirm Password</label>
                          <div id="divCheckPassword"></div>
                      </div>
                       
                    <div class="input-field">
                        <button class="btn btn-full" type="submit" name="action">Reset</button>
                    </div>
           </form>
          </div>
          </div>

<div class="col s12 m3 l4 transparent-text hide-on-small-only">&nbsp;</div>

    </div>

  </div>

</main>       <!--Import jQuery before materialize.js-->
   

<?php $this->load->view('template/default/script') ?>

<script>

  function isPasswordMatch() {
    var password = $("#newpassword").val();
    var confirmPassword = $("#confirmpassword").val();

    if (password != confirmPassword) $("#divCheckPassword").html("Passwords do not match!");
    else $("#divCheckPassword").html("");
}

$(document).ready(function () {
    $("#confirmpassword").keyup(isPasswordMatch);
});
     
   
   
</script>

   <?php $this->load->view('template/default/footer') ?>     