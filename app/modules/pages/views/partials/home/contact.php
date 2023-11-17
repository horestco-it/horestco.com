<?php
$contact = $this->config->item('indonesia');
?>

<section class="section center blue" id="contact">
  <div class="container contact-container">
    <div class="row">
      <div class="col s12">
        <h3>CONTACT US</h3>
      </div>
    </div>
    <div class="row black-text">
      <div class="col s12">
        <?=$contact['given-name']?><br>
        <?=$contact['street-address']?>, <?=$contact['locality']?>, <?=$contact['region'] ?>, <?=$contact['postal-code']?>, <?=$contact['country-name']?>
        <br>
        <i class="mdi-communication-phone"></i> <?=$contact['phones'][0]?><br>
        <i class="mdi-communication-email"></i> info@horestco.com<br>
      </div>
      <div class="col s12">
        <div class="contact-post">
          <a class="blue waves-effect waves-light btn" id="newsletter-btn" href="http://goo.gl/forms/njbeaOJMd8" target="_blank"><i class="fa fa-send"></i> NEWSLETTER</a>
        </div>
      </div>
    </div>
  </div>
</section>

 <!-- Modal contact -->
<div id="contact-post-modal" class="modal modal-fixed-footer">
  <div class="modal-content"></div>
  <div class="modal-footer">
    <a href="javascript:void(0)" class="grey modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
  </div>
</div>

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NDQHT5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!--  Google Tag manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NDQHT5');</script>