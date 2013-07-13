<?php

ini_set('display_errors', E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . '/vagrant/www');

include('log4php/Logger.php');
Logger::configure('log4php/config.xml');

$logger = Logger::getLogger("main");
$logger->info("This is an informational message.");

echo 'Test!';

?>