<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="awesome.css?parameter=1" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

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
    <option value="10" selected="true">10</option>
    <option value="25" selected="false">25</option>
    <option value="50" selected="false">50</option>
    <option value="100" selected="false">100</option>
</select>
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