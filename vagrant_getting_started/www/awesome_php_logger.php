<?php
  $parent_transaction = $_REQUEST['parentTransaction'];
  $this_transaction = $_SERVER['HTTP_X_REQUEST_ID'];
  
  //log stuff!!
  echo '<br>Parent: ' . $parent_transaction . '  This: ' . $this_transaction;
?>