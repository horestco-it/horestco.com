<div class="jumbotron">
	<div class="container">
		<h1>CUSTOMER</h1>
	</div>
</div>
<section>
	<div class="container">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Register Since</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($customers as $key => $customer): ?>
						<tr>
							<td><?=$customer->name?></td>
							<td><?=$customer->last_name?></td>
							<td><?=$customer->email?></td>
							<td><?=$customer->created_at?></td>
							<td><a href="<?=$_SERVER['PHP_SELF']?>?detail&amp;id=<?=$customer->id?>">more...</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</section>