<?php

  $keyword = '';
  $data_key = '';
  $num_results = '';
  $search_button = '';
  $num_result = isset($_REQUEST['num_results']) ? $_REQUEST['num_results'] : 10;
  $page_type = '';
  $search_button = isset($_REQUEST['search_button'])?$_REQUEST['search_button']:'';
  
  if (!empty($search_button)) {
    
    $keyword = $_REQUEST['keyword'];
    $data_key = $_REQUEST['search_type'];
    
    if ($data_key = 'customer') {
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
                 array("term" => $keyword ),
                 "sort" =>
                 array("@timestamp" => array( "order" => "desc" )),
                 "size" => $num_result);
  
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
<button type="submit" id="search_button" title="search">SEARCH</button>
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
  
  
  
  $data_array = json_decode($data, true);
  //print_r($data_array);
  if (!empty($data_array) && $data_array['status'] != 404) {
    
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
    foreach ($data_array['hits']['hits'] as $hit) {
      $hit = $hit['_source'];
      echo "<td>" . $hit['@timestamp'] . "</td>\n";
      echo "<td><a href='/view_detail.php?txid=" . $hit['@fields']['txid'] . "'>" . $hit['@fields']['txid'] . "</a></td>\n";
      echo "<tr>";
    }
  } else {
    foreach ($data_array['hits']['hits'] as $hit) {
      $hit = $hit['_source'];
      echo "<td>" . $hit['@timestamp'] . "</td>\n";
      echo "<td>" . $hit['@source'] . "</td>\n";
      echo "<td>" . $hit['@fields']['request'] . "</td>\n";
      echo "<td>" . $hit['@fields']['http_user_agent'] . "</td>\n";
      echo "<td><a href='/view_detail.php?csnutid=" . $hit['@fields']['CSNUtID'] . "'>" . $hit['@fields']['CSNUtID'] . "</a></td>\n";
      echo "<tr>";
    }
  }
  } else {
    echo 'No logs found!';
  }
  
  ?>
</table>

