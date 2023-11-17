<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($page) ?>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="<?=script_url('html5shiv.js')?>"></script>
    <script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>/slide-index/slide3-1.jpg');
        background-attachment: fixed;
        background-position: center;
    }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>


<section class="jumbotron lead background-image parallax-container valign-wrapper">
  <div class="container">
    <div class="row center">
      <h3>FURNITURE DELIVERY</h3>
      <h5 class="lead-sub-heading">
        Logistics, Delivery and Installation services
      </h5>
    </div>
  </div>
  <div class="parallax"><img src="<?=img_url('slide-index/slide3-1.jpg')?>"></div>
</section>

<section class="section container">
  <div class="row">
    <div class="col s12 center">
      <p>
        Purchasing furniture anywhere is the easy part – but delivering the goods hassle-free is what separates a professional furniture company from the rest.  
        Our experienced staff are available to arrange the best delivery option for your furniture to your destination.  Please note that delivery charges may be applicable. 
        Certain items such as beds and wardrobes may require professional installation and our furniture installers will do the necessary at no extra cost within West Malaysia.
      </p>
      <hr class="line-dotted">
    </div>

    <div class="col s12 m6 l3">
      <h5>West Malaysia</h5>
      <p>
        We are able to arrange delivery and installation on site for our clients in Peninsular Malaysia. 
        For clients who prefer to arrange their own transport or self-collect the goods, feel free to collect your furniture from our address in Glenmarie.  
      </p>
    </div>

    <div class="col s12 m6 l3">
      <h5>East Malaysia</h5>
      <p>
        We are able to arrange shipping and delivery to most parts of Sabah and Sarawak in East Malaysia. 
        Special delivery arrangements to outlying islands in East Malaysia can be arranged upon request. 
      </p>
      
    </div>
    <div class="col s12 m6 l3">
      <h5>Singapore</h5>        
      <p>
         We are able to arrange deliveries to Singapore from our Glenmarie warehouse. 
        <br>
        For clients that purchase container loads, we recommend shipping directly from our factory in Indonesia. However, you would need to appoint a clearance agent in Singapore for clearance from the port and final delivery to your destination. 
      </p>
    </div>

    <div class="col s12 m6 l3">
      <h5>Indonesia</h5>
      <p>
        Please visit <a href="http://horestco.com/furniture-delivery">Logistics</a> for detailed information. 
      </p>
    </div>
    
    <div class="col s12">
      <h5>Rest of the World</h5>
      <p>
        We ship from Port Semarang, Indonesia and Port Klang, Malaysia. We provide complete logistical support through our appointed shipping agents.
        <br>
        However, you are welcome to use your own preferred shipper's services. 
        For clients importing furniture for the first time, please get in touch 
        with a local shipping / cargo handling agency in your own area to understand the procedures and requirements for importing furniture to your country.  
      </p>
    </div>
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

</body>
</html>
