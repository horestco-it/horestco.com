<?php 
// for str_random() helper
include '../../../../classes/DB.php';
include '../../../../config.php';
$rand = str()->random(5);

?>
<div class="panel panel-default spcf-row" style="background: #f9f9f9">
  <a role="button" 
      class="text-info"
      data-toggle="collapse" 
      data-parent="#accordion" 
      href="#<?=$rand?>" 
      aria-expanded="true" 
      aria-controls="">
    <div class="panel-heading">
      <h5 class="panel-title text-info">
          <?=$rand?>
      </h5>

    </div>
  </a>
  <span class="loader" style="position:absolute;right:30px;z-index:2;top:6px;opacity:0">
    <img src="<?=base_url()?>assets/images/preloader.gif">
  </span>
  <a href="#" class="spcf-cancel-row text-danger">
    <span class="glyphicon glyphicon-remove" title="cancel"></span>
  </a>
  <hr style="margin:0">

  <div id="<?=$rand?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
    <div class="panel-body">

      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="size-add[<?=$rand?>][is_enabled]" checked> Enable Size
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Size Name:</label>
        </div>
        <div class="col-sm-8">
          <input type="text" name="size-add[<?=$rand?>][name]" class="form-control input-sm add-size-name" value="" autofocus>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Dimension:</label>
        </div>
        <div class="col-sm-8">
          <textarea name="size-add[<?=$rand?>][dimension]" class="form-control" style="font-size:12px" rows="4"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Sort Order:</label>
        </div>
        <div class="col-sm-8">
          <input type="number" min="1" name="size-add[<?=$rand?>][sort_order]" class="form-control input-sm" value="10">
        </div>
      </div>
        
      <div class="form-group"><div class="col-sm-12"><hr></div></div>
      <!-- ================================================================= -->
      
      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Retail:</label>
        </div>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon input-sm">MYR</div>
            <input type="text" name="price-add[<?=$rand?>][normal]" class="form-control input-sm" value="0.00" placeholder="Retail" />
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
            <input type="text" name="price-add[<?=$rand?>][project]" class="form-control input-sm" value="0.00" placeholder="Project" />
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
            <input type="text" name="price-add[<?=$rand?>][export]" class="form-control input-sm" value="0.00" placeholder="Export" />
          </div>
        </div>
      </div> 

      <div class="form-group"><div class="col-sm-12"><hr></div></div>
      <!-- ================================================================= -->
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="price-add[<?=$rand?>][is_promo]"> Set Promotion
            </label>
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
            <input type="text" name="price-add[<?=$rand?>][promo]" class="form-control input-sm" value="0.00" placeholder="Promo" required/>
          </div>
        </div>
      </div> 

      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Promo Note:</label>
        </div>
        <div class="col-sm-8">
          <textarea name="price-add[<?=$rand?>][promo_note]" id="" class="form-control" rows="1"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-4">
          <label for="" class="text-capitalize">Promo Description:</label>
        </div>
        <div class="col-sm-8">
          <textarea name="price-add[<?=$rand?>][promo_description]" id="" class="form-control" rows="1"></textarea>
        </div>
      </div>

      <!-- ================================================================= -->
      <div class="form-group">
        <div class="col-sm-12">
          <hr>
          <p class="text-warning">Cushion Fabric</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4" class="text-capitalize">Sunbrella:</label>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon input-sm">MYR</div>
            <input type="text" name="price-add[<?=$rand?>][sunbrella]" class="form-control input-sm" placeholder="Sunbrella"/ value="0.00">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4" class="text-capitalize">Sunproof:</label>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon input-sm">MYR</div>
            <input type="text" name="price-add[<?=$rand?>][sunproof]" class="form-control input-sm" placeholder="Sunproof"/ value="0.00">
          </div>
        </div>
      </div>

      <!-- ================================================================= -->
      <div class="form-group">
        <div class="col-sm-12">
          <hr>
          <p class="text-warning">Cushion Leather</p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4" class="text-capitalize">Genuine Leather:</label>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon input-sm">MYR</div>
            <input type="text" name="price-add[<?=$rand?>][genuine_leather]" class="form-control input-sm" placeholder="Genuine Leather" value="0.00"/>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4" class="text-capitalize">Synthetic Leather:</label>
        <div class="col-sm-8">
          <div class="input-group">
            <div class="input-group-addon input-sm">MYR</div>
            <input type="text" name="price-add[<?=$rand?>][synthetic_leather]" class="form-control input-sm"  placeholder="Synthetic Leather" value="0.00"/>
          </div>
        </div>
      </div>


    </div>
  </div>
  <script>
    $(document).ready(function(){

      var $sizeName = $('.add-size-name');
      var sizeNameVal = $sizeName.val();
      $sizeName.keyup(mirror_);
      function mirror_(){
        var $row = $(this).closest('.spcf-row');
        var $title = $row.find('.panel-title');
        var title = $title.text();
        var value = $(this).val();
        if(value == '' || value == sizeNameVal)
        {
          $title.text(sizeNameVal);
          return false;
        }
        $title.text(value);
      }
    // cancel row
      $('.spcf-cancel-row').click(function(e){
        e.preventDefault();
        console.log('cancel')
        $(this).closest('.spcf-row').remove();
      });
    })
  </script>
</div>