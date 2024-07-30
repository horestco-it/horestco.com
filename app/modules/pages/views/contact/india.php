<div id="India" class="tabcontent">
  <div class="col s12 section">
  
      <div class="row">
        <!-- col -->
        <div class="col s12 m6">
          <!-- BEGIN VCARD -->
          <div id="hcard-HORESTCO-LANGKAWI" class="vcard">

            <?php $contact = $this->config->item('india')  ?>
            
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
                  <li title="Phone">
                      <i class="fa fa-phone fa-lg"></i>  
                      <span class="type hide">Phone</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['phones'][1])?>"> 
                      <span class="value"><font color="#039be5"><?=$contact['phones'][1]?></font></span>
                      </a> 
                  </li>
                  <li title="Whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                      <a href="tel:<?=preg_replace('/-|\s/', '',$contact['whatsapp'][0])?>"> 
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
                        <abbr class="latitude" title="34°00'51.0"N"><font color="#039be5">34°00'51.0"N</font></abbr>
                        <abbr class="longitude" title="75°00'53.9"E"><font color="#039be5">75°00'53.9"E</font></abbr>
                      </a>
                  </li>
                </ul>

                <div class="icons">
                  <a href="<?=$contact['map_link']?>">
                    <img src="<?=server_img_url()?>socials/mp.png" alt="google maps">&nbsp&nbsp  
                    <span class="valign"></span>
                  </a>
                  <a href="<?=$contact['map_link']?>" title="map">
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
              <div class="column1">
                <ul class="tel">
                  <li>
                      <span><b>Export Enquiries</b></span>
                  </li> 
                  
                  <li title="whatsapp">
                      <i class="fa fa-whatsapp fa-lg"></i>  
                      <span class="type hide">Whatsapp</span>
                      <span>:</span>
                    <a href="<?=preg_replace('/-|\s/', '',$contact['whatsapp'][1])?>">  
                      <span class="value"><font color="#039be5"><?=$contact['whatsapp'][1]?></font></span>
                    </a> 
                  </li>
                </ul>
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