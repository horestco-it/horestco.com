<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="keywords" content="horestco client, <?=$client->scopes?>, <?=$client->name?>, <?=$client->location?>"/>
  <meta name="description" content="horestcto client, <?=$client->description?>" />
  <meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
  <meta name="robots" content="index, follow" />
  <title><?=strtolower($client->name)?> - Horestco client portfolio</title>


  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('owl.carousel.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="<?=script_url('html5shiv.js')?>"></script>
    <script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
  <style>
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
</head>
<body>

<?php

                    use Illuminate\Support\Str;

 $this->load->view('partials/nav') ?>

<nav class="top-nav transparent hide-on-small-only">
  <div class="container nav-wrapper">
    <div class="col s12">
      <a href="/" class="breadcrumb">Home</a>
      <a href="/portfolio" class="breadcrumb">Portfolio</a>
      <a href="/portfolio/<?=$client->page['slug']?>" class="breadcrumb"><?=ucwords($client->page['name'])?></a>
      <a href="/client/<?=$client->slug?>" class="breadcrumb"><?=ucwords($client->name)?></a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row">
  

    <div class="col s12 l5 push-l7">

      <h4><?=$client->name?></h4>
      <p><?=$client->description?></p>
      <ul class="collection with-header">
        <li class="collection-header"><h5>Job Scope:</h5></li>
        <?php foreach (explode(',', $client->scopes) as $scope): ?>
          <li class="collection-item"><?=trim($scope)?></li>
        <?php endforeach ?>
      </ul>
      <ul class="collection with-header">
        <li class="collection-header"><h5>Projects:</h5></li>
        <?php foreach ($productImages as $image): ?>
          <li class="collection-item avatar valign-wrapper">
            <?php
            $attr = [
              'class' => 'circle',
              'alt'   => ucwords(strtolower($image->product['name'])),
              'title' => ucwords(strtolower($image->product['name']))
            ];
            echo image_thumb(img_url().'products/'.$image->name, 50, $attr);
            /*
            */ ?>
            <a href="<?=base_url().'furniture/'.Str::slug($image->product['name']).'-'.$image->product['code']?>">
              <span><?=ucwords(strtolower($image->product['name']))?></span>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="col s12 l7 pull-l5">
      <div id="slide" class="owl-carousel" data-slider-id="1">
        <?php foreach ($client->images as $key => $image): ?>
          <div class="item" data-hash="<?=$image->id?>">
            <img src="<?=base_url().img_url().'portfolio/'.Str::slug($client->page["name"]).'/'.strtolower($image->name)?>"
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
                $image = img_url().'portfolio/'.Str::slug($client->page["name"]).'/'.strtolower($image->name);
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


<?php $this->load->view('partials/footer') ?>

<script src="<?=script_url('jquery.min.js')?>"></script>
<script src="<?=script_url('materialize.min.js')?>"></script>
<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script src="<?=script_url('owl.carousel2.thumbs.js')?>"></script>
<script src="<?=script_url('scripts.js')?>"></script>
<script>
  $(document).ready(function(){
    $('#slide').owlCarousel({
      loop:true,
      items:1,
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
</body>
</html>
