<form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
  <div class="panel panel-info" id="size">
    <div class="panel-heading">
      <h5 class="panel-title">Specification</h5>
    </div>
    <div class="panel-body">
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <?php if( $product->sizes()->count() > 0 ): ?>
        <?php foreach ($product->sizes()->orderBy('sort_order')->get() as $key => $size): ?>
          <?php

            $price = $size->prices()->first();
            // menjaga jika row price is null
            if( is_null($price) )
            {
              $id = ProductPrice::insertGetId([
                'product_size_id' => $size->id,
                'product_id' => $product->id,
                'normal' => 0.00,
                'promo' => 0.00,
                'project' => 0.00,
                'export' => 0.00,
                'is_promo' => 0,
                'promo_description' => '',
                'promo_note' => '',
                'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
                'updated_at' => \Carbon\Carbon::now('Asia/Jakarta'),
              ]);
              $price = ProductPrice::find($id);
            }

          ?>
        <div class="panel panel-default spcf-row">
          <a role="button"
              class="text-info"
              data-toggle="collapse"
              data-parent="#accordion"
              href="#<?=$size->id?>"
              aria-expanded="true"
              aria-controls="<?=$size->id?>">
            <div class="panel-heading">
              <h5 class="panel-title text-info">
                  <?=ucwords($size->name)?>
              </h5>
            </div>
          </a>
          <span class="loader" style="position:absolute;right:30px;z-index:2;top:6px;opacity:0">
            <img src="<?=base_url()?>assets/images/preloader.gif">
          </span>
          <a href="#" class="spcf-remove-row text-danger" data-size-name="<?=$size->name?>" data-size-id="<?=$size->id?>">
            <span class="glyphicon glyphicon-trash" title="remove"></span>
          </a>
          <hr style="margin:0">

          <div id="<?=$size->id?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">

              <div class="form-group">
                <div class="col-sm-12">
                  <p class="text-warning">Basic</p>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="size-edit[<?=$size->id?>][is_enabled]" <?php if($size->is_enabled) echo "checked" ?> > Enable Size
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Size Name:</label>
                </div>
                <div class="col-sm-8">
                  <input type="text" name="size-edit[<?=$size->id?>][name]" class="form-control input-sm input-size-name" value="<?=$size->name?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Sort Order:</label>
                </div>
                <div class="col-sm-8">
                  <input type="number" name="size-edit[<?=$size->id?>][sort_order]" class="form-control input-sm" value="<?=$size->sort_order?>">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Dimension:</label><br/>
                  <font size="1pt" color="red"><b>(enter to move the line)</b></font>
                </div>
                <div class="col-sm-8">
                  <textarea name="size-edit[<?=$size->id?>][dimension]" class="form-control" style="font-size:12px" rows="4"><?=$size->dimension?></textarea>
                </div>
              </div>

              <!-- ================================================================= -->
              <div class="form-group">
                <div class="col-sm-12">
                  <hr>
                  <p class="text-warning">Pricing</p>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Retail:</label>
                </div>
                <div class="col-sm-8">
                  <div class="input-group">
                    <div class="input-group-addon input-sm">MYR</div>
                    <input type="text" name="price-edit[<?=$price->id?>][normal]" class="form-control input-sm" value="<?=$price->normal?>" placeholder="Retail" />
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
                    <input type="text" name="price-edit[<?=$price->id?>][project]" class="form-control input-sm" value="<?=$price['project']?>" placeholder="Project" />
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
                    <input type="text" name="price-edit[<?=$price->id?>][export]" class="form-control input-sm" value="<?=$price['export']?>" placeholder="Export" />
                  </div>
                </div>
              </div>

              <!-- ================================================================= -->
              <div class="form-group">
                <div class="col-sm-12">
                  <hr>
                  <p class="text-warning">Promotion</p>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                  <div class="checkbox">
                    <label title="Enable" for="enable">
                      <input type="checkbox" id="enable" name="price-edit[<?=$price->id?>][is_promo]" <?php if($price->is_promo) echo "checked" ?> checked> Set Promotion <font size="1pt" color="red">(Uncheck, if not set Promotions)</font>
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
                    <input type="text" name="price-edit[<?=$price->id?>][promo]" id="promosi" class="form-control input-sm" value="<?=$price['promo']?>" placeholder="Promo" required/>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Promo Note:</label>
                </div>
                <div class="col-sm-8">
                  <textarea name="price-edit[<?=$price->id?>][promo_note]" id="" class="form-control" rows="1"><?=$price['promo_note']?></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Promo Description:</label>
                </div>
                <div class="col-sm-8">
                  <textarea name="price-edit[<?=$price->id?>][promo_description]" id="" class="form-control" rows="1"><?=$price['promo_description']?></textarea>
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
                    <input type="text" name="price-edit[<?=$price->id?>][sunbrella]" class="form-control input-sm" value="<?=$price['sunbrella']?>" placeholder="Sunbrella"/>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4" class="text-capitalize">Sunproof:</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <div class="input-group-addon input-sm">MYR</div>
                    <input type="text" name="price-edit[<?=$price->id?>][sunproof]" class="form-control input-sm" value="<?=$price['sunproof']?>" placeholder="Sunproof"/>
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
                    <input type="text" name="price-edit[<?=$price->id?>][genuine_leather]" class="form-control input-sm" value="<?=$price['genuine_leather']?>" placeholder="Genuine Leather"/>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4" class="text-capitalize">Synthetic Leather:</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <div class="input-group-addon input-sm">MYR</div>
                    <input type="text" name="price-edit[<?=$price->id?>][synthetic_leather]" class="form-control input-sm" value="<?=$price['synthetic_leather']?>" placeholder="Synthetic Leather"/>
                  </div>
                </div>
              </div>


            </div>
          </div>
        </div>

        <?php endforeach ?>
      <?php endif?>
      </div><!-- end accordion -->
      <div class="panel panel-default add-spcf-row" title="Add Size">
        <a role="button"
            href="#"
            id="add-spcf-row"
            data-toggle="collapse">
          <div class="panel-heading">
            <h5 class="panel-title">
              <span class="glyphicon glyphicon-plus"></span>
            </h5>
          </div>
        </a>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-sm" name="spcf-submit">Submit</button>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
$("#enable").click(function () {
        if ($(this).is(':checked')) {
            $('#promosi').attr("disabled", false);

        } else if ($(this).not(':checked')) {
            var ok = confirm('Are you sure you want to remove promotions?');
            if (ok) {
              var remove = '';
              $('#promosi').val('0.00');
              $('#promosi').attr("disabled", false);

            }
        }
    });
</script>
<script>
  $(document).ready(function(){
    var $accordion = $('#accordion');
    var $sizeName = $('.input-size-name');
    var sizeNameVal = $sizeName.val();

    // form add specification
    $('#add-spcf-row').click(function(){
      $.get("/admin-php/partials/product/ajax/add-specification-row.php", function(data){
        $accordion.append(data);
        $('.add-size').focus();
      });
    });

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

    $sizeName.keyup(mirror_);

    // remove size specification
    $('.spcf-remove-row').click(function(e){
      e.preventDefault();

      var name = $(this).data('size-name');
      var id = $(this).data('size-id');
      if( confirm('Are you sure delete '+name+' size?') )
      {
        var $row = $(this).closest('.spcf-row');
        var $loader = $(this).prev('.loader').css('opacity', 1);
        var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=delete-size-specification', {id:id});
        post.success(function(data){
          if(data)
          {
            $loader.empty();
            $row.fadeOut(700, function(){
              $row.remove();
            });
          }
        });
      }
      return;
    });

  })

</script>
