<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'cities';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['enfermeras']['get'] = 'enfermeras/index';
$route['enfermerascontador']['get'] = 'enfermeras/contador';
$route['enfermeras-one/(:num)']['get'] = 'enfermeras/one/$1';
$route['enfermeras']['post'] = 'enfermeras/index';
$route['enfermerasdelete/(:num)']['get'] = 'enfermeras/delete/$1';
$route['enfermerasupdate']['post'] = 'enfermeras/update';

$route['historialsesion']['get'] = 'historialsesion/index';
$route['historialsesion-contador']['get'] = 'historialsesion/contador';
$route['historialsesion']['post'] = 'historialsesion/index';
$route['historialsesion-delete/(:num)']['get'] = 'historialsesion/delete/$1';

$route['pacientes']['get'] = 'pacientes/index';
$route['pacientescontador']['get'] = 'pacientes/contador';
$route['paciente-one/(:num)']['get'] = 'pacientes/one/$1';
$route['paciente']['post'] = 'pacientes/index';
$route['pacientedelete/(:num)']['get'] = 'pacientes/delete/$1';
$route['pacienteupdate']['post'] = 'pacientes/update';

$route['medicos']['get'] = 'medicos/index';
$route['medicoscontador']['get'] = 'medicos/contador';
$route['medicos-one/(:num)']['get'] = 'medicos/one/$1';
$route['medicos']['post'] = 'medicos/index';
$route['medicosdelete/(:num)']['get'] = 'medicos/delete/$1';
$route['medicosupdate']['post'] = 'medicos/update';

$route['especialidadmedica']['get'] = 'especialidadmedica/index';
$route['especialidadmedica-one/(:num)']['get'] = 'especialidadmedica/one/$1';
$route['especialidadmedica']['post'] = 'especialidadmedica/index';
$route['especialidadmedica-delete/(:num)']['get'] = 'especialidadmedica/delete/$1';
$route['especialidadmedica-update']['post'] = 'especialidadmedica/update';

$route['persona']['get'] = 'persona/index';
$route['persona-one/(:num)']['get'] = 'persona/one/$1';
$route['persona']['post'] = 'persona/index';
$route['persona-delete/(:num)']['get'] = 'persona/delete/$1';
$route['persona-update']['post'] = 'persona/update';

$route['usuarios']['get'] = 'usuario/index';
$route['login/(:any)/(:any)']['get'] = 'usuario/login/$1/$2';
$route['usuario']['post'] = 'usuario/index';
$route['usuario-delete/(:num)']['get'] = 'usuario/delete/$1';
$route['usuario-update']['post'] = 'usuario/update';

$route['visitas']['get'] = 'visitas/index';
$route['visitas']['post'] = 'visitas/index';
$route['visitas-delete/(:num)']['get'] = 'visitas/delete/$1';

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
