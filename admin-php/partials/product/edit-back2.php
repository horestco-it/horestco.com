<?php if ( $product ): ?>
<h3>Edit Product</h3>
<div class="panel panel-info">

	<div class="panel-heading">
		<div class="panel-title">
      <strong><?=$product->name?></strong>
      <?php if ( isset($_SESSION['type']) && $_SESSION['type'] == 'A' && false ): ?>
        <a  href="#" class="deleteproduct" data-toggle="modal" data-target="#confirmdelete" data-id="<?=$product['id']?>"><span class="glyphicon glyphicon-trash pull-right text-danger"></span></a>
      <?php endif ?>
    </div>
	</div>

	<div class="panel-body">
    <form id="form-edit" method="POST" action="<?=$_SERVER['REQUEST_URI']?>" class="form-horizontal" role="form" enctype="multipart/form-data">
 			<div class="col-sm-5">
        <div class="well" style="padding:15px">
          <input type="hidden" name="id" value="<?=$_GET['id']?>">
          <div class="form-group" style="margin-bottom:0">
          	<div class="col-sm-4">
             	<label class="control-label" style="padding-top:0">Created Date:</label>
           	</div>
            <div class="col-sm-8">
              <p class="form-control-static" style="padding-top:0"><?=$product['created_at']?></p>
            </div>
          </div>
          <div class="form-group" style="margin-bottom:0">
            <div class="col-sm-4">
              <label class="control-label" style="padding-top:0">Last update:</label>
            </div>
            <div class="col-sm-8">
              <p class="form-control-static" style="padding-top:0"><?=$product['updated_at']?></p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Category:</label>
          <div class="col-sm-8">
            <select name="category" id="select-category" class="form-control input-sm" required="required">
              <option value="">-- Please select --</option>
              <?php foreach($category as $item):    ?>
              <option <?php if( $item['id'] == $product['category_id'] ) echo "selected" ?> value="<?=$item['id']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Sub category:</label>
          <div class="col-sm-8">
            <select name="subcategory" id="select-subcategory" class="form-control input-sm">
              <?php foreach ($subcategories as $sub): ?>
              <option <?php if($product['subcategory_id'] == $sub['id']) echo "selected"; ?> value="<?=$sub['id']?>">
              	<?=$sub['name']?>
              </option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Title:</label>
          </div>
          <div class="col-sm-8">
            <input type="hidden" name="prodid" value="<?=$product['id']?>" />
            <input type="text" name="title" class="form-control input-sm" value="<?=$product['name']?>" placeholder="Product title" required="required"/>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Product Code:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" list="codelists" name="code" class="form-control input-sm" value="<?=$product['code']?>" placeholder="Input Product Code" />
            <datalist id="codelists">
              <?php
                for ($i = 0; $i < $code_count; $i++):
                  foreach ($codelists[$i] as $code):
              ?>
                <option value="<?=$code?>"><?=$code?></option>
              <?php endforeach; endfor; ?>

            </datalist>
            <script src="<?=BASE_URL?>/admin-php/assets/js/jquery.code-validator.js"></script>
            <script>
              var $code = $('input[name="code"]');

              $code.inputCode({
                pathAnimation : '<?=BASE_URL?>/assets/images/loader.white.gif',
                ajax:'<?=BASE_URL?>/admin-php/_partials/product/ajax/field-code.php'
              });
          </script>

          </div>
        </div>

        

        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">Pricing</h5>
          </div>
          <div class="panel-body">

            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="setpromo" <?php if( $product['is_promo'] == 1 ) echo "checked" ?>> Set Promotion
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Retail:</label>
              </div>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon input-sm">MYR</div>
                  <input type="text" name="normal-price" class="form-control input-sm" value="<?=$price['normal']?>" placeholder="Retail" />
                </div>
              </div>
            </div> 


            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Promo:</label>
              </div>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon input-sm">MYR</div>
                  <input type="text" name="promo-price" class="form-control input-sm" value="<?=$price['promo']?>" placeholder="Promo" />
                </div>
              </div>
            </div> 


            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Project:</label>
              </div>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon input-sm">MYR</div>
                  <input type="text" name="project-price" class="form-control input-sm" value="<?=$price['project']?>" placeholder="Project" />
                </div>
              </div>
            </div> 


            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Export:</label>
              </div>
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon input-sm">$ USD</div>
                  <input type="text" name="export-price" class="form-control input-sm" value="<?=$price['export']?>" placeholder="Export" />
                </div>
              </div>
            </div> 

            <hr>
            
            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Promo Description:</label>
              </div>
              <div class="col-sm-8">
                <textarea name="promo-description" id="" class="form-control" rows="1"><?=$price['promo_description']?></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-4">
                <label for="" class="text-capitalize">Promo Note:</label>
              </div>
              <div class="col-sm-8">
                <textarea name="promo-note" id="" class="form-control" rows="1"><?=$price['promo_note']?></textarea>
              </div>
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

            <label for="">Description:</label>

          </div>

          <div class="col-sm-8">

            <textarea name="description" class="form-control input-sm" placeholder="Input description" rows="5" required="required"><?=$product['description']?></textarea>

          </div>

        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Dimension:</label>

          </div>

          <div class="col-sm-8">

            <textarea name="dimension" class="form-control input-sm" placeholder="Input dimension" rows="3"><?=$product['dimension']?></textarea>

          </div>

        </div>

        

        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Also Like:</label>
          </div>
          <div class="col-sm-8">
            <select name="alsolike[]" id="also-edit" class="form-control input-sm" multiple="multiple">
              <?php
                foreach($products as $p):
               ?>
              <option value="<?=$p['id']?>" <?php if(in_array($p->id, $productAlsoIds) ) echo "selected"; ?>><?=$p['name']?></option>
              <?php endforeach; ?>
            </select>

            <script>
              $('#also-edit').select2({
                tags : true,
                allowClear : true,
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
            	<option value="1" <?php if($product['is_enabled'] == 1) echo "selected" ?>>Active</option>
            	<option value="0" <?php if($product['is_enabled'] == 0) echo "selected" ?>>Inactive</option>
            </select>
          </div>
        </div>

        

        <div class="form-group">

          <div class="col-sm-4">

            <label for="">Priority:</label>

          </div>

          <div class="col-sm-8">

            <input type="text" name="priority" class="form-control input-sm" value="<?=$product['sort_order']?>" placeholder="Input priority" />

            <p class="help-block">example = 2</p>

          </div>

        </div>



        <div class="form-group">

          <div class="col-sm-4">

            <label for="">image(s)</label>

          </div>

          <div class="col-sm-8">

            <input type="file" name="images[]" multiple="multiple" accept="image/*" class="form-control input-sm"/>

            <p class="help-block">
              <em>You can select multiple images</em>
              <br>
              Dimension : 800w x 600h pixel <br/> Max size : 200KB
            </p>

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

            <button type="submit" name="edit-submit" class="btn btn-primary btn-sm">Submit</button>

            <a href="<?=THIS_FILE?>?action=search" type="button" class="btn btn-danger btn-sm">Cancel</a>

          </div>

        </div>



      </form>

      <hr />



    	</div><!-- end col-sm-5 -->



    	<div class="col-sm-7">

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

            $images = $db->query(" SELECT * FROM images WHERE product_id = :pid ");

           ?>

          <?php foreach ($images as $ind => $img): ?>

            <tr data-imageid="<?=$img['id']?>" data-pid="<?=$_GET['id']?>">

              <td style="text-align:center; vertical-align:middle">

                <img src="<?=BASE_URL?>/assets/images/furniture/<?=$img['name']?>" style="width:60%">

              </td>

              <td>

                <ul class="list-unstyled">
                  <?php if ( $img['is_primary'] == 1 ): ?>

                    <li>

                      <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>

                      <span>Yes</span>

                    </li>

                  <?php else: ?>

                    <li>
                      <button type="button" class="setprimary btn btn-default btn-xs" data-image="<?=$img['id']?>">Set as primary</button>
                    </li>

                  <?php endif ?>
                </ul>


                <p class="loader"></p>


              </td>

              <td>

                <button data-imageid="<?=$img['id']?>" type="button" class="deleteimg btn btn-danger btn-xs" data-toggle="modal" data-target="#confirmdeleteimage">Delete</button>

              </td>

            </tr>

          <?php endforeach ?>

				  </tbody>

				</table>

<?php


// ============================================================================================
// Ajax request
// 
// ============================================================================================
        
        if( isset($_GET['type']) && $_GET['type'] == 'setprimary' )
        {
          $db->bind('id', $_GET['id']);

          $db->query(" UPDATE images SET is_primary = 0 WHERE product_id = :id ");

          // if(!$set_n)
          // {
          //   echo "ERROR";
          // }

            $db->bind('imageid', $_GET['idimage']);
            $db->row(" UPDATE images SET is_primary = 1 WHERE id = :imageid ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'deletepdf' ) {

          $del_pdf = $db->row(" DELETE FROM productpdf WHERE productid = ".$_GET['id']." ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'setpriority' ) {

          $db->bind('prty', $_GET['prtyVal']);

          $setprty = $db->row(" UPDATE products SET sort_order = :prty WHERE id = ".$_GET['id']." ");

        };



        if ( isset($_GET['type']) && $_GET['type'] == 'custom' ) {

          $db->bind('id', $_GET['id']);

          $db->bind('custom', $_GET['v']);

          $switchCustom = $db->row(" UPDATE products SET custom = :custom WHERE productid = :id ");



          echo $switchCustom[0]['custom'];

        };

        if ( isset($_GET['type']) && $_GET['type'] == 'set-alt' ) {

          $db->bind('id', $_GET['imageId']);

          $db->bind('alt', $_GET['value']);

          $setAlt = $db->row(" UPDATE images SET alt = :alt WHERE id = :id ");

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
              
              $.post('/admin-php/dashboard.php?action=get-subcategories', {catid:catid}, result)

              function result(data){
                // reset option tag
                $('#edit-subcategory').empty()
                //result to select
                $.each(JSON.parse(data), function(index, value){
                  var option = '<option value="'+value.subcatid+'">'+value.name+'</option>'
                  $('#edit-subcategory').append(option)
                })
                $('#edit-category').removeAttr('disabled')
                subcategorySelectBox.removeAttr('disabled')
                $('.animation').remove()
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

            console.log(id_img)

            var req = $.get('<?=THIS_FILE?>',{action:'edit', id: '<?=$_GET['id']?>', idimage : id_img, type: 'setprimary' });

            req.success(function(data){
              location.reload();

            });

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



<?php else: ?>

  <p class="text-danger text-center">

    <span>No Product Record!</span>

    <a href="<?=THIS_FILE?>">Go Dashboard</a>

  </p>

<?php endif ?>

