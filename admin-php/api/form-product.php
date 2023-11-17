<?php
function alsoLike($capsule, $name, $category = null, $excludes = []){
    $names = explode(' ', $name);
    $queryCategory = $capsule->table('products')
                        ->select('id', 'name as text')
                        // ->orderByRaw("RAND()")
                        // ->limit(10)
                        ->where('is_enabled', 1);

    $query = $capsule->table('products')->orderBy('name')
                        ->select('id', 'name as text')
                        ->where('name', 'like', '%'.$names[0].'%')
                        ->where('is_enabled', 1);
    if( !is_null($category) ){
        $queryCategory->where('category_id', $category);
    }
    if( count($excludes) ){
        $queryCategory->whereNotIn('id', $excludes);
        $query->whereNotIn('id', $excludes);
    }

    // return $query->get();
    // return $queryCategory->get();
    return $query->unionAll($queryCategory)->get();
}

function getProductRelations($id){
    $product = Product::with('relations')->find($id);
    return $product->relations;
}
/**
 * ------------------------------------------------------
 * ACTION
 * ------------------------------------------------------
 */
if( $_SERVER['REQUEST_METHOD'] === 'POST' && $help->isAjax() ):
    //================ Also Like ====================
    if( @$_POST['action'] === 'also-like' ){
        header('Content-Type: application/json');
        $id = filter_var(@$_POST['id'], FILTER_VALIDATE_INT);
        $name = filter_var(@$_POST['name'], FILTER_SANITIZE_STRING);
        $category = filter_var(@$_POST['category'], FILTER_SANITIZE_STRING);
        
        $excludes = getProductRelations($id);
        // echo $excludes->lists('id');
        echo json_encode([
            'selected' => $excludes->lists('id'),
            'items' => alsoLike($capsule, $name, $category, $excludes->lists('id'))
        ]);
        exit();
    }
endif;