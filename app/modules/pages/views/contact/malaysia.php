<div id="Malaysia" class="tabcontent">
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