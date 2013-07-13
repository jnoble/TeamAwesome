<?php
  include 'header.php';
  include "awesome_header.php";
  ini_set('display_errors', E_ALL);
    
  ?>
<h1>Team Awesome's Amazing Logomatic Machine</h1>

<div style="width:900px;height:50px;background-color:#BCE1F5">
<br>
<form style="float:left;vertical-align:middle">
<select name="search_type">
  <option value="customer">Customer ID</option>
  <option value="transaction">TransactionID</option>
</select>

<input type="text" name="keyword" value="<?$keyword?>" />
<button type="submit" id="search_button" title="search">SEARCH</button>
</form>
<div style="float:right;vertical-align:middle">
Number of results:
<select name="num_results">
<option value="10" selected="true">10</option>
<option value="25" selected="false">25</option>
<option value="50" selected="false">50</option>
<option value="100" selected="false">100</option>
</select>
</div>
<br><br>
</div>
<br>
<table name="results" style="float:left;width:900px;">
<tr>
<th>CSNUtID</th>
<th>Name</th>
<th>Timestamp</th>
<th>Request</th>
<th>Transaction ID</th>
</tr>
<tr>
<?
$url = 'http://' . SERVICE . '/elasticsearch_service.php';
$query = array('key' => 'transaction_list', 'value' => '');
$results = curl($url, json_encode($query));
$results = json_decode($results);
echo var_export($results, true);
$mysql_url = 'http://' . SERVICE . '/mysql_service.php';
foreach ($results as $row) {
    $query = array('CSNUtID' => $row['CSNUtID']);
    $name = curl($mysql_url, json_encode($query));
    $name = json_decode($name);
    echo '<td><a href="customer_list.php?CSNUtID=' . htmlentities($row['CSNUtID']) . '">'
      . htmlentities($row['CSNUtID']) . '</a></td>';
    echo '<td>' . htmlentities($name['First']) . ' ' . htmlentities($name['Last']) . '</td>';
    echo '<td>' . htmlentities($row['timestamp']) . '</td>';
    echo '<td>' . htmlentities($row['request']) . '</td>';
    echo '<td>' . htmlentities($row['transaction']) . '</td>';
}
?>
</tr>
</table>
<?
include "awesome_footer.php";
?>