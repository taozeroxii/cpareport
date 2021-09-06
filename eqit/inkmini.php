<?php
    date_default_timezone_set('asia/bangkok');
    $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
    mysqli_set_charset($connect, "utf8");
        
    $mini_name   = $_POST['mini_name'];
    $end_date    = $_POST['end_date'];
    $eq_from_name    = $_POST['eq_from_name'];
    $eq_to_name      = $_POST['eq_to_name'];
    $check_device = $_POST['check_device'];
    $device_note      = $_POST['device_note']; 

    $sqlup = " UPDATE eqit_mini_data  SET end_date = '$end_date' , eq_from_name = '$eq_from_name' , eq_to_name = '$eq_to_name' , check_device = '$check_device' , device_note = '$device_note' WHERE mini_name = '$mini_name' AND end_date IS NULL ";
    $que = mysqli_query($connect, $sqlup);

    $sqlOK = " UPDATE eqit_minikiosk  SET mini_out_status = 'OK' WHERE mini_name = '$mini_name' ";
    $queok = mysqli_query($connect, $sqlOK);

    if ($que) {
        echo "<script language='javascript'>";
        echo "if(!alert('คืนอุปกรณ์สำเร็จ Successful ')){
        window.location.replace('index.php');
    }";
        echo "</script>";
    } else {
        echo "<script language='javascript'>";
        echo "if(!alert('Error ทำรายการไม่สำเร็จ')){
        window.location.replace('index.php');
    }";
        echo "</script>";
    }
    mysqli_close($connect);
 
?>