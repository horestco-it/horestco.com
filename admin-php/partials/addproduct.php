<?php 
$codelists = $db->query(" SELECT code FROM product ");
$code_count = count($codelists);
 ?>
<div class="col-sm-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Add New Product</h3>
    </div>
    <div class="panel-body">
      <form action="<?=THIS_FILE?>?action=addproduct&amp;upload=true" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Category:</label>
          <div class="col-sm-8">
            <select name="category" id="add-category" class="form-control input-sm" required="required">
              <option value="">-- Please select --</option>
              <?php foreach($category as $item):    ?>
              <option <?php if( GET_ID == $item['catId'] ) echo "selected" ?> value="<?=$item['catId']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            $('#add-category').change(function(){
              //console.log($(this).val());
              window.location.replace("dashboard.php?action=addproduct&id="+ $(this).val());
            });
          });
        </script>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Sub category:</label>
          <div class="col-sm-8">
            <select name="subcategory"  class="form-control input-sm">
              <?php
                $catid = GET_ID;
                if ($catid == null) {
                  $catid = 0;
                };
                $db->bind('catid', $catid);
                $subcategory = $db->query(" SELECT subcatid, name FROM subcategory WHERE catid = :catid AND status = 'A' ORDER BY name ");
               ?>
              <option value="">-- No Sub Category --</option>
              <?php foreach ($subcategory as $index => $item): ?>
              <option value="<?=$item['subcatid']?>" <?php if(!GET_ID == null && $index == 0) echo "selected"?>><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Title:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="title" class="form-control input-sm" id="" placeholder="Input Title" required="required"/>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Product Code:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" list="codelists" name="code" class="form-control input-sm" id="" placeholder="Input Product Code" />
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
          $prices = array(
            'normal',
            'project',
            'export',
            'promo'
          );
         ?>
         <?php foreach ($prices as $value): ?>           
          <div class="form-group">
            <div class="col-sm-4">
              <label for="" class="text-capitalize">Price (<small><?=$value?></small>):</label>
            </div>
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-addon input-sm">RM</div>
                <input type="text" name="<?=$value?>-price" class="form-control input-sm " placeholder="<?=$value?> price" />
              </div>
            </div>
          </div>
          <?php endforeach ?>

        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="setpromo" /> Set Promotion
              </label>
            </div>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            $('input[name="setpromo"]').change(function(){
              var isChecked = $(this).prop('checked')
              var normal    = $('input[name="normal-price"]')
              var promo     = $('input[name="promo-price"]')
              if ( isChecked ) {
                promo.attr({'required':'required', 'placeholder':'Promo price is required'})
                normal.attr({'required':'required', 'placeholder':'Normal price is required'})
                if ( promo.val() == "" ) promo.focus()
                if ( normal.val() == "" ) normal.focus()
              }else{
                promo.attr({'required': false, 'placeholder':'Promo price'})
                normal.attr({'required': false, 'placeholder':'Normal price'})
              }
            });
          });
        </script>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">SKU:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="sku" class="form-control input-sm" id="" placeholder="Input SKU" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Description:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="description" class="form-control input-sm" id="" placeholder="Input description" rows="5" required="required"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Dimension:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="dimension" class="form-control input-sm" id="" placeholder="Input dimension" rows="3"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Also Like:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="alsolike" class="form-control input-sm" id="" placeholder="Input Also like" />
            <p class="help-block"><em>Please separated by " , "</em></p>
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
            <input type="file" name="pdf-name" accept="application/pdf" class="form-control input-sm" id="" placeholder="Input Product Code" />
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
            <button type="reset" class="btn btn-info btn-sm">Reset</button>
            <a href="<?=THIS_FILE?>" type="button" class="btn btn-danger btn-sm">Cancel</a>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>
<div class="col-md-6">
<?php

// process upload product
if ($_GET['upload'] == true) {
  if (isset($_POST['submit'])) {

      $img_format = array("jpg", "png", "gif", "bmp");
      $pdf_format = "pdf";
      $max_file_size = 83886080;
      $pdf_path     = dirname(getcwd())."/itempdf/";
      $path         = dirname(getcwd())."/itemimage/o/"; // Upload directory
      $medium_path  = dirname(getcwd())."/itemimage/m/"; // Upload directory
      $small_path   = dirname(getcwd())."/itemimage/s/";
      $count = 0;

      $title        = $_POST['title'];
      $isPromo      = $_POST['setpromo'];
      $isPromo      = ( $isPromo == 'on' ) ? 1 : 0;

      $db->bind( 'category'      , $_POST['category'] );
      $db->bind( 'subcategory'   , $_POST['subcategory'] );
      $db->bind( 'title'         , $_POST['title'] );
      $db->bind( 'code'          , $_POST['code'] );
      $db->bind( 'sku'           , $_POST['sku'] );
      $db->bind( 'description'   , $_POST['description'] );
      $db->bind( 'dimension'     , $_POST['dimension'] );
      $db->bind( 'also'          , $_POST['alsolike'] );
      $db->bind( 'setpromo'      , $isPromo );

      // record data product to database
      $rec_prod    = $db->query(" INSERT INTO product(title,description,dimension,alsolike,sku,code,catId,subcatid,promo) VALUES (:title,:description,:dimension,:also,:sku,:code,:category,:subcategory,:setpromo) ");
      $sid = $db->lastInsertId();
      $db->bind( 'pid'           , $sid );    
      $db->bind( 'np'            , $_POST['normal-price']);
      $db->bind( 'pp'            , $_POST['project-price']);
      $db->bind( 'ep'            , $_POST['export-price']);
      $db->bind( 'rp'            , $_POST['promo-price']);
      $rec_prices  = $db->query(" INSERT INTO productprice(normal,project,export,promo,productid) VALUES (:np, :pp, :ep, :rp, :pid) ");
              
      // Loop $_FILES to exeicute all images
      foreach ($_FILES['images']['name'] as $f => $name) {
        $ext = pathinfo($name, PATHINFO_EXTENSION);

        
        if ($_FILES['images']['error'][$f] == 4){        
          $message[] = "No file choosen !";
          continue;
        }

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
            $name = $sid."-".str_replace(".".$ext, "", $title)."-";
            $img_name = $name.uniqid().".".$ext;
            $pdf_name = $sid."-".str_replace(" ", "-", $title).".pdf";

            // upload image to directory
            // upload original size
            if(copy($_FILES["images"]["tmp_name"][$f], $path.$img_name)){

              include_once '../classes/simpleImage.class.php';
              // create instant object from class
              $image = new SimpleImage();
              $image->load($path.$img_name);
              // resize image to medium then upload
              $image->resizeToWidth(350);
              $image->resizeToHeight(263);
              $image->save($medium_path.$img_name);
              // resize image to small then upload
              $image->resizeToWidth(155);
              $image->save($small_path.$img_name);                        

              // record image links to database
              if ($rec_prod > 0) { 

                if($count == 0){
                  $primary = 'Y';
                }else{
                  $primary = 'N';
                };
                //echo $primary."-".$img_name."-".$sid."<br>";
                $db->bind('prodid'  , $sid);
                $db->bind('imgname' , $img_name);
                $db->bind('primary' , ($count == 0) ? 'Y' : 'N' );
                $rec_images  = $db->query(" INSERT INTO productimage(productid,imagename,isprimary) VALUES (:prodid,:imgname,:primary) ");

                // upload pdf
                if( !empty($_FILES["pdf"]["tmp_name"]) && move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdf_path.$pdf_name) ){
                  $pdf_message = "<strong>". basename( $_FILES["pdf"]["name"]). "</strong> has been uploaded.";
                  $db->bind('pdfname' , $pdf_name );
                  $db->bind('prodid'  , $sid);
                  $rec_pdf     = $db->query(" INSERT INTO productpdf(pdfName,productid) VALUES (:pdfname,:prodid) ");
                }else{
                  $message[] = 'pdf is empty';
                }
                
                // redirect to edit product
                $message['success'] = ($count + 1)." file(s) images has been uploaded<br>".$pdf_message;
                $count++; // Number of successfully uploaded file

              }else{
                echo "<p text-danger'>Failed upload to database</p>";
              }

            }
          }
        }
      } // endforeach
   
    // show message
    foreach ($message as $msg) :
      if($message['success']):
        $msg = $message['success'];
        if ($type == 'A'){
          header("location:".THIS_FILE."?action=editproduct&id=".$sid);
        }
        else if($type == 'U'){
          header("location:".THIS_FILE."?action=search&id=".$_POST['category']);
        }

    ?>
      <div class="alert alert-success"><?=$msg?></div>
      <a href="<?=THIS_FILE?>?action=editproduct&amp;id=<?=$sid?>">View product</a>

    <?php
      else:
    ?>
      <div class="alert alert-danger"><?=$msg?></div>

<?php
    endif;
    endforeach;


  }
}
 ?>
</div>

