<?php 
	// ini_set("display_errors", 1);
include '../../../config.php';
include '../../api/check_session.php';

// if($type == 'A' || $type == 'U'):

include BASE_DIR . '/classes/Helper.php';
include BASE_DIR . '/classes/DB.php';

spl_autoload_register(function($class){
 include  BASE_DIR . '/' . $class . '.php';
});

function hasSearch()
{
  return isset($_GET['search']) ? '&amp;search' : '';
}
/**
 * ------------------------------------------
 * AJAX REQUEST
 * ------------------------------------------
 */
if ( isset($_GET['xhr']) && isset($_GET['action']) ) {
  

	$materials =  Models\MaterialType::where('id', $_GET['id'])->with(array(
                                  'suppliers'=>function($query){
                                      return $query->with(array('materials'));
                                    }
                                  ))
                                  ->get();
	function render($rs)
	{
		foreach($rs as $key => $type){
			$html  = "<h2 class=\"text-center text-uppercase\" style=\"margin-top:35px\">.:: {$type->name} ::.</h2>";
			$html .= "<hr>";
			foreach ($type->suppliers as $supplier) {
				$html .= "<h3 class=\"text-capitalize\">{$supplier->name} &reg;</h3>";
				$html .= "<ul class=\"list-inline\">";
				foreach ($supplier->materials as $material) {
					$file = '/images/material/' . $material->id . '-' . strtolower(str_replace(' ', '-', $material->name)) . '-small.jpg';
					$fullFile = BASE_DIR . $file;
					$src = (file_exists($fullFile) ) ? BASE_URL . $file : BASE_URL . '/images/material/not-available.jpg';
					$hasSearch = hasSearch();
					$html .= "<li class=\"thumbnail\">";
					$html .= "<a href=\"material.php?action=edit&id={$material->id}{$hasSearch}\">";
					$html .= "<img src=\"{$src}\" style=\"width:120px;height:90px\">";
					$html .= "{$material->name}</a><br>";

          if ( isset($_SESSION['type']) && $_SESSION['type'] == 'A' ):
					$html .= "<a href=\"material.php?delete&id={$material->id}\" title=\"delete item\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
          endif;

					$html .= "</li>";
				}
				$html .= "</ul>";
			}
			print $html;
		}
	}
  // search
	if ( $_GET['action'] == 'search' ) {
  		render($materials);
	}

	// tree
	if ( $_GET['action'] == 'json' ) {
		$data = array();
		$imageIds = array();
		$materialIds = array();
		$supplierIds = array();
		
		$model2 = Models\Product::where('productId', $_GET['id'])
									->select('productId', 'title as name')
									->with(array('images' => function($query){
										return $query->with('materials');
									}))
									->first();
		$rs = Models\MaterialType::with(array(
                                        'suppliers'=>function($query){
                                            return $query->with(array('materials'=>function($query){
                                              return $query->with(array('images'=>function($query){
                                                return $query->where('productid', $_GET['id']);
                                              }));
                                            }));
                                          }
                                        ))
                                        ->get();

      $images = array();
      foreach ($model2->images as $image) {
      	$images[]['name'] = $image->imagename;
      	$imageIds[] = $image->imageId;
      	foreach ($image->materials as $material) {
      		$materialIds[] = $material->id;
      		$supplierIds[] = $material->supplier_id;
      	}
      }

      foreach ($rs as $key => $category) {
      	$data[$key]['id'] = $category->id;
      	$data[$key]['text'] = $category->name;
      	foreach ($category->suppliers as $i => $supplier) {
      		$data[$key]['children'][$i]['id'] = $supplier->id;
      		$data[$key]['children'][$i]['text'] = $supplier->name;
      		if( in_array($supplier->id, $supplierIds) )
   			{
      			$data[$key]['children'][$i]['state'] = "open";
   			}else{
      			$data[$key]['children'][$i]['state'] = "closed";
   			}
      		foreach ($supplier->materials as $j => $material) {
      			$data[$key]['children'][$i]['children'][$j]['id'] = $material->id;
      			$data[$key]['children'][$i]['children'][$j]['text'] = $material->name;
      			$data[$key]['children'][$i]['children'][$j]['parentId'] = $supplier->id;
      			if( in_array($material->id, $materialIds) )
      			{
      				$data[$key]['children'][$i]['children'][$j]['checked'] = true;
      			}else{
      				$data[$key]['children'][$i]['children'][$j]['checked'] = false;
      			}

            foreach ($material->images as $k => $image) {
              if( in_array($image->imageId, $imageIds) ){
                $data[$key]['children'][$i]['children'][$j]['attributes']['images'][$k]['imageId'] = $image->imageId;
                $data[$key]['children'][$i]['children'][$j]['attributes']['images'][$k]['name'] = $image->imagename;
      				}
      			}
      			
      		}
      	}
      }
      // $helper->dd( $images );
      if ( isset($_GET['images']) ) {
      	$data = '';
      	print_r(json_encode($images));
      }
      else{
      	print_r(json_encode($data));
      }


	}

}
?>


<?php //endif; ?>