
<div class="row">
  <div class="col s12 grid-item" data-id="image-<?= $subcategory->id ?>">
    <hr class="hide show-on-print">
    <h5 class="card-panel grey darken-3 item-heading">
      <a class="white-text" href="<?= base_url() . 'furniture/' . $category->slug . '/' . $subcategory->slug ?>">
        <?= strtoupper($subcategory->name) ?>
        <span class="right">
          <i class="fa fa-angle-double-right"></i>
        </span>
      </a>
    </h5>
    <hr class="hide show-on-print">
  </div>
</div>

<?php $this->load->view('category/products', ['products' => $subcategory->products]) ?>

