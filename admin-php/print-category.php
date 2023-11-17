<?php
require 'api/check_session.php';
include '../config.php';
require_once '../classes/DB.php';
require_once '../classes/Helper.php';
require_once '../classes/Helper.php';

// Load class in Folder Models
spl_autoload_register(function($class){
  include '../' . $class . '.php';
});
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name=viewport content="width=device-width, initial-scale=1">
  
  <meta name="robots" content="index, follow" />
  <meta name="author" content="Horestco furniture - Malaysia and Indonesia" />
  <title>Horestco Furniture Catalogue</title>

  <link rel="stylesheet" href="../assets/css/global.css" media="all" />
  <link rel="stylesheet" href="../assets/css/main.css" media="all" />
  <link rel="stylesheet" href="../assets/css/font-awesome.css" media="screen" />
  <!--[if lt IE 7]>
  <link href="assets/hs/highslide-ie6.css"  rel="stylesheet"/>
  <![endif]-->
  <script src="../assets/js/vendor/jquery.min.js"></script>
  <script src="../assets/js/main.js"></script>
  <style>
  .table.category td{
      padding:3px;
  }
  </style>
  
</head>
<body>
  <!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->

  <div id="main-body">
    <div class="container-fluid">
      <div class="content" style="padding:2em 0">

        <p>
          <a href="void(0)" onclick="history.back()">
            <span class="glyphicon glyphicon-chevron-left"></span> Back
          </a>
        </p>
        
				<?php
				$categories = Models\Category::with(array(
        		'subcategories'=>function($query){
        			return $query->orderBy('name');
        		}
        	))->orderBy('maincatid')->get();

         ?>

     		<div class="row">

          <div class="col-sm-4 text-uppercase">
            <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Category</h3>
                </div>
                <div class="panel-body">
                  <table class="table category">
                    <thead>
                      <tr><th>no</th><th>Name</th><th>status</th><th>id</th><th>maincategory</th></tr>
                    </thead>
                  <?php foreach ($categories as $key => $cate): ?>
                    <?php //if ($key < 7): ?>
                      
                    <tr>
                      <td><?=$key+1?></td>
                      <td><?=$cate->name?></td>
                      <td class="text-center"><?=$cate->status?></td>
                      <td class="text-center"><?=$cate->catId?></td>
                      <td class="text-center"><?=$cate->maincatid?></td>
                    </tr>
                    <?php //endif ?>
                  <?php endforeach ?>
                  </table>
                </div>
            </div>
          </div>
     			
					<?php foreach ($categories as $cate): ?>
							
						<div class="col-sm-5th">
	     				<div class="panel panel-default">
	     					  <div class="panel-heading">
	     							<h3 class="panel-title"><?=$cate->name?> (<strong><?=$cate->catId?></strong>)</h3>
	     					  </div>
	     					  <div class="panel-body">
	     					  	<h5 class="text-uppercase" style="margin:0; border-bottom:1px solid #ddd"><strong>sub category:</strong></h5>
										<?php foreach ($cate->subcategories as $sub): ?>
											<p style="margin:5px 0"><?=$sub->name?></p>
										<?php endforeach ?>
	     					  </div>
	     				</div>
	     			</div>
					<?php endforeach ?>		

     		</div>



       </div><!-- /.content -->
    <!-- END CONTENT -->
    </div>
  </div>

  <?php include '_partials/footer.php'; ?>

  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
     var _gaq = _gaq || [];
     _gaq.push(['_setAccount', 'UA-23786270-1']);
     _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

  </script>



</body>
</html>