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