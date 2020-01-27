<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "front";
$route['admin/'] = 'admin/dashboard/index';
$route['front'] = 'front/index';
//$route['404_override'] = 'front';

 
// '/en' and '/fr' -> use default controller
require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get('language');
$result = $query->result();
foreach( $result as $row ){

	$route['^'.$row->code.'$'] = $route['default_controller'];
	$route['^'.$row->code.'/front'] = 'front/index';
	$route['^'.$row->code.'/cart'] = 'cart/index';
	$route['^'.$row->code.'/front/active'] = 'front/active';
	//$route['^'.$row->code.'/front/(:any)'] = 'front/index/$1';
	$route['^'.$row->code.'/pages/(:any)'] = 'pages/index/$1';
	$route['^'.$row->code.'/category/all_product/(:num)'] = 'category/all_product/$1';
	$route['^'.$row->code.'/category/(.+)$'] = 'category/index/$1';

	$route['^'.$row->code.'/news'] = 'news/index/';
	$route['^'.$row->code.'/news/(.+)$'] = 'news/index/$1';
	$route['^'.$row->code.'/secure/(.+)$'] = 'secure/$1';
	$route['^'.$row->code.'/download/(.+)$'] = 'download/$1';
	$route['^'.$row->code.'/search'] = 'search';
	$route['^'.$row->code.'/user/(.+)$'] = 'user/$1';

	$route['^'.$row->code.'/l/(.+)$'] = 'l/index/$1';
	$route['^'.$row->code.'/gyms/(.+)$'] = 'gyms/index/$1';
	$route['^'.$row->code.'/book/(.+)$'] = 'book/index/$1';
	$route['^'.$row->code.'/blog/(.+)$'] = 'blog/index/$1';
//	$route['^'.$row->code.'/(:any)'] = 'provider/l/$1';
	//$route['^'.$row->code.'/(:any)'] = 'product/index/$1';
	$route['^'.$row->code.'/(.+)$'] = "$1";

}

/* End of file routes.php */
/* Location: ./application/config/routes.php */