<div class="container">
	<div class="row center">
		<h5>Generate sitemap.xml</h5>
		<p>click button bellow to write sitemap.xml</p>
		<form id="generate-sitemap" method="post">
			<button class="btn" type="submit" name="submit">Generate</button>
		</form>
	</div>

	<div class="row" id="result">
		<div class="col s12 loader center"></div>
		<div class="col s12 info"></div>
	</div>
	
	<div class="row table">
	<?php if(count($sitemaps) == 0):?>
		<h3 class="grey-text">No Item</h3>
	<?php else:?>
		<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>Created</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
			<?php foreach($sitemaps as $key => $sitemap):?>
			<tr data-id="<?=$sitemap->id?>">
				<td><a href="<?=base_url('sitemaps/'.$sitemap->name)?>"><?=$sitemap->name?></a></td>
				<td><?=$sitemap->created_at?></td>
				<td><a href="#" class="use-btn">Use</a></td>
			</tr>
			<?php endforeach?>							
			</tbody>
		</table>
	</div>
	<?php endif?>
</div>

<script>
	$(document).ready(function(){
		var $sitemap = $('#generate-sitemap');
		var $loader = $('.loader');
		var $info = $('.info');
		var $table = $('table tbody');
		var $use = $('.use-btn');

		$sitemap.submit(function(e){
			e.preventDefault();
			$loader.html('Loading...');
			var post = $.post('/admin/sitemap/generate', {data:1});
			post.success(function(json){
				console.log(JSON.parse(json))
				if(json)
				{
					location.reload()
				}
			})
		});

		$use.click(function(e){
			e.preventDefault();
			var id = $(this).closest('tr').data('id');
			var post = $.post('/admin/sitemap/useit', {action:'useit', id:id});
			post.success(function(data){
				location.reload();
			});
		});
	});
</script>