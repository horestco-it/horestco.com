<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($this->uri->segment(1)."/".$this->uri->segment(2)) ?>

  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    /* reset col*/
    .row .col{
      margin: 0;
      padding: 2.5px;
    }
    section.container{
      min-height: 233px;
    }
    .card,
    .card-panel{
      margin: 0;
    }
    .card,
    .card-panel,
    .card .card-image img{
      border-radius: 0;
    }
    .card .card-image .card-title{
      padding: 10px;
      font-size: 16px;
      font-weight: 400;
      line-height: 17px;
    }
    /* fluid 5 columns */
    .grid{
      margin: -2.5px auto 10px;
    }
    .grid-sizer,
    .grid-item {
      margin-top: 0px;
      margin-bottom: 5px;
    }

  </style>
</head>
<body>

<?php 
$theme = [
  'restaurants' => 'green darken-3 white-text',
  'hotels' => 'blue darken-3 white-text',
  'condominiums' => 'light-green darken-4 white-text',
  'cruise ships' => 'indigo darken-3 white-text'
];

$groups = [
  // cruise ships
  'standart' => [48],
  // MBA, bijan, pulai desaru, healy macs 12, one resident, uppereast, aurora, madfoon, nestretto, roullette
  'medium' => [9,15,20,46,23,22,48,62,74,79],
  // petronas, alrawsah
  'big' => [1, 58]
];
 ?>

<?php $this->load->view('partials/nav') ?>

<div class="divider"></div>

<section class="container" id="portfolio-list-container">
  <div class="row grid" id="grid">

    <div class="col s12 m8 l6 grid-item">
      <div class="card-panel <?=$theme[$portfolio->name]?> client">
        <h3 class="client-title"><?=strtoupper($portfolio->name)?> <span class="gap gap-5"></span> FURNISHED</h3>
        <div class="client-content">
        	<?=$portfolio->body?>
        </div>
      </div>
    </div>
    <?php 
    ?>
    <?php foreach ($portfolio->clients as $key => $client): ?>
      <?php $image = $client->images()->orderBy('is_primary', 'desc')->first() ?>
        <?php 
          $class = 'col xs12 s6 m4 l2 grid-item ';
          
          if( 
            // last key
            $key == count($portfolio->clients)-1 
            // because in cruise ships only one item
            || in_array($client->id, $groups['standart'])
          ){
            $class.=' grid-sizer'; 
          }

          if( in_array($client->id, $groups['medium']) )
          {
            $class .= ' grid-item--width333';
          }
          elseif( in_array($client->id, $groups['big']) )
          {
            $class .= 'grid-item--width50';
          }

          $html  = "<div class=\" $class \" data-client=\"$client->id\">";
            $html .= "<a href=\"/client/$client->slug\">";
              $html .= "<div class=\"card\"><div class=\"card-image\">";
                    $image = img_url().'portfolio/'.str_slug($portfolio->name).'/'.strtolower($image->name);
                    $html .= image_thumb($image, 580);
                  $html .= "<div class=\"card-title\">".ucwords(strtolower($client->name))."</div>";
                $html .= "</div>";
              $html .= "</div>";
            $html .= "</a>";
          $html .= "</div>";

          print_r($html);

        ?>

    <?php endforeach ?>
	</div>
</section>

<?php $this->load->view('partials/footer') ?>

<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=script_url('masonry.pkgd.min.js')?>"></script>
<script>
  $(document).ready(function(){

    $('.card-title').hide();
    var $grid = $('.grid');

    $grid.masonry({
      itemSelector: '.grid-item',
      percentPosition: true,
      columnWidth: '.grid-sizer',
    });
    // layout masonry after each image loads
    $grid
    .imagesLoaded( function() {
      $('.card-title').fadeIn();
    })
    .progress(function(){
      $grid.masonry('layout');
    });
  })
</script>
</body>
</html>
