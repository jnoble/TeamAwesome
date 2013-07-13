<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="awesome10.css" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
 <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(document).ready(function(){
                  
                  $.ajax({
                         url: 'advanced_search.php',
                         dataType: 'html'
                  }).success(function(responseText) {
                             $('#advanced_search_content').html(responseText);
                             var dateFrom = $('#dateFrom'),
                             dateTo = $('#dateTo');
                  
                             dateFrom.datepicker();
                             dateTo.datepicker();
                             });
                  });
</script>

<title>Logging Test</title>
</head>
<body>
<?php
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
<a href="" id="js_advanced_search">Advanced Search</a>
<span id="advanced_search_content"></span>
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
</body>