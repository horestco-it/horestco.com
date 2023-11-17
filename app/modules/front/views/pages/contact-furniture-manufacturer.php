<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
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
        url('<?=base_url().img_url("slide-index/slide3-1.jpg")?>');
        background-attachment: fixed;
        background-position: center;
    }
    ul.tel li a{
      color: #212121;
    }
    i.icons{
      font-size: 20px;
    }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<section class="section lead background-image">
  <div class="container">
    <div class="row center">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">CONTACT</h3>
        <h5 class="lead-sub-heading" style="font-weight:400">
          VISIT US
        </h5>
      </div>
    </div>
  </div>
</section>

<section class="container">
  <div class="row">
    <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <h4>MALAYSIA</h4>
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
            <p>Showroom &amp; Warehouse:</p>
            <span class="fn n">
              <span class="given-name"><strong>HORESTCO INDUSTRIES (M) SDN. BHD</strong></span>
              <span class="additional-name">(888188-K)</span>
            </span>
            <div class="adr">
              <span class="street-address">No. 9, Jalan Kartunis U1/47</span>
              <span class="locality">Temasya Industrial Park, Glenmarie Shah Alam</span>
              <span class="region">Selangor</span>
              <span class="postal-code">40150</span>
              <span class="country-name">MALAYSIA</span>
            </div>
            <ul class="tel" style="color:#212121">
              <li title="Phone">
                <!-- <a href="tel:+603-55697999"> -->
                  <i class="mdi-communication-phone icons grey-text text-darken-1"></i>  
                  <span class="type hide">Phone</span>
                  <span class="value">+603-55697999</span>
                <!-- </a> -->
              </li>
              <li title="Hotline">
                <!-- <a href="tel:1700-81-4886"> -->
                  <i class="mdi-notification-phone-in-talk icons grey-text text-darken-1"></i> 
                  <span class="type hide">Hotline</span>
                  <span class="value">1700-81-4886</span>
                <!-- </a> -->
              </li>
              <li title="Fax">
                <!-- <a href="fax:+603-55699555"> -->
                  <i class="mdi-action-print icons grey-text text-darken-1"></i> 
                  <span class="type hide">Fax</span>
                  <span class="value">+603-55699555</span>
                <!-- </a> -->
              </li>
              <li title="Email">
                <a class="email" href="mailto:info@horestco.com">
                  <i class="mdi-communication-email icons grey-text text-darken-1"></i> 
                  <span class="type hide">Email</span>
                  <span class="value">info@horestco.com</span>
                </a>
              </li>
              <li class="geo" title="geo">
                <a target="_blank" href="http://maps.google.com.my/maps?hl=en&amp;ampgeorestrict=input_srcid:717483e9a2a6cfaa&amp;ampie=UTF8&amp;ampview=map&amp;ampcid=3081330757634961010&amp;ampq=Horestco+Industries+(M)+Sdn+Bhd&amp;amphq=Horestco+Industries+(M)+Sdn+Bhd&amp;amphnear=&amp;ampll=3.097664,101.586971&amp;ampspn=0.077135,0.128746&amp;ampz=13&amp;ampsource=embed">
                  <i class="mdi-device-gps-fixed icons grey-text text-darken-1"></i>
                 <abbr class="latitude" title="3.097664">N 3° 097664</abbr>
                 <abbr class="longitude" title="101.586971">E 101° 586971</abbr>
                </a>
              </li>
              <li style="padding:10px 0"></li>
              <li title="facebook page">
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank">
                  <img src="<?=base_url().img_url()?>socials/horestco-facebook.png" alt="horestco facebook page">  
                  <span class="valign">FOLLOW US</span>
                </a>
              </li>
           
            </ul>
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Sunday 9am-6pm
          </div>
          <div class="card-panel teal white-text">
            Please call to arrange an appointment if visiting after working hours.
            Parking available.<br>
          </div>
          <iframe style="width:100%; height:300px;" src="http://maps.google.com.my/maps?hl=en&amp;georestrict=input_srcid:717483e9a2a6cfaa&amp;ie=UTF8&amp;view=map&amp;cid=3081330757634961010&amp;q=Horestco+Industries+(M)+Sdn+Bhd&amp;hq=Horestco+Industries+(M)+Sdn+Bhd&amp;hnear=&amp;ll=3.097664,101.586971&amp;spn=0.077135,0.128746&amp;z=13&amp;output=embed"></iframe>
        </div>

        <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
        
      </div>
    </div>

    <div class="col s12">
      <div class="divider"></div>
    </div>

    <div class="col s12 m6">
      <!-- BEGIN VCARD -->
      <h4>INDONESIA</h4>
      <div id="hcard-PT-HORESTCO" class="vcard">
        <p>Factory &amp; Showroom:</p>
        <span class="fn n">
          <span class="given-name"><strong>PT. HORESTCO</strong></span>
        </span>
        <div class="adr">
          <span class="street-address">Jalan RA Rukmini RT. 18 RW. 04</span>
          <span class="locality">Bawu Batealit, Jepara</span>
          <span class="region">Jawa Tengah</span>
          <span class="postal-code">59461</span>
          <span class="country-name">INDONESIA</span>
        </div>
        <ul class="tel list-inline">
          <li>
            <span class="glyphicon glyphicon-earphone"></span> 
            <span class="type">Phone</span>:
            <span class="value">+62-85100-760267</span>
          </li>
          <li>
            <span class="glyphicon glyphicon-phone"></span> 
            <span class="type">HP</span>:
            <span class="value">+62-8551069988</span>
          </li>
          <li>                    
            <span class="glyphicon glyphicon-envelope"></span> Email:
            <a class="email" href="mailto:info@horestco.com">export@horestco.com</a>
          </li>
          <li class="geo">                
             <abbr class="latitude" title="-6.622528">N -6° 622528</abbr>
             <abbr class="longitude" title="110.718058">E 110° 718058</abbr>
          </li>
          
        </ul>
      </div>
      <br >
      <!-- End Vcard -->
    </div>
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

<?php $this->load->view('partials/scripts/zopim-chat') ?>

</body>
</html>