<?php $this->load->view('template/default/header.php') ?>
<style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>slide-index/bar-chair.jpg');
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
  </style>
<?php $this->load->view('template/default/nav.php') ?>

  <div class="section lead background-image">
    <div class="container">
      <div class="row">
        <div class="col s12 center white-text">
          <h3 class="lead-heading">ABOUT US</h3>
          <h5 class="lead-sub-heading">
            Horestco is a young but reputable company with a team that has many years of first 
          hand experience in the furniture manufacturing and hospitality industry
          </h5>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="parallax"><img src="<?=img_url('slide-index/slide3-1.jpg')?>"></div> -->

<section class="section container">
  <div class="row">

    <div class="col s12 center">
      <p>
        We specialize in manufacturing genuine high quality and heavy-duty classic wooden and rattan furniture as well as innovative and contemporary stainless steel and synthetic wicker furniture to furnish commercial spaces, hotels, resorts and restaurants.
        With Kaizen, the Japanase philosophy of constant improvement as a guiding force, 
        we continuously improve our products and services with feedback from our clients. 
        Nothing motivates us more than  watching people happily using our furniture for years.
        <br>
          Maintaining high standards of production practices, 
          we aspire to serve the hospitality market with a variety of choices, designs and materials to choose from.
      </p>
    </div>  

    <div class="col s12">
      <h5>Why choose us?</h5>        
      <p>
        We listen to and understand a client's goals, 
        concerns and the end-use of the furniture and its environment. 
        We manufacture furniture at highly competitive prices without compromising quality. 
        We take pride in what we do and we only make what we are best at. 
        We will ensure that your furniture has been made only by the best craftsmen, 
        skilled and dedicated in their craft. 
        We are more than willing to manufacture specific custom designs or custom make our standard furniture to suit our customer's needs.
        <br>
        For a selection of furniture that we have made for various projects, 
        please visit our <a href="<?=base_url('portfolio')?>">contract furniture</a> page.
      </p>
    </div>

    <div class="col s12 m6 l3">
      <h5>Our Clients</h5>
      <p>
        Our clients are mostly individual home owners, restaurants, hotels and condominiums that are very discerning in their taste and quality of furniture. Our regular clients choose us for the consistent quality and cost effectivess of our furniture.
      </p>
    </div>

      
    <div class="col s12 m6 l3">
      <h5>Manufacturing Facilities</h5>
      <p>
        We have a production facility of 4500 sq.m.with a highly experienced team of carpenters, welders, weavers, quality control managers and furniture finishing specialists in Jepara, Central Java, Indonesia - the furniture manufacturing hub of Indonesia.
      </p>
    </div>
    <div class="col s12 m6 l3">
      <h5>Capacity</h5>
      <p>
        We have a capacity to produce upto five 40ft. containers/month of contract grade furniture  which can be increased upon demand given the time.
      </p>
    </div>
      
    <div class="col s12 m6 l3">
      <h5>Quality Control</h5>

      <p>
        We understand the importance of consistent quality and on-time delivery. Our quality inspectors are dedicated and highly experienced. We are able to maintain a consistent quality with good workmanship and strong construction.
      </p>
    </div>

  </div>
</section>

<?php $this->load->view('template/default/script') ?>
<?php $this->load->view('template/default/footer') ?>

