<?php

if(! function_exists('product_thumbnail'))
{
	function product_thumbnail($products)
	{
		$html = '';
		$currency = 'MYR';

		if($products->count() == 0)
		{
			return $html;
		}

		$ci =& get_instance();

		$ci->load->helper('image_helper');
		foreach ($products->chunk(4) as $chunk):
			$html .= "<div class=\"row\">";
				foreach ($chunk as $key => $product):

					$options = array(
						'alt' => 'Teak Furniture Malaysia '.strtolower($product->subcategory['name'].' '. $product->name),
						'title' => ucwords($product->subcategory['name'].' - '.$product->name),
						'class'=> 'white-text post-image',
						'data-original'=> isset($product->imageThumb['name']) ? $product->imageThumb['name'] : null,
					);

					$label  = "<span class=\"grey-text hide-on-small-only\">";
					$label .= "	<i class=\"fa fa-tags grey-text text-darken-1 left hide-on-print gap gap-5\"></i> ";
					$label .= "</span>";
					//$label .= "<span class=\"gap gap-5 hide-on-small-only hide-on-print\"></span>";
					
				// 	$price = ($product->sizes && isset($product->sizes[0]) && $product->sizes[0]->prices['normal'] != '') 
				// 				? $product->sizes[0]->prices['normal'] == 0.00 ? '' 
				// 				: $label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">'.$currency.' '.$product->sizes[0]->prices['normal'].'</span>'
				// 				: ''; 

					// $price = ($product->sizes && $product->sizes[0]->prices['normal'] == '' || $product->sizes[0]->prices['normal'] == 0.00) 
					// 			? '' 
					// 			: $label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">'.$currency.' '.$product->sizes[0]->prices['normal'].'</span>';
				
					$html .= "<div class=\"col s6 m3 item\">";
					$html .= "<a href=\"".base_url()."furniture/".str_slug($product->name)."-".$product->id."\">";
					$html .= "	<div class=\"card lists\">";
					$html .= "		<div class=\"card-image\">";
								

									foreach ($product->images as $i => $image) {
										if( $i == 0 )
										{
											$options['data-lazy'] = false;
											$options['class'] = 'white-text post-image';
					$html .=		image_thumb(product_img_url($product->imageThumb['name']), 300, $options);
										}
					// 					if( $i == 1 && count($product->images) > 1 && !(int)$image->is_primary)
					// 					{
					// 						$options['class'] = 'transparent-text hover-image lazy lazy-loader';
					// 						$options['data-lazy'] = true;
					// 						$options['data-src'] = base_url(product_img_url(strtolower($image->name)));
					// $html .= 		image_thumb(product_img_url(strtolower($image->name)), 300, $options);
					// 					}
									}
								 
					$html .= 		"</div>";
					$html .= 			"<div class=\"card-content\" style=\"padding:10px\">";
					$html .= 				"<h5 class=\"card-title\">".strtoupper($product->name)."</h5>";
					$html .= 				"<ul>";
					$html .= 					"<li>";
				// 	$html .= $price;
					// $html .=							$product->sizes[0]->prices['promo'] == '' || $product->sizes[0]->prices['promo'] == 0.00 ? $price : $label."<span class=\"price-label grey-text text-darken-2\" style=\"margin-right:5px\">".$currency." ".$product->sizes[0]->prices['promo']."</span>";
					$html .= "				</li>";
					$html .= "			</ul>";
					$html .= "		</div>";
					$html .= "	</div>";
					$html .= "</a>";
					$html .= "</div>";

				endforeach;
			$html .= "</div>";
		endforeach;
		echo $html;
	}
}
/**
 * product_lists
 *
 * Function description
 *
 * @access	public
 * @param data	type	object 
 * @return	mix
 */
if (! function_exists('product_lists'))
{
	function product_lists($data = null, $subid = null)
	{
		if(is_null($data))
		{
			echo "null";
		}

		$ci =& get_instance();

		$ci->load->helper('image_helper');

		$html = '';

		$currency = 'MYR';


		foreach ($data as $key => $product):
			// update str image to str_slug
			//update_to_lower($product->imageThumb['id'], $product->imageThumb['name']);
			$grid = ($subid == 0 && $key == 0) ? 'grid-item grid-sizer' : 'grid-item';

				$html .= '<div class="col s12 m4 l3 item '.$grid.'" data-id="image-'.$product->subcategory['id'].'">';
					$html .= '<a href="'.base_url().'furniture/'.str_slug($product->name).'-'.$product->id.'">';
						$html .= '<div class="card lists">';
							$html .= '<div class="card-image">';

								$options = array(
									'alt' => 'Teak Furniture Malaysia '.strtolower($product->subcategory['name'].' '. $product->name),
									'title' => ucwords($product->subcategory['name'].' - '.$product->name),
									'class'=> 'white-text post-image',
									'data-original'=>$product->imageThumb['name'],
								);
								foreach ($product->images as $i => $image) {
									if( $i == 0 )
									{
										$options['data-lazy'] = false;
										$options['class'] = 'white-text post-image';
										// $html .= image_thumb(product_img_url(strtolower($image->name)), 300, $options);
										$html .= image_thumb(product_img_url($product->imageThumb['name']), 300, $options);
									}
									if( $i == 1 && count($product->images) > 1 && !(int)$image->is_primary)
									{
										$options['class'] = 'transparent-text hover-image lazy lazy-loader';
										$options['data-lazy'] = true;
										$options['data-src'] = base_url(product_img_url(strtolower($image->name)));
										$html .= image_thumb(product_img_url(strtolower($image->name)), 300, $options);
									}
								}

							$html .= '</div>';
							$html .= "<div class=\"card-content\" style=\"padding:10px\">";
							$html .= '<h5 class="card-title">'.strtoupper($product->name).'</h5>';
							$html .= '<ul>';

							// if(is_array($except) && in_array($product->category['id'], $except['category_id'])  ):

								$label = '<span class="grey-text hide-on-small-only" style="line-height:26px"><i class="mdi-action-label small grey-text text-darken-1 left hide-on-print"></i> </span><span class="gap gap-5 hide-on-small-only hide-on-print"></span>';
								$price = ($product->sizes[0]->prices['normal'] == '' || $product->sizes[0]->prices['normal'] == 0.00) ? '' : $label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">'.$currency.' '.$product->sizes[0]->prices['normal'].'</span>';
								$html .= '<li>'.$product->sizes[0]->prices['promo'] == '' || $product->sizes[0]->prices['promo'] == 0.00 ? $price : $label.'<span class="price-label grey-text text-darken-2" style="margin-right:5px">'.$currency.' '.$product->sizes[0]->prices['promo'].'</span>';

								$html .= '</li>';
							// endif;

							$html .= '</ul></div>';
						$html .= '</div>';
					$html .= '</a>';
				$html .= '</div>';

		endforeach;

		echo $html;
	}
}