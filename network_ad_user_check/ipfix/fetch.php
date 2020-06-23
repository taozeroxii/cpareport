<?php  
date_default_timezone_set('asia/bangkok');
 $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");  
 mysqli_set_charset($connect,"utf8");
 if(isset($_POST["employee_id"]))  
 {  
      $query = "SELECT * FROM network_ipfix_zone WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>
 