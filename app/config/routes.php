<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = "pages/single";
//////////////////
// DYNAMIC      //
// Product page //
//////////////////
// lists
$route['furniture'] = "catalog/lists";
// detail
$route['furniture/(:any)-(:any)'] = "catalog/detail/$1/$2";
// detail-beta
$route['furniture/(:any)-(:any)/(:any)'] = "catalog/detail/$1/$2/$3";
// category
$route['furniture/area/(:any)'] = "catalog/category/$1";
// subcategory
$route['furniture/(:any)/(:any)'] = "catalog/subcategory/$1/$2";

///////////////
// portfolio //
///////////////
$route['portfolio-commercial-furniture'] = "portfolio/portfolio/index";

$route['portfolio'] = "portfolio/portfolio/index";
// category
$route['portfolio/(:any)'] = "portfolio/category/$1";
// client
$route['client/(:any)'] = "portfolio/client/$1";

///////////////
// clearance //
///////////////
$route['malaysia-furniture-promotions'] = "pages/promotion/index";

//////////
// cart //
//////////
$route['cart'] = "cart/cart";
// beta
$route['cart/beta'] = "cart/indexBeta";

/////////////
// payment //
/////////////
$route['payment/response/backend'] = "payment/responseBackend";

/////////////
// sitemap //
/////////////
$route['sitemap'] = "pages/sitemap";

///////////
// admin //
///////////
$route['admin'] = "admin/base";
$route['admin/catalog/edit/(:num)/preview'] = "admin/catalog/edit/$1";

////////////
// single //
////////////
$route['404_override'] = "pages/sitemap";

$route['(:any)'] = "pages/single/$1";

$route['translate_uri_dashes'] = FALSE;
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/



