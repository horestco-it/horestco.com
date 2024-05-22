<?php

use Illuminate\Support\Str;

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Base.php';

class Upload extends Base{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('image');
	}

  public function do_upload()
  {
    $product = Product::find($this->input->post('pid'));
    // A list of permitted file extensions
    $allowed = array('png', 'jpg', 'gif','zip');

    if(isset($_FILES['files']) && $_FILES['files']['error'] == 0){

      $extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);

      if(!in_array(strtolower($extension), $allowed)){
        echo '{"status":"error"}';
        exit;
      }
      $file = Str::slug($product->name).'-'.$product->id.'-'.rand(100, 9999).'.'.$extension;
      if(move_uploaded_file($_FILES['files']['tmp_name'], 'files/'.$file)){
        $data = ['status'=>'success', 'file'=>$file];
        print_r(json_encode($data));
        exit;
      }
    }

    echo '{"status":"error"}';
    exit;
  }

}