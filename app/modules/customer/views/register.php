<?php $this->load->view('template/default/header') ?>

<title>Horestco | Register</title>

<?php $this->load->view('template/default/nav') ?>



<div class="divider"></div>



<main>

  <div class="container">

    <div class="row center">

      <div class="col s12">

        <h3 class="lead-heading">Customer Register</h3>

        

        <div class="red-text">

          <?php echo validation_errors(); ?>

          <?php echo $this->session->flashdata('errors') ?>

        </div>

      </div>

    </div>

		<div class="row">

      <div class="col s12 m3 l4 transparent-text hide-on-small-only">&nbsp;</div>

      <div class="col s12 m6 l4">

        <div class="card-panel bordered">

          <form action="/customer/reg_process" method="post">



            <div class="row">

              <div class="col s12 m6">

                <div class="input-field required">

                  <input type="text" name="name" id="name" value="<?=set_value('name')?>" required>

                  <label for="name">First Name:</label>

                </div>

              </div>

              <div class="col s12 m6">

                <div class="input-field">

                  <input type="text" name="last_name" id="last_name" value="<?=set_value('last_name')?>">

                  <label for="last_name">Last Name:</label>

                </div>

              </div>

            </div>



            <div class="input-field required">

              <input type="email" name="email" id="email" value="<?=set_value('email')?>" required>

              <label for="email">Email:</label>

            </div>

            

            <div class="input-field required">

              <input type="password" minlength="6" name="password1" id="password1" value="<?=set_value('password1')?>" required>

              <label for="password1">Password:</label>

            </div>

            <div class="input-field required">

              <input type="password" minlength="6" name="password" id="password" value="<?=set_value('password')?>" required>

              <label for="password2">Retype Password:</label>

              <span class="pass-info"></span>

            </div>



            <div class="input-field required">

              <input type="text" name="customer[contact][address]" id="address" value="<?=set_value('customer[contact][address]')?>">

              <label for="address"><?=ucwords('address')?>:</label>

            </div>



            <div class="input-field required">

              <input type="text" name="customer[contact][city]" id="city" value="<?=set_value('customer[contact][city]')?>">

              <label for="city"><?=ucwords('city')?>:</label>

            </div>



            <div class="row">

              <div class="col s12 m6">

                <div class="input-field"> 

                  <select name="customer[contact][country_id]" id="customer-country" class="browser-default" value="<?=set_value('customer[contact][country_id]')?>" required>

                    <option value="">-- Country --</option>

                    <?php foreach ($countries as $id => $name): ?>

                      <option  value="<?=$id?>" 

                      <?=set_select('customer[contact][country_id]', $id, set_value('customer[contact][country_id]' == $id) )?> >

                      <?=$name?>

                      </option>

                    <?php endforeach ?>

                  </select>

                </div>

              </div>



              <div class="col s12 m6">

                <div class="input-field required"> 

                  <input type="text" name="customer[contact][zip]" class="form-control" id="customer-zip" value="<?=set_value('customer[contact][zip]')?>" required>

                  <label class="control-label" for="customer-zip">Zip</label>

                </div>

              </div>

            </div>



            <div class="input-field required">

              <input type="tel" name="customer[contact][telephone]" id="customer-phone" class="form-control" value="<?=set_value('customer[contact][telephone]')?>" required>

              <label for="customer-phone">Phone</label>

            </div>



            <div class="input-field">

              <button class="btn btn-full" type="submit">Register</button>

            </div>

          </form>

        </div>

      </div>

			<div class="col s12 m3 l4 transparent-text hide-on-small-only">&nbsp;</div>

		</div>

	</div>

</main>



<?php $this->load->view('template/default/script') ?>

<script>

  var $pass1 = $('#password1');

  var $pass2 = $('#password');

  var $info = $('.pass-info');

  var pass = {};



  $pass1.keyup(function(){

    pass.one = $(this).val();

    passwordValidation()

  });



  $pass2.keyup(function(){

    pass.two = $(this).val();



    passwordValidation()

  });



  function passwordValidation() {

    if( 

         typeof pass.one == 'undefined' 

      || typeof pass.two == 'undefined'

      ) return;



    if(

      pass.one == ''

      || pass.two == ''

      ){

      $info.removeClass('red-text').empty();

      return;

    }



    if(pass.one != pass.two)

    {

      $info.addClass('red-text').html('Password doesn\'t match');

    }

    else{

      $info.removeClass('red-text').empty();

    }

  }

</script>

<?php $this->load->view('template/default/footer') ?>