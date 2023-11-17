<?php
require '../../classes/DB.php';
require '../../classes/Helper.php';
require '../../config.php';

/**
 * GLOBAL Functions
 */
class Pricetag
{
	public function __construct()
	{
		$this->helper = new Helper;
	}

	public function products($ids){
		$products = \Product::whereIn('id', $ids)
							->enabled()
							->orderByRaw("FIELD(id, ".implode(',', $ids).")")
							->get();

		return $products;
	}

	public function productWithImage($ids)
	{
		$products = [];
		foreach ($ids as $id => $imageId) {
			$product = \Product::find($id);
			$product->images = $product->images()->where('id', $imageId)->first();
			$products[$id] = $product;
		}
		return $products;
	}

	public function allProducts()
	{
		return Product::orderBy('name')->enabled()->get();
	}

	public function selectImage($imageId, $images)
	{
		foreach ($images as $key => $image) {
			if($imageId == $image->id)
			{
				return $image->name;
			}
		}
	}

	public function template2($data)
	{	
		$html = '';
		$html .= '<ul>';
		foreach($data as $product){
			$image = $product->images ? $product->images->name : 'not-available.jpg';
			$html .= '<li>'.$product->name.' - '.$image.'</li>';
		}
		$html .= '</ul>';
		return $html;
	}

	public function text($text)
	{
		return '<font style="font-size:24pt" face="Arial" valign="top">'.$text.'</font>';
	}

	public function template($data)
	{
		$baseImage = base_url('assets/images');
		$html = '<table class="tag" cellpadding="10"><tbody>';
		foreach(collect($data)->chunk(3) as $chunk):
		$html .= '<tr bgcolor="#fff">';
			foreach ($chunk as $key => $product):
			$image = $product->images ? $baseImage.'/furniture/'.$product->images->name : $baseImage.'/not-available.jpg';
		$html .= '		<td class="tag-item">';
		$html .= '				<table class="table tag-description">';
		$html .= '					<tr>';
		$html .= '						<td colspan="2" class="tag-logo"><img src="'.base_url('assets/images/horestco-logo.png').'" /></td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td colspan="2"><hr><h1 class="tag-heading">'.$product->name.'</h1><hr></td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td class="text-label">'.$this->text('Price:').'</td>';
		$html .= '						<td class="text-bold">'.$this->text($product->price_current).'</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td class="text-label">'.$this->text('Code:').'</td>';
		$html .= '						<td class="text-bold">'.$this->text($product->code).'</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td class="text-label">'.$this->text('Dimension:').'</td>';
		$html .= '						<td>'.$this->text($this->helper->br($product->dimension)).'</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td colspan="2" class="text-label">'.$this->text('Description:').'</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td colspan="2">'.$this->text($this->helper->br($product->description)).'<br>';
		$html .= '							<img style="padding:15px 0" class="img-responsive" src="'.$image.'"/>';
		$html .= '						</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td colspan="2" align="center"><font face="Carme" size="7">www.horestco.com.my</font></td>';
		$html .= '					</tr>';
		$html .= '				</table>';
		$html .= '		</td>';
			endforeach;
		$html .= '</tr>';
		endforeach;
		$html .= '</tbody></table>';

		return $html;
	}

}
