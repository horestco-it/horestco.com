<!DOCTYPE html>
<html lang="en">
<head>

  <?php get_meta($page) ?>
  <?php get_meta($this->uri->segment(1)) ?>
  
  <?php $this->load->view('partials/meta-and-assets') ?>
  
<style>
  .flex-row{
    display: flex;
    flex-direction: row;
  }
  .flex-row > * {
    flex: 1;
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
    display: flex;
    flex-direction: row;
  }

  /* Style the buttons inside the tab */
  .tab button {
    flex: 1;
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
    /* float: left; */
    padding: 14px 5px;
    
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
      url('<?=server_img_url("Beautiful-Outdoor.jpg")?>');
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
  .row-card{
    padding: 10px;
    background-color: #eee;
    margin-bottom: 15px;
  }
  .column1 {
    padding: 10px;
  }
  .column1 > ul > li {
    padding: 10px 0;
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
  <button class="tablinks" id="<?=in_array($this->input->get('t'), ['malaysia', null]) ? 'defaultOpen':''?>" onclick="openCity(event, 'Malaysia')" >KUALA LUMPUR HQ</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'bukit-bintang' ? 'defaultOpen':''?>" onclick="openCity(event, 'bukit-bintang')">BUKIT BINTANG KL</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'penang' ? 'defaultOpen':''?>" onclick="openCity(event, 'Penang')">PENANG</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'langkawi' ? 'defaultOpen':''?>" onclick="openCity(event, 'Langkawi')">LANGKAWI</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'indonesia' ? 'defaultOpen':''?>" onclick="openCity(event, 'Indonesia')">INDONESIA</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'maldives' ? 'defaultOpen':''?>" onclick="openCity(event, 'Maldives')">MALDIVES</button>
</div>
</div>
</section>

<div id="Malaysia" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
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
            
            <div class="flex-row row-card">
              <div class="column1">
                <ul class="tel">
                  <li title="Phone">
                      
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:+60355697999"> 
                      <span class="value"><font color="#039be5">+603-55697999</font></span>
                      </a> 
                  </li>
                  <li title="Phone"> 
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:+60355699555">
                      <span class="value"><font color="#039be5">+603-55699555</font></span>
                      </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/60162240799">  
                      <span class="value"><font color="#039be5">+60 162240799</font></span>
                    </a> 
                  </li>
                  <li title="whatsapp">
                    <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/60169440799">  
                      <span class="value"><font color="#039be5">+60 169440799</font></span>
                    </a> 
                  </li>
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
                  <li class="geo" title="geo">
                  <i class="fa fa-street-view fa-lg"></i>
                      <span>:</span>
                    <a target="_blank" href="https://www.google.com/maps/dir//HORESTCO+FURNITURE,+LOT+9,+JALAN+KARTUNIS+U1%2F47,+TEMASYA+INDUSTRIAL+PARK,+GLENMARIE,+40150+Shah+Alam,+Selangor,+Malaysia/@3.086798,101.5723583,17z/data=!4m16!1m6!3m5!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!2sHORESTCO+FURNITURE!8m2!3d3.086798!4d101.574547!4m8!1m0!1m5!1m1!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!2m2!1d101.574547!2d3.086798!3e1">  
                    <abbr class="latitude" title="3.086795"><font color="#039be5">N 3° 086795</font></abbr>
                    <abbr class="longitude" title="101.574548"><font color="#039be5">E 101° 574548</font></abbr>
                    </a>
                  </li>
                </ul>
                
              </div>
              <div class="column1">
                <ul class="tel">
                  <li>
                      <span><b>Export Enquiries</b></span>
                  </li> 
                  
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/60169928921">  
                      <span class="value"><font color="#039be5">+60 169928921</font></span>
                    </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/60169134571">  
                      <span class="value"><font color="#039be5">+60 169134571</font></span>
                    </a> 
                  </li>
                </ul>
              </div>
            </div>
            <a href="https://www.google.com/maps/place/HORESTCO+FURNITURE/@3.086798,101.5723583,17z/data=!3m1!4b1!4m5!3m4!1s0x31cc4c5a8d40e179:0x5c4a780cc2ec2ea0!8m2!3d3.086798!4d101.574547"> 
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
                <span class="valign"></span>
              </a>
              <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
                
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
                <span class="valign"></span>
              </a>
              
              <!--  <a href="https://wa.me/60162240799">
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/whatsapp04.png" height="60" width="60" alt="Share on Facebook">&nbsp&nbsp  
                <span class="valign"></span>
              </a> -->
              
              <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
                <span class="valign"></span>
              </a>
              
              <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                <span class="valign"></span>
              </a>
              
              <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
                <span class="valign"></span>
              </a>
              
              <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
                <img style="width:40px;height:40px" src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
                <span class="valign"></span>
              </a>
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <img src="<?=server_img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
      </div><!-- /row -->

      <div class="row">

        <!-- col -->
        <div class="col s12 m6">
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel teal white-text">
            COVID 19 UPDATE:
            <p>
              As the coronavirus COVID-19 has grown to a pandemic level—impacting our daily lives at work and home—Horestco is doing its level best to support the safety and well-being of the communities in which we live, work, and serve. 
            </p> 
            <p>
              It’s paramount to us that you continue to receive the same level of support you are accustomed to, and we’re confident that with the measures we’ve put in place, we can mitigate this risk together without business disruption. 
              <strong>Shop online and we will deliver the goods with minimum to no disruption</strong>. 
            </p>
          </div>

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.0294910996336!2d101.57235831408946!3d3.0868033543951863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c5a8d40e179%3A0x5c4a780cc2ec2ea0!2sHORESTCO%20FURNITURE!5e0!3m2!1sen!2sid!4v1580171792684!5m2!1sen!2sid" width=200% height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>

          <div class="card-panel grey white-text">
            <span>Showroom, Warehouse & Light Furniture Manufacturing.</span><br/>
            Products manufactured in-house at this unit : <br>
            Stainless Steel Umbrellas,<br> 
            Wooden Tables Tops,<br> 
            Laminate Table tops,<br> 
            Upholstered furniture,<br>
            Loose Cushions etc. 
          </div>
        </div>
      </div><!-- /row -->
      
    </div>
    
</div>

<div id="bukit-bintang" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-BUKIT-BINTANG" class="vcard">

            <?php $contact = $this->config->item('bukit-bintang')  ?>
            
            <span class="fn n">
              <span class="given-name"><strong><b><?=$contact['given-name']?><br/></b></strong></span>
              <span class="additional-name"><b><?=$contact['additional-name']?></b></span>
            </span>
            <div class="adr">
              <span class="locality"><?=$contact['locality']?>, </span>
              <span class="street-address"><?=$contact['street-address']?>,<br></span>
              <span class="postal-code"><?=$contact['postal-code']?> </span>
              <span class="region"><?=$contact['region']?></span>
              <span class="country-name"><?=$contact['country-name']?></span>
            </div>
            <br/>
          
            <div class="flex-row row-card">
              <div class="column1">
                <ul class="tel">
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][0])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                      <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][0])?>">  
                        <span class="value"><font color="#039be5"><?=$contact['whatsapp'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                      <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][1])?>">  
                        <span class="value"><font color="#039be5"><?=$contact['whatsapp'][1]?></font></span>
                      </a> 
                  </li>
                  <li title="Email">
                      <i class="fa fa-envelope fa-lg"></i> 
                      <span class="type hide">Email</span>
                      <span>:</span>
                      <span class="value">
                      <a target="_blank" href="mailto:<?=$contact['email']?>?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                      <abbr><font color="#039be5"><?=$contact['email']?></font></abbr>
                      </a>
                      </span>
                  </li>
                  <li class="geo" title="geo">
                    <i class="fa fa-street-view fa-lg"></i>
                        <span>:</span>
                      <a target="_blank" href="<?=$contact['map_link']?>">
                        <abbr class="latitude" title="<?=$contact['lat'][0]?>"><font color="#039be5"><?=$contact['lat'][1]?></font></abbr>
                        <abbr class="longitude" title="<?=$contact['long'][0]?>"><font color="#039be5"><?=$contact['long'][1]?></font></abbr>
                      </a>
                  </li>
                </ul>
              </div>
              <div class="column1" style="background-color:#eee;">
                <ul class="tel">
                  <li>
                    <span><b>Export Enquiries</b></span>
                  </li> 
                  <li title="whatsapp">
                    <i class="fa fa-whatsapp fa-lg"></i>  
                    <span class="type hide">Whatsapp</span>
                    <span>:</span>
                    <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][2])?>">  
                    <span class="value"><font color="#039be5"><?=$contact['whatsapp'][2]?></font></span>
                  </a> 
                </li>
                <li title="whatsapp">
                    <i class="fa fa-whatsapp fa-lg"></i>  
                    <span class="type hide">Whatsapp</span>
                    <span>:</span>
                    <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][3])?>">  
                      <span class="value"><font color="#039be5"><?=$contact['whatsapp'][3]?></font></span>
                    </a> 
                </li>
                </ul>
              </div>
            </div>
            
            <a href="<?=$contact['map_link']?>">
              <img src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
              <img src="<?=server_img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
              <span class="valign"></span>
            </a>

            <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
              <img src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            
            <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
              <img src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            
            <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
              <img src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
              
            <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
              <img src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
              <span class="valign"></span>
            </a>
          
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <img src="<?=server_img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
      </div><!-- /row -->

      <div class="row">

        <!-- col -->
        <div class="col s12 m6">
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel teal white-text">
            COVID 19 UPDATE:
            <p>
              As the coronavirus COVID-19 has grown to a pandemic level—impacting our daily lives at work and home—Horestco is doing its level best to support the safety and well-being of the communities in which we live, work, and serve. 
            </p> 
            <p>
              It’s paramount to us that you continue to receive the same level of support you are accustomed to, and we’re confident that with the measures we’ve put in place, we can mitigate this risk together without business disruption. 
              <strong>Shop online and we will deliver the goods with minimum to no disruption</strong>. 
            </p>
          </div>
          <iframe width="100%" height="450"  src="<?=$contact['map_embed']?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

          <div class="card-panel grey white-text">
            <strong>Showroom.</strong><br/>
            Products displayed at this showroom:<br/>
            Outdoor Furniture,<br/>
            Built In Cabinetry,  <br/>
            Living Room furniture, <br/>
            Miscellaneous Loose furnitures etc. 
          </div>
        </div>
      </div><!-- /row -->
      
    </div>
    
</div>

<div id="Penang" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-PENANG" class="vcard">

            <?php $contact = $this->config->item('penang')  ?>
            
            <div class="flex-row row-card">
              <div class="column1">
                <strong>SHOWROOM:</strong><br/>
                <span class="fn n">
                  <span class="given-name"><strong><b><?=$contact['given-name']?><br/></b></strong></span>
                </span>
                <div class="adr">
                  <span class="street-address"><?=$contact['street-address']?>,<br></span>
                  <span class="locality"><?=$contact['locality']?> </span>
                  <span class="postal-code"><?=$contact['postal-code']?><br></span>
                  <span class="region"><?=$contact['region']?></span> 
                  <span class="country-name"><?=$contact['country-name']?></span>
                </div>
                <ul class="tel">
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][0])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][0])?>">  
                      <span class="value"><font color="#039be5"><?=$contact['whatsapp'][0]?></font></span>
                    </a> 
                  </li>
                  <li title="Email">
                      <i class="fa fa-envelope fa-lg"></i> 
                      <span class="type hide">Email</span>
                      <span>:</span>
                      <span class="value">
                      <a target="_blank" href="mailto:<?=$contact['email']?>?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                      <abbr><font color="#039be5"><?=$contact['email']?></font></abbr>
                      </a>
                      </span>
                  </li>
                  <li class="geo" title="geo">
                    <i class="fa fa-street-view fa-lg"></i>
                        <span>:</span>
                      <a target="_blank" href="<?=$contact['map_link']?>">
                        <abbr class="latitude" title="<?=$contact['lat'][0]?>"><font color="#039be5"><?=$contact['lat'][1]?></font></abbr>
                        <abbr class="longitude" title="<?=$contact['long'][0]?>"><font color="#039be5"><?=$contact['long'][1]?></font></abbr>
                      </a>
                  </li>
                </ul>
              </div>
            </div>
            
            <a href="<?=$contact['map_link']?>">
              <img src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
              <img src="<?=server_img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
              <span class="valign"></span>
            </a>

            <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
              <img src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            
            <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
              <img src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
            
            <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
              <img src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
              <span class="valign"></span>
            </a>
              
            <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
              <img src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
              <span class="valign"></span>
            </a>
          
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <img src="<?=server_img_url()?>pages/penang.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-wholesaler">
        </div>
      </div><!-- /row -->

      <div class="row">

        <!-- col -->
        <div class="col s12 m6">
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel teal white-text">
            COVID 19 UPDATE:
            <p>
              As the coronavirus COVID-19 has grown to a pandemic level—impacting our daily lives at work and home—Horestco is doing its level best to support the safety and well-being of the communities in which we live, work, and serve. 
            </p> 
            <p>
              It’s paramount to us that you continue to receive the same level of support you are accustomed to, and we’re confident that with the measures we’ve put in place, we can mitigate this risk together without business disruption. 
              <strong>Shop online and we will deliver the goods with minimum to no disruption</strong>. 
            </p>
          </div>
          <iframe width="100%" height="450"  src="<?=$contact['map_embed']?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        </div>
      </div><!-- /row -->
      
    </div>
    
</div>

<div id="Langkawi" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-LANGKAWI" class="vcard">

            <?php $contact = $this->config->item('langkawi')  ?>
            
            <div class="flex-row row-card">
              <div class="column1">
                <strong>Distributor Showroom:</strong><br/>
                <span class="fn n">
                  <span class="given-name"><strong><b><?=$contact['given-name']?><br/></b></strong></span>
                </span>
                <div class="adr">
                  <span class="street-address"><?=$contact['street-address']?>,<br></span>
                  <span class="locality"><?=$contact['locality']?> </span>
                  <span class="postal-code"><?=$contact['postal-code']?> </span>
                  <span class="region"><?=$contact['region']?>, <br/></span> 
                  <span class="country-name"><?=$contact['country-name']?></span>
                </div>
                <ul class="tel">
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][0])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="Email">
                      <i class="fa fa-envelope fa-lg"></i> 
                      <span class="type hide">Email</span>
                      <span>:</span>
                      <span class="value">
                      <a target="_blank" href="mailto:<?=$contact['email']?>?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                      <abbr><font color="#039be5"><?=$contact['email']?></font></abbr>
                      </a>
                      </span>
                  </li>
                  <li class="geo" title="geo">
                    <i class="fa fa-street-view fa-lg"></i>
                        <span>:</span>
                      <a target="_blank" href="<?=$contact['map_link']?>">
                        <abbr class="latitude" title="<?=$contact['lat'][0]?>"><font color="#039be5"><?=$contact['lat'][1]?></font></abbr>
                        <abbr class="longitude" title="<?=$contact['long'][0]?>"><font color="#039be5"><?=$contact['long'][1]?></font></abbr>
                      </a>
                  </li>
                </ul>

                <div class="icons">
                  <a href="<?=$contact['map_link']?>">
                    <img src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
                    <img src="<?=server_img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>

                  <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
                    <img src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                    <img src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
                    <img src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                    
                  <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
                    <img src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
                    <span class="valign"></span>
                  </a>
                </div>
              </div>
            </div>
          
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <img src="<?=server_img_url()?>pages/malaysia-furniture-wholesaler.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-langkawi">
        </div>
      </div><!-- /row -->

      <div class="row">

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <div class="card-panel teal white-text">
            Please call to arrange an appointment if visiting after working hours.
            Parking available.<br>
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <iframe width="100%" height="450"  src="<?=$contact['map_embed']?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div><!-- /row -->
      
    </div>
    
</div>

<div id="Indonesia" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-INDONESIA" class="vcard">

            <?php $contact = $this->config->item('indonesia')  ?>
            
            <div class="flex-row row-card">
              <div class="column1">
                <strong>Factory &amp; Showroom:</strong><br/>
                <span class="fn n">
                  <span class="given-name"><strong><b><?=$contact['given-name']?><br/></b></strong></span>
                </span>
                <div class="adr">
                  <span class="street-address"><?=$contact['street-address']?>,<br></span>
                  <span class="locality"><?=$contact['locality']?> </span>
                  <span class="region"><?=$contact['region']?> </span> 
                  <span class="postal-code"><?=$contact['postal-code']?> </span>
                  <span class="country-name"><?=$contact['country-name']?></span>
                </div>
                <ul class="tel">
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][0])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="https://wa.me/<?=preg_replace('/-|\s|\+/', '', $contact['whatsapp'][0])?>">  
                      <span class="value"><font color="#039be5"><?=$contact['whatsapp'][0]?></font></span>
                    </a> 
                  </li>
                  <li title="Email">
                      <i class="fa fa-envelope fa-lg"></i> 
                      <span class="type hide">Email</span>
                      <span>:</span>
                      <span class="value">
                      <a target="_blank" href="mailto:<?=$contact['email']?>?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                      <abbr><font color="#039be5"><?=$contact['email']?></font></abbr>
                      </a>
                      </span>
                  </li>
                  <li class="geo" title="geo">
                    <i class="fa fa-street-view fa-lg"></i>
                        <span>:</span>
                      <a target="_blank" href="<?=$contact['map_link']?>">
                        <abbr class="latitude" title="<?=$contact['lat'][0]?>"><font color="#039be5"><?=$contact['lat'][1]?></font></abbr>
                        <abbr class="longitude" title="<?=$contact['long'][0]?>"><font color="#039be5"><?=$contact['long'][1]?></font></abbr>
                      </a>
                  </li>
                </ul>

                <div class="icons">
                  <a href="<?=$contact['map_link']?>">
                    <img src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  <a href="https://www.waze.com/livemap/directions/malaysia/selangor/shah-alam/horestco-industries-sdn.-bhd.?place=ChIJoTtX9FpMzDERt-gB2C7p5sQ&utm_campaign=waze_website&utm_source=waze_website"_blank" title="Waze">
                    <img src="<?=server_img_url()?>socials/waz.png" alt="waze">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>

                  <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
                    <img src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                    <img src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
                    <img src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                    
                  <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
                    <img src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
                    <span class="valign"></span>
                  </a>
                </div>
              </div>
            </div>
          
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <img src="<?=server_img_url()?>pages/dealership-tenon-mortise-machine.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-langkawi">
        </div>
      </div><!-- /row -->

      <div class="row">

        <!-- col -->
        <div class="col s12 m6">
          <div class="card-panel grey white-text">
            <span>Opening Times:</span><br/>
            Monday to Saturday :  9 am - 6 pm<br/>
            Sundays and Public Holidays : Closed. 
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel teal white-text">
            Please call to arrange an appointment if visiting after working hours.
            Parking available.<br>
          </div>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <iframe width="100%" height="450"  src="<?=$contact['map_embed']?>" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <!-- col -->
        <div class="col s12 m12">
          <div class="card-panel grey white-text">
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
      </div><!-- /row -->
      
    </div>
    
</div>

<div id="Maldives" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-MALDIVES" class="vcard">

            <?php $contact = $this->config->item('maldives')  ?>
            
            <div class="flex-row row-card">
              <div class="column1">
                <strong>SALES REPRESENTATIVE :</strong><br/>
                <span class="fn n">
                  <span class="given-name"><strong><b><?=$contact['given-name']?><br/></b></strong></span>
                </span>
                <div class="adr">
                  <span class="street-address"><?=$contact['street-address']?>,<br></span>
                  <span class="locality"><?=$contact['locality']?>, </span>
                  <span class="region"><?=$contact['region']?>, </span> 
                  <span class="postal-code"><?=$contact['postal-code']?><br/></span>
                  <span class="country-name"><?=$contact['country-name']?></span>
                </div>
                <ul class="tel">
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][0])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][0]?></font></span>
                      </a> 
                  </li>
                  <li title="Email">
                      <i class="fa fa-envelope fa-lg"></i> 
                      <span class="type hide">Email</span>
                      <span>:</span>
                      <span class="value">
                      <a target="_blank" href="mailto:<?=$contact['email']?>?subject=Customer Horestco&body=Dear Horestco Industri,%0d%0a%0d%0aCustomer Name    :%0d%0aCustomer Address :%0d%0aCustomer Phone    :%0d%0aCustomer Info Request :">
                      <abbr><font color="#039be5"><?=$contact['email']?></font></abbr>
                      </a>
                      </span>
                  </li>
                </ul>

                <div class="icons">
                  
                  <a href="https://www.facebook.com/HorestcoFurniture" target="_blank" Title="Share on Facebook">
                    <img src="<?=server_img_url()?>socials/fb.png" alt="Share on Facebook">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://twitter.com/HorestcoMY" target="_blank" Title="Share on Twitter">
                    <img src="<?=server_img_url()?>socials/twitter05.png" alt="Share on Twitter">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  
                  <a href="https://www.instagram.com/horestco_industries/" target="_blank" Title="Share on Instagram">
                    <img src="<?=server_img_url()?>socials/instagram05.png" alt="Share on Instagram">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                    
                  <a href="https://id.pinterest.com/thehorestco/" target="_blank" Title="Share on Pinteres">
                    <img src="<?=server_img_url()?>socials/pinterest05.png" alt="Share on Pinterest">  
                    <span class="valign"></span>
                  </a>
                </div>
              </div>
            </div>
          
          </div>
          <!-- End Vcard -->
        </div>

        <!-- col -->
        <div class="col s12 m6">
          <!-- <img src="<?=server_img_url()?>pages/dealership-tenon-mortise-machine.jpg" class="responsive-img z-depth-1" alt="malaysia-furniture-langkawi"> -->
        </div>
      </div><!-- /row -->
      
    </div>
    
</div>
    
  
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