<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <?php get_meta($page) ?>
  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    .canvas{
      min-height: 1px;
    }
  </style>
</head>
<body>

<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

<div class="divider"></div>
<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
  <![endif]-->
<div class="container">
  <div class="row">
  
    <div class="col s12">
      <h2 class="content-heading">Cushion Designer</h2>
    </div>
    <div class="col s12 m6">
      <canvas class="canvas" id="main-canvas"></canvas>
    </div>
    <div class="col s12 m6">
      <div class="form-group">
        <label class="col-sm-2" for="">Width:</label>
        <div class="col-sm-10">
          <input type="text" id="widthInput" class="form-control input-sm width" value="100">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2" for="">Depth:</label>
        <div class="col-sm-10">
          <input type="text" id="depthInput" class="form-control input-sm width" value="100">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          <button class="btn btn-xs set-dimension">set dimension</button>
        </div>
      </div>
    </div>

  </div>
</div>


<?php $this->load->view('partials/footer') ?>

  <script>
    $(document).ready(function(){
      var width = $('#widthInput').val();
      var depth = $('#depthInput').val();
      $('canvas').drawRect({
        layer: true,
        name : 'backLayer',
        fillStyle: '#ddd',
        x: 100, y: 60,
        width: width,
        height: depth
      })
      .drawRect({
        name: 'frontLayer',
        layer: true,
        fillStyle: '#6a6',
        x: 100, y: 60,
        width: width,
        height: depth
      });

      $('.set-dimension').click(function(){
        width = $('#widthInput').val();
        depth = $('#depthInput').val();
        $('canvas')
          .animateLayer('backLayer', {
            x: 100, y: 60,
            width: function(layer){
              return width;
            },
            height: function(layer){
              return depth;
            }
          }, 1000);

        $('canvas')
          .animateLayer('frontLayer', {
            x: 100, y: 60,
            width: function(layer){
              return width;
            },
            height: function(layer){
              return depth;
            }
          }, 1000);
      })
  })
  </script>

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