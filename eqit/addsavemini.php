<?php
   // header('Content-Type: application/json');
    date_default_timezone_set('asia/bangkok');
    $connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
    mysqli_set_charset($connect, "utf8");
    
    $mini_name   = $_POST['mini_name'];
    $eq_fname    = $_POST['eq_fname'];
    $eq_lname    = $_POST['eq_lname'];
    $eq_tel      = $_POST['eq_tel'];
    $eq_position = $_POST['eq_position'];
    $eq_dep      = $_POST['eq_dep']; 
    $eq_datestart  = $_POST['eq_datestart'];
    $eq_note     = $_POST['eq_note'];
    $eq_fsend    = $_POST['eq_fsend'];
    $eq_fopsition  = $_POST['eq_fopsition'];	
    $status_mini = "Y";    
	$sql = "INSERT INTO eqit_mini_data (mini_name,eq_fname,eq_lname,eq_tel,eq_position,eq_dep,eq_datestart,eq_note,eq_fsend,eq_fopsition,status_mini) 
	VALUES ('$mini_name','$eq_fname','$eq_lname','$eq_tel','$eq_position','$eq_dep','$eq_datestart','$eq_note','$eq_fsend','$eq_fopsition','$status_mini')";
    $querynew = mysqli_query($connect, $sql);

    $sqlup = " UPDATE eqit_minikiosk  SET mini_out_status = 'NO' WHERE mini_name = '$mini_name' ";
    $que = mysqli_query($connect, $sqlup);

    if ($querynew) {
        echo "<script language='javascript'>";
        echo "if(!alert('ทำรายการยืมสำเร็จ Successful ')){
        window.location.replace('exportpdf.php?mini_name=$mini_name');
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