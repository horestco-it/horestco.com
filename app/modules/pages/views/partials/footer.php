<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NDQHT5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>


<!--  Google Tag manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NDQHT5');</script>

<?php
$contact = $this->config->item('indonesia');
?>

<footer class="page-footer grey darken-4 section" id="footer">

    <div class="container">
      <div class="row">

        <div class="col s12 l6 grey-text text-lighten-2">
          <?php if( $this->uri->segment(1) == 'contact-furniture-manufacturer' ): ?>
          <?php else: ?>
          <h5>CONTACT</h5>
            <?=$contact['given-name'] ?><br/>
            <?=$contact['street-address']?>, <?=$contact['locality']?>, <?=$contact['region'] ?>, <?=$contact['postal-code']?>, <?=$contact['country-name']?><br>
          <i class="mdi-communication-phone"></i> <?=$contact['phones'][0]?><br>
          <i class="mdi-communication-email"></i>
           <!-- info@horestco.com -->
          <a href="mailto:info@horestco.com" style="color: #e0e0e0;"> info@horestco.com</a>
          <?php endif ?>
        </div>

        <div class="col s12 m3 l3 hide-on-print">
          <h5 class="white-text">CONNECT</h5>
          <ul class="nav-lists">
            <li><a href="/catalog-downloads" style="text-decoration: none;">Catalog Downloads</a></li>
            <li><a href="/furniture-delivery" style="text-decoration: none;">Delivery</a></li>
            <li><a href="/premium-furniture-materials" style="text-decoration: none;">Materials</a></li>
            <li><a href="/furniture-company-jobs" style="text-decoration: none;">Careers</a></li>
          
          </ul>
        </div>
        <div class="col s12 m3 l4 hide-on-print">
          <h5 class="white-text hide-on-small-and-down">&nbsp;</h5>
          <ul class="nav-lists" style="margin-top:0">
            <li><a href="/furniture-dealership" style="text-decoration: none;">Dealership</a></li>
            <li><a href="/malaysia-furniture-promotions" style="text-decoration: none;">Clearance</a></li>
            <li><a href="/sitemap" style="text-decoration: none;">Sitemap</a></li>
            <li><a href="/RefundPolicy" style="text-decoration: none;">Refund Policy</a></li>
          
          </ul>
        </div>

      </div>
    </div>

  <div class="footer-copyright" style="font-size:12px">
    <div class="container">
    © <?=date('Y')?> PT. Horestco, <strong>Furniture Manufacturer - Outdoor Furniture and Restaurant Furniture - Indonesia, Malaysia, India</strong>
    </div>
  </div>

</footer>

<script src="<?=script_url('jquery.min.js')?>"></script>
<script src="<?=script_url('materialize.min.js')?>"></script>
<script src="<?=script_url('scripts.js')?>"></script>
