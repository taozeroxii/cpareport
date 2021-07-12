<?php
$objConnect = mysql_connect("172.18.2.2", "webcvhost", "WebCpa10665Hos!") or die(mysql_error());
$objDB = mysql_select_db("lab_rs_covid_19");
mysql_query('TRUNCATE TABLE lab_result;') or die(mysql_error()); 

echo ("<script LANGUAGE='JavaScript'> window.alert('Delete All Data Successfuly !!');  window.location.href='./'; </script>");
?>