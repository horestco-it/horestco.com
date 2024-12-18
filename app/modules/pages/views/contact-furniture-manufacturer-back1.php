<!DOCTYPE html>
<html lang="en">
<head><meta charset="windows-1252">

  <?php get_meta($page) ?>
  <?php get_meta($this->uri->segment(1)) ?>
  
  <?php $this->load->view('partials/meta-and-assets') ?>
  <meta name="google-site-verification" content="9c_m7u6MVhGHrVGcGKY7AhtI3d1xM6Eq6h3wAHd1M14" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <link href="https://www.horestco.com" rel=""canonical�">
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
  
  

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  	<script src="<?=script_url('html5shiv.js')?>"></script>
  	<script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
  <style>
   .column1 {
  float: left;
  width: 50%;
  padding: 10px;
  height: 270px; /* Should be removed. Only for demonstration */
 
}
  .column {
  float: left;
  width: 50%;
  padding: 10px;
  height: auto; /* Should be removed. Only for demonstration */
}

.row:after {
  content: "";
  display: table;
  clear: both;
}
  
 

   /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  margin-top: 20px;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 80px;
  transition: 0.3s;
  font-size: 17px;
  
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
  font: bold 17px/25px Arial, Arial;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 0px solid #ccc;
  border-top: none;
  margin-left: 0px;
}
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.3), 
          rgba(0, 0, 0, 0.3)
        ),
        url('<?=base_url().img_url("Beautiful-Outdoor.jpg")?>');
        background-attachment: fixed;
        background-position: center;
        height: 250px;
        text-align: center;
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

<?php //$this->load->view('partials/nav.php') ?>
<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

<section class="section lead background-image">
  <div class="container-fluid">
    <div class="row center">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">CONTACT</h3>
        <h5 class="lead-sub-heading" style="font-weight:400">
          FEEL FREE TO CONTACT US OR EVEN BETTER - VISIT US.
        </h5>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-fluid">
  <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Malaysia')" id="defaultOpen">KUALA LUMPUR</button>
  <button class="tablinks" onclick="openCity(event, 'Penang')">PENANG</button>
  <button class="tablinks" onclick="openCity(event, 'Langkawi')">LANGKAWI</button>
  <button class="tablinks" onclick="openCity(event, 'Indonesia')">INDONESIA</button>
  <button class="tablinks" onclick="openCity(event, 'Maldives')">MALDIVES</button>
</div>
</div>
</section>

<div id="Malaysia" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
           
            <span class="fn n">
              <span class="given-name"><strong><b>HORESTCO INDUSTRIES (M) SDN. BHD<br/></b></strong></span>
              <span class="additional-name"><b>(888188-K)</b></span>
            </span>
            <div class="adr">
              <span class="street-address">No. 19, Jalan Kartunis U1/47,<br></span>
              <span class="locality">Temasya Industrial Park, Glenmarie,<br> Shah Alam</span>
              <span class="region">Selangor</span>
              <span class="postal-code">40150<br></span>
              <span class="country-name">MALAYSIA</span>
            </div>
            <br/>
            
            <div class="row">
             <div class="column1" style="background-color:#eee;">
              <ul class="tel">
              <p>
              <li title="Phone">
                  
                  <i class="fa fa-phone fa-lg"></i>  
                  <span class="type hide">Phone</span>
                  <span>:</span>
                  <a href="tel:+60355697999"> 
                  <span class="value"><font color="#039be5">+603-55697999</font></span>
                  </a> 
              </li>
              </p>
              
              <p>
              <li title="Phone"> 
                  <i class="fa fa-phone fa-lg"></i>  
                  <span class="type hide">Phone</span>
                  <span>:</span>
                  <a href="tel:+60355699555">
                  <span class="value"><font color="#039be5">+603-55699555</font></span>
                  </a> 
              </li>
              </p>
              
              <p>
              <li title="whatsapp">
                  <i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>:</span>
                <a href="https://wa.me/60162240799">  
                  <span class="value"><font color="#039be5">+60 162240799</font></span>
                </a> 
              </li>
              </p>
              
              <p>
              <li title="whatsapp">
                 <i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>:</span>
                <a href="https://wa.me/60169440799">  
                  <span class="value"><font color="#039be5">+60 169440799</font></span>
                </a> 
              </li>
              </p> 
              
              <p>
              <li title="Email">
                 <i class="fa fa-envelope fa-lg"></i> 
                  <span class="type hide">Email</span>
                  <span>:</span>
                  <span class="value">
                  <a target="_blank" href="mailto:info@horestco.com?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                  <abbr><font color="#039be5">info@horestco.com</font></abbr>
                  </a>
                  </span>
              </li>
              </p>
              
              <p>
              <li class="geo" title="geo">
               <i class="fa fa-street-view fa-lg"></i>
                   <span>:</span>
                 <a target="_blank" href="https://www.google.com/maps/dir//HORESTCO+FURNITURE,+LOT+9,+JALAN+KARTUNIS+U1%2F47,+TEMASYA+INDUSTRIAL+PARK,+GLENMARIE,+40150+Shah+Alam,+Selangor,+Malaysia/@3.086798,101.5723583,17z/data=!4m16!1m6!3m5!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!2sHORESTCO+FURNITURE!8m2!3d3.086798!4d101.574547!4m8!1m0!1m5!1m1!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!2m2!1d101.574547!2d3.086798!3e1">  
                 <abbr class="latitude" title="3.086795"><font color="#039be5">N 3° 086795</font></abbr>
                 <abbr class="longitude" title="101.574548"><font color="#039be5">E 101° 574548</font></abbr>
                 </a>
              </li>
              </p>
              
               
               </ul>
               
           </div>
           <div class="column1" style="background-color:#eee;">
             <ul class="tel">
             
             
             <li>
                <span><b>Export Enquiries</b></span>
               
             </li> 
              
              <p>  
              <li title="whatsapp">
                  <i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>:</span>
                <a href="https://wa.me/60169134571">  
                  <span class="value"><font color="#039be5">+60 169134571</font></span>
                </a> 
              </li>
              </p>
              
              <p>
              <li title="whatsapp">
                  <i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>:</span>
                 <a href="https://wa.me/60169928921">  
                  <span class="value"><font color="#039be5">+60 169928921</font></span>
                 </a> 
              </li>
              </p>
              
              
              
             
              
             
              
              
              
              
              
              
              
              <!-- <li title="Hotline">
                <a href="tel:1700-81-4886"> 
                  <i class="mdi-notification-phone-in-talk icons grey-text text-darken-1"></i> 
                  <span class="type hide">Hotline</span>
                   <span>:</span>
                  <span class="value">1700-81-4886</span>
                 </a> -->
              </li>
              <!--  <li title="Fax">
                 <a href="fax:+603-55699555"> 
                  <i class="mdi-action-print icons grey-text text-darken-1"></i> 
                  <span class="type hide">Fax</span>
                   <span>:</span>
                  <span class="value">+603-55699555</span>
                </a> -->
              </li>
              
              <li style="padding:10px 0"></li>
             
               
             </ul>
             
          </div>
         </div>
              
             
              <a href="https://www.google.com/maps/place/HORESTCO+FURNITURE/@3.086798,101.5723583,17z/data=!3m1!4b1!4m5!3m4!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!8m2!3d3.086798!4d101.574547"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
                  
                  <img src="<?=base_url().img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <!--  <a href="https://wa.me/60162240799">
                  <img src="<?=base_url().img_url()?>socials/whatsapp04.png" height="60" width="60" alt="Share on Facebook">&nbsp&nbsp  
                  <span class="valign"></span>
                </a> -->
                
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                  <img src="<?=base_url().img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
                  <img src="<?=base_url().img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
                  <img src="<?=base_url().img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
                  <span class="valign"></span>
                </a>
                
             
              
            
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
            
          </div>
          <div class="card-panel teal white-text">
           Please call to arrange an appointment if visiting between March 18 and March 31 2020. <br/>Parking available<br/>
          </div>
           
         <!--  <div style="width:200%;" class="card-panel grey white-text">
            <span>Showroom, Warehouse & Light Furniture Manufacturing.</span><br/>
            Products manufactured in-house at this unit : <br>
            Stainless Steel Umbrellas, Wooden Tables Tops, Laminate Table tops, Upholstered furniture, Loose Cushions etc. 
          </div> -->
          
        <!--   <iframe style="width:100%; height:300px;" src="http://maps.google.com.my/maps?hl=en&amp;georestrict=input_srcid:717483e9a2a6cfaa&amp;ie=UTF8&amp;view=map&amp;cid=3081330757634961010&amp;q=Horestco+Industries+(M)+Sdn+Bhd&amp;hq=Horestco+Industries+(M)+Sdn+Bhd&amp;hnear=&amp;ll=3.097664,101.586971&amp;spn=0.077135,0.128746&amp;z=13&amp;output=embed"></iframe> -->
          <div>
          <br/><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.0294910996336!2d101.57235831408946!3d3.0868033543951863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c5a8d40e179%3A0x5c4a780cc2ec2ea0!2sHORESTCO%20FURNITURE!5e0!3m2!1sen!2sid!4v1580171792684!5m2!1sen!2sid" width=200% height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe><br/>
          </div>
          <div><br/></div>
          <div style="width:100% height=100%" class="card-panel grey white-text">
            <span>Showroom, Warehouse & Light Furniture Manufacturing.</span><br/>
            Products manufactured in-house at this unit : <br>
            Stainless Steel Umbrellas,<br> 
            Wooden Tables Tops,<br> 
            Laminate Table tops,<br> 
            Upholstered furniture,<br>
            Loose Cushions etc. 
          </div>
          
        </div>

        <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
        
      </div>
    </div>
    
</div>

<div id="Penang" class="tabcontent">
  <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
           
            <span class="fn n">
              <span class="given-name"><strong><b>SHOWROOM :<br></b></strong></span>
              <span class="additional-name"><b>HORESTCO INDUSTRIES (M) SDN. BHD</b></span>
            </span>
            <div class="adr">
              <span class="street-address">70, Jalan Tanjung Tokong, Kampung Masjid,<br></span>
              <span class="locality">George Town</span>
              <span class="postal-code">10470<br></span>
              <span class="region">Penang</span>
              <span class="country-name">MALAYSIA</span>
            </div>
            <ul class="tel" style="background-color:#eee;>
              <p>
              <li title="Phone"> 
                  <br/>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-phone fa-lg"></i>  
                  <span class="type hide">Phone</span>
                  <span>&nbsp:</span>
                  <a href="tel:+6048917999">
                  <span class="value"><font color="#039be5">+604-8917999</font></span>
                  </a> 
              </li>
              </p>
              <p>
              <li title="whatsapp">
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>&nbsp:&nbsp</span>
                 <a href="https://wa.me/60166371049"> 
                  <span class="value"><font color="#039be5">+60 166371049</font></span>
                 </a> 
              </li>
              </p>
              
              <p>
              <li title="Email">
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-envelope fa-lg"></i> 
                  <span class="type hide">Email</span>
                  <span>:</span>
                  <span class="value">
                  <a href="mailto:penang@horestco.com?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                  <font color="#039be5">penang@horestco.com</font>
                  </a>
                  </span>             
              </li>
              </p>
              
              <p>
              <li class="geo" title="geo">
               &nbsp&nbsp&nbsp&nbsp<i class="fa fa-street-view fa-lg"></i>
                   <span>&nbsp:</span>
                 <a target="_blank" href="https://www.google.com.my/maps/dir//HORESTCO+FURNITURE+PENANG,+70,+Jalan+Tanjung+Tokong,+Kampung+Masjid+Tanjung+Tokong,+10470+George+Town,+Pulau+Pinang,+Malaysia/@5.4412947,100.3050744,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x304ac33e523a4d01:0x13132e924a0f46d2!2m2!1d100.3072631!2d5.4412894?hl=en">    
                 <abbr class="latitude" title="5.4412894"><font color="#039be5">N 5° 4412894</font></abbr>
                 <abbr class="longitude" title="100.3072631"><font color="#039be5">E 100° 3072631</font></abbr>
                </a>
              </li>
              </p>
              <li style="padding:10px 0"></li>
              </ul>
              
              <a href="https://www.google.com.my/maps/place/HORESTCO+FURNITURE+PENANG/@5.4412947,100.3050744,17z/data=!3m1!4b1!4m5!3m4!1s0x304ac33e523a4d01:0x13132e924a0f46d2!8m2!3d5.4412894!4d100.3072631?hl=en"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://www.waze.com/livemap/directions/malaysia/pulau-pinang/george-town/horestco-furniture-penang?place=ChIJAU06Uj7DSjAR0kYPSpIuExM" target="_blank" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                
                 <!--  <a href="https://wa.me/60166371049">
                  <img src="<?=base_url().img_url()?>socials/whatsapp04.png" height="60" width="60" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a> -->
                
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                
                <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                  <img src="<?=base_url().img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Instagram">
                  <img src="<?=base_url().img_url()?>socials/instagram05.png" alt="horestco instagram page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://id.pinterest.com/thehorestco" target="_blank" Title="Pinterst">
                  <img src="<?=base_url().img_url()?>socials/pinterest05.png" alt="horestco instagram page">  
                  <span class="valign"></span>
                </a>
                
              
              
            
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Sunday :  9 am - 6 pm<br/>
            Public Holidays : Closed. 
            
          </div>
          <div class="card-panel teal white-text">
           Please call to arrange an appointment if visiting between March 18 and March 31 2020. 
          </div>
          
        <!--   <iframe style="width:100%; height:300px;" src="http://maps.google.com.my/maps?hl=en&amp;georestrict=input_srcid:717483e9a2a6cfaa&amp;ie=UTF8&amp;view=map&amp;cid=3081330757634961010&amp;q=Horestco+Industries+(M)+Sdn+Bhd&amp;hq=Horestco+Industries+(M)+Sdn+Bhd&amp;hnear=&amp;ll=3.097664,101.586971&amp;spn=0.077135,0.128746&amp;z=13&amp;output=embed"></iframe> -->
          <iframe style="width:200%; height:500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3971.8397179603853!2d100.30507441409132!3d5.441294736307293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304ac33e523a4d01%3A0x13132e924a0f46d2!2sHORESTCO%20FURNITURE%20PENANG!5e0!3m2!1sen!2sid!4v1580100491256!5m2!1sen!2sid" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>

        <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/penang.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
        
      </div>
    </div>
</div>
</div>

<div id="Langkawi" class="tabcontent">
  <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
            
            <span class="fn n">
              <span class="given-name"><strong><b>DISTRIBUTOR SHOWROOM :<br></b></strong></span>
               <span class="additional-name"><b>SUMMER FURNISHINGS (M) SDN. BHD </b></span>
            </span>
            <div class="adr">
              <span class="street-address">Lot 91, 92 & 93, Persiaran Mutiara 2<br></span>
              <span class="locality">Kelana Mas Commercial & Tourist Centre,<br></span>
              <span class="region">Kuah 07000 Langkawi,<br></span>
              <!-- <span class="postal-code">40150</span> -->
              <span class="country-name">Kedah MALAYSIA</span>
            </div>
            
            <ul class="tel" style="background-color:#eee;>
              <p>
              <li title="Phone">
                  <br/>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-phone fa-lg"></i>  
                  <span>&nbsp&nbsp:</span>
                  <span class="type hide">Phone</span>
                  <a href="tel:+6049668375">
                  <span class="value"><font color="#039be5">+604 966 8375</font></span>
                  </a>    
              </li>
              </p>
              
              <p>
              <li title="Email">
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-envelope fa-lg"></i> 
                  <span>&nbsp:</span>
                  <span class="type hide">Email</span>
                 <span class="value">
                 <a href="mailto:info@horestco.com?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                  <font color="#039be5">info@horestco.com</font>
                  </a>
                  </span>
              </li>
              </p>
              
              <p>
              <li class="geo" title="geo">
                &nbsp&nbsp&nbsp&nbsp<i class="fa fa-street-view fa-lg"></i>
                 <span>&nbsp&nbsp:</span>
                <a target="_blank" href="https://www.google.com.my/maps/dir//Summer+Furnishings+(M)+Sdn+Bhd,+91,+Persiaran+Mutiara,Kuah,+07000+Langkawi,+Kedah,+Malaysia/@6.3244046,99.8424929,17z/data=!4m8!4m7!1m0!1m5!1m1!1s0x304c7f655e692f03:0x2cc18e886f09ceff!2m2!1d99.8460034!2d6.3233668?hl=en"> 
                 <abbr class="latitude" title="3.097664"><font color="#039be5">N 6° 324405</font></abbr>
                 <abbr class="longitude" title="101.586971"><font color="#039be5">E 99° 844682</font></abbr>
                </a>
              </li>
              </p>
              
              <li style="padding:10px 0"></li>
              </ul>
              
              <a href="https://www.google.com.my/maps/place/Summer+Furnishings+(M)+Sdn+Bhd/@6.3244046,99.8424929,17z/data=!4m5!3m4!1s0x304c7f655e692f03:0x2cc18e886f09ceff!8m2!3d6.3244046!4d99.8446816?hl=en&shorturl=1" target="_blank" title="Map"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://www.waze.com/livemap/directions/malaysia/kedah/langkawi/summer-furnishings-(m)-sdn-bhd?navigate=yes&place=ChIJAy9pXmV_TDAR_84Jb4iOwSw" target="_blank" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <!--  <a href="https://wa.me/60162240799">
                  <img src="<?=base_url().img_url()?>socials/whatsapp04.png" height="60" width="60" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a> -->
                
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                
                <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                  <img src="<?=base_url().img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Instagram">
                  <img src="<?=base_url().img_url()?>socials/instagram05.png" alt="horestco instagram page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Pinterst">
                  &nbsp<img src="<?=base_url().img_url()?>socials/pinterest05.png" alt="horestco instagram page">  
                  <span class="valign"></span>
                </a>
                 
              
              
            
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
            
          </div>
          <div class="card-panel teal white-text">Please call to arrange an appointment if visiting after working hours.<br>
          </div>

          <!-- Maps langkawi -->
          <iframe style="width:200%; height:500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7931.073569543403!2d99.84030423162953!3d6.324404595421984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304c7f655e692f03%3A0x2cc18e886f09ceff!2sSummer+Furnishings+(M)+Sdn+Bhd!5e0!3m2!1sen!2sid!4v1548379364146"></iframe>
        </div>

        <div class="col s12 m6">
          <!-- <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler"> -->
        </div>
        
      </div>
    </div>
</div>

<div id="Indonesia" class="tabcontent">
  <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
           
            <span class="fn n">
              <span class="given-name"><strong><b>FACTORY & SHOWROOM :<br></b></strong></span>
              <span class="additional-name"><b>PT. HORESTCO</b></span>
            </span>
            <div class="adr">
              <span class="street-address">Jl. Raya Bawu-Batealit,<br></span>
              <span class="locality">RT 40 RW 08 Bawu IV Bawu Batealit,<br></span>
              <span class="region">Jepara, Jawa Tengah</span>
              <span class="postal-code">59461</span>
              <span class="country-name">INDONESIA</span>
            </div>
            <ul class="tel" style="background-color:#eee;>
              <p>
              <li title="Phone"> 
                  <br/>&nbsp&nbsp&nbsp<i class="fa fa-phone fa-lg"></i>  
                  <span class="type hide">Phone</span>
                  <span>&nbsp&nbsp:</span>
                  <a href="tel:+6285100760267">
                  <span class="value">+62-85-100760267</span>
                  </a> 
              </li>
              </p>
              
               <p>
               <li title="whatsapp">  
                  &nbsp&nbsp&nbsp<i class="fa fa-whatsapp fa-lg"></i>  
                  <span class="type hide">Whatsapp</span>
                  <span>&nbsp:</span>
                  <a href="https://wa.me/628551069988">
                  <span class="value"><font color="#039be5">+62-8551069988</font></span>
                  </a> 
              </li>
              </p>
              
              <p>
              <li title="Hotline">      
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-mobile fa-lg"></i> 
                  <span class="type hide">Hotline</span>
                  <span>&nbsp&nbsp&nbsp:</span>
                  <a href="tel:+628551069988">
                  <span class="value"><font color="#039be5">+62-8551069988</font></span>
                  </a> 
              </li>
              </p>
              
              <p>
              <li title="Email">  
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-envelope fa-lg"></i> 
                  <span class="type hide">Email</span>
                  <span>:</span>
                 <span class="value">
                 <a href="mailto:export@horestco.com?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                  <font color="#039be5">export@horestco.com</font>
                  </a>
                  </span>
              </li>
              </p>
              
              <p>
              <li class="geo" title="geo">
                &nbsp&nbsp&nbsp&nbsp<i class="fa fa-street-view fa-lg"></i>
                   <span>&nbsp:</span>
                <a target="_blank" href="https://www.google.com/maps/dir//PT.+HORESTCO,+Jl.+Raya+Bawu-Batealit,+RT+40+RW+08,+Bawu+IV,+Bawu,+Kec.+Batealit,+Kabupaten+Jepara,+Jawa+Tengah+59461/@-6.6298361,110.7362554,17z/data=!4m16!1m6!3m5!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!2sPT.+HORESTCO!8m2!3d-6.6298414!4d110.7384441!4m8!1m0!1m5!1m1!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!2m2!1d110.7384441!2d-6.6298414!3e1">  
                 <abbr class="latitude" title=" -6.6298414"><font color="#039be5">N -6° 6298414</font></abbr>
                 <abbr class="longitude" title="110.738444"><font color="#039be5">E 110° 738444</font></abbr>
                </a>
              </li>
              </p>
              
              <li style="padding:10px 0"></li>
              <li>
              </ul>
              <a href="https://www.google.com/maps/place/PT.+HORESTCO/@-6.6298361,110.7362554,17z/data=!3m1!4b1!4m5!3m4!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!8m2!3d-6.6298414!4d110.7384441"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://www.waze.com/livemap/directions/indonesia/jawa-tengah/horestco-indonesia?place=ChIJbYnkmkohcS4RaSVhbsnIJUI&utm_campaign=waze_website&utm_source=waze_website" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                 <!--  <a href="https://wa.me/60162240799">
                  <img src="<?=base_url().img_url()?>socials/whatsapp04.png" height="60" width="60" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a> -->
                
                <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                
                <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                  <img src="<?=base_url().img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Instagram">
                  <img src="<?=base_url().img_url()?>socials/instagram05.png" alt="horestco instagram page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href=" https://id.pinterest.com/thehorestco" target="_blank" Title="Pinterst">
                  <img src="<?=base_url().img_url()?>socials/pinterest05.png" alt="horestco instagram page">  
                  <span class="valign"></span>
                </a>
                
              </li>
              
            
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
           Monday to Saturday :  07:30 am - 4 pm<br/>
           Sundays and Public Holidays : Closed.
           
          </div>
          <div class="card-panel teal white-text">
            Please call to arrange an appointment if visiting after working hours.
            Parking available.<br>
          </div>
          
         <div>
         <iframe style="width:200%; height:500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1375227751796!2d110.73625541414172!3d-6.629836066652829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e71201eb45e5363%3A0x77cc4003e6ac057f!2sPT.%20HORESTCO!5e0!3m2!1sen!2sid!4v1580103617270!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
         </div>
        <div style="width:100%;" class="card-panel grey white-text">
            <span>Furniture Manufacturing Factory, Showroom & Warehouse. </span><br/><br/>
            <span>Production Departments / products manufactured in-house at this unit : </span><br/><br/>
            <span>Woodworking (Wooden Furniture), 
            <br/>Metal working (metal furniture), 
            <br/>Weaving (Woven furniture), 
            <br/>Finishing, 
            <br/>Upholstery (Sofas, beds, dining chairs), 
            <br/>Sewing (Loose and fixed cushions)</span>
          </div>
        </div>

       <!--  <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>-->
        
      </div>
    </div>
</div>

<div id="Maldives" class="tabcontent">
  <div class="col s12 section">
      <div class="row">
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          
          <div id="hcard-HORESTCO-INDUSTRIES-(M)-SDN-BHD" class="vcard">
           
            <span class="fn n">
              <span class="given-name"><strong><b>SALES REPRESENTATIVE :<br></b></strong></span>
              <span class="additional-name"><b>Ibrahim Nihad</b></span>
            </span>
            <div class="adr">
              <span class="street-address">9-D, Marine Villa, Varudhee Higun,<br></span>
              <span class="locality">Varudhee Higun,<br></span>
              <span class="region">Maafannu, Male</span>
              <span class="postal-code"> 20282<br></span>
              <span class="country-name">MALDIVES</span>
            </div>
            <ul class="tel" style="background-color:#eee;>
              
              <li title="Phone">
                 
                  <br/>&nbsp&nbsp&nbsp&nbsp<i class="fa fa-phone fa-lg"></i>  
                  <span class="type hide">Phone</span>
                  <span>&nbsp&nbsp&nbsp:</span>
                  <a href="tel:+9607774711">
                  <span class="value"><font color="#039be5">+960-777-4711</font></span>
                  </a> 
              </li>
              </p>
              
              <p>
              <li title="Email"> 
                  &nbsp&nbsp&nbsp&nbsp<i class="fa fa-envelope fa-lg"></i> 
                  <span class="type hide">Email</span>
                  <span>&nbsp&nbsp:</span>
                  <span class="value">
                  <a class="email" href="mailto:maldives@horestco.com?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                  <font color="#039be5">maldives@horestco.com</font>
                  </a>
                  </span>  
              </li>
              </p>
              <!--  <li class="geo" title="geo">
                <a target="_blank" href="https://www.google.com/maps/dir//PT.+HORESTCO,+Jl.+Raya+Bawu-Batealit,+RT+40+RW+08,+Bawu+IV,+Bawu,+Kec.+Batealit,+Kabupaten+Jepara,+Jawa+Tengah+59461/@-6.6298361,110.7362554,17z/data=!4m16!1m6!3m5!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!2sPT.+HORESTCO!8m2!3d-6.6298414!4d110.7384441!4m8!1m0!1m5!1m1!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!2m2!1d110.7384441!2d-6.6298414!3e1">
                  <i class="mdi-device-gps-fixed icons grey-text text-darken-1"></i>
                   <span>:</span>
                 <abbr class="latitude" title=" -6.6298414">N -6° 6298414</abbr>
                 <abbr class="longitude" title="110.738444">E 110° 738444</abbr>
                </a>
              </li> -->
              <li style="padding:10px 0"></li>
              <li>
              <!-- <a href="https://www.google.com/maps/place/PT.+HORESTCO/@-6.6298361,110.7362554,17z/data=!3m1!4b1!4m5!3m4!1s0x2e71201eb45e5363:0x77cc4003e6ac057f!8m2!3d-6.6298414!4d110.7384441"> 
                  <img src="<?=base_url().img_url()?>socials/mp.png">  
                  <span class="valign"></span>
                </a> -->
              <!--  <a href="" target="_blank" title="Waze">
                  <img src="<?=base_url().img_url()?>socials/waz.png">  
                  <span class="valign"></span>
                </a> -->
                </ul>
               <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Facebook">
                  <img src="<?=base_url().img_url()?>socials/fb.png" alt="horestco facebook page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                
                <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                  <img src="<?=base_url().img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                  <span class="valign"></span>
                </a>
                
                <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Instagram">
                  <img src="<?=base_url().img_url()?>socials/instagram05.png" alt="horestco instagram page">&nbsp&nbsp   
                  <span class="valign"></span>
                </a>
                <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Pinterst">
                  &nbsp<img src="<?=base_url().img_url()?>socials/pinterest05.png" alt="horestco instagram page">  
                  <span class="valign"></span>
                </a>
                
                
              </li>
              
            
          </div>
          <!-- End Vcard -->
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
             Monday to Saturday :  9 am - 6 pm<br/>
             Sundays and Public Holidays : Closed.
          </div>
          <div class="card-panel teal white-text">
            Please call to arrange an appointment if visiting after working hours.
            Parking available.<br>
          </div>
          
          
          
         <!--  <iframe style="width:200%; height:500px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.1375227751796!2d110.73625541414172!3d-6.629836066652829!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e71201eb45e5363%3A0x77cc4003e6ac057f!2sPT.%20HORESTCO!5e0!3m2!1sen!2sid!4v1580103617270!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div> 

       < <div class="col s12 m6">
          <img src="<?=base_url().img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div> -->
        
      </div>
    </div>
</div>


  
    

	

    



	

    <!-- indonesia -->
    
  
<?php $this->load->view('partials/footer') ?> 

<?php $this->load->view('partials/scripts/zopim-chat') ?>




<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>