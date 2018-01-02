<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Main/home';

$route['login'] = 'Main/login';
$route['logout'] = 'Main/logout';
$route['home']  = 'Main/home';
$route['checklogin'] = 'Main/checkLoginData';


//Cities ROUTES
$route['cities'] = 'Cities/home';
$route['addcities'] = 'Cities/addpage';
$route['insertcities'] = 'Cities/insert';
$route['cities/modify/(:num)'] = 'Cities/modifypage/$1';
$route['editcities/(:num)'] = 'Cities/edit/$1';
$route['cities/delete/(:num)'] = 'Cities/delete/$1';

//Districts ROUTES
$route['districts'] = 'Districts/home';
$route['adddistricts'] = 'Districts/addpage';
$route['insertdistricts'] = 'Districts/insert';
$route['districts/modify/(:num)'] = 'Districts/modifypage/$1';
$route['editdistricts/(:num)'] = 'Districts/edit/$1';
$route['districts/delete/(:num)'] = 'Districts/delete/$1';

//Clients ROUTES
$route['clients'] = 'Clients/home';
$route['addclients'] = 'Clients/addpage';
$route['insertclients'] = 'Clients/insert';
$route['clients/modify/(:num)'] = 'Clients/modifypage/$1';
$route['editclients/(:num)'] = 'Clients/edit/$1';
$route['clients/delete/(:num)'] = 'Clients/delete/$1';

//Balancelogs ROUTES
$route['balancelogs'] = 'Balancelogs/home';
$route['addbalancelogs'] = 'Balancelogs/addpage';
$route['insertbalancelogs'] = 'Balancelogs/insert';
$route['balancelogs/modify/(:num)'] = 'Balancelogs/modifypage/$1';
$route['editbalancelogs/(:num)'] = 'Balancelogs/edit/$1';
$route['balancelogs/delete/(:num)'] = 'Balancelogs/delete/$1';


//Users ROUTES
$route['users'] = 'Users/home';
$route['addusers'] = 'Users/addpage';
$route['insertusers'] = 'Users/insert';
$route['users/modify/(:num)'] = 'Users/modifypage/$1';
$route['editusers/(:num)'] = 'Users/edit/$1';
$route['users/delete/(:num)'] = 'Users/delete/$1';

//Stations ROUTES
$route['stations'] = 'Stations/home';
$route['addstations'] = 'Stations/addpage';
$route['insertstations'] = 'Stations/insert';
$route['stations/modify/(:num)'] = 'Stations/modifypage/$1';
$route['editstations/(:num)'] = 'Stations/edit/$1';
$route['stations/delete/(:num)'] = 'Stations/delete/$1';

//Lines ROUTES
$route['lines'] = 'Lines/home';
$route['addlines'] = 'Lines/addpage';
$route['insertlines'] = 'Lines/insert';
$route['lines/modify/(:num)'] = 'Lines/modifypage/$1';
$route['editlines/(:num)'] = 'Lines/edit/$1';
$route['lines/delete/(:num)'] = 'Lines/delete/$1';

//LivesLines ROUTES
$route['livelines'] = 'LiveLines/home';
$route['addlivelines'] = 'LiveLines/addpage';
$route['insertlivelines'] = 'LiveLines/insert';
$route['livelines/modify/(:num)'] = 'LiveLines/modifypage/$1';
$route['editlivelines/(:num)'] = 'LiveLines/edit/$1';
$route['livelines/delete/(:num)'] = 'LiveLines/delete/$1';

//Paths ROUTES
$route['paths'] = 'Paths/home/1';
$route['paths/(:num)'] = 'Paths/home/$1';
$route['addpaths/(:num)'] = 'Paths/addpage/$1';
$route['insertpaths'] = 'Paths/insert';
$route['paths/modify/(:num)'] = 'Paths/modifypage/$1';
$route['editpaths/(:num)'] = 'Paths/edit/$1';
$route['paths/delete/(:num)'] = 'Paths/delete/$1';

//Articles ROUTES
$route['articles'] = 'Articles/home';
$route['addarticles'] = 'Articles/addpage';
$route['insertarticles'] = 'Articles/insert';
$route['articles/modify/(:num)'] = 'Articles/modifypage/$1';
$route['editarticles/(:num)'] = 'Articles/edit/$1';
$route['articles/delete/(:num)'] = 'Articles/delete/$1';

//Faqs ROUTES
$route['faqs'] = 'Faqs/home';
$route['addfaqs'] = 'Faqs/addpage';
$route['insertfaqs'] = 'Faqs/insert';
$route['faqs/modify/(:num)'] = 'Faqs/modifypage/$1';
$route['editfaqs/(:num)'] = 'Faqs/edit/$1';
$route['faqs/delete/(:num)'] = 'Faqs/delete/$1';

//AboutUs ROUTES
$route['aboutus'] = 'AboutUs/home';
$route['addaboutus'] = 'AboutUs/addpage';
$route['insertaboutus'] = 'AboutUs/insert';
$route['aboutus/modify/(:num)'] = 'AboutUs/modifypage/$1';
$route['editaboutus/(:num)'] = 'AboutUs/edit/$1';
$route['aboutus/delete/(:num)'] = 'AboutUs/delete/$1';

//Messages ROUTES
$route['messages'] = 'Messages/home';
$route['addmessages'] = 'Messages/addpage';
$route['insertmessages'] = 'Messages/insert';
$route['messages/modify/(:num)'] = 'Messages/modifypage/$1';
$route['messages/delete/(:num)'] = 'Messages/delete/$1';

//Drivers ROUTES
$route['drivers'] = 'Drivers/home';
$route['adddrivers'] = 'Drivers/addpage';
$route['insertdrivers'] = 'Drivers/insert';
$route['drivers/modify/(:num)'] = 'Drivers/modifypage/$1';
$route['editdrivers/(:num)'] = 'Drivers/edit/$1';
$route['drivers/delete/(:num)'] = 'Drivers/delete/$1';

//Buses ROUTES
$route['buses'] = 'Buses/home';
$route['addbuses'] = 'Buses/addpage';
$route['insertbuses'] = 'Buses/insert';
$route['buses/modify/(:num)'] = 'Buses/modifypage/$1';
$route['editbuses/(:num)'] = 'Buses/edit/$1';
$route['buses/delete/(:num)'] = 'Buses/delete/$1';

//Favourite_line ROUTES
$route['favourite_lines'] = 'Favourite_lines/home';
$route['addfavourite_lines'] = 'Favourite_lines/addpage';
$route['insertfavourite_lines'] = 'Favourite_lines/insert';
$route['favourite_lines/modify/(:num)'] = 'Favourite_lines/modifypage/$1';
$route['editfavourite_lines/(:num)'] = 'Favourite_lines/edit/$1';
$route['favourite_lines/delete/(:num)'] = 'Favourite_lines/delete/$1';


//API
$route['api/login'] = 'Api/login';
$route['api/register'] = 'Api/register';
$route['api/set_image'] = 'Api/set_image';
$route['api/get_profile'] = 'Api/get_profile';
$route['api/get_districts'] = 'Api/get_districts';
$route['api/get_cities'] = 'Api/get_cities';
$route['api/get_districts_by_cityID/(:num)'] = 'Api/get_districts_by_cityID/$1';
$route['api/get_driver_data/(:num)'] = 'Api/get_driver_data/$1';
$route['api/get_bus_data/(:num)'] = 'Api/get_bus_data/$1';
$route['api/get_all_lines/(:num)'] = 'Api/get_all_lines/$1';
$route['api/get_faqs'] = 'Api/get_faqs';
$route['api/get_aboutus'] = 'Api/get_aboutus';
$route['api/get_messages/(:num)'] = 'Api/get_messages/$1';
$route['api/post_messages'] = 'Api/post_messages';
$route['api/get_favourites/(:num)'] = 'Api/get_favourites/$1';
$route['api/delete_favourite/(:num)'] = 'Api/delete_favourite/$1';
$route['api/add_favourite'] = 'Api/add_favourite';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
