<?php 
include '../../../config.php';
include '../../../classes/DB.php';
include '../../../classes/Helper.php';
require '../../api/check_session.php';

if(check_ajax()):

  $product = Product::find($_POST['id']);
  $material = Material::find($_POST['materialId']);
  $materialsArray = MaterialCategory::associateWithImage($_POST['id']);
  
  if(isset($_GET['action']) && $_GET['action'] == 'update-image')
  {
    $material->images()->sync(json_decode($_POST['imageIds']));

    $data = [
      'count' => $material->images()->count()
    ];
    print_r(json_encode($data));

    exit;
  }

  if( $_POST['url'] == 'upload.php' && $_POST['section'] == 'material' ):
    
  ?>



    <form id="select-image">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><small>Select Image for</small> <?=$material->name?></h4>
      </div>
      <div class="modal-header">
        <button type="submit" class="btn btn-success btn-sm">Save changes</button>
      </div>
      <div class="modal-body">
          <ul class="list-inline">
            <?php foreach ($product->images as $key => $image): ?>
              <?php 
                $condition = array($image->id => $material->images->lists('id'));
                $isChecked = setup_class($condition, ['checked'=>''] );
                $isOpacity = setup_class($condition, ['active'=>'inactive'] );
               ?>
              <li class="thumbnail material <?=$isOpacity?>" data-image-id="<?=$image->id?>">
                <img width="140px" src="<?=src($image->name)?>">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" class="check-<?=$key?>" <?=$isChecked?> >
                  </label>
                </div>
              </li>
            <?php endforeach ?>
          </ul>
      </div>
    </form>

    <script>
      $(document).ready(function(){

        $('.thumbnail').find('input[type="checkbox"]').change(opacitized)

        $('#select-image').submit(function(e){
          e.preventDefault();
          var imageIds = [];
          $('.thumbnail').each(function(){
            var $this = $(this)
            var $checkbox = $this.find('input[type="checkbox"]');
            if( $checkbox.prop('checked') )
            {
              imageIds.push($this.data('image-id'));
            }
          });

          var data = {
            id:'<?=$_GET["id"]?>',
            materialId:'<?=$_POST['materialId']?>',
            imageIds:JSON.stringify(imageIds)
          };
          var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=update-image',data);
          post.success(function(res){
            var res = JSON.parse(res);
            $('#myModal').modal('hide')
          })
          // console.log(imageIds.join());
        });

        function opacitized(){
          var $this = $(this);
          var $parent = $this.closest('.material');
          // if checked
          console.log($this)
          if($this.prop('checked'))
          {
            $parent.removeClass('inactive').addClass('active')
          }
          else{
            $parent.removeClass('active').addClass('inactive')
          }
        }

      });
    </script>

<?php exit; endif;?>



 <?php endif; // end check_ajax()?>
