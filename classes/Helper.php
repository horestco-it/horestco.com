<?php

use Illuminate\Support\Str;

require_once('Db.class.php');
class Helper extends Db

{
  private $db;

  private $path;

  public function __construct()
  {
    $this->db = new Db;
  }

  public function autoload($path)
  {
    $this->path = $path;
    spl_autoload_register(function($class){
      include  $this->path . '/' . $class . '.php';
    });
  }

  public function hashing($password, $salt = null)

  {

    $salt = (!is_null($salt)) ? 'garam' : $salt;

    return crypt($password, $salt);

  }



  public function pass_verify($input, $hash)

  {

    return hash_equals($hash, crypt($input, $hash));

  }

  

  public static function status($status)

  {

    if ( $status == 1 ) {

      return '<span style="color:green">Active</span>';

    }

    else{

      return '<span style="color:red">Inactive</span>';

    }

  }



  public static function printr($rs, $die = false)
  {
  	echo "<pre>";
  	print_r($rs);
  	echo "</pre>";
  	if($die) die();
  }
  
  public static function dd($rs)
  {
  	echo "<pre>";
  	var_dump($rs);
  	echo "</pre>";
  }

  public function json($rs)
  {
  	return json_encode($rs);
  }

  public function isAjax()
  {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  /**
   * $str = TIARA TABLE
   * output = tiara-table
   */

  public function url_slug($title, $separator = '-')
  {
    // $title = static::ascii($title);

    // Convert all dashes/underscores into separator
    $flip = $separator == '-' ? '_' : '-';

    $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

    // Remove all characters that are not the separator, letters, numbers, or whitespace.
    $title = preg_replace('![^'.preg_quote($separator).'\pL\pN\s]+!u', '', mb_strtolower($title));

    // Replace all separator characters and whitespace by a single separator
    $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

    return trim($title, $separator);
  }

  public function str_slug($value='')
  {
    return Str::slug($value);
  }


  public function deleteImage($file)
  {
    if ( file_exists($file) ) {
      // delete images
      unlink($file);
    }
  }

  public function imageSrc($file)
  {
    $fullFile = BASE_DIR . $file;
    return (file_exists($fullFile) ) ? BASE_URL . $file : BASE_URL . '/images/material/not-available.jpg';
    return $src;
  }



  /**
   * @param $alsolike = string (item1, item2, ...)
   * @param $option return array ("item1", "item2")
   * if $option true return array with single quote ("'item'", "'item2'")
   */

  public function getProductByAlsoLike($alsolike, $option = false)

  {

    $also = array();

    if ($option) {

      foreach (explode(',', $alsolike) as $item) {

        $also[] = $item;

      }

    }

    else{

      foreach (explode(',', $alsolike) as $item) {

        $also[] = "'$item'";

      }

    }

    return $also;

  }



  /**
   * @param string $imageId support array
   * @return array
   */

  public function getProductimageMaterial($imageId)

  {

    $db = new Db;

    $query = " SELECT material.id AS id, 

              material.code AS code, 

              material.name AS name, 

              image.imageId AS imageId, 

              image.isprimary AS isprimary, 

              image.imagename AS image ";

    $query .= " FROM productimage AS image ";

    $query .= " LEFT JOIN `productimage_material` AS pm ON image.imageId = pm.image_id ";

    $query .= " LEFT JOIN `materials` AS material ON pm.material_id = material.id ";

    $query .= " WHERE image.imageId IN({$imageId}) ORDER BY isprimary DESC ";



    $materials = $db->query($query);

    $res = array();

    $i = 0;

    foreach(array_values($materials) as $val){

       $res[$val['id']]['id'] =  $val['id'];

       $res[$val['id']]['name'] =  $val['name'];

       $res[$val['id']]['code'] =  $val['code'];

       $res[$val['id']]['images'][] =  $val['imageId'];



       if ($i == 0) $res[$val['id']]['default'] = 1;



       $i++;

    }

    return array_values($res);

  }



  public function materialImage($productId = null)

  {
    if (! is_null($productId) )
    {
      $this->db->bind('pid', $productId);
    }
    $query  = " SELECT  img.imageId, 
                        img.imagename, 
                        img.isPrimary, 
                        mat.id, 
                        mat.name, 
                        mat.description, 
                        mat.supplier_id,
                        type.id as typeId, 
                        type.name as type ";
    $query .= " FROM material_types as type ";
    $query .= " LEFT JOIN materials as mat";
    $query .= " ON type.id = mat.material_type_id ";
    $query .= " LEFT JOIN productimage as img ";
    $query .= " ON mat.id = img.material_id ";

    if(! is_null($productId) )
    {
      $query .= " WHERE productid = :pid ";
    }
    $query .= " ORDER BY typeId ";

    $res = $this->db->query($query);

    $images = array();
    foreach(array_values($res) as $i => $val){

       $images[$val['type']][$val['id']]['material_id'] =  $val['id'];
       $images[$val['type']][$val['id']]['type'] =  $val['type'];
       $images[$val['type']][$val['id']]['name'] =  $val['name'];
       $images[$val['type']][$val['id']]['description'] =  $val['description'];
       $images[$val['type']][$val['id']]['supplier'] =  $val['supplier_id'];
       $images[$val['type']][$val['id']]['id'][] =  $val['imageId'];
       $images[$val['type']][$val['id']]['images'][] =  $val['imagename'];



       if ($val['isPrimary'] == 'Y') $images[$val['type']][$val['id']]['default'] = 1;

    }



    return $images;

  }



  public function getImages($res, $images)

  {

    foreach ($material['images'] as $image) {

      $images[]['name'] = $image;

    }

    $images = array();

    foreach ($res as $i => $image) {

      $images[]['name'] = $images;

    }

    return $images;

  }

  public function br($res)

  {

    $search = array("\r\n", "\n", "\r");

    $replace = '<br />';

    $bio = str_replace($search, $replace,$res);

    return $bio;

  }


}



$helper =  new Helper;

 ?>
