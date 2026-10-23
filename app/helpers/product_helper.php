<?php

use Illuminate\Support\Str;

if(! function_exists('product_thumbnail'))
{
	function product_thumbnail($products)
	{
		$html = '';

		if (empty($products))
		{
			return $html;
		}

		$chunks = is_array($products) ? array_chunk($products, 4) : $products->chunk(4);

		$ci =& get_instance();
		$ci->load->helper('image_helper');

		foreach ($chunks as $chunk):
			$html .= '<div class="row">';
				foreach ($chunk as $key => $product):
					$product = is_array($product) ? (object)$product : $product;
					$subName = isset($product->subcategory['name']) ? $product->subcategory['name'] : (isset($product->category['name']) ? $product->category['name'] : 'Furniture');
					$thumbImg = isset($product->imageThumb['name']) ? $product->imageThumb['name'] : (isset($product->images[0]->src) ? $product->images[0]->src : (isset($product->images[0]['src']) ? $product->images[0]['src'] : ''));

					$options = array(
						'alt' => 'Horestco ' . strtolower($subName . ' ' . $product->name),
						'title' => ucwords($subName . ' - ' . $product->name),
						'class' => 'white-text post-image responsive-img',
						'data-original' => $thumbImg,
					);

					$slug = isset($product->slug) ? $product->slug : Str::slug($product->name);

					$html .= '<div class="col s6 m3 item">';
					$html .= '<a href="' . base_url() . 'furniture/' . $slug . '-' . $product->id . '">';
					$html .= '	<div class="card lists z-depth-1">';
					$html .= '		<div class="card-image">';
					$html .= 			image_thumb(product_img_url($thumbImg), 300, $options);
					$html .= '		</div>';
					$html .= '		<div class="card-content" style="padding:10px">';
					$html .= '			<h5 class="card-title" style="font-size: 0.95rem; font-weight: 600; line-height: 1.3;">' . strtoupper($product->name) . '</h5>';
					if (!empty($product->code) || !empty($product->sku)) {
						$code = !empty($product->code) ? $product->code : $product->sku;
						$html .= '		<p style="font-size:0.8rem; color:#888; margin-top:4px;">CODE: ' . htmlspecialchars($code) . '</p>';
					}
					$html .= '		</div>';
					$html .= '	</div>';
					$html .= '</a>';
					$html .= '</div>';

				endforeach;
			$html .= '</div>';
		endforeach;
		echo $html;
	}
}

/**
 * product_lists
 */
if (! function_exists('product_lists'))
{
	function product_lists($data = null, $subid = null)
	{
		if(empty($data))
		{
			return;
		}

		$ci =& get_instance();
		$ci->load->helper('image_helper');

		$html = '';

		foreach ($data as $key => $product):
			$product = is_array($product) ? (object)$product : $product;
			$grid = ($subid == 0 && $key == 0) ? 'grid-item grid-sizer' : 'grid-item';
			$subId = isset($product->subcategory['id']) ? $product->subcategory['id'] : 0;
			$subName = isset($product->subcategory['name']) ? $product->subcategory['name'] : 'Furniture';
			$thumbImg = isset($product->imageThumb['name']) ? $product->imageThumb['name'] : (isset($product->images[0]->src) ? $product->images[0]->src : '');
			$slug = isset($product->slug) ? $product->slug : Str::slug($product->name);

			$html .= '<div class="col s12 m4 l3 item ' . $grid . '" data-id="image-' . $subId . '">';
			$html .= '<a href="' . base_url() . 'furniture/' . $slug . '-' . $product->id . '">';
			$html .= '<div class="card lists z-depth-1">';
			$html .= '<div class="card-image">';

			$options = array(
				'alt' => 'Horestco ' . strtolower($subName . ' ' . $product->name),
				'title' => ucwords($subName . ' - ' . $product->name),
				'class' => 'white-text post-image responsive-img',
				'data-original' => $thumbImg,
			);

			$html .= image_thumb(product_img_url($thumbImg), 300, $options);

			$html .= '</div>';
			$html .= '<div class="card-content" style="padding:10px">';
			$html .= '<h5 class="card-title" style="font-size: 0.95rem; font-weight: 600; line-height: 1.3;">' . strtoupper($product->name) . '</h5>';
			if (!empty($product->code) || !empty($product->sku)) {
				$code = !empty($product->code) ? $product->code : $product->sku;
				$html .= '<p style="font-size:0.8rem; color:#888; margin-top:4px;">CODE: ' . htmlspecialchars($code) . '</p>';
			}
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</a>';
			$html .= '</div>';

		endforeach;

		echo $html;
	}
}
