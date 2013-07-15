<?php

  $keyword = '';
  $data_key = '';
  $num_result = '';
  $search_button = '';
  $num_result = isset($_REQUEST['num_results']) ? $_REQUEST['num_results'] : 10;
  $page_type = '';
  $search_button = isset($_REQUEST['search_button'])?$_REQUEST['search_button']:'';
  
  //if (!empty($search_button)) {
  if (isset($_REQUEST['search_button'])) {
    
    $keyword = $_REQUEST['keyword'];
    $data_key = $_REQUEST['search_type'];
    
    if ($data_key == 'customer') {
      $page_type = 'tx_report';
    } else {
      $page_type = 'stack_report';
    }
  }
  if ($page_type ==  'tx_report') {
    $term = array( "CSNUtID" => $keyword );
  } else {
    $term = array( "txid" => $keyword );
  }
  $query = array(
                 "query" =>
                 array("term" => $term),
                 "sort" =>
                 array("@timestamp" => array( "order" => "desc" )),
                 "size" => $num_result);
  
  date_default_timezone_set("UTC");
  $index = "clickstream-" . date("Y.m.d");
  $data = curl("http://" . ELASTICSEARCH . ":9200/" . $index . "/_search",
               json_encode($query));
  ?>
<h1>Team Awesome's Amazing Logomatic Machine</h1>

<div style="width:900px;height:50px;background-color:#BCE1F5">
<br>
<form style="vertical-align:middle">
<select name="search_type">
<option value="customer">Customer ID</option>
<option value="transaction">TransactionID</option>
</select>

<input type="text" name="keyword" value="<?$keyword?>" />
<button type="submit" name="search_button" id="search_button" title="search">SEARCH</button>
<div style="float:right;vertical-align:middle">
Number of results:
<select name="num_results">
<option value="10" selected="true">10</option>
<option value="25" selected="false">25</option>
<option value="50" selected="false">50</option>
<option value="100" selected="false">100</option>
</select>
</div>
</form>
<br><br>
</div>
<br>
<table name="results" style="float:left;width:900px;">
<?php
  /*
   {
   "query": {
   "term": {
   "CSNUtID": "51e11b77dcbb6"
   }
   },
   
   "sort": [
   {
   "@timestamp": {
   "order": "desc"
   }
   }
   ],
   "size": size
   }
   */
  
  
  //print_r($data); 
  $data_array = json_decode($data, true);
  if (!empty($data_array)) {
    
    ?>
<tr>
<?php
  if ($page_type == 'tx_report') {
    ?>
<th>Timestamp</th>
<th>txid</th>
<?php
  } else {
    ?>
<th>Timestamp</th>
<th>Server</th>
<th>Request</th>
<th>User Agent</th>
<th>CSNUtID</th>
<?php
  }
  ?>
</tr>
<tr>
<?php
  
  if ($page_type == 'tx_report') {
    //print_r($data);
    foreach ($data_array['hits']['hits'] as $hit) {
      $hit = $hit['_source'];
      $txid = is_array($hit['@fields']['txid']) ? $hit['@fields']['txid'][0] : $hit['@fields']['txid'];
      $detail_url="/?search_type=transaction&keyword=" . $txid . "&search_button=&num_results=" . $num_result;
      echo "<td>" . $hit['@timestamp'] . "</td>\n";
      echo "<td><a href='" . $detail_url . "'>" . $txid . "</a></td>\n";
      echo "<tr>";
    }
  } else {
    foreach ($data_array['hits']['hits'] as $hit) {
      $hit = $hit['_source'];
      $detail_url="/?search_type=customer&keyword=" . $hit['@fields']['CSNUtID'] . "&search_button=&num_results=" . $num_result;
      echo "<td>" . $hit['@timestamp'] . "</td>\n";
      echo "<td>" . $hit['@source'] . "</td>\n";
      echo "<td>" . $hit['@fields']['request'] . "</td>\n";
      echo "<td>" . $hit['@fields']['http_user_agent'] . "</td>\n";
      echo "<td><a href='" . $detail_url . "'>" . $hit['@fields']['CSNUtID'] . "</a></td>\n";
      echo "<tr>";
    }
  }
  } else {
    echo 'No logs found!';
  }
  
  ?>
</table>

