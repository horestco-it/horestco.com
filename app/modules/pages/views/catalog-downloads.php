<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($this->uri->segment(1)) ?>
  
  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>background/sun-lounger-blured.jpg');
        background-attachment: fixed;
        background-position: center;
        background-position-y: 0;
        background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
</head>
<body>

<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

<div class="section lead background-image">
  <div class="container">
    <div class="row">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">CATALOG DOWNLOADS</h3>
        <h5 class="lead-sub-heading">
          Discover a wide range of the products that you can find at <span class="tonjol">horestco.com</span> and in our showroom.
          Clearly structured, includes all the necessary basic information
        </h5>
        <div class="lead-btn-wrapper">
          <a href="<?=base_url('files/horestco-catalog_2016.pdf')?>" download class="btn btn-large waves-effect waves-light green lighter-3">
            <i class="mdi-action-get-app right"></i>  DOWNLOAD</a>
        </div>
        <h5 class="lead-sub-heading">
          Download and save it on your device as a convenient reference for offline viewing.
        </h5>
      </div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col s12 center" style="font-size:20px;line-height:34px">
        <p class="lead-sub-heading">
          Allow yourself a few moments to browse our catalog and your life will open to a world of stylish possibilities.
          All this will happen with a simple click and indulge your imagination with a little “wow”.
        </p>
      </div>
      <div class="col s12 center">

      <a class="btn-floating btn-large waves-effect waves-light grey hide-on-med-and-down" href="#synthetic-wicker">
        <i class="mdi-navigation-expand-more"></i>
      </a>
        
      </div>
    </div>
  </div>
</section>


<section id="synthetic-wicker" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
        <img src="<?=base_url().img_url()?>pages/materials-synthetic-wicker.jpg" alt="synthetic wicker furniture" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Synthetic Wicker:</h5>
        <p>
          Our woven furniture is made from the highest quality wicker fibres. This remarkable material is soft and gentle to touch and has additional benefits which include tear resistance, UV resistance and weather resistance. 
        </p>
        <div class="row">
          <div class="col s12 m8 l5">
            <div class="collection">
             
            <a href="<?=base_url('files/material catalogue/viro-furniture-catalogue-2024.pdf')?>" download class="collection-item" aria-label="Viro Furniture Catalogue 2024 - Katalog furnitur Viro untuk 2024">
            <i class="mdi-action-get-app"></i>  Download the Viro® catalogue 2024
          </a>
              <a href="<?=base_url('files/material catalogue/viro-fiber-furniture-catalogue-2022.pdf')?>" download class="collection-item" aria-label="Viro Fiber Furniture Catalogue 2022 - Katalog furnitur serat Viro edisi 2022">
                <i class="mdi-action-get-app"></i>  Download the Viro® fiber catalogue
              </a>
              <a href="<?=base_url('files/material catalogue/viro-furniture-products-catalogue.pdf')?>" download class="collection-item" aria-label="Viro Furniture Products Catalogue - Katalog produk furnitur dari Viro">
                <i class="mdi-action-get-app"></i>  Download the Viro® product catalogue
              </a>
              <a href="<?=base_url('files/material catalogue/viro-weaving-pattern-catalogue-2022.pdf')?>" download class="collection-item" aria-label="Viro Weaving Pattern Catalogue 2022 - Katalog pola anyaman Viro edisi 2022">
                <i class="mdi-action-get-app"></i>  Download the Viro® weaving pattern catalogue

                <a href="<?=base_url('files/material catalogue/viro-natura-furniture-brochure.pdf')?>" download class="collection-item" aria-label="Viro Natura Furniture Brochure - Brosur produk furnitur alami dari Viro">
                <i class="mdi-action-get-app"></i>  Download the Viro® Viro Naturra catalogue
              <a href="<?=base_url('files/material catalogue/raucord-classic-colour-card.pdf')?>" download class="collection-item" aria-label="Raucord Classic Colour Card - warna klasik untuk produk Raucord"><i class="mdi-action-get-app"></i>  Download the Rehau® colour card classic</a>
              <a href="<?=base_url('files/material catalogue/raucord-natural-fiber-furniture.pdf')?>" download class="collection-item" aria-label="Raucord Natural Fiber Furniture - Informasi produk furnitur dari serat alami Raucord"><i class="mdi-action-get-app"></i>  Download the Rehau® natural collection</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
        <a href="<?=base_url().img_url()?>pages/cushion-sunbrella2x.jpg">
          <img alt="fabric cushion furniture" 
          src="<?=base_url().img_url()?>pages/cushion-sunbrella.jpg" 
          srcset="<?=base_url().img_url()?>pages/cushion-sunbrella.jpg 2x, <?=base_url().img_url()?>pages/cushion-sunbrella2x.jpg 3x" 
          class="responsive-img">
        </a>
      </div>
      <div class="col s12 m10">
        <h5>Fabric:</h5>
        <p>
          Our range of luxury cushions adds classy touch to your furniture. In our outdoor furniture, we use Sunbrella® and Sunproof®, the leaders in the market, for performance fabrics. Want to know the best part, here we go, they are colourfast, water repellent and UV resistant, standing up to the harsh outdoor weather conditions. Available in a range of outstanding solid colours, stripes and jacquards, designed only for the best furniture.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
                   <a href="<?=base_url('files/material catalogue/sunbrella-european-furniture-catalogue.pdf')?>" class="collection-item" aria-label="Sunbrella European Furniture Catalogue - Katalog furnitur Sunbrella edisi Eropa" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunbrella® Europan catalogue.
                  </a>
                  <a href="<?=base_url('files/material catalogue/sunbrella-furniture-fabric-catalogue.pdf')?>" class="collection-item" aria-label="Sunbrella Furniture Fabric Catalogue - Katalog kain furnitur Sunbrella" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunbrella® catalogue collection.
                  </a>
                  <a href="<?=base_url('files/material catalogue/premium-furniture-catalogue-ED2024-horestco.pdf')?>" class="collection-item" aria-label="Premium Furniture Catalogue ED2024 Horestco - Katalog furnitur premium terbaru edisi 2024" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunproof® catalogue collection.
                  </a>
                  <a href="<?=base_url('files/material catalogue/outdoor-acrylic-fabric-catalog-2023.pdf')?>" class="collection-item" aria-label="Outdoor Acrylic Fabric Catalog 2023 - Katalog kain akrilik outdoor terbaru" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunproof® Acrylic Fabric collection.
                  </a>
                  <a href="<?=base_url('files/material catalogue/sling-sunproof-furniture-material.pdf')?>" class="collection-item" aria-label="Sling Sunproof Furniture Material - Informasi material furnitur" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunproof® Sling collection.
                  </a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>   




<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      <img src="<?=base_url().img_url()?>pages/materials-marbels-and-granites.jpg" alt="Marbles and granites" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Marbles and Granites:</h5>
        <p>
        We often make furniture with Marble and Granite Tops. We are able to source local Indonesian and Malaysian marbles as well as imported Italian, Egyptian or Indian Marbles and granites upon request.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
              <a href="<?=base_url('files/material catalogue/stone-table-tops-catalogue.pdf')?>" class="collection-item" aria-label="Stone Table Tops Catalogue - Katalog meja dengan pilihan material" target='_blank'><i class="fa fa-download left"></i>  Download Premium material Terazzo®  </a>
             <a href="<?=base_url('files/material catalogue/giza-porcelain-stone-table-tops.pdf')?>" class="collection-item" aria-label="Giza Porcelain Stone Table Tops - Katalog meja dengan material batu porselen Giza" target='_blank'><i class="fa fa-download left"></i>  Download Table Top Gizza® </a>
             <a href="<?=base_url('files/material catalogue/quadra-e-catalog-furniture-2024.pdf')?>" class="collection-item" aria-label="Quadra E-Catalog Furniture 2024 - Katalog furnitur terbaru dari Quadra" target='_blank'><i class="fa fa-download left"></i>  Download the Countertop Quadra® </a>
             <a href="<?=base_url('files/material catalogue/summit-rustique-furniture-catalog-2023.pdf')?>" class="collection-item" aria-label="Summit Rustique Furniture Catalog 2023 - Katalog furnitur bergaya rustik untuk 2023" target='_blank'><i class="fa fa-download left"></i>  Download the Summit Rustique® </a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>  


<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      <img src="<?=base_url().img_url()?>pages/materials-stainless-steal.jpg" alt="Stainless Steel #304" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Stainless Steel #304:</h5>
        <p>
        We use marine grade 304 stainless steel in our furniture. It is highly resistant to corrosion and easy to maintain. It is precisely made using Argon gas Tig welding and comes in hairline or mirror finish surfaces. Certification of grade authenticity of our stainless steel profiles are available upon request.
        </p>
        <div class="row">
          
        </div>
      </div>
      
    </div>
  </div>
</section> 

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      <img src="<?=base_url().img_url()?>pages/materials-furniture-furnishing.jpg" alt="furniture finishing" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Furniture Finishing:</h5>
        <p>
        Our furniture finishing team has expertise in various types of water and oil based wood surface finishes, varnishes and stains including Nitrocellulose(NC), Polyuretherane, Lacquer and Shellac. Our outdoor teak furniture is finely sanded and waxed without any further finishing process leaving the natural grains visible.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
            <a href="<?=base_url('files/material catalogue/furniture-finishing-options.pdf')?>" class="collection-item" aria-label="Furniture Finishing Options - Pilihan opsi finishing furnitur untuk berbagai kebutuhan" target='_blank'><i class="fa fa-download left"></i>  Download the Timber Finishing® </a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section> 


<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      <img src="<?=base_url().img_url()?>pages/materials-alumunium.jpg" alt="aluminium furniture" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Aluminium:</h5>
        <p>
        Aluminium is a highly malleable metal. It is corrosion resistant and can be easily made into various shapes and sizes. We use powder coated non-anondised aluminium in our outdoor furniture frames.
        </p>
        <div class="row">
        </div>
      </div>
      
    </div>
  </div>
</section> 


<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      
      </div>
      <div class="col s12 m10">
        <h5>Foams:</h5>
        <p>
        Foams that comply with different countries standards are available upon request. We recommend Quck Dry Foam - for outdoor and sea-side use of furniture.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
            <a href="<?=base_url('files/material catalogue/urecel-quickdry-furniture-material-brochure.pdf')?>" class="collection-item" aria-label="Urecel Quickdry Furniture Material Brochure - Brosur material furnitur dengan teknologi pengeringan cepat" target='_blank'><i class="fa fa-download left"></i>  Download The Brochure  </a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section> 

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      
      </div>
      <div class="col s12 m10">
        <h5>Serafil Threads:</h5>
        <p>
        We use serafil threads manufactured by Amann Group, Germany for outdoor cushions and parasols. Serafil threads are multifilament sewing threads that are highly durable and resistant to weather. The water repellent version Serafil WR is a basic requirement for water-tight seams.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
          
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section> 

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      
      </div>
      <div class="col s12 m10">
        <h5>Leather:</h5>
        <p>
        We are able to source various leathers produced in Indonesia, India and Italy. For more information about various leathers, <a href="<?=base_url('files/material catalogue/OUTDOOR SYNTHETIC LEATHER UPHOLSTERY.pdf')?>">click here</a>. Should you require samples of any of the above mentioned materials, please feel free to contact us and we will post them to your address.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
            <a href="<?=base_url('files/material catalogue/outdoor-synthetic-leather-upholstery-catalogue.pdf')?>" class="collection-item" aria-label="Outdoor Synthetic Leather Upholstery Catalog - Katalog kulit sintetis untuk outdoor" target='_blank'>
                    <i class="fa fa-download left"></i>  Download the Sunproof® Synthetic Leather</a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section> 

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      
      </div>
      <div class="col s12 m10">
        <h5>Fittings:</h5>
        <p>
        Our fittings are made from either stainless steel #304 or Solid Brass – often custom-made for our products. Certain off the shelf aluminium alloy fittings may also be used especially door and drawer handles. Hinges and drawer rails are sourced from Hafele or equivalent quality suppliers.
        </p>
        <div class="row">
          
        </div>
      </div>
      
    </div>
  </div>
</section> 

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
      
      </div>
      <div class="col s12 m10">
        <h5>High Pressure Laminate (HPL):</h5>
        <p>
        High Pressure Laminate is a surface solution with extensive choice of color, pattern and textures. Its advantages include its non-porosity, overall durability, impact and stain resistance. 
              F&B outlets prefer these table tops for being easy to clean & maintain. 
              We use laminates 
              from <a href="<?=base_url('files/wilson-art-catalog.pdf')?>" target="_blank">WilsonArt (USA)</a> 
              and <a href="<?=base_url('files/catalog-arborite.pdf')?>" target="_blank">Arborite (Canada)</a>.
        </p>
        <div class="row">
          
        </div>
      </div>
      
    </div>
  </div>
</section> 


<?php $this->load->view('partials/footer') ?>
<script>
  $(document).ready(function(){
    $('.scrollspy').scrollSpy();
  });
</script>
</body>
</html>
