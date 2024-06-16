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
|example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:my-controller/index-> my_controller/index
|my-controller/my-method-> my_controller/my_method
*/

$route['default_controller'] = 'welcome'; // Contrôleur par défaut
$route['search'] = 'search/index'; 
$route['welcome/search'] = 'welcome/search';


$route['404_override'] = '';
$route['artists/view/(:num)'] = 'artists/view/$1';

$route['translate_uri_dashes'] = FALSE;
$route['album/details/(:num)'] = 'album/details/$1';
$route['playlist'] = 'playlist/index';
$route['playlist/create'] = 'playlist/create';
$route['auth/register'] = 'auth/register';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
$route['playlist/add_to_playlist_song/(:num)'] = 'playlist/add_to_playlist/$1';
$route['albums/add_album_to_playlist/(:num)/(:num)'] = 'albums/add_album_to_playlist/$1/$2';

$route['albums/add_album_to_playlist_action'] = 'albums/add_album_to_playlist_action';
$route['artist/albums/(:num)'] = 'albums/artist_albums/$1';

