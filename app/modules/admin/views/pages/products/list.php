<div class="container">

	<div class="row">

		<div class="col s6 input-field">

			

			<input type="text" id="search" list="code" v-model="filterKey">

			<label for="search">Search Anything</label>

			<datalist id="code">

				<?php $option = '' ?>

			<?php foreach ($products as $key => $product): ?>

				<?php $option .= "<option value=\"$product->code\">$product->name</option>"; ?>

			<?php endforeach ?>

			<?php echo $option; ?>

				

			</datalist>



		</div>



		<div class="col s6 add-product">

			<a href="../catalog/add" class="btn"><i class="material-icons">add</i></a>

		</div>



		<div class="col s12">

			<table>

				<thead>

					<tr>

						<th v-for="column in columns">{{ column }}</th>

					</tr>

				</thead>

				<tbody>

					<tr style="border-bottom:1px solid #ddd" 

							v-for="product in data | filterBy filterKey" 

							data-id="{{$index + 1}}">



						<td>{{product.code}}</td>

						<td>{{product.name}}</td>

						<td>{{product.is_enabled}}</td>

						<td>{{product.subcategory['name']}}</td>

						<td>

							<a href="edit/{{product.id}}" target="_blank" class="btn">Edit</a>

						</td>

					</tr>					

				</tbody>

			</table>

		</div>

	</div>

</div>



<script src="<?=script_url('vue.min.js')?>"></script>

<script src="<?=script_url('vue-resource.min.js')?>"></script>

<script>

	new Vue({

		el : '#app',

		data : {

			columns : ['Code', 'Name', 'Status', 'Sub Category', 'Action'],

			filterKey : '',

			data : []

		},

		ready: function(){

			this.getProducts();

		},

		methods : {

			getProducts : function(){

				this.$http.post('/admin/catalog/products/ajax', {jqxhr:true})

									.success(function(data){

										this.$set('data', data);

									});



			}

		}

	});

</script>