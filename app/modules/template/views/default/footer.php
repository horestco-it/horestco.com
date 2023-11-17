
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NDQHT5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<?php ob_start() ?>

<!--  Google Tag manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NDQHT5');</script>



<?php $contact = $this->config->item('indonesia'); ?>

<footer class="page-footer grey darken-4 section" id="footer">

    <div class="container">
      <div class="row">

        <div class="col s12 l6 grey-text text-lighten-2">
          <h5>CONTACT</h5>
          <?=$contact['given-name'] ?><br/>
            <?=$contact['street-address']?>, <?=$contact['locality']?>, <?=$contact['region'] ?>, <?=$contact['postal-code']?>, <?=$contact['country-name']?><br>
          <i class="mdi-communication-phone"></i> <?=$contact['phones'][0]?><br>
          <i class="mdi-communication-email"></i> <a href="mailto:info@horestco.com" style="color: #e1e0e0;"> info@horestco.com</a><br>
        </div>

        <div class="col s12 l3 hide-on-print">
          <h5 class="white-text">CONNECT</h5>
          <ul class="nav-lists">
            <li><a href="<?=base_url('malaysia-furniture-faqs')?>" style="text-decoration: none;">FAQ</a></li>
            <li><a href="/catalog-downloads" style="text-decoration: none;">Catalog Downloads</a></li>
            <li><a href="/furniture-delivery" style="text-decoration: none;">Delivery</a></li>
            <li><a href="/premium-furniture-materials" style="text-decoration: none;">Materials</a></li>
            <li><a href="/furniture-company-jobs" style="text-decoration: none;">Careers</a></li>
            <li><a href="/furniture-dealership" style="text-decoration: none;">Dealership</a></li>
            <li><a href="/malaysia-furniture-promotions" style="text-decoration: none;">Clearance</a></li>
            <li><a href="/sitemap">Sitemap</a></li>
          </ul>
        </div>

      </div>
    </div>

  <div class="footer-copyright">
    <div class="container">
    © <?=date('Y')?> horestco.com - <strong>Furniture Manufacturer - Outdoor Furniture and Restaurant Furniture - Indonesia, Malaysia, India</strong>
    </div>
  </div>

</footer>


</body>
</html>

<?php echo minify_html(ob_get_clean()); ?>