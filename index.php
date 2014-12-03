<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('CHARSET', 'UTF-8'); //ISO-8859-1
session_name('0ri5tR4v3l');
session_cache_limiter('nocache');
date_default_timezone_set('America/Santiago');
header('Content-Type: text/html; charset=' . CHARSET);

try
{
    require_once APP_PATH . 'Config.php';
    require_once APP_PATH . 'Request.php';
    require_once APP_PATH . 'Bootstrap.php';
    require_once APP_PATH . 'Controller.php';
    require_once APP_PATH . 'Model.php';
    require_once APP_PATH . 'View.php';
    require_once APP_PATH . 'Registro.php'; //Trabajar con patron Singleton
    require_once APP_PATH . 'Database.php';
    require_once APP_PATH . 'Session.php';
    require_once APP_PATH . 'Funciones.php';

    Session::init();

    Bootstrap::run(new Request);
}
catch (Exception $e)
{
    echo $e->getMessage();
}
?>