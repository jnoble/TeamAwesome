<?php
  include "awesome_header.php";
  ini_set('display_errors', E_ALL);
  
  $keyword = '';
  if (isset($_REQUEST['keyword'])) {
    $keyword = $_REQUEST['keyword'];
  }
  ?>
<h1>Team Awesome's Amazing Logomatic Machine</h1>
<a title="run" class="run_button">RUN</a
<form>
<input type="text" name="keyword" value="<?$keyword?>" />
<button type="submit" id="search_button" title="search">SEARCH</button>
</form>

Number of results:
<select>
<option value="10" selected="true">10</option>
<option value="25" selected="false">25</option>
<option value="50" selected="false">50</option>
<option value="100" selected="false">100</option>
</select>
<a id="js_advanced_search">Advanced Search</a>
<div width="300px" style="background-color:#BCE1F5;" id="advanced_search_content"></div>
<table name="results">
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