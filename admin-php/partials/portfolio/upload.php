<div class="panel panel-info">
	<div class="panel-body">
		<form action="_partials/portfolio/addclient.php?upload=true&amp;clientid=<?=$_GET['clientid']?>" method="post" enctype="multipart/form-data" role="form">
			<legend>Upload Files</legend>
			<div class="form-group">
				<label for="">Image(s):</label>
	  		<input type="file" id="fileupload" name="images[]" multiple="multiple" accept="image/*"/>
	  	</div>
	  	<div class="form-group" id="upload-result">
  		  	<button type="submit" name="uploadsubmit" id="uploadsubmit" class="btn btn-primary">Submit</button>
		  	</div>
		</form>
	</div>
</div>