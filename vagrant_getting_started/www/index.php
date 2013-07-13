<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="awesome.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript">

$('#search_button').click(function(e) {
                          
                          });
</script>
<title>Logging Test</title>
</head>
<body>
<?php
    
    $keyword = '';
    if (isset($_REQUEST['keyword'])) {
        $keyword = $_REQUEST['keyword'];
    }
?>
<a title="run" class="run_button">RUN</a
<form>
    <input type="text" name="keyword" value="<?$keyword?>" />
    <button type="submit" id="search_button" title="search">SEARCH</button>
</form>
Number of results:  
<select>
    <option value="10" selected>10</option>
    <option value="25">25</option>
    <option value="50">50</option>
    <option value="100">100</option>
</select>
<table name="results">
<th>
<tr>
<td>CSNUtID</td>
<td>Timestamp</td>
<td>Process</td>
<td>Message</td>
<td>Transation</td>
</tr>
</th>
<tr>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
<td>TEST</td>
</tr>
</table>
</body>