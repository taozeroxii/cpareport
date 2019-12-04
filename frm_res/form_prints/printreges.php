<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Print</title>
    <?php
    include('../../config/my_con.class.php');
    include('../../config/pg_con.class.php');
    $id =  $_GET['id'];
    $sql = "select * from frm_res_require_login_hosxp where id = '" . $id . "' ORDER BY id desc ";
    $query = mysqli_query($con, $sql);
    //onLoad="window.print()"
    ?>

</head>

<body onLoad="window.print()">
    <style>p{font-size: 16px;}</style>
    <div class="container mt-5 border">
        <br>
        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
            <div class="header" style="background: gray;color:white;padding:15px">
                <H3>ใบแจ้งที่: <?php echo $result['id']; ?></H3>
                <H5>วันที่แจ้ง: <?php echo $begin = $result['insertdate_time']; ?></H5>
            </div>
            <hr>
            <div class="cotaint">
                <p>ชื่อ-นามสกุล : <?php echo $userregis =  $result['pname'] . $result['fname'] . '    ' . $result['lname']; ?></p>
                <p>ชื่อภาษาอังกฤษ : <?php echo $result['panme'] . $result['fname'] . '    ' . $result['lname']; ?></p>
                <p>เพศ : <?php echo $result['gender']; ?> </p>
                <p>ปีเกิด : <?php echo $result['birthday']; ?> </p>
                <p>เลขที่ใบประกอบวิชาชีพ : <?php echo $result['doctor_cert']; ?> </p>
                <p>ตำแหน่งหลัก : <?php echo $result['jobclass']; ?> </p>
                <p>แผนก : <?php echo $result['spclty']; ?> </p>
                <p>เฉพาะทาง : <?php echo $result['speciality']; ?> </p>
                <p>วันที่เริ่มงาน : <?php echo $result['first_day_in_job']; ?> </p>
                <p>user : <?php echo $result['username']; ?> </p>
                <p>password : <?php echo $result['password']; ?> </p>
                <p>หมายเหตุ(รหัสห้อง) : <?php echo $result['note']; ?> </p>
            </div>
        <?php } ?>

    </div>
    <hr>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>