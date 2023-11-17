<!DOCTYPE html>
<html lang="en">
<head>
  
  <?php get_meta() ?>
  <meta name="google-site-verification" content="6L1Kg1ix0KggGtCyTvvSmQqdtIo4DchTBtazVlxmn9A" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  
  <link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
  <link rel="stylesheet" href="<?=style_url('font-awesome.min.css')?>">
  <link href="<?=style_url('materialize.css')?>" rel="stylesheet" media="screen,all"/>
  <link href="<?=style_url('animate.min.css')?>" rel="stylesheet" media="screen,all"/>
  <link href="<?=style_url('jquery.fullPage.css')?>" rel="stylesheet" media="screen,all"/>
  <link rel="stylesheet" href="<?=style_url('font-awesome.min.css')?>">
  <link href="<?=style_url('style.css')?>" type="text/css" rel="stylesheet" media="screen,all"/>

<style>
  .submenu > li{
    position: relative;
    border-right: 1px solid #ededed;
  }
  .submenu > li:first-child{
    border-left: 1px solid #ededed;
  }
  nav.secondary-nav{
    position:relative;
  }
  .section{
    padding: 0;
  }
  .section .section-header-box{
    width: 100%
  }
  .section .section-header{
    margin: 0 auto 4rem;
    background: rgba(255, 255, 255, .5);
    width: 300px;
    padding: 3% 3% 1%;
  }
  .card .card-title{
    width: 100%;
    font-size: 14px;
    letter-spacing: 2px;
  }
 
  #contact{
    background-size: cover;
    background-attachment: fixed;
    background-position-y: 50px;
    background-image: url('<?=base_url().img_url()?>pages/index-horestco-outdoor-furniture.jpg');
  }
  #contact .contact-container,
  #contact .contact-post{
    background: rgba(255, 255, 255, .5);
    padding: 3%;
  }
  
  #cushion *::selection{
    background: #ad1457;
    color: white;
  }
  .slider ul.indicators{
    bottom: 18%;
    z-index: 3;
  }

/*  footer{
    display:block;
    position:fixed;
    bottom: -84px;
    width: 100%;
    z-index:9;
    text-align:center;
  }*/
  
  </style>

</head>
<body id="wrapper">

<?php $this->load->view('template/default/nav') ?>

<main id="fullpage">

  <?php
    $this->load->view('partials/home/slider');

    $this->load->view('partials/home/about');

    $this->load->view('partials/home/portfolio');

    $this->load->view('partials/home/catalog');

    $this->load->view('partials/home/material');

    $this->load->view('partials/home/cushion');

    $this->load->view('partials/home/contact');
  ?>

</main>
<script src="<?=script_url('jquery.min.js')?>"></script>
<script src="<?=script_url('materialize.min.js')?>"></script>
<script src="<?=script_url('scripts.js')?>"></script>
<script src="<?=assets_url('/vendor/jquery.slimscroll.min.js')?>"></script>
<script src="<?=script_url('jquery.fullPage.min.js')?>"></script>
<script>
  $(document).ready(function() {
    $('.slider').slider({transition:1000,interval:7000});

    $('#fullpage').fullpage({
      verticalCentered: false,
      navigation: true,
      navigationPosition: 'right',
      css3:false,
      scrollingSpeed: 1000,
      scrollOverflow: true
    });

    /////////////////////
    // contact section //
    /////////////////////
    // open google form newsletter
    var iframe = '<iframe src="http://goo.gl/forms/njbeaOJMd8" width="100%" height="600px"></iframe>';
    var $newsletter = $('#newsletter-btn');
    var $modal = $('#contact-post-modal');
    $newsletter.leanModal({
      opacity: 1,
      ready: function(){
        $modal.find('.modal-content').html(iframe);
      }
    })

  });
</script>
</body>

</html>

