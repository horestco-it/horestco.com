<?php

require 'data.php';

$tag = new Pricetag;

$ids = "[480,478,628,629,659,882]";
// $ids = $_GET['ids'];
$ids = json_decode($ids);
// $helper->dd($tag->data($ids)->toArray());

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PRICE TAG</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?=base_url('admin-php/assets/css/bootstrap-default.min.css')?>" >
		<style>
			.text-label{
				color: #888;
			}
			.text-bold{
				font-weight: bold;
			}
			.tag{
				width: 21.0cm;
				height: 29.7cm;
				border: 1px solid #ddd;
			}
			.tag-logo{
				text-align: center;
				padding: 10px 0;
			}
			.tag-logo img{
				height: 24px;
			}
			.tag hr{
				margin: 0;
			}
			.tag-item{
				max-width: 6.5cm;
				height: 14.5cm;
				vertical-align: top;
				overflow:hidden;

				padding-left: 15px;
				padding-right: 15px;
			}
			.tag-heading{
				border-top: 1px solid #ddd;
				border-bottom: 1px solid #ddd;
			}
			.tag-heading h4{
				font-size: 12pt;
				font-weight: bold;
			}

			.tag-body{
				font-size: 8pt;
			}

			.table.tag-description{
				margin-bottom: 2px;
			}

			.table.tag-description td{
				border: none;
				padding: 2px;
				padding-left: 0;
			}
		</style>
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

		<div class="container">
			<table class="tag" border="1">
				<tbody>
					<?php foreach($tag->products($ids)->chunk(3) as $chunk):?>
					<tr>
						<?php foreach ($chunk as $key => $product): ?>
							<td class="tag-item">
								<div class="tag-logo">
									<img src="<?=base_url('assets/images/horestco-logo.png')?>">
								</div>
								<div class="tag-heading">
									<h4><?=$product->name?></h4>
								</div>
								<div class="tag-body">
									<table class="table tag-description" border="0">
										<tr>
											<td class="text-label">Price:</td>
											<td class="text-bold"><?=$product->price_current?></td>
										</tr>
										<tr>
											<td class="text-label">Code:</td>
											<td class="text-bold"><?=$product->code?></td>
										</tr>
										<tr>
											<td class="text-label">Dimension:</td>
											<td><?=$helper->br($product->dimension)?></td>
										</tr>
									</table>
									<div class="text-label">Description:</div>
									<?=$product->description?>
									<img class="img-responsive" src="<?=base_url('assets/images/furniture/'.$product->images[0]['name'])?>" alt="">
								</div>
								<div class="tag-footer">
									www.horestco.com.my
								</div>
							</td>
						<?php endforeach ?>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>

	</body>
	</html>
