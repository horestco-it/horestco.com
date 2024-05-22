<?php

use Illuminate\Support\Str;
defined('BASEPATH') OR exit('No direct script access allowed');


function getConfig($type = null)
{

  $setting = parse_ini_file(FCPATH.'/setting.ini.php');
  if($type) {
    return $setting[$type];
  }
  return $setting;
}

function url($path = false) {
  $config = getConfig();
  if($path) {
    $config['server_url'].'/'.$path;
  }
	return $config['server_url'];
}

function server_url() {
  $config = getConfig();
	return $config['server_url'];
}

if (! function_exists('get_meta'))
{
  function get_meta($page = 'home')
  {
    $meta = Metadata::where('page', $page)->first();
    if( $meta ) {
      foreach ($meta->toArray() as $name => $content) {
        if ($name == 'title')
        {
          echo "<title>".trim(ucwords($content))."</title> \n";
        }
        elseif(
             $name == 'description'
          || $name == 'keywords'
          || $name == 'author'
          || $name == 'robots'
          )
        {
          echo "<meta name=\"$name\" content=\"".ucwords($content)."\"/> \n";
        }   
      }
      return;
    }
    else{
      $title = 'Teak Wood Furniture - HORESTCO INDUSTRIES (M) SDN. BHD (888188-K)';
      $description = 'Buy teak wood furniture for your home from Horestco, furniture Manufacturer, Retailer and Wholesaler. We offer a wide range of furniture designs suiting to your needs.';
      $keyword = 'Teak Wood Furniture Malaysia, Outdoor Furniture Malaysia, Restaurant Furniture Wholesaler, Rattan Furniture, Restaurant Chairs Distributor, Custom Fine Dining Furnitures, Swimming Pool Furniture Kuala Lumpur, Restaurant Table And Chair Supplier, Bar Chairs And Tables, Hotel Furniture Supplier Malaysia, Outdoor Stainless Steel Furniture, Modern Resort Furniture, Contract Cafe Furniture, Malaysia, Dining Furniture, Living Furniture, Bedroom Furniture, Outdoor Funiture';
      $author = 'Horestco Sdn. Bhd. - Malaysia';
      $robots = 'index, follow';

			echo '<title>'.$title.' - HORESTCO</title>';
      echo '<meta name="description" content="'.$description.'" />';
      echo '<meta name="keyword" content="'.$keyword.'" />';
      echo '<meta name="author" content="'.$author.'" />';
      echo '<meta name="robots" content="'.$robots.'" />';
		}
  }

	function get_meta0($slug = '/')
	{
		$page = Page::slug($slug)
									->en()
									->with(array(
										'metas'
									))
									->first();
                  
		if( is_null($page) || !$page->metas )
		{
      $meta = Meta::find(1);
			echo '<title>'.$meta->title.'</title>';
      foreach (['description', 'keywords', 'author', 'robots'] as $item) {
        echo '<meta name="'.$item.'" content="'.$meta->$item.'" />';
      }
      return;
		}						
		foreach ($page->metas->toArray() as $name => $content) {
      if ($name == 'title')
      {
      	echo "<title>".trim(ucwords($content))." - HORESTCO</title> \n";
      }
      elseif(
      		 $name == 'description'
      	|| $name == 'keywords'
      	|| $name == 'author'
      	|| $name == 'robots'
      	)
      {
        echo "<meta name=\"$name\" content=\"".ucwords($content)."\"/> \n";
      }   
    }
	}
}

if (! function_exists('active_page'))
{
	function active_page($current, $link, $cssClass = ' active')
	{
		if($current == Str::slug($link)) echo $cssClass;
		return false;
	}
}

if ( !function_exists('assets_url') )
{
	function assets_url($file = '')
	{
		return base_url('assets/'). $file;
	}
}

if(!function_exists('asset_styles'))
{
  /**
   * fetch style asset <link>
   * $styles = [
   *   ['href'=>'style.css', 'media'=>'all'],
   *   ['href'=>'style2.css', 'media'=>'screen'],
   *   ['href'=>'print.css', 'media'=>'print'],
   *  ]
   * @param  [array] $styles mix
   * @param  [array] $setting mix
   * @return [type]  mix
   */
  function asset_styles( $styles = array(), $setting = array())
  {
    if(!is_array($styles))
    {
      return "Paramater 1 must be array type";
    }
    if( count($styles) == 0 ) return;

    $default['path'] = base_url('assets/css');

    $config = array_merge($default, $setting);


    foreach ($styles as $i => $style) {
      $attr = "";
      $style['rel'] = 'stylesheet';
      foreach ($style as $prop => $value) {
        if ($prop == 'href' && isset($config['path']) )
        {
          $value = $config['path'].'/'.$value;
        }
        $attr .= " {$prop}=\"{$value}\" ";
      }
      echo "<link $attr>";
    }
  }
}

if(!function_exists('asset_scripts'))
{
  /**
   * fetch style asset <link>
   * $scripts = [
   *   ['href'=>'style.css', 'media'=>'all'],
   *   ['href'=>'style2.css', 'media'=>'screen'],
   *   ['href'=>'print.css', 'media'=>'print'],
   *  ]
   * @param  [array] $scripts mix
   * @param  [array] $setting mix
   * @return [type]  mix
   */
  function asset_scripts( $scripts = array(), $setting = array())
  {
    if(!is_array($scripts))
    {
      return "Paramater 1 must be array type";
    }
    if( count($scripts) == 0 ) return;

    $default['path'] = base_url('assets/js/');
    $config = array_merge($default, $setting);

    foreach ($scripts as $i => $script) {
      $attr = "";
      foreach ($script as $prop => $value) {
        if ($prop == 'src' && isset($config['path']) )
        {
          $value = $config['path'].$value;
        }
        $attr .= " {$prop}=\"{$value}\" ";
      }
      echo "<script $attr></script>";
    }
  }
}


if ( !function_exists('img_url') )
{
	function img_url($file = '')
	{
		return 'assets/images/'. $file;
	}
}

if ( !function_exists('server_img_url') )
{
	function server_img_url($file = '')
	{
		return server_url().img_url($file);
	}
}

if ( !function_exists('product_img_url') )
{
	function product_img_url($file = '')
	{
		return 'assets/images/furniture/'. $file;
	}
}

if ( !function_exists('style_url') )
{
	function style_url($file = '')
	{
		return base_url('assets/css/'. $file);
	}
}

if ( !function_exists('script_url') )
{
	function script_url($file = '')
	{
		return base_url('assets/js/'.$file);
	}
}

if ( !function_exists('assets') )
{
	function assets($index = null, $file = 'assets.json')
	{
		$json = file_get_contents(FCPATH.'resources/theme/2016/assets/'. $file);

    $result =  json_decode($json, true);

    if (is_null($index))
    {
    	return $result;
    }
    return $result[$index];
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

if (! function_exists('vd'))
{
	function vd($data)
	{
		echo "<pre>";
		var_dump($data);
        echo "</pre>";
        exit();
	}
}

if (! function_exists('update_product_code'))
{
	function update_product_code($id, $code)
	{
		$product = Product::find($id);
		$product->code = str_replace(' ', '', $code);
		$product->save();
	}
}


if (!function_exists('minify_html'))
{
	///////////////////
	// HTML Minifier //
	/////////////////////////////////////////////////////////
	/// https://gist.github.com/tovic/d7b310dea3b33e4732c0 //
	/////////////////////////////////////////////////////////
	function minify_html($input) {
    if(trim($input) === "") return $input;
    // Remove extra white-space(s) between HTML attribute(s)
    $input = preg_replace_callback('#<([^\/\s<>!]+)(?:\s+([^<>]*?)\s*|\s*)(\/?)>#s', function($matches) {
        return '<' . $matches[1] . preg_replace('#([^\s=]+)(\=([\'"]?)(.*?)\3)?(\s+|$)#s', ' $1$2', $matches[2]) . $matches[3] . '>';
    }, str_replace("\r", "", $input));
    // Minify inline CSS declaration(s)
    if(strpos($input, ' style=') !== false) {
        $input = preg_replace_callback('#<([^<]+?)\s+style=([\'"])(.*?)\2(?=[\/\s>])#s', function($matches) {
            return '<' . $matches[1] . ' style=' . $matches[2] . minify_css($matches[3]) . $matches[2];
        }, $input);
    }
    return preg_replace(
        array(
            // t = text
            // o = tag open
            // c = tag close
            // Keep important white-space(s) after self-closing HTML tag(s)
            '#<(img|input)(>| .*?>)#s',
            // Remove a line break and two or more white-space(s) between tag(s)
            '#(<!--.*?-->)|(>)(?:\n*|\s{2,})(<)|^\s*|\s*$#s',
            '#(<!--.*?-->)|(?<!\>)\s+(<\/.*?>)|(<[^\/]*?>)\s+(?!\<)#s', // t+c || o+t
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<[^\/]*?>)|(<\/.*?>)\s+(<\/.*?>)#s', // o+o || c+c
            '#(<!--.*?-->)|(<\/.*?>)\s+(\s)(?!\<)|(?<!\>)\s+(\s)(<[^\/]*?\/?>)|(<[^\/]*?\/?>)\s+(\s)(?!\<)#s', // c+t || t+o || o+t -- separated by long white-space(s)
            '#(<!--.*?-->)|(<[^\/]*?>)\s+(<\/.*?>)#s', // empty tag
            '#<(img|input)(>| .*?>)<\/\1>#s', // reset previous fix
            '#(&nbsp;)&nbsp;(?![<\s])#', // clean up ...
            '#(?<=\>)(&nbsp;)(?=\<)#', // --ibid
            // Remove HTML comment(s) except IE comment(s)
            '#\s*<!--(?!\[if\s).*?-->\s*|(?<!\>)\n+(?=\<[^!])#s'
        ),
        array(
            '<$1$2</$1>',
            '$1$2$3',
            '$1$2$3',
            '$1$2$3$4$5',
            '$1$2$3$4$5$6$7',
            '$1$2$3',
            '<$1$2',
            '$1 ',
            '$1',
            ""
        ),
    $input);
	}
}


// CSS Minifier => http://ideone.com/Q5USEF + improvement(s)
if(!function_exists('minify_css'))
{
  function minify_css($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
            // Remove unused white-space(s)
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
            // Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
            '#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
            // Replace `:0 0 0 0` with `:0`
            '#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
            // Replace `background-position:0` with `background-position:0 0`
            '#(background-position):0(?=[;\}])#si',
            // Replace `0.6` with `.6`, but only when preceded by `:`, `,`, `-` or a white-space
            '#(?<=[\s:,\-])0+\.(\d+)#s',
            // Minify string value
            '#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][a-z0-9\-_]*?)\2(?=[\s\{\}\];,])#si',
            '#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
            // Minify HEX color code
            '#(?<=[\s:,\-]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
            // Replace `(border|outline):none` with `(border|outline):0`
            '#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
            // Remove empty selector(s)
            '#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s'
        ),
        array(
            '$1',
            '$1$2$3$4$5$6$7',
            '$1',
            ':0',
            '$1:0 0',
            '.$1',
            '$1$3',
            '$1$2$4$5',
            '$1$2$3',
            '$1:0',
            '$1$2'
        ),
    $input);
  }
}

// JavaScript Minifier
if(!function_exists('minify_js'))
{
  function minify_js($input) {
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
        ),
    $input);
  }
}


/* 
 * getGeoIP
 * 
 * Returns GEO info about an IP address from 
 * FreeGeoIP.net, allows 10,000 queries per hour.
 * 
 * @param str     $ip        IP to check leave blank to get REMOTE_ADDR
 * @param boolean $jsonArray Return JSON as array?
 * @return (obj|booealn) If info can be return use obj, otherwise report false.
 */
if(!function_exists('getGeoIp'))
{
    function getGeoIP($ip = null, $jsonArray = false) {
        try {
            // If no IP is provided use the current users IP
            if($ip == null) {
                $ip   = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
            }
            // If the IP is equal to 127.0.0.1 (IPv4) or ::1 (IPv6) then cancel, won't work on localhost
            // if($ip == "127.0.0.1" || $ip == "::1") {
            //     throw new Exception('You are on a local sever, this script won\'t work right.');
            // }
            // Make sure IP provided is valid
            if(!filter_var($ip, FILTER_VALIDATE_IP)) {
                throw new Exception('Invalid IP address "' . $ip . '".');
            }
            if(!is_bool($jsonArray)) {
                throw new Exception('The second parameter must be a boolean - true (return array) or false (return JSON object); default is false.');
            }
            // Fetch JSON data with the IP provided
            $url  = "http://freegeoip.net/json/" . $ip;
            // Return the contents, supress errors because we will check in a bit
            $json = @file_get_contents($url);
            // Did we manage to get data?
            if($json === false) {
                return false;
            }
            // Decode JSON
            $json = json_decode($json, $jsonArray);
            // If an error happens we can assume the JSON is bad or invalid IP
            if($json === null) {
                // Return false
                return false;
            } else {
                // Otherwise return JSON data
                return $json;
            }
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }
    
}


if(!function_exists('str_slug'))
{
  function str_slug($value) {
    return Str::slug($value);
  }
}

if(!function_exists('str_plural'))
{
  function str_plural($value, $count) {
    return Str::plural($value, $count);
  }
}