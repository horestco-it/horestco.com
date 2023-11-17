<?php
$tabs = [

];
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <?php //get_meta($page) ?>
  <?php get_meta($this->uri->segment(1)) ?>
  
  <?php $this->load->view('partials/meta-and-assets') ?>
  
<style>
  .flex-row{
    display: flex;
    flex-direction: row;
  }
  .flex-row > * {
    flex: 1;
  }
   
    .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: auto; /* Should be removed. Only for demonstration */
  }

  .row:after {
    content: "";
    display: table;
    clear: both;
  }
    
  

    /* Style the tab */
  .tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    margin-top: 20px;
    display: flex;
    flex-direction: row;
  }

  /* Style the buttons inside the tab */
  .tab button {
    flex: 1;
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
    /* float: left; */
    padding: 14px 5px;
    
  }

  /* Change background color of buttons on hover */
  .tab button:hover {
    background-color: #ddd;
  }

  /* Create an active/current tablink class */
  .tab button.active {
    background-color: #ccc;
    font: bold 17px/25px Arial, Arial;
  }

  /* Style the tab content */
  .tabcontent {
    display: none;
    padding: 6px 12px;
    border: 0px solid #ccc;
    border-top: none;
    margin-left: 0px;
  }
  .lead.background-image{
    background-image: 
      linear-gradient(
        rgba(0, 0, 0, 0.3), 
        rgba(0, 0, 0, 0.3)
      ),
      url('<?=server_img_url("Beautiful-Outdoor.jpg")?>');
      background-attachment: fixed;
      background-position: center;
      height: 250px;
      text-align: center;
  }
  ul.tel li a{
    color: #212121;
  }
  i.icons{
    font-size: 20px;
  }
  .row-card{
    padding: 10px;
    background-color: #eee;
    margin-bottom: 15px;
  }
  .column1 {
    padding: 10px;
  }
  .column1 > ul > li {
    padding: 10px 0;
  }
</style>

</head>
<body>

<?php //$this->load->view('partials/nav.php') ?>
<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

<section class="section lead background-image">
  <div class="container-fluid">
    <div class="row center">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">CONTACT</h3>
        <h5 class="lead-sub-heading" style="font-weight:400">
          FEEL FREE TO CONTACT US OR EVEN BETTER - VISIT US.
        </h5>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-fluid">
  <div class="tab">
  <button class="tablinks" id="<?=in_array($this->input->get('t'), ['malaysia', null]) ? 'defaultOpen':''?>" onclick="openCity(event, 'Malaysia')" >KUALA LUMPUR HQ</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'penang' ? 'defaultOpen':''?>" onclick="openCity(event, 'Penang')">PENANG</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'langkawi' ? 'defaultOpen':''?>" onclick="openCity(event, 'Langkawi')">LANGKAWI</button>
  <button class="tablinks" id="<?=$this->input->get('t') == 'indonesia' ? 'defaultOpen':''?>" onclick="openCity(event, 'Indonesia')">INDONESIA</button>
</div>
</div>
</section>

<?php $this->load->view('contact[covid]/kuala-lumpur') ?>
<?php $this->load->view('contact[covid]/penang') ?>
<?php $this->load->view('contact[covid]/langkawi') ?>
<?php $this->load->view('contact[covid]/indonesia') ?>
    
  
<?php $this->load->view('partials/footer') ?> 

<?php $this->load->view('partials/scripts/zopim-chat') ?>




<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>