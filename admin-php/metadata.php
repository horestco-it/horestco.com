<?php
  ini_set("display_errors", 1);
	
require 'api/check_session.php';
require '../classes/DB.php';
require '../classes/SheetDB.php';
require '../config.php';
require '../classes/Helper.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] != 'A' ){
  header('location:dahboard.php');
  return;
}
$helper = new Helper();
$metadata = new SheetDB();

$metadataValues = $metadata->get();

if(isset($_POST['submit']) && count($metadataValues) > 0){
	$data = [];

	foreach ($metadataValues as $item) {
		$data[] = [
			'id' => $item->ID,
			'page' => $item->PAGE,
			'title' => $item->TITLE,
			'description' => $item->DESCRIPTION,
			'keywords' => $item->KEYWORDS
		];
	}
	if(count($data)){
		$capsule->table('metas')->truncate();
		$capsule->table('metas')->insert($data);
	}
	echo "submit";
}
	// top navigation
	include 'partials/header.php';
 ?>

	<div id="wrap" class="container">
		<h2>METADATA</h2>
		<div class="panel-body">
			<div class="text-left">
				<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<button type="submit" name="submit" class="btn btn-success btn-sm" style="min-width:150px;margin-bottom:1em">Sync</button>
				</form>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>PAGE</th>
						<th>TITLE</th>
						<th>DESCRIPTION</th>
						<th>KEYWORDS</th>
					</tr>
				</thead>
				<!-- <tbody data-sheetdb-url="https://sheetdb.io/api/v1/r6ob29yy8mnw7"
							data-sheetdb-sort-by="ID"
							data-sheetdb-sort-order="asc"> -->
				<?php if(count($metadataValues)) :?>
				<tbody>
					<?php foreach($metadataValues as $item):?>
					<tr>
						<td><?=$item->ID?></td>
						<td><?=$item->PAGE?></td>
						<td><?=$item->TITLE?></td>
						<td><?=$item->DESCRIPTION?></td>
						<td><?=$item->KEYWORDS?></td>
					</tr>
					<?php endforeach?>
				</tbody>
				<?php else: ?>
				<tbody>
					<tr>
						<td><em>Data is empty</em></td>
					</tr>
				</tbody>	
				<?php endif ?>
				
			</table>
		</div>
	</div><!-- end wrap -->

  <?php include 'partials/footer.php'; ?>
	<!-- <script src="https://sheetdb.io/handlebars.js"></script> -->
  </body>
</html>