<?php

ini_set('display_errors', E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . '/vagrant/www');
require 'log4php/Logger.php';
require 'log4php/appenders/LoggerAppenderAMQP.php';
require 'log4php/layouts/LoggerLayoutGelf.php';

define('ELASTICSEARCH', '10.26.82.142');
define('LOAD_BALANCER', '192.168.50.4');
define('PHP', '192.168.50.5');
define('SERVICE', '192.168.50.6');

// Get or set user ID cookie
$_SESSION['CSNUtID'] = isset($_COOKIE['CSNUtID']) ? $_COOKIE['CSNUtID'] : '';
if (!$_SESSION['CSNUtID']) {
   $_SESSION['CSNUtID'] = uniqid();
   $expiration = time() + (3 * 365 * 24 * 60 * 60); // 3 years
   setcookie('CSNUtID', $_SESSION['CSNUtID'], $expiration, '/');
}
// Get transaction IDs
$_SESSION['HTTP_X_REQUEST_ID'] = isset($_SERVER['HTTP_X_REQUEST_ID']) ? $_SERVER['HTTP_X_REQUEST_ID'] : '';
$_SESSION['PARENT_REQUEST_ID'] = isset($_REQUEST['PARENT_REQUEST_ID']) ? $_REQUEST['PARENT_REQUEST_ID'] : '';
$_SESSION['BROWSE_DEPTH'] = isset($_REQUEST['BROWSE_DEPTH']) ? $_REQUEST['BROWSE_DEPTH'] : 1;
if (! $_SESSION['PARENT_REQUEST_ID']) {
  $_SESSION['BROWSE_DEPTH']++;
}
    
Logger::configure('log4php/config.xml');
server_log($_SERVER['PHP_SELF']);

function server_log($request, $type='PHP') {
  $logger = Logger::getLogger("main");
  $server_data = array('CSNUtID' => $_SESSION['CSNUtID'],
                       'HTTP_X_REQUEST_ID' => $_SESSION['HTTP_X_REQUEST_ID'],
                       'PARENT_REQUEST_ID' => $_SESSION['PARENT_REQUEST_ID'],
                       'BROWSE_DEPTH' => $_SESSION['BROWSE_DEPTH'],
                       'REQUEST' => $request,
                       'type' => $type,
                       'TIMESTAMP' => date(DATE_ATOM));
  $logger->info(json_encode($server_data));
}

function curl($url, $json) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  		   'Content-Type: application/json',
		   'Content-Length: ' . strlen($json))
  );
  return curl_exec($ch);
}

function quote($value, $type) {
  if ($type == 0) {
    return "'" . $value . "'";
  }
  return $value;
}

function pretend_nothing_happened() {
  ;
}

?>
