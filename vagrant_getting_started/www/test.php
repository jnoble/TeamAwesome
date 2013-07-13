<?php
require 'header.php';

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

    $request = array('type' => 'user_id', 'key' => $_SESSION['CSNUtID']);
    $request = array('type' => 'transaction_id', 'key' => $_SESSION['HTTP_X_REQUEST_ID']);
$result = curl('http://' . SERVICE . '/elasticsearch_service.php', json_encode($request));
echo '<br />Results:<br />' . var_export($result, true);



?>