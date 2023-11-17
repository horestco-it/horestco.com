<?php 
include '../../api/check_session.php';
 ?>
<div class="col-sm-offset-3 col-sm-6">

	<div class="panel panel-primary">

		<div class="panel-heading">

			<h3 class="panel-title">Add New Client</h3>

		</div>

		<div class="panel-body">

		  <form id="clientform" class="form-horizontal" role="form">

		  

		  	<div class="form-group">

		  		<div class="col-sm-4">

		  			<label for="">Client Category:</label>

		  		</div>

		  		<div class="col-sm-8">

		  			<select name="category" class="form-control text-capitalize input-sm" required>

		  				<option value="">--Please select--</option>

							<?php

								foreach ($portocategory as $row):

							?>

							<option value="<?=$row['portoid']?>"><?=$row['name']?></option>

							<?php endforeach; ?>

		  			</select>

		  		</div>

		  	</div>

		  

		  	<div class="form-group">

		  		<div class="col-sm-4">

		  			<label for="">Name:</label>

		  		</div>

		  		<div class="col-sm-8">

		  			<input type="text" class="form-control input-sm" name="name" placeholder="name of client" required>

		  		</div>

		  	</div>

		  

		  	<div class="form-group">

		  		<div class="col-sm-4">

		  			<label for="">Address:</label>

		  		</div>

		  		<div class="col-sm-8">

		  			<input type="text" class="form-control input-sm" name="address" placeholder="address of client" required>

		  		</div>

		  	</div>

		  

		  	<div class="form-group">

		  		<div class="col-sm-4">

		  			<label for="">Job Scopes:</label>

		  		</div>

		  		<div class="col-sm-8">

		  			<input type="text" class="form-control input-sm" name="scopes" placeholder="Input field">

		  			<p class="text-warning"><em>Separate by "," (coma)</em></p>

		  		</div>

		  	</div>

		  

		  	<div class="form-group">

		  		<div class="col-sm-4">

		  			<label for="">Description:</label>

		  		</div>

		  		<div class="col-sm-8">

		  			<textarea name="des" class="form-control"></textarea>

		  		</div>

		  	</div>

		  

		  	<button type="submit" name="addsubmit" class="btn btn-primary btn-sm">Submit</button>

		  	<a href="<?=THIS_FILE?>" class="btn btn-danger btn-sm">Cancel</a>

		  </form>

		</div>

	</div>

</div>



<?php

include '../../../classes/Db.class.php';

$db = new DB();

if ( isset($_GET['addsubmit']) && $_GET['addsubmit'] ):

	$db->bindMore(array(

		'category'=> $_POST['category'],

		'name'		=> $_POST['name'],

		'address'	=> $_POST['address'],

		'path'		=> strtolower(str_replace(" ", "", $_POST['name'])),

		'scopes'	=> $_POST['scope'],

		'des'  		=> $_POST['des']

		));

	$sql = " INSERT INTO portoclient(portoid,name,location,path,scopes,description) 

				VALUES (:category, :name, :address, :path, :scopes, :des) ";

	$clients = $db->query($sql);

	if ( $clients ) {

		// header("location:../../portfolio.php");

		$client = array('status' => true, 'lastid' => $db->lastInsertId() );

		echo json_encode($client);

	}

	else{

		$client = array('status' => false );

		echo json_encode($client);

	}

endif

?>