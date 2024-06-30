<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['(:any)'] = 'Epub/$1';
$route['(exam|doexam|result|request)/(:any)'] = 'Epub/$1/$2';
$route['(request)/(:any)/(:any)'] = 'Epub/$1/$2/$3';
$route['default_controller'] = 'Epub';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
