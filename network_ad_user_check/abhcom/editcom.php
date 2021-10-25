<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>

    <?php

    include 'config/mysql_con.class.php';
    date_default_timezone_set('Asia/Bangkok');

    $dep_detail = $_POST['dep_name'];
    $va         = explode("|", $dep_detail);
    $dep_name   = $va[1];

    $com_id      = $_POST['com_id'];
    $com_name    = $_POST['com_name'];
    $com_depid   = $va[0];
    $com_code    = $_POST['com_code'];
    $com_year    = $_POST['com_year'];
    $com_status  = $_POST['com_status'];
    $com_os_m    = $_POST['com_os_m'];
    $com_type    = $_POST['com_type'];
    $com_brand   = $_POST['com_brand'];
    $com_graphip = $_POST['com_graphip'];
    $com_dvdrom  = $_POST['com_dvdrom'];
    $com_cpu_m   = $_POST['com_cpu_m'];
    $com_cpu     = $_POST['com_cpu'];
    $com_ghz     = $_POST['com_ghz'];
    $com_ram_m   = $_POST['com_ram_m'];
    $com_hdd_m   = $_POST['com_hdd_m'];
    $com_note    = $_POST['com_note'];
    
    $com_userupdate = $_POST['com_userupdate'];

    $com_dateupdate   = DATE('Y-m-d H:i:s');


    $sql = " UPDATE com_detail 
             SET com_name    = '$com_name',
                 com_depid   = '$com_depid',
                 com_code    = '$com_code',
                 com_year    = '$com_year',
                 com_status  = '$com_status',
                 com_os_m    = '$com_os_m',
                 com_type    = '$com_type',
                 com_brand   = '$com_brand',
                 com_graphip = '$com_graphip',
                 com_dvdrom  = '$com_dvdrom',
                 com_cpu_m   = '$com_cpu_m',
                 com_cpu     = '$com_cpu',
                 com_ghz     = '$com_ghz',
                 com_ram_m   = '$com_ram_m',
                 com_hdd_m   = '$com_hdd_m',
                 com_note    = '$com_note',
                 com_userupdate    = '$com_userupdate',
                 com_dateupdate    = '$com_dateupdate'
             WHERE com_id = '$com_id' ";


    if (mysqli_query($con, $sql)) {

        echo "<script type=\"text/javascript\">";
        echo "alert(\"ปรับปรุงข้อมูลสำเร็จ...\");";
        echo "location.href = 'com_detail.php';";
        echo "</script>";
        exit();
    } else {
        echo "<script type=\"text/javascript\">";
        echo "alert(\"ไม่สามารถปรับปรุงข้อมูลได้ กรุณาตรวจสอบ...\");";
        echo "location.href = 'com_detail.php';";
        echo "</script>";
        exit();
    }
    mysqli_close($con);

    ?>
</body>

</html>