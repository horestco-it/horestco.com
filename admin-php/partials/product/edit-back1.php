<?php 

  ini_set("display_errors", 1);

	$db->bind('pid',	$_GET['id']);

  $prod = $db->row(" SELECT * FROM product WHERE productId = :pid ");

  $db->bind('catid', $prod['catid']);

  $subcategories = $db->query(" SELECT * FROM subcategory WHERE status = 'A' AND catid = :catid ");

  $codelists = $db->query(" SELECT code FROM product ");

  $code_count = count($codelists);

  $thisMaterial = $helper->materialImage($_GET['id']);

  $allMaterials = $helper->materialImage();

  // $helper->dd($allMaterials);
  $materials = array();
  foreach ($allMaterials as $group => $values):
    foreach($values as $i => $value):
      $materials[$group][$i]['id'] = $value['material_id'];
      $materials[$group][$i]['text'] = $value['name'];
    endforeach;
  endforeach;

  // $helper->dd($materials);

?>

<?php if ( $prod ): ?>

<div class="panel panel-info">

	<div class="panel-heading">

		<h3 class="panel-title">Edit product <strong><?=$prod['title']?></strong></h3>

	</div>

	<div class="panel-body">

    <form id="form-edit" method="POST" action="<?=THIS_FILE?>?action=edit&amp;id=<?=$_GET['id']?>" class="form-horizontal" role="form" enctype="multipart/form-data">

 			<div class="col-sm-5">

        <div class="well" style="padding:15px">

          <input type="hidden" name="id" value="<?=$_GET['id']?>">

          <div class="form-group" style="margin-bottom:0">

          	<div class="col-sm-4">

             	<label class="control-label" style="padding-top:0">Created Date:</label>

           	</div>

            <div class="col-sm-8">

              <p class="form-control-static" style="padding-top:0"><?=$prod['createddate']?></p>

            </div>

          </div>

          <div class="form-group" style="margin-bottom:0">

            <div class="col-sm-4">

              <label class="control-label" style="padding-top:0">Last update:</label>

            </div>

            <div class="col-sm-8">

              <p class="form-control-static" style="padding-top:0"><?=$prod['lastupdate']?></p>

            </div>

          </div>

        </div>



        <div class="form-group">

          <label class="col-sm-4" control-label for="">Category:</label>

          <div class="col-sm-8">

            <select name="category" id="edit-category" class="form-control input-sm" required="required">

              <option value="">-- Please select --</option>

              <?php foreach($category as $item):    ?>

              <option <?php if( $item['catId'] == $prod['catid'] ) echo "selected" ?> value="<?=$item['catId']?>"><?=$item['name']?></option>

              <?php endforeach ?>

            </select>

          </div>

        </div>

        <div class="form-group">

          <label class="col-sm-4" control-label for="">Sub category:</label>

          <div class="col-sm-8">

            <select name="subcategory" id="edit-subcategory" class="form-control input-sm">

              <?php foreach ($subcategories as $item): ?>

              <option <?php if($prod['subcatid'] == $item['subcatid']) echo "selected"; ?> value="<?=$item['subcatid']?>">

              	<?=$item['name']?>

              </option>

              <?php endforeach ?>

            </select>

            <script>
            
            </script>

          </div>

        </div>

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Title:</label>

          </div>

          <div class="col-sm-8">

            <input type="hidden" name="prodid" value="<?=$prod['productId']?>" />

            <input type="text" name="title" class="form-control input-sm" value="<?=$prod['title']?>" placeholder="Product title" required="required"/>

          </div>

        </div>



        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Product Code:</label>

          </div>

          <div class="col-sm-8">

            <input type="text" list="codelists" name="code" class="form-control input-sm" value="<?=$prod['code']?>" placeholder="Input Product Code" />

            <datalist id="codelists">

              <?php

                for ($i = 0; $i < $code_count; $i++):

                  foreach ($codelists[$i] as $code):

              ?>

                <option value="<?=$code?>"><?=$code?></option>

              <?php endforeach; endfor; ?>

            </datalist>

          </div>

        </div>



        <?php 

          $show_prices = $db->row(" SELECT * FROM productprice WHERE productid = ".$_GET['id'] );

          $prices = array(

            'normal'  => $show_prices['normal'],

            'project' => $show_prices['project'],

            'export'  => $show_prices['export'],

            'promo'   => $show_prices['promo']

          );

         ?>

         <?php foreach ($prices as $key => $value): ?>           

          <div class="form-group">

            <div class="col-sm-4">

              <label for="" class="text-capitalize">Price (<small><?=$key?></small>):</label>

            </div>

            <div class="col-sm-8">

              <div class="input-group">

                <div class="input-group-addon input-sm">RM</div>

                <input type="text" name="<?=$key?>-price" class="form-control input-sm" value="<?=$value?>" placeholder="<?=$key?>" />

              </div>

            </div>

          </div>

          <?php endforeach ?>



        <div class="form-group">

          <div class="col-sm-offset-4 col-sm-10">

            <div class="checkbox">

              <label>

                <input type="checkbox" name="setpromo" <?php if( $prod['promo'] == 1 ) echo "checked" ?>> Set Promotion

              </label>

            </div>

          </div>

        </div>



        <script>

          $(document).ready(function(){

            $('input[name="setpromo"]').change(function(){

              var isChecked   = $(this).prop('checked')

              var normal      = $('input[name="normal-price"]')

              var promo       = $('input[name="promo-price"]')

              if ( isChecked ) {

                normal.attr({'required':'required', 'placeholder':'Normal price is required'})

                promo.attr({'required':'required', 'placeholder':'Promo price is required'})

                if ( normal.val() == "" || normal.val() == 0.00 ){

                  normal.focus()

                }

                else{

                  promo.focus()

                }

              }else{

                $('input[name="normal-price"]')

                  .attr({'required': false, 'placeholder':'Normal price'});

                $('input[name="promo-price"]')

                  .attr({'required': false, 'placeholder':'Promo price'});

              }

            });

          });

        </script>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">SKU:</label>

          </div>

          <div class="col-sm-8">

            <input type="text" name="sku" class="form-control input-sm" value="<?=$prod['sku']?>" placeholder="Input SKU" />

          </div>

        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Description:</label>

          </div>

          <div class="col-sm-8">

            <textarea name="description" class="form-control input-sm" placeholder="Input description" rows="5" required="required"><?=$prod['description']?></textarea>

          </div>

        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Dimension:</label>

          </div>

          <div class="col-sm-8">

            <textarea name="dimension" class="form-control input-sm" placeholder="Input dimension" rows="3"><?=$prod['dimension']?></textarea>

          </div>

        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Also Like:</label>

          </div>

          <div class="col-sm-8">

            <?php

                $also = implode(',', $helper->getProductByAlsoLike($prod['alsolike']) );

                $products = $db->query(" SELECT * FROM product WHERE status = 'A' AND code IN({$also}) ");

             ?>

            <select name="alsolike[]" id="also-edit" class="form-control input-sm" multiple="multiple">

              <?php

                foreach($products as $product):

               ?>

              <option value="<?=$product['code']?>" selected ><?=$product['title']?></option>

              <?php endforeach; ?>

            </select>

            <script>

              var data = <?=json_encode($codes)?>;

              $('#also-edit').select2({

                data : data,

                placeholder : 'Select other product to recommend'

              })

            </script>



          </div>

        </div>

				

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Status</label>

          </div>

          <div class="col-sm-8">

            <select name="status" class="form-control input-sm">

            	<option value="A" <?php if($prod['status'] == 'A') echo "selected" ?>>Active</option>

            	<option value="I" <?php if($prod['status'] == 'I') echo "selected" ?>>Inactive</option>

            </select>

          </div>

        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Priority:</label>

          </div>

          <div class="col-sm-8">

            <input type="text" name="priority" class="form-control input-sm" value="<?=$prod['priority']?>" placeholder="Input priority" />

            <p class="help-block">example = 2</p>

          </div>

        </div>



        <div class="form-group">

          <div class="col-sm-4">

            <label for="">image(s)</label>

          </div>

          <div class="col-sm-8">

            <input type="file" name="images[]" multiple="multiple" accept="image/*" class="form-control input-sm"/>

            <p class="help-block"><em>You can select multiple images</em></p>

          </div>

        </div>  

      

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">PDF</label>

          </div>

          <div class="col-sm-8">

            <input type="file"name="pdf" accept="application/pdf" class="form-control input-sm" id="" placeholder="Input Product Code" />

          </div>

        </div>




        <div class="form-group">

          <div class="col-sm-8 col-sm-offset-3">

            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>

            <a href="<?=THIS_FILE?>?action=search" type="button" class="btn btn-danger btn-sm">Cancel</a>

          </div>

        </div>



      </form>

      <hr />



    	</div><!-- end col-sm-5 -->



    	<div class="col-sm-7">

        <table class="table table-bordered">

          <tr>

            <td>PDF</td>

            <td>

              <?php 

                $show_pdf = $db->row("SELECT * FROM productpdf WHERE productid = ".$_GET['id']." ");

              ?>

             <?php if (!$show_pdf > 0): ?>

                <em>Null</em>                

              <?php else: ?>

                <a href="<?=BASE_URL?>/itempdf/<?=$show_pdf['pdfName']?>?v=<?=rand(1000,9999)?>" target="_blank">Preview</a>                 

            </td>

            <td>

              <button id="deletepdf" class="btn btn-danger btn-xs">Delete</button>

            </td>



            <?php endif ?>



          </tr>

        </table>

        <?php //include 'commercial-settings.php'; ?>

        <div class="form-group">

          <div class="col-sm-10">

            <div class="checkbox">

              <label>

                <input type="checkbox" id="custom-switch" name="setcustom" <?php if($prod['custom']) echo 'checked' ?>> Custom

              </label>

            </div>

          </div>

        </div>

				<table class="table table-bordered table-striped">

					<thead>

						<tr>

							<th>Image</th>

							<th colspan="2">Actions</th>

						</tr>

					</thead>

					<tbody>

          <?php

            $db->bind('pid', $_GET['id']);

            $images = $db->query(" SELECT * FROM productimage WHERE productid = :pid ");

           ?>

          <?php foreach ($images as $ind => $img): ?>

            <tr data-imageid="<?=$img['imageId']?>">

              <td style="text-align:center; vertical-align:middle">

                <img src="<?=BASE_URL?>/itemimage/m/<?=$img['imagename']?>" style="width:90%">

              </td>

              <td>

                <ul class="list-unstyled">
                  <li>
                    <label for="">alt :</label>
                    <input type="text" class="alt form-control-input-sm" value="<?=$img['alt']?>" placeholder="set alt">
                  </li>
                  <?php if ( $img['isprimary'] == 'Y' ): ?>

                    <li>

                      <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>

                      <span>Yes</span>

                    </li>

                  <?php elseif( $img['isprimary'] == 'N' ): ?>

                    <li>
                      <button type="button" class="setprimary btn btn-default btn-xs" data-image="<?=$img['imageId']?>">Set as primary</button>
                    </li>

                  <?php endif ?>
                </ul>




                

                <h6>Materials :</h6>

                <p class="select-custom-materials">

                <select name="materials" class="form-control input-sm materials" style="width:200px" <?php if (!$prod['custom']) echo "disabled"; ?> >

                  <option value=""></option>
                  <?php foreach ($materials as $group => $values): ?>
                    <optgroup label="<?=$group?>" style="text-transform:uppercase; background:blue"></optgroup>
                    <?php foreach ($values as $key => $item): ?>

                      <option value="<?=$item['id']?>"
                        <?php if($item['id'] == $img['material_id']) echo "selected" ?>
                      ><?=$item['text']?></option>

                    <?php endforeach ?>
                  <?php endforeach ?>

                </select>

                </p>

                <p class="loader"></p>


              </td>

              <td>

                <button data-imageid="<?=$img['imageId']?>" type="button" class="deleteimg btn btn-danger btn-xs" data-toggle="modal" data-target="#confirmdeleteimage">Delete</button>

              </td>

            </tr>

          <?php endforeach ?>

				  </tbody>

				</table>

<?php

if ( isset($_POST['submit']) ) {

// ============================================================================================

// Record to database

// GENERAL VARIABLES

// ============================================================================================ 

 

  $sid          = $_GET['id'];

  $title        = $_POST['title'];

  $isPromo      = $_POST['setpromo'];

  $isPromo      = ( $isPromo == 'on' ) ? 1 : 0;

  $pdf_name     = $sid."-".str_replace(" ", "-", $title).".pdf";



// ============================================================================================

// Record to database

// PRICES

// ============================================================================================ 

 

    date_default_timezone_set('Asia/Jakarta');   // set timezone to "Asia/Jakarta"

    $date         = date(' Y-m-d H:i:s ');

    $db->bindMore(array(

        'id'            => $_GET['id'],

        'catid'         => $_POST['category'],

        'subcatid'      => $_POST['subcategory'],

        'title'         => $_POST['title'],

        'code'          => $_POST['code'],

        'sku'           => $_POST['sku'],

        'also'           => implode(',', $_POST['alsolike']),

        'description'   => $_POST['description'],

        'dimension'     => $_POST['dimension'],

        'status'        => $_POST['status'],

        'priority'      => $_POST['priority'],

        'setpromo'      => $isPromo,

        'lastupdate'    => $date

      ));



    $submit = $db->query(" UPDATE product SET catid=:catid, subcatid=:subcatid, title=:title, code=:code, sku=:sku, alsolike=:also, description=:description, dimension=:dimension, status=:status, priority=:priority, promo=:setpromo, lastupdate=:lastupdate WHERE productId = :id ");

    // foreach($_POST['alsolike'] as $also){

    //   $db->bind('also', $also);

    //   $db->bind('pid', $_GET['id']);

    //   $db->query("UPDATE also SET name = :also WHERE product_id = :pid ");

    // }

            

// ============================================================================================

// Record to database

// PRICES

// ============================================================================================      

    $price = $db->row(" SELECT COUNT(*) as 'count' FROM productprice WHERE productid = ".$_GET['id']." ");

    $db->bindMore(array(

        'id' => $_GET['id'],

        'np' => $_POST['normal-price'],

        'pp' => $_POST['project-price'],

        'ep' => $_POST['export-price'],

        'rp' => $_POST['promo-price']

      ));

    // if row empty insert

    if ($price['count'] < 1) { 

      $db->query(" INSERT INTO productprice(normal,project,export,promo,productid) VALUES(:np, :pp, :ep, :rp, :id) ");

    }

    // if row not empty update data price

    else{

      $db->row(" UPDATE productprice SET normal=:np, project=:pp, export=:ep, promo=:rp WHERE productid = :id ");

    }



// ============================================================================================

// Record to database

// IMAGES

// ============================================================================================
    include_once '../classes/Images.class.php';  

    // create instant object from class

    $img_format = array("jpg", "png", "gif", "bmp");

    $pdf_format = "pdf";

    $max_file_size = 83886080;

    $pdf_path     = BASE_DIR."/itempdf/";

    $path         = BASE_DIR."/itemimage/o/"; // Upload directory

    $medium_path  = BASE_DIR."/itemimage/m/"; // Upload directory

    $small_path   = BASE_DIR."/itemimage/s/";

    $count = 0;



    // Loop $_FILES to exeicute all images

    foreach ($_FILES['images']['name'] as $f => $name) {
      
      $image = new Image($_FILES['images']['tmp_name']);

      $ext = pathinfo($name, PATHINFO_EXTENSION);

      if ($_FILES['images']['error'][$f] == 0) {



        if ($_FILES['images']['size'][$f] > $max_file_size) {

          $message[] = "$name is too large!";

          continue; // Skip large images

        }

        elseif( ! in_array($ext, $img_format) ){

          $message[] = "$name is not a valid format";

          continue; // Skip invalid file formats

        }                   

        else{ // No error found! Move uploaded images

          $img_name =  uniqid($sid. "-" .str_replace(" ", "-", $title) ).".".$ext;



          // upload image to directory



            

          // upload original size
          if($image->save() ){


            // resize image to medium then upload

            $image->resizeToWidth(225);

            $image->save($medium_path.$img_name);

            // resize image to small then upload

            $image->resizeToWidth(155);

            $image->save($small_path.$img_name); 



            $db->bind('productid',  $sid);

            $db->bind('imagename',  $img_name);

            $db->bind('setprimary', 'N');



            $rec_images  = $db->query(" INSERT INTO productimage(productid,imagename,isprimary) VALUES (:productid,:imagename,:setprimary) ");

            $count++; // Number of successfully uploaded file

          }

        }

      }

    } // endforeach



// ============================================================================================

// Record to database

// PDF

// ============================================================================================

    $count_pdf = $db->query(" SELECT COUNT(*) as 'count' FROM productpdf WHERE productid = ".$_GET['id']." ");

    if( !empty($_FILES["pdf"]["tmp_name"]) ){

    //$message[] = $count_pdf[0]['count'];

      if ( $count_pdf[0]['count'] < 1 ) { // if empty on the record table

        copy($_FILES["pdf"]["tmp_name"], $pdf_path.$pdf_name);

        $db->bind('pdfname' , $pdf_name );

        $db->bind('prodid'  , $sid);

        $rec_pdf     = $db->query(" INSERT INTO productpdf(pdfName,productid) VALUES (:pdfname,:prodid) ");

      }else{

        copy($_FILES["pdf"]["tmp_name"], $pdf_path.$pdf_name);              

        $db->bind('pdfname' , $pdf_name );

        $db->bind('sid'  , $_GET['id']);

        $rec_pdf     = $db->query(" UPDATE productpdf SET pdfName = :pdfname WHERE productid = :sid ");

      }

    };



    // show message

    foreach ($message as $msg) :

      if($message['success']):

    ?>

      <div class="alert alert-success"><?=$msg?></div>

      <a href="<?=THIS_FILE?>?action=edit&amp;id=<?=$sid?>">View product</a>

    <?php else: ?> 

      <div class="alert alert-danger"><?=$msg?></div>

    <?php

    endif;

    endforeach;

    header("location:".THIS_FILE."?action=edit&id=".$_GET['id']);



  

} // end submit

// ============================================================================================

// Ajax request

// 

// ============================================================================================

        
        
        if ( isset($_GET['type']) && $_GET['type'] == 'deleteimage' ) {

          $db->bind('imageId', $_GET['idimage']);

          $del_img = $db->row(" DELETE FROM productimage WHERE imageId = :imageId ");

        };



        if( isset($_GET['type']) && $_GET['type'] == 'setprimary' ){

          $db->bind('id', $_GET['id']);

          $set_n = $db->row(" UPDATE productimage SET isprimary = 'N' WHERE productid = :id ");

          $db->bind('imageid', $_GET['idimage']);

          $set_y = $db->row(" UPDATE productimage SET isprimary = 'Y' WHERE imageId = :imageid ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'deletepdf' ) {

          $del_pdf = $db->row(" DELETE FROM productpdf WHERE productid = ".$_GET['id']." ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'setpriority' ) {

          $db->bind('prty', $_GET['prtyVal']);

          $setprty = $db->row(" UPDATE product SET priority = :prty WHERE productid = ".$_GET['id']." ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'custom' ) {

          $db->bind('id', $_GET['id']);

          $db->bind('custom', $_GET['v']);

          $switchCustom = $db->row(" UPDATE product SET custom = :custom WHERE productid = :id ");



          echo $switchCustom[0]['custom'];

        };

        if ( isset($_GET['type']) && $_GET['type'] == 'set-alt' ) {

          $db->bind('id', $_GET['imageId']);

          $db->bind('alt', $_GET['value']);

          $setAlt = $db->row(" UPDATE productimage SET alt = :alt WHERE imageId = :id ");

        };



// end ajax request

?>

       <script>

        $(document).ready(function(){

          // Global variable
          var animation = '<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>';
          

          // dinamic subcategory
          $('#edit-category').change(function(){
              $('.animation').remove()

              var catid = $(this).val(),
                  subcategorySelectBox = $('#edit-subcategory')

              subcategorySelectBox.attr('disabled', 'disabled')
              $(this).attr('disabled', 'disabled')
              $(this).parent().append('<span class="animation"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>')
              
              $.getJSON('<?=BASE_URL?>/admin-php/_partials/subcategory/ajax/getByCategory.php', {catid:catid}, function(data){
                result(data)
                $('#edit-category').removeAttr('disabled')
                subcategorySelectBox.removeAttr('disabled')
                $('.animation').remove()
              })

              function result(data){
                // reset option tag
                $('#edit-subcategory').empty()
                //result to select
                $.each(data, function(index, value){
                  var option = '<option value="'+value.subcatid+'">'+value.name+'</option>'
                  $('#edit-subcategory').append(option)
                })
              }
            })

          // set alt image
          $('.alt').blur(function(){
            var value = $(this).val()
            if (value == ''){
              alert('not allow if empty.')
              $(this).focus()
              return
            }
            $('.loader').remove()
            var parent = $(this).parent()
            parent.append(animation)
            var imageId = $(this).closest('tr').data('imageid')
            var ajax = $.get('<?=THIS_FILE?>', {action:'edit', id:'<?=$_GET['id']?>', imageId: imageId, value:value, type: 'set-alt' })
            ajax.success(function(data){
              $('.loader').remove()
            })
          })


          $('.setprimary').click(function(){

            var id_img    = $(this).data('image'),

            $this_row     = $(this).closest('tr');

            var req = $.get('<?=THIS_FILE?>?',{action:'edit', id: '<?=$_GET['id']?>', idimage : id_img, type: 'setprimary' });

            req.success(function(){

              location.reload();

            });

          });



          $('#confirmdeleteimage').on('show.bs.modal', function(e){

          	var button  = $(e.relatedTarget)

	          var row     = button.closest('tr')

	          var idimage = row.data('imageid')

	          var modal   = $(this)

	          var btnDel  = modal.find('#keepdelete')

	          modal.find('.modal-body').text('Are you sure want to delete this image ?')



	          btnDel.click(function(){

	          	row.remove()

	            $.get('<?=THIS_FILE?>', {action:'edit', id:'<?=$_GET['id']?>', idimage: idimage, type: 'deleteimage'})

	            modal.modal('hide')

	          })

          });



          $('#deletepdf').click(function(){

            var delpdf = $.get('<?=THIS_FILE?>',{action:'edit', id: '<?=$_GET['id']?>', type: 'deletepdf' });

            delpdf.success(function(){

              location.reload();

            });

          });



          // switch on / off custom

          $('#custom-switch').click(function(){

            var isChecked = $(this).prop('checked')

            $('p.loader').empty()

            var custom_value = 0

            if (!isChecked){
              $('.materials').attr('disabled', 'disabled')
            }
            else{
              $('.materials').removeAttr('disabled')
              custom_value = 1
            }

            $(this).parent().append('<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>')

            $.get('<?=THIS_FILE?>', {action: 'edit', v : custom_value, id: '<?=$_GET["id"]?>', type: 'custom'}, function(data){

              $('span.loader').empty()

            })

          })

          // Setting material for image
          $('.materials').select2({

            placeholder : 'Set Material'

          })

          $('.materials').change(function(){

            var row = $(this).closest('tr'),

                image = row.data('imageid'),

                material = $(this).val(),

                loader = $(this).parent().next()

            loader.empty()

            loader.append('<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>')

            $.get('_partials/product/ajax/set-material.php', {image:image, material:material}, function(data){

              console.log(data)

              loader.empty()

                    .append('<span class="glyphicon glyphicon-ok text-success"></span> <span class="text-success">Change material successfully</span>')

            })

          })



        });

      </script>





			</div><!-- end col-sm-7 -->

	</div>

</div>



<!-- Modal confirm to delete -->



<div class="modal fade" id="confirmdeleteimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <div class="modal-body">

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancel (Esc)</button>

        <button type="button" class="btn btn-default btn-sm" id="keepdelete">Keep Delete</button>

      </div>

    </div>

  </div>

</div>

<?php else: ?>

  <p class="text-danger text-center">

    <span>No Product Record!</span>

    <a href="<?=THIS_FILE?>">Go Dashboard</a>

  </p>

<?php endif ?>

