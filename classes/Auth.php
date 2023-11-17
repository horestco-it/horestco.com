<?php 
require_once dirname(__FILE__) . '/../vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;
// Create the Sentry alias
class_alias('Cartalyst\Sentry\Facades\Native\Sentry', 'Sentry');

/**
* 
*/
class Auth
{
	protected $capsule;

	protected $sentry;
	
	function __construct()
	{
		$this->sentry = new Sentry;
		$this->connect();
	}

	protected function connect()
	{
		$setting = parse_ini_file("settings.ini.php");

		$this->capsule = new Capsule;

		$this->capsule->addConnection(array(
		    'driver'    => 'mysql',
		    'host'      => $setting['host'],
		    'database'  => $setting['dbname'],
		    'username'  => $setting['user'],
		    'password'  => $setting['password'],
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => ''
		));
		// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
		return $this->capsule->bootEloquent();
	}


	public function login($array)
	{
		try
		{
	    	// Authenticate the user
			$user = Sentry::authenticate($array, false);
			
		}
		catch (Exception $e)
		{
		    echo $e->getMessage();
		}
	}

	public function create()
	{
		try
		{
		    // Create the user
		    $user = Sentry::createUser(array(
		        'email'     => 'john.doe@example.com',
		        'password'  => 'test',
		        'activated' => true,
		    ));

		    // Find the group using the group id
		    $adminGroup = Sentry::findGroupById(1);

		    // Assign the group to the user
		    $user->addGroup($adminGroup);
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
		    echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
	}

	public function register($array)
	{
		try
		{
	    	// Authenticate the user
			$user = Sentry::register($array);
			
		}
		catch (Exception $e)
		{
		    echo $e->getMessage();
		}
	}

	public function redirect($url)
	{
		return header("location:{$url}");
	}

	public function logout()
	{
		return Sentry::logout();
	}
}

$auth = new Auth;

 ?>