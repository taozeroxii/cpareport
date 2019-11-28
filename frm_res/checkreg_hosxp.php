<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>table reg hosxp</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>


<body style="font-family: 'Prompt', sans-serif;">

    <style>
        .fontstatusa {
            color: red;
        }
        .fontstatusb {
            color: green;
        } 
    </style>
    <!--  /////////////////// เชื่อมต่อ และquery จำนวนหน้าและและช่องแถบค้นหา GET METHOD FROM ค้นหา//////////////////     -->
    <?php
    include('../config/my_con.class.php');
    include('../config/pg_con.class.php');
    $perpage = 5;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    //query เอาเลขหน้า
    $start = ($page - 1) * $perpage;
    $sql = "select * from frm_res_require_login_hosxp  ORDER BY id limit {$start} , {$perpage} ";
    $query = mysqli_query($con, $sql);

    $allrec = "SELECT * FROM frm_res_require_login_hosxp ORDER BY id";
    $queryalrecord = mysqli_query($con, $allrec);

    ///////////////////////////////////// เมื่อกดรับงาน ส่ง POST เข้ามาทำงาน //////////////////////////////// 
    if (isset($_POST['closejob'])) { //หากกดยืนยันรับงาน 
        //echo $_POST['admin_name'].$_POST['status_fix'].$_POST["repair_report_id"].$_SESSION['cid']; 
        mysqli_set_charset($con, "utf8");



        echo $addadminjob = "UPDATE `frm_res_require_login_hosxp` SET 
        `status` = 'done', 
        `enddate_time` = '".$_POST['enddate_time']."',
        `it_getrequest` = '".$_POST["txtassisadmin"]."'  WHERE id = '".$_POST["idform"]."'";

        $Queryaddadminjob =  mysqli_query($con, $addadminjob);
        //echo  $Queryaddadminjob;
        if ($Queryaddadminjob) {
            // LINE API NOTIFY//
            function send_line_notify($message, $token)
            {
                $ch = curl_init();
                curl_setopt(
                    $ch,
                    CURLOPT_URL,
                    "https://notify-api.line.me/api/notify"
                );
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                return $result;
            }
            $message = 'ดำเนินการเพิ่ม user hosxp '."\r\n".
            'วันที่ขอเพิ่ม :'.$_POST['begindate']."\r\n".
            'ชื่อ :'.$_POST["userregis"]."\r\n".
            'สถานะ : ดำเนินการแล้ว '."  ".  $_POST["txtassisadmin"]."\r\nเวลา: ".  $_POST["enddate_time"];
            $token = 'JM1KlQ87yxrkoRZ1bGpyHscYMiiqMO4rzyBC5EBzkhj';
            send_line_notify($message, $token);
            echo "<script>alert('บันทึกสำเร็จ');window.location = 'checkreg_hosxp.php'</script>";
        } else {
            echo "connect fail";
        }
        mysqli_close($conn);
    }
    ?>

    <?php
    mysqli_set_charset($con, "utf8");
    if (isset($_GET['txtKeyword'])) {
        if ($_GET["txtKeyword"] != "") {
            $sql  =  "select * from frm_res_require_login_hosxp 
                        WHERE (id LIKE '%" . $_GET["txtKeyword"] . "%' or 
                        pname LIKE '%" . $_GET["txtKeyword"] . "%' 
                        or fname LIKE '%" . $_GET["txtKeyword"] . "%' 
                        or lname LIKE '%" . $_GET["txtKeyword"] . "%' 
                        or cid LIKE '%" . $_GET["txtKeyword"] . "%' 
                        or username LIKE '%" . $_GET["txtKeyword"] . "%' 
                        or status LIKE '%" . $_GET["txtKeyword"] . "%' )";
        } else {
            $sql = "select * from frm_res_require_login_hosxp  ORDER BY id desc limit {$start} , {$perpage} ";
        }
        $query = mysqli_query($con, $sql);
    }
    ?>


    <hr>
    <!--  //////////////////////////////////////////// ค้นหา/////////////////////////////////////////////////////////     -->
    <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
        <!-- $_SERVER['SCRIPT_NAME']; คือการดึงชื่อเอกสารมา เมื่อกด form นี้ให้เกิดaction โหลดหน้าเดิม-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <center>
                        <h1>รายการคำขอเพิ่ม user hosxp</h1>
                    </center>
                </div>
                <div class="col-lg-6">
                    <table class="table table-bordered ">
                        <tr>
                            <th>
                                <input name="txtKeyword" placeholder="ค้นหา" type="text" class="form-control" id="txtKeyword" value="">
                            </th>
                            <th><input type="submit" class="btn btn-info btn-lg btn-block" value="Search"> </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </form>

    <!--  //////////////////////////////////////////////////////////////////////////////////////////////////////////////    -->


    <div class="container-fluid ">
        <?php echo  '<p>จำนวนทั้งหมด : ' . $totaldata = mysqli_num_rows($queryalrecord) . ' รายการ</p>'; ?>
        <hr calss='mx-auto mt-5 shadow p-3 bg-white rounded'>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover ">
                    <thead>
                        <tr>
                            <th style="text-align:center;"> เลขที่</th>
                            <th style="text-align:center;">ชื่อ-นามสกุล ผู้แจ้ง </th>
                            <th style="text-align:center;">ตำแหน่งหลัก</th>
                            <th style="text-align:center;">แผนก</th>
                            <th style="text-align:center;">ชื่อ ผู้ดำเนินการ </th>
                            <th style="text-align:center;">สถานะดำเนินการ</th>
                            <th style="text-align:center;">วันที่แจ้ง</th>
                            <th style="text-align:center;">ดำเนินการเสร็จ</th>
                            <th style="text-align:center;">ตรวจสอบ</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php while ($result = mysqli_fetch_assoc($query)) { ?>
                            <tr data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <td style="text-align:center;"><?php echo $result['id']; ?> </td>
                                <td><?php echo $result['pname'] . ' ' . $result['fname'] . '    ' . $result['lname']; ?> </td>
                                <td><?php echo $result['jobclass'] ?></td>
                                <td><?php echo $result['spclty']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['it_getrequest']; ?> </td>
                                <td class="<?php if (($result['status'] == 'waiting')) { echo 'fontstatusa'; } else echo 'fontstatusb'; ?>" style="text-align:center;"><?php echo $result['status']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['insertdate_time']; ?> </td>
                                <td style="text-align:center;"><?php echo $result['enddate_time']; ?> </td>
                                <td>
                                    <center><button class="btn btn-info" data-toggle="modal" data-target="#closejob<?php echo $result['id']; ?>">เพิ่มเติม</button> </center>
                                </td>
                            </tr>


                            <!--///////////////////////////////////////////// Modal close job  ///////////////////////////////////////////////////////-->
                            <div class="modal fade" id="closejob<?php echo $result['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">ปิดงาน</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>ใบแจ้งที่: <?php echo $result['id']; ?></p>
                                            <p>วันที่แจ้ง: <?php echo $begin = $result['insertdate_time']; ?></p>
                                            <p>ชื่อ-นามสกุล: <?php echo $userregis =  $result['pname'] . $result['fname'] . '    ' . $result['lname']; ?></p>
                                            <p>ชื่อภาษาอังกฤษ: <?php echo $result['panme'] . $result['fname'] . '    ' . $result['lname']; ?></p>
                                            <p>เพศ: <?php echo $result['gender']; ?> </p>
                                            <p>ปีเกิด: <?php echo $result['birthday']; ?> </p>
                                            <p>เลขที่ใบประกอบวิชาชีพ: <?php echo $result['doctor_cert']; ?> </p>
                                            <p>ตำแหน่งหลัก: <?php echo $result['jobclass']; ?> </p>
                                            <p>แผนก: <?php echo $result['spclty']; ?> </p>
                                            <p>เฉพาะทาง: <?php echo $result['speciality']; ?> </p>
                                            <p>วันที่เริ่มงาน: <?php echo $result['first_day_in_job']; ?> </p>
                                            <p>user.: <?php echo $result['username']; ?> </p>
                                            <p>password.: <?php echo $result['password']; ?> </p>
                                            <p>หมายเหตุ.: <?php echo $result['note']; ?> </p>
                                            <hr>
                                            <h4 class="modal-title">ข้อมูลเพิ่มเติม</h4>
                                            <hr>
                                            <form action="#" method="POST" name='colsejob'>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <label for="assis1">ผู้ดำเนินการ</label>
                                                        <select id="inputState" name="txtassisadmin" class="form-control" required>
                                                            <option selected value="">...</option>
                                                            <option value="เอก">เอก</option>
                                                            <option value="โอ">โอ</option>
                                                            <option value="ดอย">ดอย</option>
                                                            <option value="มาร์ค">มาร์ค</option>
                                                            <option value="เต๋า">เต๋า</option>
                                                        </select>
                                                    </div>
                                                </div>
                                              
                                        </div>

                                        <div class="modal-footer">
                                            <?php
                                                date_default_timezone_set("Asia/Bangkok"); //ตั้งโซนเวลา
                                                $month = date('m');
                                                $day = date('d');
                                                $year = (date('Y'));
                                                $TIME = date("H:i:s");   //date("h:i:s a"); แบบมีpm am
                                                $today = $year . '-' . $month . '-' . $day . '  ' . $TIME;
                                                ?>
                                            <input type="hidden" name="status" value="done">
                                            <input type="hidden" name="userregis" value="<? echo $userregis;?>">
                                            <input type="hidden" name="idform" value="<?echo $result['id'];?>">
                                            <input type="hidden" name="enddate_time" value="<?php echo $today ?>">
                                            <input type="hidden" name="begindate" value="<?php echo $begin ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            <input type="submit" name="closejob" class="btn btn-primary" value="ดำเนินการแล้ว">
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


                        <?php } ?>
                    <tbody>
                </table>
            </div>
        </div>


        <!--  /////////////////// ส่วนของ paginatorทำ query มาใหม่และนับจำนวนแถว //////////////////     -->
        <?php

        $sql2 = "select * from frm_res_require_login_hosxp ";
        if (isset($_GET['txtKeyword'])) {
            if ($_GET["txtKeyword"] != "") {
                $sql2  =  "SELECT * FROM frm_res_require_login_hosxp WHERE (id LIKE '%" . $result['adminget_name'] . "%' or fname LIKE '%" . $_GET["txtKeyword"] . "%' or status LIKE '%" . $_GET["txtKeyword"] . "%' )";
            } else {
                $sql2 = "SELECT * FROM `frm_res_require_login_hosxp` ORDER BY `id` DESC";
            }
        }

        $query2 = mysqli_query($con, $sql2);
        $total_record = mysqli_num_rows($query2);
        $total_page = ceil($total_record / $perpage);
        ?>


        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="index.php?page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span></a>
                <li class="page-item">
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="index.php?page=<?php echo $total_page; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span></a>
            </li>
            </ul>
        </nav>
    </div>
    </div>
    </div> <!-- /container -->
    <!--  /////////////////// ส่วนของ paginatorทำ query มาใหม่และนับจำนวนแถว //////////////////     -->


    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                if (i < 3) {
                    i++;
                    $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                }

            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });

            $('#submit').click(function() {
                $.ajax({
                    url: "name.php",
                    method: "POST",
                    data: $('#add_name').serialize(),
                    success: function(data) {
                        alert(data);
                        $('#add_name')[0].reset();
                    }
                });
            });

        });
    </script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
</body>

</html>