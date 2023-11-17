<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($page) ?>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">

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
        url('<?=base_url().img_url()?>background/work-table.jpg');
        background-attachment: fixed;
        background-position: center;
        background-position-y: 0;
        background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<section class="section lead background-image grey darken-3">
  <div class="container">
    <div class="row valign-wrapper">
      <div class="col s12 center white-text valign">
        <h3 class="lead-heading"><?=strtoupper($site->name)?></h3>
      </div>
    </div>
  </div>
</section>

<section class="section container">
  <div class="row">

    <div class="col s12">
      <div class="row">
        <div class="col s12 m4">
          <h5>A Passion for Design</h5>
          <p>
            We strongly believe our greatest assets are our people. If you love design and want to give life to your passion of distinctive designing, this place could be perfect for you. 
            We offer an exceptional work environment and the chance to work in challenging designs. 
            <br>
            We have exported to over 20 countries worldwide and we have achieved that in a short span of time through hardwork and dedication. 
            We believe in a long lasting relationship, reliable, fair and engaging experience for all our stakeholders. 
          </p>
        </div>
        <div class="col s12 m8">
          <div class="row">
            <div class="col s12 m6">
              <h5>How does working at horestco feel like?</h5>
              <p>
                Diversity of thoughts and ideas enables us better services to our clients. 
                We will give you the tools and mentorship you  need to progress, develop and excel in your career.
                <br>
                For us, it’s vital you share our enthusiasm and passion for work - so we can work together to achieve success.
              </p>
            </div>
            <div class="col s12 m6">
              <h5>Equal Opportunity Employer</h5>
              <p>
                We are equal opportunity employer. We attract individuals from different backgrounds and cultures who-like you- bring a unique point of view and unique business skills. You will work with great people and will be exposed to a range of alternative perspectives. 
                We hire Malaysian nationals or foreigners holding relevant residence status in Malaysia.
              </p>
            </div>
            
            <div class="col s12">
              <div class="card-panel bordered center">
                <h6>
                  <i class="mdi-content-send"></i> 
                  Drop us an email with your <strong>resume</strong> and <strong>recent photograph</strong> at <a href="mailto:hr@horestco.com">hr@horestco.com</a>
                </h6>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<?php $this->load->view('partials/footer') ?>

</body>
</html>
