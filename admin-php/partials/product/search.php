<?php 

  /*

  // this section is extend from dashboard.php

  // this section is on if $_GET['action'] == 'search'

  */



 ?>

<div class="col-sm-offset-3 col-sm-6">

  <div class="panel panel-primary">

    <div class="panel-heading">

      <h3 class="panel-title">Search Item</h3>

    </div>

    <div class="panel-body">

      <form id="form-search-product" class="form-horizontal" role="form">

        <div class="form-group">

          <label class="col-md-2" for="">Category</label>

          <div class="col-md-8">

            <select name="category" id="searchcategory" class="form-control input-sm">

              <option value="All" selected>--All--</option>

              <?php

                foreach($categories as $category):

              ?>

                <option value="<?=$category['id']?>" <?php if(isset($_POST['category']) && $_POST['category'] == $category['id']) echo "selected" ?>><?=$category['name']?></option>

              <?php

                endforeach;

              ?>

            </select>

          </div>

        </div>

        <div class="form-group">

          <label class="col-md-2" for="">Status</label>

          <div class="col-md-8">

            <select name="status" class="form-control input-sm">

              <option value="1"   <?php if (isset($_POST['status']) && $_POST['status'] == 1)    echo "selected";?>>Active</option>

              <option value="All" <?php if (isset($_POST['status']) && $_POST['status'] == "All")  echo "selected";?>>--All--</option>

              <option value="0"   <?php if (isset($_POST['status']) && $_POST['status'] == 0)    echo "selected";?>>Inactive</option>

            </select>

          </div>

        </div>



        <div class="form-group">

          <label class="col-md-2" control-label for="">Item ID</label>

          <div class="col-md-8">

            <input type="text" name="id" list="item-id" class="form-control input-sm"  />

            <datalist id="item-id">

              <?php foreach($products as $product): ?>

              <option  value="<?=$product['id']?>"><?=$product['name']?></option>

              <?php endforeach; ?>

            </datalist>

          </div>

        </div>



        <div class="form-group">

          <label class="col-md-2" control-label for="">Title</label>

          <div class="col-md-8">

            <input type="text" name="title" list="title" class="form-control input-sm">

            <datalist id="title">

              <?php foreach($productID as $id): ?>

              <option  value="<?=$id['name']?>"><?=$id['id']?></option>

              <?php endforeach; ?>

            </datalist>

          </div>

        </div>



        <div class="form-group">

          <label class="col-md-2" control-label for="">Code</label>

          <div class="col-md-8">

            <input name="code" list="code-search" class="form-control input-sm">

            <datalist id="code-search">

              <?php foreach($productID as $id): ?>

              <option  value="<?=$id['code']?>"><?=$id['name']?></option>

              <?php endforeach; ?>

            </datalist>

          </div>

        </div>



        <div class="form-group">    

          <div class="col-md-8 col-md-offset-2">

            <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>

          </div>

        </div>



      </form>

    </div>

  </div>

</div>

