<header class="navbar-fixed menu" style="position:absolute;top:0;left:0;right:0">
  <nav class="white" data-role="navigation">
    <div class="nav-wrapper container">
      <ul class="right hide-on-med-and-down submenu">
        <li class=" <?php active_page($page, 'about-horestco-furniture')?>">
          <a href="/about-horestco-furniture">ABOUT US</a>
        </li>
        <li class=" <?php active_page($page, 'portfolio')?>">
          <a href="/portfolio" class="submenu-button" data-activates="portfolio-menu">PORTFOLIO</a>
          <ul id="portfolio-menu" class="dropdown-content">
            <li><a href="/portfolio/restaurant-furniture">Restaurants</a></li>
            <li><a href="/portfolio/hotel-furniture">Hotels</a></li>
            <li><a href="/portfolio/condominium-furniture">Condominiums</a></li>
            <li><a href="/portfolio/cruise-ship-furniture">Cruise Ships</a></li>
          </ul>
        </li>
        <li class="">
          <a href="/furniture" class="submenu-button" data-activates="catalog">CATALOG</a>
          <ul id="catalog" class="dropdown-content">
            <?php foreach ($menus as $key => $menu): ?>
              <?php if ($key < 4): ?>
              <li><a href="<?=base_url($menu->url)?>"><?=ucwords(strtolower($menu->name))?></a></li>
              <?php endif ?>
            <?php endforeach ?>
            <li class="divider"></li>
            <li><a href="/catalog-downloads">Downloads</a></li>
          </ul>
        </li>
        <li class=" <?php active_page($page, 'premium-furniture-materials')?>">
          <a href="/premium-furniture-materials">MATERIALS</a>
        </li>
        <li class=" <?php active_page($page, 'contact-furniture-manufacturer')?>">
          <a href="/contact-furniture-manufacturer">CONTACT</a>
        </li>
        <li class=" <?php active_page($page, 'malaysia-furniture-promotions')?>">
          <a href="/malaysia-furniture-promotions">CLEARANCE</a>
        </li>
        <li class="cart">
          <a href="/cart">
            <i class="material-icons left">shopping_cart</i>
            <?php
              if ($this->session->has_userdata('cart_contents')):
                $cart = $this->session->cart_contents;
            ?>
            <span class="badge circle teal"><?=$cart['total_items']?></span>
            <?php endif ?>
          </a>
        </li>
      </ul>

      <ul class="side-nav" id="mobile-menu">
        <li class=" <?php active_page($page, 'about-horestco-furniture')?>">
          <a href="/about-horestco-furniture">ABOUT US</a>
        </li>
        <li class=" <?php active_page($page, 'portfolio')?>">
          <a href="/portfolio" class="submenu-button-mobile" data-activates="portfolio-menu-2">PORTFOLIO</a>
          <ul id="portfolio-menu-2" class="dropdown-content">
            <li><a href="/portfolio/restaurant-furniture">Restaurants</a></li>
            <li><a href="/portfolio/hotel-furniture">Hotels</a></li>
            <li><a href="/portfolio/condominium-furniture">Condominiums</a></li>
            <li><a href="/portfolio/cruise-ship-furniture">Cruise Ships</a></li>
          </ul>
        </li>
        <li class="">
          <a href="/furniture" class="submenu-button-mobile" data-activates="catalog-2">CATALOG</a>
          <ul id="catalog-2" class="dropdown-content">
            <?php foreach ($menus as $key => $menu): ?>
              <?php if ($key < 4): ?>
              <li><a href="<?=base_url($menu->url)?>"><?=ucwords(strtolower($menu->name))?></a></li>
              <?php endif ?>
            <?php endforeach ?>
            <li class="divider"></li>
            <li><a href="/catalog-downloads">Downloads</a></li>
          </ul>
        </li>
        <li class=" <?php active_page($page, 'premium-furniture-materials')?>">
          <a href="/premium-furniture-materials">MATERIALS</a>
        </li>
        <li class=" <?php active_page($page, 'contact-furniture-manufacturer')?>">
          <a href="/contact-furniture-manufacturer">CONTACT</a>
        </li>
        <li class=" <?php active_page($page, 'malaysia-furniture-promotions')?>">
          <a href="/malaysia-furniture-promotions">CLEARANCE</a>
        </li>
        <li class="cart">
          <a href="/cart">
            <i class="material-icons left">shopping_cart</i>
            <?php
              if ($this->session->has_userdata('cart_contents')):
                $cart = $this->session->cart_contents;
            ?>
            <span class="badge circle teal"><?=$cart['total_items']?></span>
            <?php endif ?>
          </a>
        </li>
      </ul>



      <a href="" data-activates="mobile-menu" class="button-collapse mobile-menu"><i class="material-icons">menu</i></a>
      <a href="/" class="brand-logo">
        <span class="hide">HORESTCO</span>
        <img src="<?=base_url().img_url()?>horestco-logo.png" alt="HORESTCO" class="valign responsive-img">
      </a>

    </div>
  </nav>
</header>