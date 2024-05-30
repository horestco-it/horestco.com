<?php

use Illuminate\Support\Str;

 $this->load->view( config_item('theme').'header', ['page'=>$this->uri->segment(1)."/".$this->uri->segment(2)] ) ?>
  <style>
    .card-content{
      min-height:150px;
    }
  </style>

<?php $this->load->view( config_item('theme').'nav' ) ?>

<?php 
$theme = [
  'restaurants' => 'green darken-3 white-text',
  'hotels' => 'blue darken-3 white-text',
  'condominiums' => 'light-green darken-4 white-text',
  'cruise ships' => 'indigo darken-3 white-text',
  'residential' => 'indigo darken-2 white-text',
];

$groups = [
  // cruise ships, max tien
  'standart' => [48, 93],
  // MBA, bijan, pulai desaru, healy macs 12, one resident, uppereast, aurora, madfoon, nestretto, roullette, cibiuk
  'medium' => [9,15,20,46,23,22,48,62,74,79],
  // petronas, alrawsah
  'big' => [1, 58]
];
 ?>

<section class="container" id="portfolio-list-container">
  <div class="card">
    <div class="card-panel <?=$theme[$portfolio->name]?> client">
      <h3 class="client-title"><?=strtoupper($portfolio->name)?> <span class="gap-5 gap"></span> FURNISHED </h3>
      <div class="client-content">
        <?=$portfolio->body?>
      </div>
    </div>
  </div>
  <div class="card z-depth-0" style="margin-top:50px">
    <h6 style="color:grey">
      From <strong><?=$items['from']?></strong> to <strong><?=$items['to']?></strong>. Total <strong><?=$items['total']?></strong>
    </h6>
  </div>
  <div class="row">
    <?php foreach($items['data'] as $item): ?>
    <?php 
      $name = $item['image'] && $item['image']['name'] ? strtolower($item['image']['name']) : null;
      $image = img_url().'portfolio/'.Str::slug($portfolio->name).'/'.$name;
    ?>
    <div class="col s12 m6 l4">
      <div class="card horizontal z-depth-0" style="border:1px solid #ddd">
        <div class="card-image">
        <?=image_thumb($image, 200)?>
        </div>
        <div class="card-stacked">
          <div class="card-content">
            <div class="card-title"><?=str()->limit($item['name'], 25)?></div>
            <p class="black-text"><?=str()->limit($item['description'], 50)?></p>
          </div>
          <div class="text-right card-action" style="text-align:right">
            <a href="/client/<?=$item['slug']?>">More</a>
          </div>
        </div>
      </div>
      
    </div>
    <?php endforeach;?>
  </div>
  <div class="row">
    <div class="col">
      <?php if(count($items['data'])):?>
        <ul class="text-center pagination" style="text-align:center">
          <!-- <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li> -->
          <?php foreach($items['links'] as $item): ?>
          <li class="<?=$item['active'] ? 'active': 'waves-effect'?>"><a href="<?=$item['url'] ? $item['url'] : 'javascript:void(0)'?>"><?=$item['label']?></a></li>
          <?php endforeach;?>
          <!-- <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li> -->
        </ul>
      <?php endif;?>
    </div>
  </div>
</section>

<?php $this->load->view('template/default/script') ?>
<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<?php $this->load->view('template/default/footer') ?>
