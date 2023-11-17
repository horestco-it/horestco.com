<?php 
include 'config.php';


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

if (!function_exists('str_slug'))
{
	function str_slug($value='')
  {
    $url = strtolower( str_replace(' ', '-', $value) );
    
    return str_replace(',', '', $url);
  }
}


if (!function_exists('printr'))
{
	function printr($rs, $die = false)
  {
  	echo "<pre>";
  	print_r($rs);
  	echo "</pre>";
  	if($die) die();
  }
}

if (!function_exists('dd'))
{
	function dd($rs)
  {
  	echo "<pre>";
  	var_dump($rs);
  	echo "</pre>";
  }
}

if (!function_exists('upload_image'))
{
	function upload_image($file, $setting = array())
	{
		if( $file['error'] != 0 )
		{
			return false;
		}
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
		);

		$config = array_merge($default, $setting);

		/////////////////////////
		// convert to multiple //
		/////////////////////////
		if( is_array($file['name']) && $config['multiple'] == true )
		{
			// multiple
			if ( !in_array(0, $file['error']) )
			{
				return false;
			}
			$files = array_merge(array(), $file);
			$config['random'] = true;
		}
		elseif( !is_array($file['name']) && $config['multiple'] == false )
		{
			$files = array();
			foreach($file as $key => $f){
				$files[$key] = (array)$f;
			}
		}
		else{
			throw new Exception("Multiple selection does not allowed");
			return false;
		}
		

		$success = [];
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
	      $success[] =  move_uploaded_file($files['tmp_name'][$key], $config['path'].$filename.".$ext");
			}

			return in_array(1, $success);

		} catch (Exception $e) {
	    echo $e->getMessage() ."<br>";
	  }
	}
}

if (!function_exists('timestamps'))
{
	function timestamps($loc = 'Asia/Jakarta')
	{
		date_default_timezone_set($loc);
		$d = getdate();
		echo "$d[year]-$d[mon]-$d[mday] $d[hours]:$d[minutes]:$d[seconds]";
	}
}

	
?>
