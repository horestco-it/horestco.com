<?php 
ini_set("display_errors", 1);
require '../../../classes/Db.class.php';
require '../../../config.php';
$db = new DB();
$portocategory = $db->query(" SELECT * FROM pages WHERE category = 'portfolio' AND name != 'portfolio' ORDER BY 'name' ");
$db->bind('clientid', (isset($_GET['id'])) ? $_GET['id'] : null );
$client = $db->row(" SELECT * FROM porto_clients WHERE id = :clientid ");

$portoid = $client['page_id'];
$name = $client['name'];
$address = $client['location'];
$scopes = $client['scopes'];
$des = $client['description'];
$status = $client['is_enabled'];


?>

<?php if ( isset($_GET['modal']) && $_GET['modal'] == 'body' ): ?>


<form id="updatetextform" method="post" role="form">

  	<div class="form-group">
		<label for="">Category:</label>
		<select name="portoid" class="form-control text-capitalize input-sm" required>
			<option value="">--Please select--</option>
			<?php
				foreach ($portocategory as $row):
			?>
			<option value="<?=$row['id']?>" <?php if($row['id'] == $portoid) echo "selected"; ?>><?=$row['name']?></option>
			<?php endforeach; ?>
		</select>
  	</div>

	<div class="form-group">
		<label for="">Name</label>
		<input type="text" name="name" class="form-control input-sm" value="<?=$name?>">
	</div>

	<div class="form-group">
		<label for="">Address</label>
		<input type="text" name="location" class="form-control input-sm" value="<?=$address?>">
	</div>

	<div class="form-group">
		<label for="">Job Scopes</label>
		<input type="text" name="scopes" class="form-control input-sm" value="<?=$scopes?>">
	</div>

	<div class="form-group">
		<select name="status" class="form-control input-sm">
			<option value="1" <?php if( $status == 1 ) echo 'selected' ?> >Active</option>
			<option value="0" <?php if( $status == 0 ) echo 'selected' ?> >Inactive</option>
		</select>
	</div>

	<div class="form-group">
		<label for="">Sort Order</label>
		<input type="text" name="sort_order" class="form-control input-sm" value="<?=$client['sort_order']?>">
	</div>

	<div class="form-group">
		<label for="">Description</label>
		<textarea name="des" cols="30" rows="10" class="form-control input-sm"><?=$des?></textarea>
	</div>

	<button id="btnupdate" name="edit-text-submit" class="btn btn-info btn-sm">Submit</button>
	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
</form>
<script>
	$(document).ready(function(){

		$('#updatetextform').submit(function(e){
			e.preventDefault();
			$.ajax({
				url : '<?=$_SERVER["PHP_SELF"]?>?action=edit-text&id=<?=$_GET["id"]?>',
				method: 'post',
				data : $(this).serialize(),
				success : function(data){
					location.reload();
				}
			})
		});

	});
</script>

<?php endif ?>

<?php 

if( isset($_GET['action']) && $_GET['action'] == 'edit-text' ){
	$db = new DB;

	$db->bind('clientid', $_GET['id']);
	$db->bind('portoid', $_POST['portoid']);
	$db->bind('name', $_POST['name']);
	$db->bind('location', $_POST['location']);
	$db->bind('scopes', $_POST['scopes']);
	$db->bind('sort_order', $_POST['sort_order']);
	$db->bind('status', $_POST['status']);
	$db->bind('des', $_POST['des']);
	$update = $db->row(" UPDATE porto_clients SET 
								page_id =  :portoid,
								name = :name, 
								location = :location, 
								scopes = :scopes,
								sort_order = :sort_order,
								is_enabled = :status, 
								description = :des 
								WHERE id = :clientid 
							");
}

 ?>