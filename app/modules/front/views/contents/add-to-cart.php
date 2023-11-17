<div class="row">
  <form class="col s12 addCart center">
    <input type="hidden" name="id" value="<?=$product->id?>">
    <input type="hidden" name="name" value="<?=$product->name?>">
    <input type="hidden" id="size_id" name="size_id" value="<?=$size?>">
    <input type="number" min="1" class="form-control center" name="qty" value="1">
    <button class="btn teal" title="Add To Cart">
      <i class="mdi-action-shop left"></i>
      <span class="text-cart hide-on-small-only">Add To Cart</span> 
    </button>
  </form>
</div>