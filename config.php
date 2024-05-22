<?php 
// include 'classes/Helper.php';
	// param

use Illuminate\Support\Str;

if(isset($_GET['action'])){
	define("GET_ACTION", $_GET['action']);
}
if (isset($_GET['id'])) {
	define("GET_ID", $_GET['id']);
}
if (isset($_GET['pid'])) {
	define("GET_PID", $_GET['pid']);
}
if (isset($_GET['catid'])) {
	define("GET_CATID", $_GET['catid']);
}
if (isset($_GET['subcatid'])) {
	define("GET_SUBCATID", $_GET['subcatid']);
}
if (isset($_POST['submit'])) {
	define("POST_SUBMIT", $_POST['submit']);	//
}

if (isset($_GET['lang'])) {
	define('LANG', $_GET['lang']);
}
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
define("THIS_FILE", $_SERVER['PHP_SELF']);
define('BASE_DIR', dirname(__FILE__));
define('PROTOCOL', $_SERVER['SERVER_NAME'] == 'horestco.com' ? 'https':'http');
define('BASE_URL', PROTOCOL."://$_SERVER[HTTP_HOST]");

if(!function_exists('base_url'))
{
	function base_url($segment = null)
	{
		return BASE_URL . '/' . $segment;
	}
}

if(!function_exists('base_path'))
{
	function base_path($segment = null)
	{
		return BASE_DIR . '/' . $segment;
	}
}

if(!function_exists('img_path'))
{
	function img_path($segment = null)
	{
		return 'assets/images/'. $segment;
	}
}

if (!function_exists('filter_lang'))
{
	function filter_lang($en, $id)
	{
		return (isset($_GET['lang']) && $_GET['lang'] == 'id') ? $id : $en;
	}
}

if (!function_exists('lang_url'))
{
	function lang_url()
	{
		return (isset($_GET['lang']) && $_GET['lang'] == 'id') ? '/id/' : '/';
	}
}


if (!function_exists('filter_outdoor'))
{
	function filter_outdoor($id, $name)
	{
		return $id == 41 ? 'outdoor' : $name;
	}
}

if (!function_exists('upload_image'))
{
	function upload_image($file, $setting = array())
	{
		// filename storage
		$filenames = [];
		///////////////////////////////////
		// setting default configuration //
		///////////////////////////////////
		$default = array(
			'multiple' 		=> false,
			'type'				=> array('jpg', 'png', 'gif', 'bmp'),
			'path'				=> $_SERVER['DOCUMENT_ROOT'].'/',
			'filename'		=> null,
			'random'			=> false,
			'size_limit'	=> 500000, // 500Kb
			'data'				=> array(),
		);

		$config = array_merge($default, $setting);

		/////////////////////////
		// convert to multiple //
		/////////////////////////
		// multiple
		if( is_array($file['name']) && $config['multiple'] == true )
		{
			if ( in_array(4, $file['error']) )
			{
				return false;
				exit;
			}
			$files = array_merge(array(), $file);
			$config['random'] = true;
		}
		// single
		elseif( !is_array($file['name']) && $config['multiple'] == false )
		{
			if( $file['error'] == 4 )
			{
				return false;
				exit;
			}
			$files = array();
			foreach($file as $key => $f){
				$files[$key] = (array)$f;
			}
		}
		else{
			throw new Exception("Multiple selection does not allowed");
			return false;
		}
		/////////////////////
		// proccess upload //
		/////////////////////
		try {
			foreach($files['name'] as $key => $name)
			{
				$ext =  pathinfo($name, PATHINFO_EXTENSION);
				$fnameInfo =  pathinfo($name, PATHINFO_FILENAME);
				// filter type
				if( !in_array($ext, $config['type']) )
				{
					throw new Exception("Format image <strong>{$name}</strong> is not allow");
				}
				// filter size
				if($files['size'][$key] > $config['size_limit']) {
	        throw new Exception("<strong>{$name}</strong> is too large!");
	      }
				// set filename
				$filename = !is_null($config['filename']) ? $config['filename'] : $fnameInfo;
				if( $config['random'] )
				{
					$filename = $filename."-".rand(100, 999);
				}
	      if( move_uploaded_file($files['tmp_name'][$key], $config['path'].$filename.".$ext") )
	      {
	      	$filenames[] = $filename.".$ext";
	      }
			}

			return $filenames;

		} catch (Exception $e) {
	    echo $e->getMessage() ."<br>";
	  }
	}
}

if (!function_exists('upload_product_image'))
{

	function upload_product_image($files, $setting)
	{

    $product = Product::find($setting['product_id']);

		$filename = array(
	    Str::slug($product->category['name']),
	    'furniture',
	    Str::slug($product->name),
	    $product->id
	  );
	  
		$default = [
			// basic upload
	    'multiple' => true,
	    'path'     =>  base_path(img_path('furniture/')),
	    'filename' => implode('-', $filename),
		];

		$config = array_merge($default, $setting);

    $filenames = upload_image($files, $config);

    if( count($filenames) > 0 )
    {
    	$images = [];
      foreach($filenames as $key => $filename){
	      $data = array(
	                'product_id' => (int)$product->id,
	                'is_primary' => 0,
	                'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
	                'updated_at' => \Carbon\Carbon::now('Asia/Jakarta')
	              );
        $data['name'] = $filename;
        $images[$key] = new Image($data);
      }

      $product->images()->saveMany($images);

      if( !in_array(1, $product->images->lists('is_primary')) )
      {
        $id = $product->images->lists('id')[0];
        $image = Image::find($id);
        $image->is_primary = 1;
        $image->save();
      }
      return true;
    }
    return false;
	}
}

if (!function_exists('src'))
{
	function src($file, $pathRelative = 'furniture/', $notFound = 'not-available.jpg')
	{
		$fileimage = img_path($pathRelative.$file);
		
	  return file_exists(base_path($fileimage))  ? base_url($fileimage) : base_url().img_path($notFound);
	}
}

if (!function_exists('setup_class'))
{
	/**
	 * setup css class
	 * @param  array  $inArray [$needle, $haystack]
	 * @param  array 	$class   class collection .example : ['classActive'=>'classInactive']
	 * @return string css class collection
	 */
	function setup_class($inArray = array(), $class)
	{
		$classes = (array)$class;

		$key = array_keys($inArray)[0];

		if(in_array($key, $inArray[$key]))
		{
			return implode(' ', array_keys($classes));
		}
		return implode(' ', $classes);
	}
}

if (!function_exists('check_ajax'))
{
	function check_ajax()
	{
		if( 
	  	isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
	  	&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
	  	&& !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
	  ){
			return true;
	  }else{
	  	return false;
	  }
	}
}

if (!function_exists('timestamps'))
{
	function timestamps($loc = 'Asia/Jakarta')
	{
		date_default_timezone_set($loc);
		$d = getdate();
		return "$d[year]-$d[mon]-$d[mday] $d[hours]:$d[minutes]:$d[seconds]";
	}
}

	
?>
