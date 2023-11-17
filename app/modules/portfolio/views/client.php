<?php $this->load->view( config_item('theme').'header', ['page'=>$this->uri->segment(1)."/".$this->uri->segment(2)] ) ?>

  <meta name="keywords" content="horestco client, <?=$client->scopes?>, <?=$client->name?>, <?=$client->location?>"/>
  <meta name="description" content="horestcto client, <?=$client->description?>" />
  <meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
  <meta name="robots" content="index, follow" />
  <title><?=ucwords(strtolower($client->name.' '.$client->location))?> Furnished</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=style_url('owl.carousel.css')?>">

  <style>
    .client-heading{
      margin-top: -3px;
    }
    .parallax-container.jumbotron{
      min-height: 1px;
      height: 90px;
    }
    .owl-carousel{
      margin-bottom: 15px;
    }
    .owl-thumbs .owl-thumb-item:hover{
      cursor: pointer;
    }
    .owl-thumbs .owl-thumb-item:hover img,
    .owl-thumbs .owl-thumb-item.active img{
      box-shadow: 0 0 3px 1px rgba(0, 0, 0, .6);
    }

  </style>

<?php $this->load->view( config_item('theme').'nav' ) ?>

<nav class="top-nav transparent hide-on-small-only">
  <div class="container nav-wrapper">
    <div class="col s12">
      <a href="/" class="breadcrumb">Home</a>
      <a href="/portfolio" class="breadcrumb">Portfolio</a>
      <a href="/<?=$client->page['slug']?>" class="breadcrumb"><?=ucwords($client->page['name'])?></a>
      <a href="/client/<?=$client->slug?>" class="breadcrumb"><?=ucwords($client->name)?></a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">

    <div class="col s12 l5 push-l7">

      <h4 class="client-heading"><?=$client->name?></h4>
      <h5><small class="grey-text"><?=$client->location?></small></h5>
      <p><?=$client->description?></p>

      <?php if (count($productImages->toArray()) > 0): ?>
      <ul class="collection with-header">
        <li class="collection-header"><h5>Job Scope:</h5></li>
        <?php foreach ($productImages as $image): ?>
          <li class="collection-item avatar valign-wrapper">
            <?php
            $attr = [
              'class' => 'circle',
              'alt'   => ucwords(strtolower($image->product['name'])),
              'title' => ucwords(strtolower($image->product['name']))
            ];
            echo image_thumb(product_img_url($image->name), 50, $attr);
            /*
            */ ?>
            <a href="<?=base_url().'furniture/'.str_slug($image->product['name']).'-'.$image->product['id']?>">
              <span><?=ucwords(strtolower($image->product['name']))?></span>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
      <?php elseif($client->scopes): ?>
      <ul class="collection with-header">
        <li class="collection-header"><h5>Job Scope:</h5></li>
        <?php foreach (explode(',', $client->scopes) as $scope): ?>
          <li class="collection-item"><?=ucwords(trim($scope))?></li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>

      <?php if ($client->pdf): ?>
      <p>
        <a href="<?=base_url('files/portfolio/'.$client->pdf)?>" class="btn" download><i class="fa fa-download"></i> Download Gallery</a>
      </p>
      <?php endif ?>

    </div>

    <div class="col s12 l7 pull-l5">
      <div id="slide" class="owl-carousel" data-slider-id="1">
        <?php foreach ($client->images as $key => $image): ?>
          <div class="item" data-hash="<?=$image->id?>">
            <img src="<?=base_url().img_url().'portfolio/'.str_slug($client->page["name"]).'/'.strtolower($image->name)?>"
             title ="<?=$title?>"
             alt="<?=$alt?>">
          </div>
        <?php endforeach ?>
      </div>

      <?php ?>

      <div class="row">
        <div class="owl-thumbs" data-slider-id="1">
          
          <?php foreach ($client->images as $key => $image): ?>
            <div class="col m2 owl-thumb-item">
              <?php
                $image = img_url().'portfolio/'.str_slug($client->page["name"]).'/'.strtolower($image->name);
                $attr = [
                  'alt' => $altThumb,
                  'title' => $titleThumb,
                ];
                echo image_thumb($image, 100, $attr);
              ?>
            </div>
          <?php endforeach ?>

        </div>
      </div>
    </div>

  </div>
</div>

<?php $this->load->view(config_item('theme').'script') ?>

<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script src="<?=script_url('owl.carousel2.thumbs.js')?>"></script>
<script>
  $(document).ready(function(){
    $('#slide').owlCarousel({
      loop:true,
      items:1,
      dots:false,
      autoplay:true,
      autoplayHoverPause:true,
      // plugin thumbnails
      thumbs:true,
      thumbsPrerendered: true,
      URLhashListener:true,
      startPosition: 'URLHash'
    })
  })
</script>

<?php $this->load->view(config_item('theme').'footer') ?>