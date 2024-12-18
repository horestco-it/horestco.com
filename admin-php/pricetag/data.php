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
			// $product->is_hidding = false;
			$product->images = $product->images()->where('id', $imageId)->first();
			$products[$product->id] = $product;
		}

		return collect($this->itemComplement($products));
	}

	private function itemComplement($products, $item = 3)
	{
		$result = [];
		$lastProduct = collect($products)->last();
		$id = $lastProduct->id;
		$product = \Product::find($id);
		$product->images = $product->images()->where('id', $lastProduct->images->id)->first();
		$product->is_hidden = true;

		$dividen = collect($products)->count() % $item;
		// jika jumlah item bukan kelipatan 3
		$need = $dividen != 0 ? $item - $dividen : 0;

		for($i=0; $i < $need ; $i++){
			$products = array_add($products, 'hidden-'.$i, $product);
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

	public function text($text)
	{
		return '<font style="font-size:24pt" face="Arial" valign="top">'.$text.'</font>';
	}

	private function styleHidden($product)
	{
		return isset($product->is_hidden) ? 'text-hidden' : '';
	}


	public function template($data)
	{

		$baseImage = base_url('assets/images');
		$html = '<table class="tag" cellpadding="10"><tbody>';
		foreach($data->chunk(3) as $key => $chunk):
		$html .= '<tr bgcolor="#fff">';
			foreach ($chunk as $product):
			$image = isset($product->images) ? $baseImage.'/furniture/'.$product->images->name : $baseImage.'/not-available.jpg';
		$html .= '		<td class="tag-item">';
		$html .= '				<table class="table tag-description">';
		$html .= '					<tr>';
		$html .= '						<td colspan="2" class="tag-logo"><img src="'.base_url('assets/images/horestco-logo.png').'" class="img-resposive" /></td>';
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
		$html .= '							<img style="width:100%;padding:15px 0" class="img-responsive" src="'.$image.'"/>';
		$html .= '						</td>';
		$html .= '					</tr>';
		$html .= '					<tr>';
		$html .= '						<td colspan="2" align="center"><font face="Carme" size="7">www.horestco.com</font></td>';
		$html .= '					</tr>';
		$html .= '				</table>';
		$html .= '		</td>';
			endforeach;
		$html .= '</tr>';
		endforeach;
		$html .= '</tbody></table>';

		return $html;
	}

	public function template2($data)
	{	
		$html = '';

		foreach(collect($data)->chunk(3) as $chunk):
			$html .= '<div class="row">';
			foreach($chunk as $key => $product):
				$html .= '<div class="col-sm-4">';
					$image = $product->images ? $product->images->name : 'not-available.jpg';
					$html .= '<h1>'.$product->name.'</h1>';
				$html .= '</div>';
			endforeach;
			$html .= '</div>';
		endforeach;

		$html .= '';
		return $html;
	}

}
