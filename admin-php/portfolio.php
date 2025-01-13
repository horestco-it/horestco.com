<?php 
require 'api/check_session.php';
require_once '../classes/Db.class.php';
require_once '../classes/Helper.php';
require '../config.php';
$db = new DB;
$portocategory = $db->query(" SELECT * FROM pages WHERE category = 'portfolio' AND name != 'portfolio' ORDER BY 'name' ");
 ?>


<?php
$db = new DB;


if( isset($_GET['action']) && $_GET['action'] == 'add-tooltip' ){
	$db = new DB;
	$post = json_decode($_POST['data']);
	// $db-> = $post->clientid;
	// $data = $post->pid;
	// $data = $post->coordinate;
	// $data = $post->idportoimage;
	$db->bindMore(array(
		'clientid' => $post->clientid,
		'pid' => $post->pid,
		'coordinate' => $post->coordinate,
		'idportoimage' => $post->idportoimage
		));
	$data = $db->query(" INSERT INTO portotooltip VALUES(null,:clientid, :pid, :coordinate, :idportoimage) ");
	dj($data);
};
if ( isset($_GET['action']) && $_GET['action'] == 'update-tooltip' ) {
	$db = new DB();
	$coordinate = $_GET['left'].",".$_GET['top'];
	$db->bindMore(array(
			'id' 	=> $_GET['id'],
			'coords' => $coordinate
		));
	$tooltip = $db->row(" UPDATE portotooltip SET coordinate = :coords WHERE idtooltip = :id ");
	if ($tooltip > 0) {
		return true;
	}
};

if ( isset($_GET['action']) && $_GET['action'] == 'delpertooltip' ) {
	$db = new DB();
	$db->bind('id', $_GET['id']);
	$deltooltip = $db->row(" DELETE FROM portotooltip WHERE idtooltip = :id ");
	if ($deltooltip > 0) {
		echo 1;
	}
};
// delete client
if ( isset($_GET['action']) && $_GET['action'] == 'deleteclient' ) {
	$db = new DB();
	$db->bind('clientid', $_GET['id']);
	$deleteclient = $db->row(" DELETE FROM porto_clients WHERE id = :clientid ");
	// if ( $deleteclient ) {
	$db = new DB();
	$db->bind('clientid', $_GET['id']);
	$deleteimage = $db->query(" DELETE FROM portoimage WHERE clientid = :clientid ");
	$db = new DB();
	$db->bind('clientid', $_GET['id']);
	$deletetooltip = $db->query(" DELETE FROM portotooltip WHERE clientid = :clientid ");

};

if ( isset($_GET['action']) && $_GET['action'] == 'deleteimage' ) {
	$db = new DB();
	$db->bind('id', $_GET['id']);
	$image = $db->row(" SELECT * FROM porto_images WHERE id = :id ");
	$name = $image['name'];
	// $clientId = $image['porto_client_id'];
	// // retreive folder name category portfolio
	// $db->bind('clientId', $clientId);
	// $client = $db->row(" SELECT * FROM porto_clients WHERE id = :clientId ");
	// $db->bind('pageId', $client['page_id']);
	// $page = $db->row(" SELECT * FROM pages WHERE id = :pageId ");
	
	$db = new DB();
	$db->bind('id', $_GET['id']);
	$deleteimage = $db->row(" DELETE FROM porto_images WHERE id = :id ");
	
	unlink(base_path('assets/images/portfolio/'.$_GET['category'].'/'.$name));
	header("Location:".base_url('admin-php/portfolio.php'));
	echo $name;
};

if ( isset($_GET['action']) && $_GET['action'] == 'setprimary' ) {
	$db = new DB();
	$db->bind('clientid', $_GET['clientid']);
	$reset = $db->query(" UPDATE porto_images SET is_primary = 0 WHERE porto_client_id=:clientid ");
	$db = new DB();
	$db->bind('imageid', $_GET['imageid']);
	$setprimary = $db->query(" UPDATE porto_images SET is_primary = 1 WHERE id=:imageid ");
	if ( count($reset) > 0 && count($setprimary) > 0 ) {
		echo true;
	}
}
?>



<?php include 'partials/header.php'; ?>
<div id="wrap">
	<div class="container">
  	<div class="row">
  	  <div class="col-sm-12 main">
    		<h2 class="text-center">Manage Portfolio</h2>
    	</div>
			<div class="col-sm-offset-3 col-sm-6">
				<?php if ( !isset($_GET['action'] ) ): ?>
		  		<p class="text-center">
						<a class="btn btn-sm btn-success" href="<?=THIS_FILE?>?action=add">
							<span class="glyphicon glyphicon-plus"></span> Add Client
						</a>
		  		</p>
				<div class="form-group">
					<p class="text-center">
						Choose category to show the lists item of clients !
					</p>
					<select name="" class="form-control text-capitalize" id="select-category">
						<option value="">--Choose Category--</option>
						<?php foreach ($portocategory as $row): ?>
							<option data-category="<?=$row['name']?>" value="<?=$row['id']?>"><?=$row['name']?></option>
						<?php endforeach; ?>
					</select>
				</div> 
				<?php endif ?>
				<?php if ( isset($_GET['action']) && $_GET['action'] == 'add' ): ?>
			  	<div class="panel panel-primary">
			  		<div class="panel-heading">
			  			<h3 class="panel-title">Add Client</h3>
			  		</div>
			  		<div class="panel-body">
			  		  <form id="clientform" role="form">
			  		  
			  		  	<div class="form-group">
			  		  		<label for="">Client Category:</label>
			  		  		<!-- <div class="input-group"> -->
			  		  			<select name="category" class="form-control text-capitalize input-sm" required>
			  		  				<option value="">--Please select--</option>
	  									<?php
	  										foreach ($portocategory as $row):
	  									?>
	  									<option value="<?=$row['id']?>"><?=$row['name']?></option>
	  									<?php endforeach; ?>
			  		  			</select>
			  		  	</div>
			  		  
			  		  	<div class="form-group">
			  		  		<label for="">Name:</label>
			  		  		<input type="text" class="form-control input-sm" name="name" placeholder="name of client" required>
			  		  	</div>
			  		  
			  		  	<div class="form-group">
			  		  		<label for="">Address:</label>
			  		  		<input type="text" class="form-control input-sm" name="location" placeholder="address of client" required>
			  		  	</div>
			  		  
			  		  	<div class="form-group">
			  		  		<label for="">Job Scopes:</label>
			  		  		<input type="text" class="form-control input-sm" name="scopes" placeholder="Input field">
			  		  		<p class="text-warning"><em>Separate by "," (coma)</em></p>
			  		  	</div>
			  		  
			  		  	<div class="form-group">
			  		  		<label for="">Description:</label>
			  		  		<textarea name="description" class="form-control"></textarea>
			  		  	</div>
			  		  
			  		  	<button type="submit" class="btn btn-primary btn-sm">Submit</button>
			  		  	<a href="<?=THIS_FILE?>" class="btn btn-danger btn-sm">Cancel</a>
			  		  </form>
			  		</div>
			  	</div>
			  	<?php endif; ?>
			  	<?php if ( isset($_GET['action']) && $_GET['action'] == 'upload' && $_GET['clientid'] ): ?>
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Upload Files</h3>
						</div>
						<div class="panel-body">
							<form action="partials/portfolio/addclient.php?upload=true&amp;clientid=<?=$_GET['clientid']?>" method="post" enctype="multipart/form-data" role="form">
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
				<?php endif; ?>
				<?php if ( isset($_GET['action']) && $_GET['action'] == 'uploadpdf' && $_GET['clientid'] ): ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
							<h3 class="panel-title">Upload PDF</h3>
						</div>
					<div class="panel-body">
						<form action="partials/portfolio/addclient.php?uploadpdf=true&amp;clientid=<?=$_GET['clientid']?>" method="post" enctype="multipart/form-data" role="form">
							<div class="form-group">
		  		  		<input type="file" id="pdfupload" name="pdf" accept="application/pdf"/>
		  		  	</div>
		  		  	<div class="form-group" id="upload-result">
	  		  		  	<button type="submit" name="uploadpdfsubmit" class="btn btn-primary">Submit</button>
			  		  	</div>
						</form>
		  		</div>
		  	</div>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="col-sm-12 client-detail"></div>
				<div class="col-sm-12 result-thumbnail" style="padding-top:20px"></div>
			</div>
		</div>
	</div><!-- end container -->
</div><!-- end wrap -->


<script>
	$(document).ready(function(){

		var imageUrl = "<?=base_url()?>assets/images/";
		// add-client || add client
		$('#clientform').submit(function(e){
			console.log('submited');
			e.preventDefault();
			$.ajax({
				url : 'partials/portfolio/addclient.php?action=addclient',
				method: 'POST',
				data : $(this).serialize(),
				success : function(data, textStatus, xhr){
				    console.log('data', textStatus, xhr)
					data = JSON.parse(data);
					location.reload();
				},
				fail: function(xhr, textStatus, errorThrown){
                   console.log('error>>', xhr, errorStatus, errorThrown)
                }
			});
			
		});

		$('#select-category').change(function(){
			var resultThumbnail = $('.result-thumbnail')
			$('.client-detail').empty()
			resultThumbnail.empty()
								.prepend('<p class="text-center"><img src="'+imageUrl+'loader.white.gif" /></p>')
			var id = $(this).val()
			$(this).val('');

			var clients = $.getJSON('partials/portfolio/getClients.php', {action:'search', id:id});

			clients.done(function(data){
				// console.log(data)
				resultThumbnail.empty()
				if(data == 'empty'){
					resultThumbnail.append('<p class="text-center text-danger">Empty Record</p>')
				}
				else{
					$.each(data, function(key,client){

						var src = ( client.image && client.image.name ) ?  imageUrl+'portfolio/'+client.page.name+'/'+client.image.name : '<?=BASE_URL?>/images/index/not-available.jpg'
						var thumbnail  = '<div class="col-xs-6 col-sm-3 col-md-2 col-lg-2 item-thumbnail" data-id="'+client.id+'"><div class="thumbnail">'
								thumbnail += '<a href="javascript:void(0)"><img class="detailclient" src="'+src+'" /></a>'
								thumbnail += '<div class="caption"><a class="detailclient" href="javascript:void"><h5>'+client.name+'</h5></a>'
								var status = ( client.status == 1 ) ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>'
								thumbnail += '<p style="color:#999">Status: '+status+'</p>'
								thumbnail += '<a class="deleteclient" href="javascript:void(0)" style="color:#999;font-size:12px"><span class="glyphicon glyphicon-trash"></span> Delete client</a></div>'
								thumbnail += '</div></div>'
						$('.result-thumbnail').append(thumbnail)
					})
				}



				$('.deleteclient').click(function(){
					var thumbnail = $(this).closest('.item-thumbnail')
					var id = thumbnail.data('id')
					var confirmasi = confirm('Are you sure DELETE client ?')
					if ( confirmasi == true ) {
						$.get('<?=THIS_FILE?>', {action:'deleteclient', id:id}, function(data){
							thumbnail.remove()
						})
					}
					else{
						return false
					}
				})

				// DETAIL CLIENT
				$('.item-thumbnail').find('.detailclient').click(function(){
					var container = $('.client-detail')
					var clientid = $(this).closest('.item-thumbnail').data('id')

					container.empty()
								.prepend('<p class="text-center"><img src="'+imageUrl+'loader.white.gif" /></p>')
					// animation scroll to
		        // dapat dari http://stackoverflow.com/a/6677069
		        $('html, body').animate({
		            scrollTop: $(container).offset().top - 50
		        }, 1000);
		        // --------------------------------------------
					var clientdetail = $.getJSON('partials/portfolio/getClients.php', {action:'search', detail:'client', id:clientid})
					clientdetail.done(function(data){
						// console.log(data)

						container.empty()
						$('#carousel-client').empty()
						$.each(data, function(key, detail){
							// console.log(detail)
							var carousel  = '<div class="edited-text" style="border:1px solid #ddd;padding:10px"><h3 id="name">'+detail.name+' <small>'+detail.location+'</small><input type="hidden" value="'+detail.name+'"></h3>'
									carousel += '<hr>'
									carousel += '<h4>Description:</h4>'
									carousel += '<p id="des">'+detail.description+'</p>'
									carousel += '<h4>Job Scopes:</h4>'
									carousel += '<p>'+detail.scopes+'</p>'
							var 	status = detail.is_enabled ? '<small style="color:green">Active</small>' : '<small style="color:red">Inactive</small>'
									carousel += '<h4>Status: '+status+'</h4>'
									carousel += '<a class="edittextbtn" data-client="'+clientid+'" data-toggle="modal" href="#update-text"><span class="glyphicon glyphicon-edit"></span> Edit</a></div><hr>'
									carousel += '<div class="row"><div class="col-md-8">'
									carousel += '<div id="carousel-id" class="carousel slide" data-ride="carousel" data-interval="false">'
									carousel += '<div class="carousel-inner">'
								// fetching image to carousel
								var isAddimages = false;
								$.each(detail.images, function(k, img){
									var src = '';
									if ( img.name ) {
										isAddimages = true
										src = imageUrl+'portfolio/'+detail.category+'/'+img.name
									}
									else{
										src = '<?=BASE_URL?>/images/index/not-available.jpg'
									}
									carousel += '<div class="item" data-client="'+clientid+'" data-category="'+detail.category+'" data-image="'+img.id+'">'
									carousel += '<img src="'+src+'" alt="'+img.name+'" style="margin:auto" />'
									carousel += '<div class="btn-group"  style="position:absolute;bottom:0px;left:40%">'
									if ( img.is_primary == 1 ) {
										carousel += '<button class="btn btn-success btn-sm" disabled="disabled">'
										carousel += '<span class="glyphicon glyphicon-ok"></span> Primary</button>'
									}
									else{
										carousel += '<a class="btn btn-warning btn-sm setprimary" href="javascript:void(0)">'
										carousel += 'Set Primary</a>'
									}
									carousel += '<a class="btn btn-default btn-sm deleteimage" href="javascript:void(0)">'
									carousel += '<span class="glyphicon glyphicon-trash"></span> Delete this Image</a></div>'
									//console.log(img.tooltip)

									if( img.tooltip ){
										// var count = img.tooltip.title.length
										var j = 0
										$.each(img.tooltip.title, function(key, value){
											var coords = {}
											var pid = {}
											var idtooltip = {}

											for (var i = 0; i < img.tooltip.coord.length; i++) {
												coords[i] = img.tooltip.coord[i]
												pid[i] = img.tooltip.pid[i]
												idtooltip[i] = img.tooltip.id_tooltip[i]
											};
											var url = '<?=BASE_URL?>/itemdetail.php?pid='
											carousel += '<div class="showcase-tooltips" data-tooltip="'+idtooltip[j]+'" style="position:absolute;left:'+coords[j][0]+'px;top:'+coords[j][1]+'px">'
											carousel += '<a data-toggle="tooltip" class="btn btn-info btn-sm tooltip-marker" href="'+url+pid[j]+'" title="'+value+'" style="border-radius:50%;z-index:1" target="_blank"><span class="glyphicon glyphicon-plus"></span></a>'
											carousel += '</div>'

											carousel += '<div class="coordinate-result" style="top:'+ ( j * 50 ) +'px"><form class="form-inline" role="form" data-tooltip="'+idtooltip[j]+'">'
											carousel += '<div class="form-group"><label for="x">X:</label>'
											carousel +=	'<input type="text" class="form-control input-sm coord-x-'+idtooltip[j]+'" value="'+coords[j][0]+'"></div>'
											carousel +=	'<div class="form-group"><label for="y">Y:</label>'
											carousel +=	'<input type="text" class="form-control input-sm coord-y-'+idtooltip[j]+'" value="'+coords[j][1]+'"></div>'
											carousel += '<div class="form-group success-result"></div>'
											carousel += '<a href="javascript:void(0)" class="form-group deletePermanent text-danger"><span class="glyphicon glyphicon-trash"></span></a>'
											//carousel += '<button type="submit" data-tooltip="'+idtooltip[j]+'" class="btn btn-primary btn-sm">Submit</button>'
											carousel += '</form></div>'

											j++
										})
									}

									carousel += '</div>' // end item
									
								})
								// end fetching image

									carousel += '</div>'
									carousel += '<a class="left carousel-control" href="#carousel-id" role="button" data-slide="prev">'
									carousel += '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>'
									carousel += '<span class="sr-only">Previous</span>'
									carousel += '</a>'
									carousel += '<a class="right carousel-control" href="#carousel-id" role="button" data-slide="next">'
									carousel += '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'
									carousel += '<span class="sr-only">Next</span>'
									carousel += '</a>'
									carousel += '</div>' // end #carousel-id

									carousel += '</div>' // end column-8
									carousel += '<div class="col-sm-4 control-panel">'
									if ( isAddimages ) {
										carousel += '<div class="btn-group"><button data-client="'+clientid+'" type="button" class="btn btn-info btn-sm add-tooltip">Add Tag</button>'
										carousel += '<a href="<?=THIS_FILE?>?action=upload&clientid='+clientid+'" class="btn btn-sm btn-warning add-images">Add Images</a>'
										carousel += '<a href="<?=THIS_FILE?>?action=uploadpdf&clientid='+clientid+'" class="btn btn-sm btn-info">Add PDF</a></div>'
									}
									else{
										carousel += '<h5 class="text-danger">No image !!</h5>'
										carousel += '<a href="<?=THIS_FILE?>?action=upload&clientid='+clientid+'" class="btn btn-warning add-images">Add Images</a>'
									}
									carousel += '<div class="formbox"></div>'
									carousel += '</div>' // end column-4
									carousel += '<div>'
									carousel += '</div></div>' // end row
							container.append(carousel)
							$('#carousel-id').find('.item').first().addClass('active')

							$('.edittextbtn').click(function(e){
								var id = $(this).data('client')
								var modal = $('#update-text')
								var modalBody = modal.find('.modal-body')
								var modalHeader = modal.find('.modal-header')
								var remote = 'partials/portfolio/edittext.php'
								var btn = modal.find('#btnupdate')

								modal.on('show.bs.modal', function(){
									modalHeader.load(remote+'?modal=header')
									modalBody.load(remote+'?modal=body&id='+id)
								})
								.delay()
								.modal({
									show : false
								});
								modal.on('hide.bs.modal', function(){
									console.log('closed')
								})

							})

							$('.deleteimage').click(function(){
								var imageid = $(this).closest('.item').data('image');
								var category = $(this).closest('.item').data('category');
								if(confirm('are you sure?'))
								{
									$.get('<?=THIS_FILE?>', {action:'deleteimage', id:imageid, category:category}, function(data){
										if ( data ) {
											console.log(data)
											alert('Deleted Image Success')
											location.reload()
										};
									});

								}
							});


							$('.setprimary').click(function(){
								var imageid = $(this).closest('.item').data('image')
								var clientid = $(this).closest('.item').data('client')
								$.get('<?=THIS_FILE?>', {action:'setprimary', imageid:imageid, clientid:clientid}, function(data){
									if ( data ){
										alert('Set Primary Success')
									}
								})
							})


							var tooltip = $('.tooltip-marker')
							tooltip.tooltip()
							dragToolMarker(tooltip)
							$('.coordinate-result').draggable()

						})// end $.each(data)

						var h = 0;
						$('.add-tooltip').click(function(){
							var id_client = $(this).data('client')
							var imageActive = $('#carousel-id').find('.item.active')
							var id_image = imageActive.data('image')
							var temp_id = 'temp'+h

							var formbox  = '<form class="form-tooltip" role="form" data-tooltip="'+temp_id+'" style="margin-top:10px;border:1px solid #ddd;padding:10px">'
							formbox += '<div class="input-group"><div class="input-group-addon">X</div>'
							formbox += '<input type="text" class="form-control coord-x-'+temp_id+'" value="0" />'
							formbox += '<div class="input-group-addon">px</div></div>'
							formbox += '<div class="input-group"><div class="input-group-addon">Y</div>'
							formbox += '<input type="text" class="form-control coord-y-'+temp_id+'" value="0" />'
							formbox += '<div class="input-group-addon">px</div></div>'
							formbox += '<div class="input-group">'
							formbox += '<input type="text" class="form-control pid" placeholder="Product id" required />'
							formbox += '<div class="input-group-addon"><a href="dashboard.php" target="_blank">Search</a></div></div>'
							formbox += '<button type="button" class="btn btn-primary btn-sm submit-tooltip">Submit</button>'
							formbox += '<button type="button" class="btn btn-danger btn-sm pull-right delete-tooltip">Cancel</button>'
							formbox += '</form>'

							var newtoolMarker = '<div class="showcase-tooltips" data-tooltip="'+temp_id+'" style="position:absolute;left:50%;top:'+(h*20)+'px;z-index:3">'
							newtoolMarker += '<a data-toggle="tooltip" class="btn btn-warning btn-sm tooltip-marker" href="" title="" style="border-radius:50%" target="_blank"><span class="glyphicon glyphicon-plus"></span></a>'
							newtoolMarker += '</div>'


							$('.control-panel').children('.formbox').prepend(formbox)
							imageActive.append(newtoolMarker)
							dragToolMarker($('.tooltip-marker'))
							// cancel add tooltip
							$('.delete-tooltip').click(function(){
								$(this).parent().remove()
								var thisTempId = $(this).parent().data('tooltip')
								$('*[data-tooltip="'+thisTempId+'"]').remove()
							})
							// submit add tooltip
							$('.submit-tooltip').click(function(){
								var imageActive = $('#carousel-id').find('.item.active')
								var id_image = imageActive.data('image')
								var thisTempId = $(this).parent().data('tooltip')
								var valx = $(this).parent().find('.coord-x-'+thisTempId).val()
								var valy = $(this).parent().find('.coord-y-'+thisTempId).val()
								var pid  = $(this).parent().find('.pid').val()
								var data = {}
								data.clientid = parseInt(id_client);
								data.pid = parseInt(pid);
								data.coordinate = valx+','+valy;
								data.idportoimage = id_image;
								//console.log(data)
								$.post('<?=THIS_FILE?>?action=add-tooltip', {data:JSON.stringify(data)})
								$(this).html('<span class="glyphicon glyphicon-ok"></span>')
								$(this).parent().delay(1000).fadeOut()
							})

							h++

						})

						$('.deletePermanent').click(function(){
							var id = $(this).parent().data('tooltip')
							var conf = confirm('Do you really delete tooltip permanently?')
							if ( conf == true ) {
								$.get('<?=THIS_FILE?>', {action:'delpertooltip', id:id})
								$('*[data-tooltip="'+id+'"]').remove()
							}
							else{
								return false;
							}
						})

					})
				})// end click item-thumbnail
				
			})
		})

		function dragToolMarker(tooltip){
			tooltip.draggable({
				// event
				stop: function(event, ui){
					var container = $('.carousel-inner').offset()
					var pos = ui.helper.offset();
					var left = Math.ceil( pos.left - container.left )
					var top = Math.ceil( pos.top - container.top )
					var idtooltip = $(this).parent().data('tooltip')
					//console.log( Math.ceil(left)+" , "+Math.ceil(top)+" For idtooltip "+idtooltip )
					var inputY = $('.coord-y-'+idtooltip)
					var inputX = $('.coord-x-'+idtooltip)
					inputX.val(left)
					inputY.val(top)
					$.get('<?=THIS_FILE?>', {action:'update-tooltip', left:left, top:top, id:idtooltip})
					inputY
						.closest('.coordinate-result')
						.find('.success-result')
						.html('')
						.append('<span class="glyphicon glyphicon-ok text-success"></span>')
				},
				// event
				drag: function(event, ui){
					var container = $('.carousel-inner').offset()
					var pos = ui.helper.offset();
					var left = Math.ceil( pos.left - container.left )
					var top = Math.ceil( pos.top - container.top )
					var idtooltip = $(this).parent().data('tooltip')
					//console.log( Math.ceil(left)+" , "+Math.ceil(top)+" For idtooltip "+idtooltip )
					var inputX = $('.coord-x-'+idtooltip)
					var inputY = $('.coord-y-'+idtooltip)
					inputX.val(left)
					inputY.val(top)
				}
				
			}) // end draggable
		} // end function dragToolMarker()

	}); // document.ready

</script>
	
<div class="modal fade" id="update-text">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4>Edit Client</h4>
			</div>
			<div class="modal-body"></div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php include 'partials/footer.php'; ?>
</body>
</html>
