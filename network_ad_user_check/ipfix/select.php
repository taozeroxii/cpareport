<?php  
date_default_timezone_set('asia/bangkok');
 if(isset($_POST["employee_id"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");  
      mysqli_set_charset($connect,"utf8"); 
      $query = "SELECT * FROM network_ipfix_zone WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%"><label>IP Addess</label></td>  
                     <td width="70%">'.$row["ipaddess"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>ขอใช้เมื่อ</label></td>  
                     <td width="70%">'.$row["updatedate"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>เบอร์โทรศัพท์</label></td>  
                     <td width="70%">'.$row["telephone"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>สถานที่ตั้ง IP</label></td>  
                     <td width="70%">'.$row["location"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>หมายเหตุ</label></td>  
                     <td width="70%">'.$row["note"].'</td>  
                </tr>  
           ';  
      }  
      $output .= '  
           </table>  
      </div>  
      ';  
      echo $output;  
 }  
 ?>
 