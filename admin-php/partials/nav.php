<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Admin Horestco MY </a>
    </div>

    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-menu">
        <!-- products -->
        <li class="dropdown">
          <a  href="#" 
              class="dropdown-toggle text-capitalize" 
              data-toggle="dropdown">
              <span class="glyphicon glyphicon-th"></span> 
              products <b class="caret"></b>
          </a>
          <ul class="dropdown-menu text-capitalize">
            <li>
              <a href="<?=base_url()?>admin-php/dashboard.php">
                <span class="glyphicon glyphicon-pencil text-info"></span>
                Manage
              </a>
            </li>
            <li>
              <a href="<?=base_url()?>admin-php/dashboard.php?action=add">
                <span class="glyphicon glyphicon-plus text-success"></span>
                New
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?=base_url('admin-php/category.php')?>">category</a></li>
            <li><a href="<?=base_url('admin-php/subcategory.php')?>">subcategory</a></li>
          </ul>
        </li>
        <!-- portfolio -->
        <li class="dropdown">
          <a  href="#" 
              class="dropdown-toggle text-capitalize" 
              data-toggle="dropdown">
              <span class="glyphicon glyphicon-th"></span> 
              clients <b class="caret"></b>
          </a>
          <ul class="dropdown-menu text-capitalize">
            <li>
              <a href="<?=base_url()?>admin-php/portfolio.php">
                <span class="glyphicon glyphicon-pencil text-info"></span>
                Manage
              </a>
            </li>
            <li>
              <a href="<?=base_url()?>admin-php/portfolio.php?action=add">
                <span class="glyphicon glyphicon-plus text-success"></span>
                New
              </a>
            </li>
          </ul>
        </li>
        <!-- materials -->
        <li class="dropdown">
          <a  href="#" 
              class="dropdown-toggle text-capitalize" 
              data-toggle="dropdown">
              <span class="glyphicon glyphicon-th"></span> 
              materials <b class="caret"></b>
          </a>
          <ul class="dropdown-menu text-capitalize">
            <li>
              <a href="<?=base_url()?>admin-php/material.php">
                <span class="glyphicon glyphicon-pencil text-info"></span>
                Manage
              </a>
            </li>
            <li>
              <a href="<?=base_url()?>admin-php/material.php?action=add">
                <span class="glyphicon glyphicon-plus text-success"></span>
                New
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?=base_url('admin-php/material.php?action=category')?>">category</a></li>
            <li><a href="<?=base_url('admin-php/material.php?action=subcategory')?>">subcategory</a></li>
          </ul>
        </li>
        <!-- Print -->
        <li class="dropdown">
          <a  href="#" 
              class="dropdown-toggle text-capitalize" 
              data-toggle="dropdown">
              <span class="glyphicon glyphicon-print"></span> 
              Print <b class="caret"></b>
          </a>
          <ul class="dropdown-menu text-capitalize">
            <li>
              <a href="<?=base_url()?>admin-php/pricetag.php">
                <span class="glyphicon glyphicon-tags text-info"></span> Price Tag
              </a>
            </li>
          </ul>
        </li>

      </ul>

      <p id="welcome" class="navbar-text text-capitalize pull-right">
        <span class="glyphicon glyphicon-user"></span> 
        <strong><?=isset($_SESSION['displayname']) ? $_SESSION['displayname'] : 'Anonymous'?></strong>
      </p>

      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'A' ): ?>
        <li><a href="<?=BASE_URL?>/api/get_metadata" onclick="return confirm('Are you sure to update metadata?')"><span class="glyphicon glyphicon-file"></span> Metadata</a></li>
        <li><a href="<?=BASE_URL?>/admin-php/setting.php"><span class="glyphicon glyphicon-cog"></span> Setting</a></li>
        <?php endif ?>
        <li><a href="api/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>

  </div>
</nav>