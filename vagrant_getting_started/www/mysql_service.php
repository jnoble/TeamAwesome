<?php 

require 'header.php';


function query($sql) {
  $mysqli = mysqli_connect('localhost', 'root', 'guest', 'mydata');
  $res = mysqli_query($mysqli, $sql);

  $logger = Logger::getLogger("main");
  server_log('MySQL', $sql);

  return $res;
}

?>