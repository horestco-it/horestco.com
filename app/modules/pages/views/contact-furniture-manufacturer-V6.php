<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
  <?php get_meta($page) ?>
  <?php $this->load->view('partials/meta-and-assets') ?>
<link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">
  
  <style>
    
  nav.secondary-nav{
    position:relative;
  }
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
              <span class="street-address">No. 19, Jalan Kartunis U1/47</span>
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
              <li>
              <a href="https://www.google.com/maps/dir//9,+Jalan+Kartunis+U1%2F47,+Kawasan+Perindustrian+Temasya,+40150+Shah+Alam,+Selangor,+Malaysia/@3.0868018,101.5723372,17z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x31cc4c4dc8cec749:0x322390d830bd1dc7!2m2!1d101.5745259!2d3.0868018" target="_blank" title="Map"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">  
                  <span class="valign"></span>
                </a>
                <a href="https://mobile-web.world.waze.com/en_GB/meetup/location?h=w281x3swj" target="_blank" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">  
                  <span class="valign"></span>
                </a>
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">  
                  <span class="valign"></span>
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
          
        <!--   <iframe style="width:100%; height:300px;" src="http://maps.google.com.my/maps?hl=en&amp;georestrict=input_srcid:717483e9a2a6cfaa&amp;ie=UTF8&amp;view=map&amp;cid=3081330757634961010&amp;q=Horestco+Industries+(M)+Sdn+Bhd&amp;hq=Horestco+Industries+(M)+Sdn+Bhd&amp;hnear=&amp;ll=3.097664,101.586971&amp;spn=0.077135,0.128746&amp;z=13&amp;output=embed"></iframe> -->

          <iframe style="width:100%; height:300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.02952206236!2d101.572359814933!3d3.0867950971902296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4b6c7a59c4e5%3A0xecb2c409ca576195!2sHORESTCO+FURNITURE!5e0!3m2!1sen!2sid!4v1548314932143"></iframe>
        </div>

        <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
        
      </div>
    </div>

	<div class="col s12">
		<div class="divider"></div>
	</div>

    <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <h4>LANGKAWI</h4>
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
            <p>Distributor:</p>
            <span class="fn n">
              <span class="given-name"><strong>SUMMER FURNISHINGS (M) SDN. BHD</strong></span>
            </span>
            <div class="adr">
              <span class="street-address">Lot 91, 92 & 93, Persiaran Mutiara 2</span>
              <span class="locality">Kelana Mas Commercial & Tourist Centre</span>
              <span class="region">Kuah 07000 Langkawi</span>
              <!-- <span class="postal-code">40150</span> -->
              <span class="country-name">kedah MALAYSIA</span>
            </div>
            <ul class="tel" style="color:#212121">
              <li title="Phone">
                <!-- <a href="tel:+603-55697999"> -->
                  <i class="mdi-communication-phone icons grey-text text-darken-1"></i>  
                  <span class="type hide">Phone</span>
                  <span class="value">+604 966 8375</span>
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
                <a target="_blank" href="http://maps.google.com.my/maps?hl=en&ampgeorestrict=input_srcid:717483e9a2a6cfaa&ampie=UTF8&ampview=map&ampcid=3081330757634961010&ampq=Horestco+Industries+(M)+Sdn+Bhd&amphq=Horestco+Industries+(M)+Sdn+Bhd&amphnear=&ampll=3.097664,101.586971&ampspn=0.077135,0.128746&ampz=13&ampsource=embed">
                  <i class="mdi-device-gps-fixed icons grey-text text-darken-1"></i>
                 <abbr class="latitude" title="3.097664">N 6° 324405</abbr>
                 <abbr class="longitude" title="101.586971">E 99° 844682</abbr>
                </a>
              </li>
              <li style="padding:10px 0"></li>
              <li>
              <a href="https://www.google.com.my/maps/place/Summer+Furnishings+(M)+Sdn+Bhd/@6.3244046,99.8424929,17z/data=!4m5!3m4!1s0x304c7f655e692f03:0x2cc18e886f09ceff!8m2!3d6.3244046!4d99.8446816?hl=en&shorturl=1" target="_blank" title="Map"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">  
                  <span class="valign"></span>
                </a>
                <a href="https://www.waze.com/ul?ll=6.32440460%2C99.84468160&navigate=yes&zoom=16" target="_blank" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">  
                  <span class="valign"></span>
                </a>
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">  
                  <span class="valign"></span>
                </a>
              </li>
              
            </ul>
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday 9am-6pm
          </div>
          <div class="card-panel teal white-text">Please call to arrange an appointment if visiting after working hours.<br>
          </div>

          <!-- Maps langkawi -->
          <iframe style="width:100%; height:300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7931.073569543403!2d99.84030423162953!3d6.324404595421984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304c7f655e692f03%3A0x2cc18e886f09ceff!2sSummer+Furnishings+(M)+Sdn+Bhd!5e0!3m2!1sen!2sid!4v1548379364146"></iframe>
        </div>

        <div class="col s12 m6">
          <!-- <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler"> -->
        </div>
        
      </div>
    </div>



	<div class="col s12">
		<div class="divider"></div>
	</div>

    <!-- indonesia -->
    <div class="col s12 m6">
      <!-- BEGIN VCARD -->
      <h4>INDONESIA</h4>
      <div id="hcard-PT-HORESTCO" class="vcard">
        <p>Factory &amp; Showroom:</p>
        <span class="fn n">
          <span class="given-name"><strong>PT. HORESTCO</strong></span>
        </span>
        <div class="adr">
          <span class="street-address">Jl. Raya Tahunan - Batealit KM.07 No.24 Bawu RT 07 RW 02</span>
          <span class="locality">Bawu Batealit, Jepara</span>
          <span class="region">Jawa Tengah</span>
          <span class="postal-code">59461</span>
          <span class="country-name">INDONESIA</span>
        </div>
        <ul class="tel list-inline">
          <li>
          	<i class="mdi-communication-phone icons grey-text text-darken-1"></i>  
            <span class="type">Phone</span>:
            <span class="value">+62-85100-760267</span>
          </li>
          <li>
          	<i class="mdi-hardware-smartphone icons grey-text text-darken-1"></i>
            <span class="type">HP</span>:
            <span class="value">+62-8551069988</span>
          </li>
          <li>
          <i class="mdi-communication-email icons grey-text text-darken-1"></i>                  
            <span class="glyphicon glyphicon-envelope"></span> Email:
            <a class="email" href="mailto:export@horestco.com">export@horestco.com</a>
          </li>
          <li class="geo">
            <a href="https://goo.gl/maps/8riuZRxmAcA2" target="_blank">
          <i class="mdi-device-gps-fixed icons grey-text text-darken-1"></i>           
             <abbr class="latitude" title="-6.622528">N -6.628827</abbr>
             <abbr class="longitude" title="110.718058">E 110.731283</abbr> <!-- -6.628827, 110.731283 -->
          </li></a>
          
        </ul>
      </div>
      <br >
      <!-- End Vcard -->
      <iframe style="width:100%; height:300px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7926.291096229164!2d110.7269072408181!3d-6.628837780830272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e71201eb45e5363%3A0x77cc4003e6ac057f!2sPT.+HORESTCO!5e0!3m2!1sen!2sid!4v1548314319635"></iframe>
    </div>
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

<?php $this->load->view('partials/scripts/zopim-chat') ?>

</body>
</html>