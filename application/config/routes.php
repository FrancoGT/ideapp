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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_array_materiales']['get'] = 'dashboard/get_array_materiales';
$route['get_array_precios']['get'] = 'dashboard/get_array_precios';

//metodos para mostrar registros
$route['recuperar_proyecto_construccion']['get'] = 'servicio/recuperar_proyecto_construccion';
$route['recuperar_materiales']['get'] = 'servicio/recuperar_materiales';
$route['recuperar_trabajadores']['get'] = 'recurso_humano/recuperar_trabajadores';
$route['recuperar_areas_cargos']['get'] = 'recurso_humano/recuperar_areas_cargos';
$route['recuperar_perfil']['get'] = 'recurso_humano/recuperar_perfil';
$route['recuperar_presupuestos']['get'] = 'finanza/recuperar_presupuestos';
$route['recuperar_pagos']['get'] = 'finanza/recuperar_pagos';
//metodos para insertar y actualizar registros
$route['insertar_proyecto_construccion']['post'] = 'servicio/insertar_proyecto_construccion';
$route['actualizar_proyecto_construccion']['post'] = 'servicio/actualizar_proyecto_construccion';
$route['insertar_material']['post'] = 'servicio/insertar_material';
$route['actualizar_material']['post'] = 'servicio/actualizar_material';
$route['insertar_trabajador']['post'] = 'recurso_humano/insertar_trabajador';
$route['actualizar_trabajador']['post'] = 'recurso_humano/actualizar_trabajador';
$route['insertar_area_cargo']['post'] = 'recurso_humano/insertar_area_cargo';
$route['actualizar_area_cargo']['post'] = 'recurso_humano/actualizar_area_cargo';

//metodos para hacer busquedas
$route['buscar_proyecto_construccion']['get'] = 'servicio/buscar_proyecto_construccion';