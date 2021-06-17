<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require_once '../config.php';
require_once '../include/UIControllerClass.php';
require_once '../include/utilities.php';

if (empty($_SESSION['user'])) {
  $module = "user";
} else {
  if (isset($_REQUEST['module'])) {
    $module = $_REQUEST['module'];
  } else {
    $module = "vehicle";
    $_REQUEST['action'] = 'vehicles';
  }
}
$includefile = "../modules/" . ucfirst($module) . 'ControllerClass.php';
if (file_exists($includefile)) {
  require_once $includefile;
}

$classname = ucfirst($module) . "ControllerClass";
$ui = new $classname($_REQUEST);
$ui->execute(array_change_key_case($_REQUEST));