<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="awesome10.css" type="text/css" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>

$(document).ready(function(){
                  var advancedSearchLink = $('#js_advanced_search'),
                  transactionID = $('#transactionID').val();
                  
                  $(document).ajaxStart(function(){
                                        $.ajax({
                                               url: 'awesome_php_logger.php?parentTransaction=' + transactionID
                                               });
                                        });
                  advancedSearchLink.click(function(e){
                                           if($('#advanced_search_content').html() == '') {
                                           $.ajax({
                                                  url: 'advanced_search.php',
                                                  dataType: 'html',
                                                  }).success(function(responseText) {
                                                             $('#advanced_search_content').html(responseText);
                                                             var dateFrom = $('#dateFrom'),
                                                             dateTo = $('#dateTo');
                                                             
                                                             dateFrom.datepicker();
                                                             dateTo.datepicker();
                                                             });
                                           } else {
                                           $('#advanced_search_content').html('');
                                           }
                                           });
                  });
</script>

<title>Logging Test</title>
</head>
<body>
<input type="hidden" id="transactionID" value="<?=isset($_SERVER['HTTP_X_REQUEST_ID'])?$_SERVER['HTTP_X_REQUEST_ID']:''?>">