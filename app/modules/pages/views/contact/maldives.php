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