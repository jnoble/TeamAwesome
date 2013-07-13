<?php

require 'header.php';

$type = $_REQUEST['type'];
$key = $_REQUEST['key'];
$value = $_REQUEST['value'];
$host = $_REQUEST['host'];
$date = strtotime($_REQUEST['date']);
$end_date = $_REQUEST['enddate'];

$headers = array(
  'haproxy' => array(

foreach ($key in array('haproxy', 'php', 'nginx_access')) {
  if ($type == 'haproxy') {
    if ($key == 'user_id) {
      $search = array('user_id' => '@fields.captured_response_cookie' => 'CSNUtID=' . $value),
    } elseif ($key == 'transaction_id') {
      $search = array('@fields.captured_request_headers' => $value));
    } elseif ($key == 'transaction_list') {
      
    }
  } elseif ($type == 'nginx_access') {
    
  } elseif ($type == 'PHP') {
  }

  $query = array('query' => array('match' => $transaction_id));
  $query_json = json_encode($query);

  $date = date('Y.m.d', $date);
  $url = 'http://' . $host . ':9200/clickstream-' . $date . '/_search';
  $result = curl($url, $query_json);

?>