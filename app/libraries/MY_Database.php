<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Illuminate\Database\Capsule\Manager as Capsule;

class MY_Database extends Capsule
{
	public function __construct()
	{
		parent::__construct();

    	$setting = parse_ini_file(FCPATH . "setting.ini.php");

		$capsule = new Capsule;

		$capsule->addConnection(array(
		    'host'      => $setting['host'],
		    'database'  => $setting['database'],
		    'username'  => $setting['username'],
		    'password'  => $setting['password'],
		    'driver'    => 'mysql',
		    'charset'   => 'utf8',
		    'collation' => 'utf8_general_ci',
		    'prefix'    => ''
		));

		$capsule->setAsGlobal();
		$capsule->bootEloquent();

	}
}