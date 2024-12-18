<?php
include '../../classes/DB.php';
include '../../config.php';
include '../partials/header2.php';
include '../partials/nav.php';


?>
<link href="<?=BASE_URL?>/admin-php/assets/css/pricetag.css" rel="stylesheet" media="all"/>
<link href="<?=BASE_URL?>/admin-php/assets/css/print-pricetag.css" rel="stylesheet" media="print" />
<style media="print">
	@page{
		size: A4 potrait;
		margin: 0.1in;
	}
</style>
<style>
	[v-cloak]{
		display: none;
	}
	.img-thumb{
		border: 1px solid #e5e5e5;
		padding: 5px;
		margin: 2px;
	}
	.img-thumb:hover{
		cursor: pointer;
		border-color: #ccc;
	}
	.img-thumb.active{
		border-color: #2c3e50;
	}

	.print .item{
		border: 1px dashed #ddd;
	}
</style>
</head>
<body id="app" class="tag6 pricetag">

<section v-cloak>
	
	<div class="jumbotron hide-on-print">
		<div class="container">
			<h1>PRICE TAG</h1>
		</div>
	</div>

	<div class="container hide-on-print" style="margin-bottom:30px">
		<div class="row">
			<div class="col-sm-4 add">
				<div class="form-group">
					<label for="selectProduct">Product:</label>
					<select id="selectProduct" class="form-control input-sm" v-model="pid" @change="selectProduct(pid)">
						<option value="" selected>-- Select --</option>
						<option v-for="option in prdList" :value="option.id">{{ option.name }}</option>
					</select>
				</div>
				<div class="form-group" v-if="show">
					<label for="">Select Size:</label>
					<select id="" class="form-control input-sm" v-model="product.size" placeholder="Select size">
						<option v-for="size in sizes" :value="size.id">{{ size.name }}</option>
					</select>
				</div>
				<div class="form-group" id="images" v-if="show">
					<p><label for="">Select Image:</label></p>
					<img class="img-thumb" :class="isActive ? 'active':''" v-for="image in images" src="<?=base_url()?>assets/images/furniture/{{ image.name }}" width="100" @click="selectImage(pid, image.id, $event)">
				</div>
				<div class="form-group">
					<div class="input-group" style="width:110px">
			      <span class="input-group-btn">
			        <button class="btn btn-default btn-sm" type="button" @click="qtyDown">
			        	<span class="glyphicon glyphicon-minus"></span>
			        </button>
			      </span>
			      <input type="text" class="form-control input-sm" min="1" v-model="qty" value="1">
						<span class="input-group-btn">
			        <button class="btn btn-default btn-sm" type="button" @click="qty++">
			        	<span class="glyphicon glyphicon-plus"></span>
			        </button>
			      </span>
			    </div>
				</div>
				<div class="form-group">
				</div>
				<div class="form-group">
					<button :disabled="disable.addProduct" class="btn btn-success btn-sm" style="width:100%" @click="addProduct($event)">Add</button>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" style="width:100%" @click="print($event)">Print</button>
				</div>
			</div>
			<div class="col-sm-8">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Product</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="product in products" transition="fade">
							<td>
								<h5>{{ product.name }}</h5>
								<span class="text-label">{{ product.sizes[0].name }}</span>
							</td>
							<td><img src="<?=base_url()?>assets/images/furniture/{{ product.images.name }}" width="200"></td>
							<td><a href="#" @click="removeProduct($index, $event)"><span class="glyphicon glyphicon-trash text-danger"></span></a></td>
						</tr>
					</tbody>
				</table>
				<div class="row">
					<div class="col-sm-12">
						<button class="btn btn-primary pull-right" @click="print($event)">Print</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="container hide-on-print">
		<div class="form-group">

			<label for="">Font Size:</label>
			<div class="btn-group btn-group-xs" role="group" aria-label="...">
			  <button type="button" class="btn btn-default" @click="style.body.fontSize++"><span class="glyphicon glyphicon-plus"></span></button>
			  <button type="button" class="btn btn-default" disabled>{{ style.body.fontSize }}</button>
			  <button type="button" class="btn btn-default" @click="style.body.fontSize--"><span class="glyphicon glyphicon-minus"></span></button>
			</div>
			<button class="btn btn-xs" @click="style.body.fontSize = 12">Defult</button>
			<p></p>
		</div>
	</section>


	<section class="print-area container-fluid show-on-print">
		
		<ul class="list-unstyled tags">
			<li v-for="product in products" class="tag-item">
				<div class="tag-logo text-center">
					<img src="<?=base_url()?>assets/images/horestco-logo.png">
				</div>
				<hr>
				<h5 class="tag-heading" data-pid="{{ product.id }}">{{ product.name }}</h5>
				<hr>
				<div class="tag-body" :style="{fontSize: style.body.fontSize + 'px'}">
					<table class="table">
						<tr>
							<td class="text-label" style="color:#888">PRICE</td>
							<td>:</td>
							<td style="font-weight:bold">
								<span>MYR </span>
								<span :class="{ 'text-del' : product.sizes[0].prices.is_promo }">{{ product.sizes[0].prices.retail }}</span>
								<span v-if="product.sizes[0].prices.is_promo" class="text-danger">{{ product.sizes[0].prices.promo }}</span>
							</td>
						</tr>
						<tr>
							<td class="text-label" style="color:#888">CODE</td>
							<td>:</td>
							<td>{{{ product.code }}}</td>
						</tr>
						<tr>
							<td colspan="3">
								<span class="text-label" style="color:#888">DIMENSION :</span>
								<br>
								<span>{{{ product.sizes[0].dimension }}}</span>
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<span class="text-label" style="color:#888">DESCRIPTION :</span>
								<br>
								<span>{{{ product.desc }}}</span>
							</td>
						</tr>
					</table>
				</div>
				<div class="tag-image text-center">
					<img data-image="{{ product.images.id }}" src="<?=base_url()?>assets/images/furniture/{{ product.images.name }}" class="img-responsive">
				</div>
				<div class="tag-footer text-center">
					For more info : www.horestco.com
				</div>
			</li>
		</ul>
	</section>

</section>


<script class="hide-on-print" src="<?=base_url('assets/js/vue.min.js')?>"></script>
<script class="hide-on-print" src="<?=base_url('assets/js/vue-resource.min.js')?>"></script>

<script class="hide-on-print">

	Vue.component('images', {
		props : ['myFoo'],
		template : '<div>{{ myFoo }}</div>',
	});

	const App = new Vue({
		el : '#app',
		data : {
			messages : {},
			api : '../api/api.php',
			show : false,
			isActive : false,
			product : {pid:'', image:'', size:'' },
			images : [],
			sizes : [],
			products : [],
			qty : 1,
			disable : {
				addProduct : true,
			},
			// style
			style : {
				body : {
					fontSize : 12,
				}
			}
		},
		methods : {
			getPrdList : function(){
				this.$http.get(this.api, {_s:'prdList'}, function(data){
					this.$set('prdList', data);
				});
			},

			selectProduct : function(pid, e){
				var self = this;

				this.product.pid = pid;

				// reset
				self.images = [];
				this.$http.get(this.api, {_s:'product', pid:this.pid}, function(product){
					self.$set('sizes', product.sizes);
					self.$set('product.size',product.sizes[0].id)
					self.$set('images', product.images);
					self.$set('product.image', product.images[0].id);

					if(self.product.image != '')
					{
						self.disable.addProduct = false;
					}

				});



				this.show = true;
			},
			selectImage : function(pid, imgId, e){
				 this.product.image = imgId;
				// toggle class active
				var elm = jQuery(e.target);
				elm.parent().find('img').removeClass('active');
				elm.addClass('active');

				this.disable.addProduct = false;
			},
			addProduct : function(event){

				event.preventDefault();

				if(this.product.pid == '')
				{
					alert('Please select product');
					return false;
				}
				if(this.product.image == '')
				{
					alert('Please select image');
					return false;
				}

				for(var i=0; i < this.qty; i++){
					this._appendProduct({pid:this.product.pid, image:this.product.image, size:this.product.size});
				}

				this.disable.addProduct = true;
			},
			removeProduct : function(index, e){
				this.products.splice(index, 1);
				e.preventDefault();
			},

			print : function(e){
				if(this.products.length == 0)
				{
					alert('Add product first');
					return false;
				}

				window.print();
				
				e.preventDefault();
			},

			qtyDown : function(){
				if(this.qty > 1) this.qty--;
			},

			_appendProduct : function(product){
				var self = this;
				this.$http.get(this.api, {_s:'prdImgSize', pid:product.pid, image:product.image, size:product.size}, function(data){
					console.log(data)
					// append or prepend product
					self.products.unshift(data);

					// reset
					self.product = {pid: '', image: '', size:''};
					this.show = false;
					// selected
					var select = jQuery('#selectProduct');
					select.find('option').removeAttr('selected');
				});
			},

			_initProducts : function(){
				var products = [
					{pid:608, image:5, size:2},
					{pid:546, image:569, size:182},
					{pid:562, image:534, size:175},
				];

				for(var i=0; i < products.length; i++){
					var product = products[i];
					this._appendProduct({pid:product.pid, image:product.image, size:product.size});
				}
			}

		},
		ready : function(){
			// retrieve product list
			this.getPrdList();

			// init product
			this._initProducts();

		},
	});

</script>

<?php include '../partials/footer2.php' ?>
