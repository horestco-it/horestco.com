<?php

use Illuminate\Support\Str;

 $this->load->view( config_item('theme').'header' ) ?>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="<?=script_url('html5shiv.js')?>"></script>
    <script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url("slide-index/slide2-1.jpg")?>');
        background-attachment: fixed;
        background-position: center;
    }
  </style>

<?php $this->load->view( config_item('theme').'nav' ) ?>

<section class="section lead background-image">
  <div class="container">
    <div class="row">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">OUR PORTFOLIO</h3>
        <h5 class="lead-sub-heading">
          If you are looking for furniture for a project, please send us the architectural drawings, B.O.Q. and other related information, so that we can advise or quote in a timely manner.
        </h5>
      </div>
    </div>
  </div>
</section>

<section class="container section">
  <div class="row">

  	<div class="col s12 center">
      <p>
        Over the years, we have worked with numerous hotels, restaurants and others in the hospitality sector to design and manufacture furniture that fits their purpose. Our regular clients choose us due to our efficiency in manufacturing and delivering cost-effective and commercial-grade furniture with large customisation options
      </p>
  	</div>

  	<div class="col s12">
  		<h5>Our Clients Include:</h5>
  		<ol>
  			<?php foreach ($portfolio as $key => $porto): ?>
  				<?php if ($porto->name != 'portfolio'): ?>
  				<li> <a href="<?=base_url('client/'.Str::slug($porto->slug))?>"><?=$porto->name?></a></li>
  				<?php endif ?>
  			<?php endforeach ?>
        <li><a href="<?=base_url('portfolio/restaurant-furniture')?>" class="grey-text">More...</a></li>
      </ol>
  	</div>

  	<div class="col s12">
  		<p>
  		
				At Horestco, we understand a designer's vision and fabricate furniture that realises the purpose in the most cost-effective manner, providing the crucial reinterpretation between a designer's goals and a craftsman's skills and limitations. We are open to sharing our knowledge and expertise of art and science of furniture making to help yourself in sourcing your furniture - whether it is made from us or from our competitors.
				<br>
				We provide complete information about the different furniture materials that go into the fabrication process, fabrics, construction and designs. Many of our now standard furniture models have come about through various interior designers and architects. We also offer free downloads of 3D images of our products for our clients and designers, suitable for use with most CAD and design softwares. These 3D images can be provided plain, allowing you to render them in the colours, fabrics and stains you require to complement the theme of your project. For any enquiries regarding our 3D Images, please contact us.
  		</p>
	    <p>
			  At Horestco, we understand  a designer's vision and fabricate furniture that realises the purpose in the most cost-effective manner, providing the crucial reinterpretation between a designer's goals and a craftsman's skills and limitations. We  are open to sharing our knowledge and expertise of art and science of furniture making to help yourself in sourcing your furniture - whether it is made from us or from our competitors. <br />
			  We provide complete information about the different furniture materials that go into the fabrication process, fabrics, construction and designs. Many of our now standard furniture models have come about through various interior designers and architects. We also offer free downloads of 3D images of our products for our clients and designers, suitable for use with most CAD and design softwares. These 3D images can be provided plain, allowing you to render them in the colours, fabrics and stains you require to complement the theme of your project. For any enquiries regarding our 3D Images, please contact us.
	    </p>
	    <p>
			  Most of our furniture is made from <strong>premium materials </strong>that are most suitable for heavy duty commercial use such as <strong>Grade A Teak wood (Tectona Grandis), Stainless Steel grade 304 (Inox), Viro&reg; and Rehau Raucord&reg; Synthetic rattan.</strong> We are able to source Hafele<strong>&reg;</strong> or Bluum<strong>&reg;</strong> furniture hardware fittings wherever required. <br />
	    </p>
	    <p>
			  Commercial grade furniture is very different in construction, fabrication process and selection of materials. It is often simple in design but  made from high grade materials and constructed with the most suitable welding and joinery process to give it the durability demanded in a commercial setting.  
	      <br/>
			  <strong>Our furniture can be found in condominium poolside areas all over Malaysia, restaurants as far as Mombasa, Africa and Brisbane, Australia and cruise ships in Maldives.</strong> It is not because of our strategic location or slick marketing, but due to our consistent high quality, competitive pricing, pre &amp; post sales services and the good word put out by our satisfied customers.
	    </p>
  	</div>

  </div>
 </section>


<?php $this->load->view( config_item('theme').'script' ) ?>
<?php $this->load->view( config_item('theme').'footer' ) ?>