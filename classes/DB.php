<?php 
require_once dirname(__FILE__) . '/../vendor/autoload.php';
use \Illuminate\Database\Capsule\Manager as Capsule;

$setting = parse_ini_file(__DIR__."/../setting.ini.php");

$capsule = new Capsule;

$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => $setting['host'],
    'database'  => $setting['database'],
    'username'  => $setting['username'],
    'password'  => $setting['password'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

// Logger
if(!function_exists('logger'))
{
    function logger() {
        $queries = \Illuminate\Database\Capsule\Manager::getQueryLog();
        $formattedQueries = array();
        foreach( $queries as $query ) :
            $prep = $query['query'];
            foreach( $query['bindings'] as $binding ) :
                $prep = preg_replace("#\?#", $binding, $prep, 1);
            endforeach;
            $formattedQueries[] = $prep;
        endforeach;
        return $formattedQueries;
    }
}

if(!class_exists('Builder')){
    class Builder extends Capsule {
        public function __construct()
        {
            $this->bootEloquent();
            $this->setAsGlobal();
        }
    }
}
