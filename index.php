<?php
date_default_timezone_set('Asia/Jakarta');
//this use as base url, call BASE_URL to get this
define('BASE_URL', 'http://localhost/taskmanager/index.php');
//this use as base directory, call BASE_DIR to get this
define('BASE_DIR', 'http://localhost/taskmanager');
//require router.php for url
require_once('router.php');

$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
$router = new Router();
$router->route($url);
