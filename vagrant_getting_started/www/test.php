<?php

ini_set('display_errors', E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . '/vagrant/www');

require 'log4php/Logger.php';
require 'log4php/appenders/LoggerAppenderAMQP.php';
require 'log4php/layouts/LoggerLayoutGelf.php';
/*
$csn_utid = isset($_COOKIE['CSNUtID']) ? $_COOKIE['CSNUtID'] : '';
if (!$csn_utid) {
   $csn_utid = uniqid();
   $expiration = time() + (3 * 365 * 24 * 60 * 60); // 3 years
   set_cookie('CSNUtID', $csn_utid, $expiration, '/');
}
$transaction = isset($_SERVER['HTTP_X_REQUEST_ID']) ? $_SERVER['HTTP_X_REQUEST_ID'] : '';
$parent_transaction = isset($_REQUEST[''])
*/
//Logger::configure('log4php/config.xml');

//$logger = Logger::getLogger("main");
//$logger->info("This is an informational message.");

echo phpinfo();
echo 'Transaction: ' . $transaction . PHP_EOL;
echo var_export($_COOKIE, true);

?>