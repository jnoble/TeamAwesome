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
  'HA Proxy' => array('@fields.accept_date' => 'timestamp',
  	       	      '@fields.captured_response_cookie' => 'CSNUtID',
                      '@fields.captured_request_headers' => 'transaction',
		      '@fields.http_request' => 'request'),
  'Load Balancer' => array('@timestamp' => 'timestamp',
                    	   '@fields.txid' => 'transaction',
		     	   '@fields.request' => 'request'),
  'PHP' => array('TIMESTAMP' => 'timestamp',
  		 'CSNUtID' => 'CSNUtID',
                 'HTTP_X_REQUEST_ID' => 'transaction',
		 'PARENT_REQUEST_ID' => 'parent',
		 'REQUEST' => 'request') );

header('Content-Type: application/json');

$date = date('Y.m.d', $start_date);
$url = 'http://' . ELASTICSEARCH . ':9200/clickstream-' . $date . '/_search';
if ($key == 'transaction_list') {
  $query = '';
  log_server($query_json, 'ElasticSearch');
  $output = curl($url, json_encode($query));
  $output = process_output(json_decode($output));
  echo json_encode($output);
  exit(0);
}

$output = array();
foreach ($key in array('haproxy', 'php', 'nginx_access')) {
  if ($type == 'haproxy') {
    if ($key == 'user_id) {
      $search = array('key' => '@fields.captured_response_cookie', 'value' => 'CSNUtID=' . $value);
    } elseif ($key == 'transaction_id') {
      $search = array('key' => '@fields.captured_request_headers', 'value' => $value));
    } else {
      continue;
    }
  } elseif ($type == 'nginx_access') {
    if ($key == 'transaction_id') {
      $search = array('key' => '@fields.txid', 'value' => $value);
    } else {
      continue;
    }
  } elseif ($type == 'PHP') {
    $search = array('key' => $key, 'value' => $value);
  }
  $query = array('query' => array('match' => $search));
  $query_json = json_encode($query);
  log_server($query_json, 'ElasticSearch');
  $result = curl($url, $query_json);
  $output = array_merge($output, json_decode($result));
}
$output = process_output($output);
echo json_encode($output);


function process_output($input) {
  $output = array();
  foreach ($row in $output) {
    $new_row = array();
    if (isset($row['@type'])) {
      if ($row['@type'] == 'nginx_access') {
        $new_row['type'] = $type = 'Load Balancer';
      } elseif ($row['@type'] == 'haproxy_log') {
        $new_row['type'] = $type = 'HA Proxy';
      }
    } else {
      $type = 'PHP';
      $new_row['type'] = $row['type'];
    }
    
    foreach ($headers[$type] as $header) {
      $new_row[$header[1]] = $row[$header[0]];
    }
    $output[] = $new_row;
  }
  return $output;
}

?>