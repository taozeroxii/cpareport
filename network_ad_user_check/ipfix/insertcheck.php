<?php  
date_default_timezone_set('asia/bangkok');
 $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");  
 mysqli_set_charset($connect,"utf8");
 $today =  date('Y-m-d H:i:s');
 if(!empty($_POST))  
 {  

      $output = '';  
      $message = '';  
      $ipaddess = mysqli_real_escape_string($connect, $_POST["ipaddess"]);  
      $updatedate = mysqli_real_escape_string($connect, $_POST["updatedate"]);  
      $telephone = mysqli_real_escape_string($connect, $_POST["telephone"]);  
      $location = mysqli_real_escape_string($connect, $_POST["location"]);  
      $note = mysqli_real_escape_string($connect, $_POST["note"]);  
      if($_POST["employee_id"] != '')  
      {  
           $query = "  
           UPDATE network_ipfix_zone   
           SET ipaddess='$ipaddess',   
           updatedate='$today',   
           telephone='$telephone',   
           location = '$location',   
           note = '$note',
           flage = 'N'      
           WHERE id='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {  
           $query = "  
           INSERT INTO network_ipfix_zone(ipaddess, updatedate, telephone, location, note)  
           VALUES('$ipaddess', '$updatdate', '$telephone', '$location', '$note');  
           ";  
           $message = 'Data Inserted';  
      }  
      if(mysqli_query($connect, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM network_ipfix_zone ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Employee Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>