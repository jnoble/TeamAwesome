<?php

require 'header.php';

$key = $_REQUEST['key'];
$value = $_REQUEST['value'];
$start_date = $_REQUEST['startdate'] ?: date(DATEATOM);
$start_date = strtotime($start_date);
$end_date = $_REQUEST['enddate'];
if ($end_date) {
   $end_date = strtotime($end_date);
} else {
  $end_date = time() - 60 * 60;
}

$headers = array(
  'haproxy' => array('timestamp' => '@fields.accept_date',
  	       	     'CSNUtID'   => '@fields.captured_response_cookie',
                     'transaction' => '@fields.captured_request_headers',
		     'request' => '@fields.http_request',
		     'depth' => '',
 		     'type' => 'HAProxy'),
  'nginx_access' => array('timestamp' => '',
  		          'CSNUtID'   => '',
                    	  'transaction' => '',
		     	  'request' => '',
		     	  'depth' => '',
 		     	  'type' => ''),
  'PHP' => array('timestamp' => 'TIMESTAMP',
  		 'CSNUtID'   => 'CSNUtID',
                 'transaction' => 'HTTP_X_REQUEST_ID',
		 'parent' => 'PARENT_REQUEST_ID',
		 'request' => 'REQUEST',
		 'depth' => 'BROWSE_DEPTH',
 		 'type' => 'type') );

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