<?php
ini_set("display_errors", 0);

require 'api/check_session.php';
require '../config.php';
require_once '../classes/DB.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] != 'A' ){
  echo "Access Denied. <br/>";
  echo "<a href='/admin-php/dashboard.php'>Dashboard</a>";
  return;
}

$website      = "@horestco.com";      
$userTypes = [
  'A' => 'Admin',
  'U' => 'User',
  'P' => 'Personal',
];
$users    = \Horestco\My\Model\User::all();

//////////////////
// add new user //
//////////////////
if ( isset($_POST['add-submit']) )
{
  $inputs = array(
    'email'     => $_POST['name'] . $website,
    'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT),
    'type'      => $_POST['type'],
    'name'      => $_POST['display'] != '' ? $_POST['display'] : $_POST['name'],
  );

  $create = \Horestco\My\Model\User::insert($inputs);

  if($create)
  {
    header("location:setting.php");
  }
}

///////////////
// edit user //
///////////////
if(isset($_GET['action']) && $_GET['action'] == "edituser")
{
  $user = \Horestco\My\Model\User::find($_GET['id']); 

  // edit submit
  if ( isset($_POST['edit_submit']) )
  {
    $user->email     = $_POST['name'];
    $user->password  = password_hash( $_POST['password'], PASSWORD_DEFAULT);
    $user->type      = $_POST['type'];
    $user->name      = $_POST['display'] != '' ? $_POST['display'] : $_POST['name'];
    $update = $user->save();

    if($update) header("Refresh:0");
  }
}
/////////////////
// delete user //
/////////////////
if ( isset($_GET['action']) && $_GET['action'] == "delete")
{
  $user = \Horestco\My\Model\User::find($_GET['id']);
  if( $user->delete() )
  {
    header("location:".$_SERVER['PHP_SELF']);
  }

}
 ?>
<!-- top navigation -->
<?php include 'partials/header.php'; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2 main">
      <h1>Setting User Login</h1>
      <hr />
<!--
===============================================================
Add new user
===============================================================
-->
<?php if(isset($_GET['action']) && $_GET['action'] == "adduser" ): ?>

<div class="panel panel-primary" style="width:50%">
    <div class="panel-heading">
      <h3 class="panel-title">Add new user</h3>
    </div>

    <div class="panel-body">
      <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" role="form">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" name="name" placeholder="username" required="required"/>
            <div class="input-group-addon">@horestco.com</div>
          </div>
        </div>                  

        <div class="form-group">
          <input type="text" class="form-control" name="password" placeholder="password" required="required"/>
        </div>

        <div class="form-group">
          <select name="type" class="form-control" required="required">
            <option value="A">Admin</option>
            <option value="P">Personalia</option>
            <option value="U" selected>User</option>
          </select>
        </div>                   

        <div class="form-group">
          <input type="text" class="form-control" name="display" placeholder="Display name" />
        </div>            

        <button type="submit" name="add-submit" class="btn btn-primary">Submit</button>

        <a href="<?=$_SERVER['PHP_SELF']?>" name="cancel" class="btn btn-primary">Cancel</a>

      </form>
    </div>
</div>

<?php endif ?>

<!--
===============================================================
Edit user
===============================================================
-->
<?php if(isset($_GET['action']) && $_GET['action'] == "edituser"):?>

<div class="panel panel-primary" style="width:50%">

  <div class="panel-heading">
    <h3 class="panel-title">Edit user</h3>
  </div>

  <div class="panel-body">
    <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" role="form">
      <div class="form-group">
        <input type="hidden" class="form-control" name="id" value="<?=$user['id']?>"/>
      </div>  

      <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="username" value="<?=$user['email']?>"/>
      </div>                  

      <div class="form-group">
        <input type="text" class="form-control" name="password" placeholder="[unchanged]" />
      </div>

      <div class="form-group">
        <select name="type" class="form-control">
          <?php if($type == "A"):?>
            <option value="A" selected>Admin</option>
            <option value="P">Personalia</option>
            <option value="U">User</option>
          <?php elseif($type == "P"): ?>                      
            <option value="A">Admin</option>
            <option value="P" selected>Personalia</option>
            <option value="U">User</option>
          <?php else: ?>
            <option value="A">Admin</option>
            <option value="P">Personalia</option>
            <option value="U" selected>User</option>
          <?php endif ?>
        </select>
      </div>                   

      <div class="form-group">
        <input type="text" class="form-control" name="display" placeholder="Display name" value="<?=$user['name']?>" />
      </div>            

      <button type="submit" name="edit_submit" class="btn btn-primary">Submit</button>

      <a href="<?=$_SERVER['PHP_SELF']?>" name="cancel" class="btn btn-primary">Cancel</a>

    </form>
  </div>
</div>

<?php endif ?>

<p><a href="<?=$_SERVER['PHP_SELF']?>?action=adduser">Add User</a></p>
<!--
==========================================================
GET USER
==========================================================
-->
<div class="">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th width="200">Type</th>
        <th>Action</th>
        <th style="width:100px">Password</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach($users as $i => $user): ?>

      <tr>
        <td><?=$i+1?></td>
        <td><?=$user['name']?></td>
        <td><?=$user['email']?></td>
        <td>
          <?php
            echo isset($userTypes[$user['type']]) ? $userTypes[$user['type']] : '--';
            ?>
        </td>
        <td>
          <a href="<?=$_SERVER['PHP_SELF']?>?action=edituser&amp;id=<?=$user['id']?>">Edit</a> 
          <br/>
          <a onclick="return confirm('Are you sure DELETE <?=$user["name"]?> ?');" href="<?=$_SERVER['PHP_SELF']?>?action=delete&amp;id=<?=$user['id']?>">Remove</a>
        </td>
        <td>
          <?php
            echo $user['password'] ? '<span class="text-muted">[unchanged]</span>': '<span class="text-danger">[unset]</span>';
          ?>
        </td>
      </tr>

    <?php endforeach; ?>

    </tbody>
  </table>
</div><!-- end table-responsive -->

</div>
</div>
</div>

  </body>

  </html>

