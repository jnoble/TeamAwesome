<?php
  include "awesome_header.php";
  ini_set('display_errors', E_ALL);
  
  $keyword = '';
  if (isset($_REQUEST['keyword'])) {
    $keyword = $_REQUEST['keyword'];
  }

  $data_key = $_REQUEST['search_type'];
  $num_results = $_REQUEST['num_results'];
  $search_button = $_REQUEST['search_button'];
  
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
<th>Timestamp</th>
<th>Process</th>
<th>Message</th>
<th>Transation</th>
</tr>
<tr>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
</tr>
</table>
<?
include "awesome_footer.php";
?>