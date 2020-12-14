<?php 
include 'config/db.php';
date_default_timezone_set('Asia/Bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
<style>
    .fbody{
    font-family: 'Kanit', sans-serif;
    }
</style>
    <title>WIFI</title>
</head>

<body>
<?
$sql = " SELECT * FROM cpa_wifiauthen ORDER BY id DESC ";
$row = mysqli_query($conn, $sql);
?>
    <div class="w3-container fbody">
  <h2 class="fbody">รายการขอใช้งาน WI-FI :: ABH-GUEST</h2>
  <p>ตรวจสอบผู้ขอใช้งาน<em>สร้างรหัส wifi Set (จัดการสร้างรหัส)</em>ได้รหัสแจ้งผู้ขอใช้งาน และ update แจ้งผู้ขอ Active</p>

  <table class="w3-table-all fbody">
    <thead>
      <tr class="w3-red">
      <th>#</th>
      <th>Id</th>
        <th>NAME</th>
        <th>Dep</th>
        <th>Tel</th>
        <th>Client</th>
        <th>Start</th>
        <th>End</th>
        <th>Set</th>
        <th>Active</th>
      </tr>
    </thead>
    <?php
    $rw=0;
    while($result = mysqli_fetch_array($row)){
    $rw++;
        ?>
    <tr>
      <td><?php echo $rw;?></td>
      <td><?php echo $result['id'];?></td>
      <td><?php echo $result['name_send'];?></td>
      <td><?php echo $result['dep'];?></td>
      <td><?php echo $result['phone'];?></td>
      <td><?php echo $result['user_count'];?></td>
      <td><?php echo $result['startdate'];?></td>
      <td><?php echo $result['enddate'];?></td>
      <td>
           <?php
           if ( $result['flage'] =='Y') {
              echo '<a href="https://172.16.36.1:8080/wirelessguest" target="_blank" title="จัดการสร้างรหัส">  <button class="w3-button w3-xlarge w3-circle w3-teal">+</button></a>';
           }else{
             echo '<button class="w3-button w3-xlarge w3-circle w3-black">x</button></a>';          
            } 
           ?>
      </td>
      <td>
      <?php
           if ( $result['flage'] =='Y') {
           echo '<a href="update_wifi.php?id='.$result["id"].' title="UPDATE แจ้งผู้ขอ"><button class="w3-bar-item w3-button w3-teal">+</button></a></td>';
    }else{
        echo '<button class="w3-bar-item w3-button w3-red">x</button></a>';          
       } 
       ?>
    </tr>
    <?
}
?>
  </table>
</div>
</body>
</html>