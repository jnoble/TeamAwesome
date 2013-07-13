<?php

require 'header.php';

$key = $_REQUEST['key'];
$value = $_REQUEST['value'];
$start_date = strtotime($_REQUEST['startdate']);
$end_date = strtotime($_REQUEST['enddate']);

$headers = array(
  'haproxy' => array('timestamp' => '@fields.accept_date',
  	       	     'CSNUtID'   => '@fields.captured_response_cookie',
                     'transaction' => '@fields.captured_request_headers'

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
$date = date('Y.m.d', $start_date);
$url = 'http://' . ELASTICSEARCH . ':9200/clickstream-' . $date . '/_search';

log_server($query_json, 'ElasticSearch');
$result = curl($url, $query_json);

header('Content-Type: application/json');
echo $result;

?>