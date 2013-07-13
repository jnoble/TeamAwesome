<?php

ini_set('display_errors', E_ALL);
set_include_path(get_include_path() . PATH_SEPARATOR . '/vagrant/www');

require 'log4php/Logger.php';
require 'log4php/appenders/LoggerAppenderAMQP.php';
require 'log4php/layouts/LoggerLayoutGelf.php';

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

server_log('PHP', $_SERVER['PHP_SELF']);

$visits = 0;
//$sql = 'DROP TABLE tblLog';
//$sql = 'CREATE TABLE tblState (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, CSNUtID CHAR(20), visits INT);';
$sql = 'SELECT visits FROM tblState WHERE CSNUtID=' . quote($_SESSION['CSNUtID'], 0);
$res = query($sql);
if ($res === false) {
  echo 'select failed: ' . $sql . '<br />';
  pretend_nothing_happened();
} else {
  $row = $res->fetch_assoc();
  if (isset($row['visits'])) {
    $visits = $row['visits'];
    $sql = 'UPDATE tblState SET visits = ' . quote($visits + 1, 1) 
      . ' WHERE CSNUtID=' . quote($_SESSION['CSNUtID'], 0);
  } else {
    $sql = 'INSERT INTO tblState (CSNUtID, visits) VALUES (' . quote($_SESSION['CSNUtID'], 0) . ', 1);';
  }
  $res = query($sql);
  if ($res === false) {
    echo 'update failed (' . $sql . ')<br />';
    pretend_nothing_happened();
  }
}

//echo phpinfo();
echo 'Transaction: ' . htmlentities($_SESSION['HTTP_X_REQUEST_ID']) . '<br />';
echo 'User ID: ' . htmlentities($_SESSION['CSNUtID']) . '<br />';
echo 'Prior number of visits: ' . htmlentities($visits) . '<br />';

$query = '';


function server_log($type, $request) {
  Logger::configure('log4php/config.xml');
  $logger = Logger::getLogger("main");
  $server_data = array('CSNUtID' => $_SESSION['CSNUtID'],
                       'HTTP_X_REQUEST_ID' => $_SESSION['HTTP_X_REQUEST_ID'],
                       'PARENT_REQUEST_ID' => $_SESSION['PARENT_REQUEST_ID'],
                       'BROWSE_DEPTH' => $_SESSION['BROWSE_DEPTH'],
                       'SERVER' => $type,
                       'REQUEST' => $request,
                       'TIMESTAMP' => date(DATE_ATOM));
  $logger->info(json_encode($server_data));
}

    
function query($sql) {
  $mysqli = mysqli_connect('localhost', 'root', 'guest', 'mydata');
  $res = mysqli_query($mysqli, $sql);

  $logger = Logger::getLogger("main");
  server_log('MySQL', $sql);

  return $res;
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