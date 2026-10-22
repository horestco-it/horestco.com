<?php

use Illuminate\Support\Str;

/**
 * Function Name
 *
 * Function description
 *
 * @access	public
 * @param	type	name
 * @return	type	
 */

function image_src($filename, $width = 300) 
{

  $ci =& get_instance();
  $path = 'assets/images/furniture/';
  $pathinfo = pathinfo($filename);
  $image_thumb = $pathinfo['filename']."_".$width.".".$pathinfo['extension'];

  if(!is_dir(FCPATH.$path.'thumbs')) {
    mkdir(FCPATH.$path.'thumbs');
  }

  if( !file_exists(FCPATH.$path.$filename) )
  {
    return base_url().img_url('not-available.jpg');
  }

  if (! file_exists(FCPATH.$path.'thumbs/'.$image_thumb))
  {
    $ci->load->library('image_lib');
    $config['image_library']    = 'gd2';
    $config['source_image']     = FCPATH.$path.$filename;
    $config['new_image']        = FCPATH.$path.'thumbs/'.$image_thumb;
    $config['width']            = $width;
    $config['maintain_ratio']   = TRUE;
    $config['quality']          = 90;

    $ci->image_lib->initialize( $config );
    if( $ci->image_lib->resize() )
    {
      echo $ci->image_lib->display_errors();
    }
    $ci->image_lib->clear();
  }

  return base_url().$path.'thumbs/'.$image_thumb;
}
 

if (! function_exists('image_thumb'))
{
	function image_thumb($path, $width, $options = array())
	{
		if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
			$default = array(
				'data-src' => $path,
				'data-lazy' => false,
				'alt' => 'Horestco Furniture'
			);
			$options = array_merge($default, $options);
			$options['src'] = $path;
			$attr = '';
			foreach ($options as $key => $opt) {
				if ($key === 'data-lazy' && is_bool($opt)) continue;
				$attr .= " $key=\"$opt\" ";
			}
			return '<img '.$attr.'/>';
		}
    if( !file_exists(FCPATH.$path) )
    {
      return '<img src="'.base_url().img_url('not-available.jpg').'" >';
    }

		$ci =& get_instance();

		// get file name
		$filename = explode('/', $path);

    $filename = end($filename);

    $img = explode('.', $filename);

    $ext = '.'.end($img);

    $image_thumb = dirname($path) . '/thumbs/'.$img[0].'_'.$width.$ext;



    if (! file_exists($image_thumb))
    {
      // LOAD LIBRARY

      $ci->load->library('image_lib');
      // CONFIGURE IMAGE LIBRARY
      $config['image_library']    = 'gd2';
      $config['source_image']     = FCPATH.$path;
      $config['new_image']        = $image_thumb;
      $config['width']            = $width;
      $config['maintain_ratio']   = TRUE;
      $config['quality']          = 100;


      $ci->image_lib->initialize( $config );
      if( $ci->image_lib->resize() )
      {
        echo $ci->image_lib->display_errors();
      }
      $ci->image_lib->clear();
    }

    $default = array(
      'data-src'=>base_url().$image_thumb,
      'data-lazy' => false,
      'alt'=>'horestco furniture manufacturer'
    );

    $options = array_merge($default, $options);

    if( $options['data-lazy'] )
    {
      $options['src'] = base_url('assets/images/preloader.gif');
      $options['style'] = 'width:20px';
    }
    else{
      $options['src'] = base_url().$image_thumb;
    }

    $attr = '';

    foreach ($options as $key => $opt) {
      $attr .= " $key=\"$opt\" ";
    }

    return '<img '.$attr.'/>';
	}
}

/**
 * Function Name
 *
 * Function description
 *
 * @access  public
 * @param  type  name
 * @return  type  
 */
 
if (! function_exists('file_to_lower'))
{
  function file_to_lower($path, $id = null)
  {
    $files = array_diff(scandir($path), array('..', '.'));
    $newFiles = [];
    foreach ($files as $file) {
      $ext = '.'.strtolower(pathinfo($file, PATHINFO_EXTENSION ));
      $newfile = explode('.', $file);
      $newfile = Str::slug($newfile[0]).$ext;
      $newfiles[] = $newfile;
      // echo "$newfile <br>";
      rename($path.$file, $path.$newfile);
    }

    vd($newFiles);
  }
}



/**
 * Function Name
 *
 * update record to lowercase filename
 *
 * @access  public
 * @param  type  name
 * @return  type  
 */

 

if (! function_exists('update_to_lower'))

{

  function update_to_lower($id, $name)

  {
    $filename = explode('.', $name);
    $ext = '.'.end($filename);

    $image = Image::find($id);

    $image->name = Str::slug($filename[0]).$ext;

    return $image->save();

  }

}