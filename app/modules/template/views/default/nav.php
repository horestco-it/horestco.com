<style type="text/css">
  
  
</style>

<?php
function imgPlaceholder($text = 'horestco.com'){
  return 'https://via.placeholder.com/300x225?text='.$text;
}

function getImage($submenu){
  $image = imgPlaceholder();
  if(!is_null($submenu->image) && $submenu->image){
    $image = base_url($submenu->image);
  }
  return $image;
}

function getImageMenu($menu){
  
  if(!$menu || !$menu->image) {
    return getImage($menu->submenus[0]);
  }

  return base_url($menu->image);
}
?>

</head>
<body>
<?php ob_start() ?>
<header class="navbar-fixed menu">
  <nav class="white primary-nav" data-role="navigation">
    <div class="nav-wrapper container">
      <ul class="top-menu right hide-on-med-and-down">
        <li class="bl">
          <a href="<?=base_url('contact-furniture-manufacturer')?>">CONTACT US</a>
        </li>
                <li class="bl">
          <a href="https://wa.me/60162240799?text=Hi%20Horestco%2C%20I%20have%20an%20inquiry" target="_blank" class="teal-text" style="font-weight:bold">
            <i class="fa fa-whatsapp left green-text"></i> WHATSAPP US
          </a>
        </li>

        <li class="customer bl">
          <a href="/customer/login" class="submenu-button" data-activates="customer-dropdown" data-belloworigin="true">
            <?= $this->auth->check() ? $this->auth->user('name') : 'ACCOUNT' ?>
          </a>

          <ul id="customer-dropdown" class="dropdown-content">
            <?php if ($this->auth->check()): ?>
            <li><a href="/customer/logout">Logout</a></li>
            <?php else: ?>
            <li><a href="/customer/login?_r=1">Login</a></li>
            <li><a href="/customer/register">Register</a></li>
            <?php endif ?>
          </ul>
        </li>
      
      </ul>

      <a href="" data-activates="mobile-menu" class="button-collapse mobile-menu hide-on-print"><i class="mdi-action-view-headline"></i></a>
      <a href="/" class="brand-logo">
        <span class="carme">HORESTCO</span>
        <sup class="tm">TM</sup>
      </a>
      <div class="sub-brand-logo hide-on-med-and-down">Hospitality &amp; Residential Furniture</div>


      <!-- MOBILE SIDE MENU -->
      <ul class="side-nav no-padding" id="mobile-menu">
        <li class=" <?php active_page($this->uri->segment(1), 'home')?>">
          <a class="waves-effect waves-teal" href="/"><i class="mdi-action-home left"></i> HOME</a>
        </li>
        <li class="divider"></li>
        <li class=" <?php active_page($this->uri->segment(1), 'about-horestco-furniture')?>">
          <a class="waves-effect waves-teal" href="/about-horestco-furniture">ABOUT US</a>
        </li>
        <li class="<?php active_page($this->uri->segment(1), 'furniture')?> no-padding">
          <ul class="collapsible">
            <li>
              <a href="/furniture" class="waves-effect waves-teal">CATALOG</a>
              <div class="collapsible-body" style="display:block">
                <ul>
                  <?php foreach ($menus as $key => $menu): ?>
                    <?php if ($key < 4): ?>
                    <li><a class="waves-effect waves-teal" href="<?=base_url($menu->url)?>"><?=ucwords(strtolower($menu->name))?></a></li>
                    <?php endif ?>
                  <?php endforeach ?>
                  <li><a class="waves-effect waves-teal" href="/catalog-downloads">Downloads</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </li>
        <li class="<?php active_page($this->uri->segment(1), 'portfolio')?> no-padding">
          <ul class="collapsible">
            <li>
              <a href="/portfolio" class="waves-effect waves-teal">PORTFOLIO</a>
              <div class="collapsible-body" style="display: block">
                <ul>
                  <li><a class="waves-effect waves-teal" href="/portfolio/restaurant-furniture">Restaurants</a></li>
                  <li><a class="waves-effect waves-teal" href="/portfolio/hotel-furniture">Hotels</a></li>
                  <li><a class="waves-effect waves-teal" href="/portfolio/condominium-furniture">Condominiums</a></li>
                  <li><a class="waves-effect waves-teal" href="/portfolio/cruise-ship-furniture">Cruise Ships</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </li>
        <li class=" <?php active_page($this->uri->segment(1), 'premium-furniture-materials')?>">
          <a class="waves-effect waves-teal" href="/premium-furniture-materials">MATERIALS</a>
        </li>
        <li class=" <?php active_page($this->uri->segment(1), 'contact-furniture-manufacturer')?>">
          <a class="waves-effect waves-teal" href="/contact-furniture-manufacturer">CONTACT</a>
        </li>
                <li>
          <a class="waves-effect waves-teal" href="https://wa.me/60162240799?text=Hi%20Horestco%2C%20I%20have%20an%20inquiry" target="_blank">
            <i class="fa fa-whatsapp left green-text"></i> WHATSAPP US
          </a>
        </li>
        <li class=" <?php active_page($this->uri->segment(1), 'malaysia-furniture-promotions')?>">
          <a class="waves-effect waves-teal" href="/malaysia-furniture-promotions">CLEARANCE</a>
        </li>
      </ul>

      <!-- show in print view -->
      <ul class="right hide http">
        <li><a href="">horestco.com</a></li>
      </ul>

    </div>
  </nav>
</header>

<nav data-role="navigation" class="secondary-nav hide-on-med-and-down">
<div class="container">
  <ul class="navbar">
  <?php
    if(count($menus)):
      foreach($menus as $key => $menu):
  ?>
    <li>
      <a href="<?=base_url($menu->url)?>" class="submenu-button" data-activates="catalog-dropdown<?=$key?>">
        <?=$menu->name?> <i class="fa fa-caret-down"></i>
      </a>
      <ul id="catalog-dropdown<?=$key?>" class="dropdown-content dropdown-catalog">
        <li>
          <div class="container">
            <div class="row">
              <div class="col s5">
                <?php if( count($menu->submenus) ): ?>
                  <ul class="list-submenu">
                  <?php if(! preg_match('/home-office/', $menu->url )): ?>
                    <li>
                      <a href="<?=base_url($menu->url)?>" data-image="<?=getImageMenu($menu)?>">
                        <?=strtoupper($menu->name)?>
                      </a>
                    </li>
                  <?php endif ?>
                  <?php foreach( $menu->submenus as $k => $submenu ): ?>
                    <li>
                      <a href="<?=$submenu->url?>" data-image="<?=getImage($submenu)?>">
                        <?=strtoupper($submenu->name)?>
                      </a>
                      <img class="hide ghost-image" src="<?=base_url($submenu->image)?>" />
                    </li>
                  <?php endforeach?>
                  </ul>
                <?php endif?>
              </div>
              <div class="col s7">
                <img class="responsive-img" src="<?=getImageMenu($menu)?>" />
              </div>
            </div>
          </div>
        </li>
      </ul>
    </li>
  <?php
      endforeach;
    endif;
  ?>
</div>
</nav>

<?php echo minify_html(ob_get_clean()); ?>
