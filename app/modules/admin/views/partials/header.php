<header>
  <nav class="white z-depth-0">
    <div class="container">
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu grey-text"></i></a>
      <a href="#" class="brand-logo black-text hide-on-large-only ">ADMIN</a>
      <a href="<?=base_url()?>admin/logout" class="black-text right">Logout</a>
    </div>
  </nav>
</header>

<ul id="slide-out" class="side-nav fixed grey darken-3">
  <li class="white"><div class="black-text">ADMIN</div></li>
  <li class="no-padding">
    <ul class="collapsible collapsible-accordion">
      <li>
        <a class="collapsible-header">PRODUCT<i class="mdi-navigation-arrow-drop-down right"></i></a>
        <div class="collapsible-body">
          <ul class="grey darken-3">
            <li><a href="<?=base_url()?>admin/catalog/products/add">Add</a></li>
            <li><a href="<?=base_url()?>admin/catalog/products">update</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </li>
  <li><a href="/admin/sitemap" class="white-text">Sitemap Generator</a></li>
</ul>
       

<script>
  $(document).ready(function(){
    $(".button-collapse").sideNav({
      menuWidth: 240, // Default is 240
      edge: 'left', // Choose the horizontal origin
    });
  })
</script>


        