<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	public function submenus()
	{
		return $this->hasMany('Submenu');
	}
}


/* End of file Menu.php */
/* Location: .//C/xampp/htdocs/horestco.com.my/app/models/Menu.php */