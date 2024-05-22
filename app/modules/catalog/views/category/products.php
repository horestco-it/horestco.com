<?php

use Illuminate\Support\Str;

 if ($products && count($products)) : ?>
  <?php foreach ($products->chunk(4) as $chunk) : ?>
    <div class="row">
      <?php foreach ($chunk as $key => $product) : ?>
        <div class="col s6 m3 item">
          <a href="<?= base_url() . "furniture/" . Str::slug($product->name) . "-" . $product->id ?>">
            <div class="card lists">
              <div class="card-image">
                <?php $this->load->view('category/image', ['product' => $product]) ?>
              </div>
              <div class="card-content" style="padding:10px">
                <h5 class="card-title"><?= strtoupper($product->name) ?></h5>
                <ul>
                  <li>
                    <?php // $this->load->view('category/pricing', ['product' => $product]) ?>
                  </li>
                </ul>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach ?>
    </div>
  <?php endforeach ?>
<?php else: ?>
  <div class="card"><em>No Products</em></div>
<?php endif ?>