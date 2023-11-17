<?php 
  // error_reporting(E_ALL);
  ini_set("display_errors", 0);
  include '../classes/Helper.php';
  include '../classes/DB.php';
  include '../config.php';

  $messages = array();
  $username = null;

  if (isset($_POST['submit'])) {
    // variable
    $auth['username']     = $username = $_POST['name'];
    $auth['password']     = $_POST['password'];
    $auth['redirect']     = isset($_POST['url']) ? $_POST['url'] : null;;

    //;validasi
    if ( $auth['username'] == '' ) $messages['username'] = 'Please insert username !!';
    if ( $auth['password'] == '' ) $messages['password'] = 'Please insert password !!';

    if (!count($messages)) {
      $db = new Db();
      $db->bind("username", $auth['username']);
      $row = $db->row(" SELECT * FROM users WHERE email = :username");

      // $helper->dd($blockCipher->decrypt($row['password']) );

      if (!$row)
      {
        $messages['error-credential'] = 'The username and password incorrect';
      }
      elseif(!password_verify($auth['password'] , $row['password']))
      {
        $messages['password-error'] = 'Password incorrect';
      }
      else
      {
        session_start();
        $_SESSION['username']       = $row['email'];
        $_SESSION['type']           = $row['type'];
        $_SESSION['displayname']    = $row['name'];
        $_SESSION['start']          = time();
        $_SESSION['expired']        = $_SESSION['start'] + ( 60 * 120 ); // 60 menit

        if ($auth['redirect'] == '')
        {
          header("location:dashboard.php");
        }
        else
        {
          header("location:" . $auth['redirect'] );
        }
      }
      
    }

  }


 ?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">
    <meta http-equiv="expires" content="sat, 02 jun 2018 14:30:00 GMT">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="../../favicon.ico">



    <title>Signin Template for Admin Horestco</title>


    <!-- Bootstrap core CSS -->

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="<?=base_url()?>assets/css/styles.css" rel="stylesheet" />



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

  </head>



  <body>

    <div class="container" style="padding:40px 20px;">

      <div class="row">

          <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">

            <?php if ( isset($messages) && count($messages) > 0 ): ?>
              <?php foreach ($messages as $key => $msg): ?>
              <div class="well">
                <p class="text-danger"><?=$msg?></p>
              </div>
              <?php endforeach ?>
            <?php endif ?>

              <form role="form" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formLogin">

                  <h2 class="text-center">Admin Login</h2>

                  <hr />

                  <?php if(isset($_GET['redirect'])): ?>
                    <input type="hidden" class="form-control" name="url" value="<?=$_GET['url']?>" />
                  <?php endif ?>


                  <div class="form-group">

                      <label for="inputName">Username</label>

                      <input value="<?=$username?>" type="text" class="form-control" name="name" data-ng-model="user.name" placeholder="Enter Username" required autofocus />
                      

                  </div>

                  <div class="form-group">

                      <label for="inputPass">Password</label>

                      <input type="password" class="form-control" name="password" data-ng-model="user.password" placeholder="Password" required />

                  </div>

                  <button type="submit" class="btn btn-primary btn-block" name="submit" ng-disabled="formLogin.$invalid">Login</button>

              </form>

          </div>



      </div>

  </div>

  </body>

</html> 