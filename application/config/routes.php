<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'cities';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['pacientes']['get'] = 'pacientes/index';
$route['pacientescontador']['get'] = 'pacientes/contador';
$route['paciente']['post'] = 'pacientes/index';
$route['pacientedelete/(:num)']['get'] = 'pacientes/delete/$1';
$route['pacienteupdate']['post'] = 'pacientes/update';

$route['especialidadmedica']['get'] = 'especialidadmedica/index';
$route['especialidadmedica-one/(:num)']['get'] = 'especialidadmedica/one/$1';
$route['especialidadmedica']['post'] = 'especialidadmedica/index';
$route['especialidadmedica-delete/(:num)']['get'] = 'especialidadmedica/delete/$1';
$route['especialidadmedica-update']['post'] = 'especialidadmedica/update';

$route['provincias']['get'] = 'provincias/index';
$route['cantones/(:num)']['get'] = 'provincias/cantones/$1';

$route['generos']['get'] = 'generos/index';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
//$route['api/example/users/(:num)'] = 'api/example/users/id/$1'; // Example 4
//$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/users/id/$1/format/$3$4'; // Example 8
