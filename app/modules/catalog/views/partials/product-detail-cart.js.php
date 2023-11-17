<script>
  
/////////////////
// add to cart //
/////////////////
$(document).ready(function(){

  var $addFabric = $('#add-fabric-checkbox');
  var $selectFabricField = $('.select-fabric-box');
  var $optionalLists = $('.optional-material').find('.material-lists');
  var $optionalField = $('.optional-category-field');
  var $isAddOptField = $('#isAddOptional');

  selectMaterial($('.material-lists').find('.item'));

  // init
  $selectFabricField.hide()

  ///////////////////////
  // action add fabric //
  ///////////////////////
  $addFabric.click(function(){

    if($(this).prop('checked'))
    {
      // get material id if active
      $optionalLists.find('li').each(function(){
        if($(this).hasClass('active'))
        {
          var $field = $( $(this).data('target-field') );
          setValue( $field, $(this).data('id') );
        }
      });
      // set option true
      $isAddOptField.val(true);
      // slide
      $selectFabricField.slideDown();
    }
    else{
      // set option false
      $isAddOptField.val(false);
      // reset value
      $optionalField.val('')
      // hide slide up
      $selectFabricField.slideUp();
    }
  });

  function selectMaterial($items)
  {
    $items.each(function(){
      $(this).click(function(){
        var $targetField = $($(this).data('target-field'));
        setValue($targetField, $(this).data('id'));
        activeMaterial($(this));
      });
    });
  }

  function setValue($field, value)
  {
    $field.val(value);
  }

  function activeMaterial($this)
  {
    // reset active
    $this.closest('ul.collapsible').find('li .image').removeClass('active');
    // set active
    $this.find('.image').addClass('active');
  }

  /////////////////////
  // submit add cart //
  /////////////////////
  $('.add-cart').submit(function(e){
    e.preventDefault();

    var $loader = $(this).find('.progress');

    $loader.css('opacity', 1);

    $.post('/cart/addCart', $(this).serialize(), function(data){

      var carts = JSON.parse(data);

      // console.log(carts);
      $loader.css('opacity', 0);
                                                                                    
      if( carts.error )
      {
        Materialize.toast(carts.error, 4000, 'red lighten-4 red-text');
        return;
      }
      Materialize.toast('Item added to Cart', 5000, 'green lighten-4 green-text');

      $('.carts').empty().append(updateCart(carts));

      // jika cart shopping masih kosong
      if(carts.total_items == 1)
      {
        $('.cart').children('a').append('<span class="badge circle teal white-text">'+carts.total_items+'</span>');
      }
      // jika tidak hanya tambah text saja
      else{
        // append to top navigation
        $('.cart .badge').text(carts.total_items)
      }
      return false;
    });
  });

  function updateCart(carts)
  {
    // var carts = JSON.parse(carts);
    var item = '';
    var total = '';

    total += '<li>';
    total +=    '<div class="cart-total grey white-text">';
    total +=      'Total Amount : <span class="teal-text">'+carts.total+'</span>';
    total +=    '</div>';
    total +=    '<div class="center" style="margin: 10px 0">';
    total +=      '<a href="/cart" class="btn z-depth-0">view shopping cart</a>';
    total +=    '</div>';
    total +=  '</li>';

    $.each(carts.contents, function(id, cart){
      item += '<li class="cart-item">';
      item +=   '<div class="row">';
      item +=     '<div class="col s12 m4 cart-item-image">';
      item +=     '<img src="/assets/images/furniture/'+cart.image+'" width="100" />';
      item +=     '</div>';
      item +=     '<div class="col s12 m6 cart-item-detail">';
      item +=       '<div class="detail"><strong>'+cart.name+'</strong></div>';
                   if( cart.fabric )
                  {
      item +=       '<div class="detail">+ '+cart.fabric+'</div>';

                  }
      item +=       '<div class="detail"><span class="grey-text">Size:</span> '+cart.size+'</div>';
      item +=       '<div class="detail"><span class="grey-text">Price:</span> '+cart.price+'</div>';
      item +=       '<div class="detail"><span class="grey-text">Qty:</span> '+cart.qty+'</div>';
      item +=       '<div class="detail"><span class="grey-text">Subtotal:</span> '+cart.subtotal+'</div>';
      item +=     '</div>';
      item +=   '</div>';
      item += '</li>';
    });

    total += item;
    
    return total;
  }
});

</script>

<script src="<?=script_url('vue.min.js')?>"></script>
<script>

  var vm = new Vue({
    el : '#product-detail-container',
    data : {
      name : 'Horestco',
    }
  });

  vm.$watch('size' , function(val, oldVal){
        console.log(val);
      })

</script>
