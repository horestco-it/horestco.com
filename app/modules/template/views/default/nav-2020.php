  </head>


  <!-- <style type="text/css">
    .right{
      font-family: Calibri;
    }
    
    nav.secondary-nav{
      font-family: Calibri;
      background: #42413E;
    }

    nav.secondary-nav .navbar .dropdown-content{
      background: #42413E;
    }

    nav.secondary-nav .navbar > li > a:hover{
      background: transparent;
    }
  </style> -->

<body>
<?php ob_start() ?>
<header class="navbar-fixed menu">
  <nav class="white primary-nav" data-role="navigation">
    <div class="nav-wrapper container">

      <ul class="right hide-on-med-and-down submenu">
        
        <li class="cart bl">
          <a href="/cart" class="submenu-button" data-activates="cart-dropdown" data-belloworigin="true">
            <i class="fa fa-shopping-cart left <?php echo $this->session->has_userdata('cart_contents') ? 'teal-text' : 'grey-text' ?>"></i> Cart
            <?php
              if ($this->session->has_userdata('cart_contents')):
                $cart = $this->session->cart_contents;
            ?>
            <span class="badge circle teal white-text"><?=$cart['total_items']?> </span>
            <?php endif ?>
          </a>

          <ul id="cart-dropdown" class="dropdown-content z-depth-3">
            <li class="cart-items-on-nav">
              <ul class="carts">
                <?php if ($this->session->has_userdata('cart_contents')): ?>
                  <li>
                    <div class="cart-total grey white-text">
                      Total Amount : <span class="teal-text"><?= $this->cart->total() ?></span>
                    </div>
                    <div class="center" style="margin: 10px 0">
                      <a href="/cart" class="btn z-depth-0">view shopping cart</a>
                    </div>
                  </li>
                  <?php foreach ($this->cart->contents() as $key => $cart): ?>
                  <li class="cart-item">
                    <div class="row">
                      <div class="col s12 m4 cart-item-image">
                        <?=image_thumb(img_url('furniture/'.$cart['image']), 100, ['class'=>''])?>
                      </div>
                      <div class="col s12 m8 cart-item-detail">
                        <div class="detail"><strong><?=$cart['name']?></strong></div>
                        <?php if ($cart['fabric']): ?>
                        <div class="detail">+ <?=$cart['fabric']?></div>
                        <?php endif ?>
                        <div class="detail"><span class="grey-text">Size</span> : <?=$cart['size']?></div>
                        
                        <div class="detail"><span class="grey-text">Price</span> : <?=$cart['price']?></div>
                        <div class="detail"><span class="grey-text">Qty</span> : <?=$cart['qty']?></div>
                        <div class="detail"><span class="grey-text">Subtotal</span> : <?=$cart['subtotal']?></div>
                      </div>
                    </div>
                  </li>
                  <?php endforeach ?>
                <?php else: ?>
                  <li>You have no items in your shopping cart.</li>
                <?php endif ?>
              </ul>
            </li>
          </ul>
        </li>

        <li class="customer bl">
          <a href="/customer/login" class="submenu-button" data-activates="customer-dropdown" data-belloworigin="true">
            <i class="fa fa-user left <?php echo ($this->auth->check()) ? 'orange-text': 'grey-text'; ?> "></i> 
            <?= $this->auth->check() ? $this->auth->user('name') : 'Account' ?>
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
        <span class="hide">HORESTCO</span>
        <img src="<?=base_url().img_url()?>horestco-logo.png" alt="HORESTCO" class="valign responsive-img">
      </a>

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
        <li class="cart">
          <a class="waves-effect waves-teal" href="/cart">
            <i class="mdi-action-shopping-cart left"></i> CART
            <?php
              if ($this->session->has_userdata('cart_contents')):
                $cart = $this->session->cart_contents;
            ?>
            <span class="badge circle teal white-text"><?=$cart['total_items']?></span>
            <?php endif ?>
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

      <li class=" <?php active_page($this->uri->segment(1), '/')?>">
        <a class="" href="/"><i class="fa fa-home"></i></a>
      </li>
      <li class=" <?php active_page($this->uri->segment(1), 'about-horestco-furniture')?>">
        <a class="" href="/about-horestco-furniture">ABOUT US</a>
      </li>
      <li class="">
        <a href="/furniture" class="submenu-button" data-activates="catalog-dropdown" data-belloworigin="true">
          CATALOG <i class="fa fa-caret-down"></i>
        </a>
        <ul id="catalog-dropdown" class="dropdown-content">
          <?php foreach ($menus as $key => $menu): ?>
            <?php if ($key < 4): ?>
            <li><a href="<?=base_url($menu->url)?>"><?=ucwords(strtolower($menu->name))?></a></li>
            <?php endif ?>
          <?php endforeach ?>
          <li class="divider"></li>
          <li><a href="/catalog-downloads">Downloads</a></li>
        </ul>
      </li>
      <li class=" <?php active_page($this->uri->segment(1), 'portfolio')?>">
        <a href="/portfolio" class="submenu-button" data-activates="portfolio-menu">PORTFOLIO <i class="fa fa-caret-down"></i></a>
        <ul id="portfolio-menu" class="dropdown-content">
          <li><a href="/portfolio/restaurant-furniture">Restaurants</a></li>
          <li><a href="/portfolio/hotel-furniture">Hotels</a></li>
          <li><a href="/portfolio/condominium-furniture">Condominiums</a></li>
          <li><a href="/portfolio/cruise-ship-furniture">Cruise Ships</a></li>
        </ul>
      </li>
      <li class=" <?php active_page($this->uri->segment(1), 'premium-furniture-materials')?>">
          <a href="/premium-furniture-materials">MATERIALS</a>
      </li>
      <li class=" <?php active_page($this->uri->segment(1), 'contact-furniture-manufacturer')?>">
        <a href="/contact-furniture-manufacturer">CONTACT</a>
      </li>
      <li class=" <?php active_page($this->uri->segment(1), 'malaysia-furniture-promotions')?>">
        <a href="/malaysia-furniture-promotions">CLEARANCE</a>
      </li>
<!--       <ul class="topnav">
      <input type="text" placeholder="Search our Product..." name="search">
    </ul>
    </ul> -->
  </div>
<!--   <ul class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 well">
        <?php
        $attr = array("class" => "form-horizontal", "role" => "form", "id" => "form1", "name" => "form1");
        echo form_open("pagination/search", $attr);
        ?>
        <div class="form-group">
          <div class="col-md-6">
            <input class="form-control" id="product_name" name="product_name" placeholder="Search our Product..." type="text" value="<?php echo set_value('id_product');?>" />
          </div>
          <div class="col-md-6">
            <input id="btn_search" name="btn_search" type="submit" class="btn btn-danger" value="Search" />
          </div>
        </div>
        <?php echo form_close(); ?>
    </div>
  </div>
</ul> -->
</nav>

<?php echo minify_html(ob_get_clean()); ?>
