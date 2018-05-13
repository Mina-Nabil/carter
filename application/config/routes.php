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

//Reports
$route['report/drivers'] = 'Reports/getDriverReport';

//Cities ROUTES
$route['cities'] = 'Cities/home';
$route['addcities'] = 'Cities/addpage';
$route['insertcities'] = 'Cities/insert';
$route['cities/modify/(:num)'] = 'Cities/modifypage/$1';
$route['editcities/(:num)'] = 'Cities/edit/$1';
$route['cities/delete/(:num)'] = 'Cities/delete/$1';

//Bustypes ROUTES
$route['bustypes'] = 'Bustypes/home';
$route['addbustypes'] = 'Bustypes/addpage';
$route['insertbustypes'] = 'Bustypes/insert';
$route['bustypes/modify/(:num)'] = 'Bustypes/modifypage/$1';
$route['editbustypes/(:num)'] = 'Bustypes/edit/$1';
$route['bustypes/delete/(:num)'] = 'Bustypes/delete/$1';

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
$route['changePass/(:any)'] = 'Clients/forgotPW/$1';
$route['confirmPwChange'] = 'Clients/changePw';

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
$route['paths'] = 'Paths/pickline';
$route['paths/redirect'] = 'Paths/pathredirect';
$route['paths/(:num)'] = 'Paths/home/$1';
$route['addpaths/(:num)'] = 'Paths/addpage/$1';
$route['insertpaths'] = 'Paths/insert';
$route['paths/modify/(:num)'] = 'Paths/modifypage/$1';
$route['editpaths/(:num)'] = 'Paths/edit/$1';
$route['paths/delete/(:num)'] = 'Paths/delete/$1';


//Privilages ROUTES
$route['privilages'] = 'Privilages/home/1';
$route['privilages/(:num)'] = 'Privilages/home/$1';
$route['addprivilages/(:num)'] = 'Privilages/addpage/$1';
$route['insertprivilages'] = 'Privilages/insert';
$route['privilages/delete/(:num)/(:num)'] = 'Privilages/delete/$1/$2';

//Articles ROUTES
$route['articles'] = 'Articles/home';
$route['addarticles'] = 'Articles/addpage';
$route['insertarticles'] = 'Articles/insert';
$route['articles/modify/(:num)'] = 'Articles/modifypage/$1';
$route['editarticles/(:num)'] = 'Articles/edit/$1';
$route['articles/delete/(:num)'] = 'Articles/delete/$1';

//Promos ROUTES
$route['promos'] = 'Promos/home';
$route['addpromos'] = 'Promos/addpage';
$route['insertpromos'] = 'Promos/insert';
$route['promos/modify/(:num)'] = 'Promos/modifypage/$1';
$route['editpromos/(:num)'] = 'Promos/edit/$1';
$route['promos/delete/(:num)'] = 'Promos/delete/$1';

//Faqs ROUTES
$route['faqs'] = 'Faqs/home';
$route['addfaqs'] = 'Faqs/addpage';
$route['insertfaqs'] = 'Faqs/insert';
$route['faqs/modify/(:num)'] = 'Faqs/modifypage/$1';
$route['editfaqs/(:num)'] = 'Faqs/edit/$1';
$route['faqs/delete/(:num)'] = 'Faqs/delete/$1';

//Notifications ROUTES
$route['notifications'] = 'Notifications/home';
$route['addnotifications'] = 'Notifications/addpage';
$route['insertnotifications'] = 'Notifications/insert';
$route['notifications/modify/(:num)'] = 'Notifications/modifypage/$1';
$route['editnotifications/(:num)'] = 'Notifications/edit/$1';
$route['notifications/delete/(:num)'] = 'Notifications/delete/$1';

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

//Linerequests ROUTES
$route['linerequests'] = 'Linerequests/home';
$route['addlinerequests'] = 'Linerequests/addpage';
$route['insertlinerequests'] = 'Linerequests/insert';
$route['linerequests/modify/(:num)'] = 'Linerequests/modifypage/$1';
$route['linerequests/delete/(:num)'] = 'Linerequests/delete/$1';

//Drivers ROUTES
$route['drivers'] = 'Drivers/home';
$route['adddrivers'] = 'Drivers/addpage';
$route['insertdrivers'] = 'Drivers/insert';
$route['drivers/modify/(:num)'] = 'Drivers/modifypage/$1';
$route['editdrivers/(:num)'] = 'Drivers/edit/$1';
$route['drivers/delete/(:num)'] = 'Drivers/delete/$1';
$route['blckactvdrvr'] = 'Drivers/blockActivateDriverPage';

//Buses ROUTES
$route['buses'] = 'Buses/home';
$route['addbuses'] = 'Buses/addpage';
$route['insertbuses'] = 'Buses/insert';
$route['buses/modify/(:num)'] = 'Buses/modifypage/$1';
$route['editbuses/(:num)'] = 'Buses/edit/$1';
$route['buses/delete/(:num)'] = 'Buses/delete/$1';

//Driverpackages ROUTES
$route['driverpackages'] = 'Driverpackages/home';
$route['adddriverpackages'] = 'Driverpackages/addpage';
$route['insertdriverpackages'] = 'Driverpackages/insert';
$route['driverpackages/modify/(:num)'] = 'Driverpackages/modifypage/$1';
$route['editdriverpackages/(:num)'] = 'Driverpackages/edit/$1';
$route['driverpackages/delete/(:num)'] = 'Driverpackages/delete/$1';

//Favourite_line ROUTES
$route['favourite_lines'] = 'Favourite_lines/home';
$route['addfavourite_lines'] = 'Favourite_lines/addpage';
$route['insertfavourite_lines'] = 'Favourite_lines/insert';
$route['favourite_lines/modify/(:num)'] = 'Favourite_lines/modifypage/$1';
$route['editfavourite_lines/(:num)'] = 'Favourite_lines/edit/$1';
$route['favourite_lines/delete/(:num)'] = 'Favourite_lines/delete/$1';

//Traveltickets ROUTES
$route['traveltickets'] = 'Traveltickets/defaultPage';
$route['traveltickets/(:num)'] = 'Traveltickets/home/$1';
$route['addtraveltickets'] = 'Traveltickets/defaultaddPage';
$route['addtraveltickets/(:num)'] = 'Traveltickets/addpage/$1';
$route['inserttraveltickets'] = 'Traveltickets/insert';
$route['traveltickets/modify/(:num)'] = 'Traveltickets/modifypage/$1';
$route['edittraveltickets/(:num)'] = 'Traveltickets/edit/$1';
$route['traveltickets/delete/(:num)'] = 'Traveltickets/delete/$1';

//Push
$route['push'] = 'Push/home';
$route['push/getAllPn'] = 'Push/getLogs/1';
$route['push/getTopUsersPn'] = 'Push/getLogs/2';
$route['push/getSpmsgsPn'] = 'Push/getLogs/3';
$route['push/sendMsg'] = 'Push/initiateMsg';
$route['sendpushfromApi'] = 'Push/sendCustomData';


//Reports

//API
$route['api/login'] = 'Api/login';
$route['api/register'] = 'Api/register';
$route['api/set_image'] = 'Api/set_image';
$route['api/set_MobNumber'] = 'Api/set_MobNumber';
$route['api/get_profile'] = 'Api/get_profile';
$route['api/update_profile'] = 'Api/update_profile';
$route['api/change_pw'] = 'Api/change_pw';
$route['api/setTag'] = 'Api/setTag';
$route['api/get_districts'] = 'Api/get_districts';
$route['api/get_cities'] = 'Api/get_cities';
$route['api/get_districts_by_cityID/(:num)'] = 'Api/get_districts_by_cityID/$1';
$route['api/get_driver_data/(:num)'] = 'Api/get_driver_data/$1';
$route['api/get_bus_data/(:num)'] = 'Api/get_bus_data/$1';
$route['api/get_all_lines/(:num)'] = 'Api/get_all_lines/$1';
$route['api/get_faqs'] = 'Api/get_faqs';
$route['api/get_aboutus'] = 'Api/get_aboutus';
$route['api/get_lines_summary'] = 'Api/get_lines_summary';
$route['api/get_messages/(:num)'] = 'Api/get_messages/$1';
$route['api/post_messages'] = 'Api/post_messages';
$route['api/get_favourites/(:num)'] = 'Api/get_favourites/$1';
$route['api/get_lines_by_districts/(:num)'] = 'Api/get_lines_by_districts/$1';
$route['api/delete_favourite'] = 'Api/delete_favourite';
$route['api/add_favourite'] = 'Api/add_favourite';
$route['api/getFreeCode'] = 'Api/getFreeCode';
$route['api/requestSpecialBus'] = 'Api/requestSpecialBus';
$route['api/getArticle'] = 'Api/getArticle';
$route['api/getUsedDistricts'] = 'Api/getUsedDistricts';
$route['api/getLineDetails'] = 'Api/getLineDetails';
$route['api/isFavourite'] = 'Api/isFavourite';
$route['api/getNotifications'] = 'Api/getNotifications';
$route['api/subscribeTicket'] = 'Api/subscribeTicket';
$route['api/getOldTrips'] = 'Api/getOldTrips';
$route['api/getNewTrips'] = 'Api/getNewTrips';
$route['api/resetUser'] = 'Api/resetUser';
$route['api/cancelTrip'] = 'Api/cancelTrip';
$route['api/get_path/(:num)'] = 'Api/get_path/$1';
$route['api/getTripStatus'] = 'Api/getTripStatus';
$route['api/forgotPW'] = 'Api/forgotPW';
$route['api/checkPromocode'] = 'Api/checkPromocode';
$route['api/(:any)'] = 'Api/DefaultError/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
