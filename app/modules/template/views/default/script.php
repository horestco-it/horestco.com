<?php ob_start() ?>
<script src="<?=script_url('jquery.min.js')?>"></script>
<script src="<?=script_url('materialize.min.js')?>"></script>
<script src="<?=script_url('scripts.js')?>"></script>
<script>
$('ul.list-submenu > li > a').hover(function(){
  var $a = $(this)
  var $img = $a.closest('.col').next().children('img')
  var src = $a.data('image')
  if( src ){
    $img.attr('src', src)
  }
})

$('.submenu-button').dropdown({
  alignment: 'right'
})
$(document).ready(function(){

})
</script>
<?php echo minify_html(ob_get_clean()); ?>