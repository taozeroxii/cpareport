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
            color: crimson;
        }

        .fontstatusb {
            color: green;
        }

        @media print {
            .nonprint {
                display: none;
            }

            .print {
                width: 100%;
                float: left;
            }

            .print p {
                font-size: 16px;
            }

            .modal-backdrop {
                display: none;
            }

            body {
                background: white;
            }
        }

        .ccik:hover {
            cursor: pointer;
            color: blue;
            font-weight: bold;
        }
    </style>

    <div class="nonprint">
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark ">
            <a class="navbar-brand" href="../index.php">Report</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="#">หน้ารายการคำขอ <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="index.php">เพิ่มผู้ใช้งานHosxp</a>
                    <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </div>
            </div>
        </nav>
    </div>

    <!--  /////////////////// เชื่อมต่อ และquery จำนวนหน้าและและช่องแถบค้นหา GET METHOD FROM ค้นหา//////////////////     -->
    <?php
    include('../config/my_con.class.php');
    include('../config/pg_con.class.php');
    $perpage = 10;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    //query เอาเลขหน้า
    $start = ($page - 1) * $perpage;
    $sql = "select * from frm_res_require_login_hosxp  ORDER BY id desc limit {$start} , {$perpage} ";
    $query = mysqli_query($con, $sql);

    $allrec = "SELECT * FROM frm_res_require_login_hosxp ORDER BY id desc";
    $queryalrecord = mysqli_query($con, $allrec);

    ///////////////////////////////////// เมื่อกดรับงาน ส่ง POST เข้ามาทำงาน //////////////////////////////// 
    if (isset($_POST['closejob'])) { //หากกดยืนยันรับงาน 
        //echo $_POST['admin_name'].$_POST['status_fix'].$_POST["repair_report_id"].$_SESSION['cid']; 
        mysqli_set_charset($con, "utf8");



        echo $addadminjob = "UPDATE `frm_res_require_login_hosxp` SET 
        `status` = 'done', 
        `enddate_time` = '" . $_POST['enddate_time'] . "',
        `it_getrequest` = '" . $_POST["txtassisadmin"] . "'  WHERE id = '" . $_POST["idform"] . "'";

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
            $message = 'ดำเนินการเพิ่ม user hosxp ' . "\r\n" .
                'วันที่ขอเพิ่ม :' . $_POST['begindate'] . "\r\n" .
                'ชื่อ :' . $_POST["userregis"] . "\r\n" .
                'สถานะ : ดำเนินการแล้ว ' . "  " .  $_POST["txtassisadmin"] . "\r\nเวลา: " .  $_POST["enddate_time"];
            $token = 'd5zh3iN8q18hw1cTYxIJc2eS4OlZBOCMq6VOySo2u3z';
            send_line_notify($message, $token);
            echo "<script>alert('บันทึกสำเร็จ');window.location = 'checkreg_hosxp.php'</script>";
        } else {
            echo "connect fail";
        }
        mysqli_close($con);
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
                        or status LIKE '%" . $_GET["txtKeyword"] . "%' )  ORDER BY id desc";
        } else {
            $sql = "select * from frm_res_require_login_hosxp  ORDER BY id desc limit {$start} , {$perpage} ";
        }
        $query = mysqli_query($con, $sql);
    }
    ?>


    <!--  //////////////////////////////////////////// ค้นหา/////////////////////////////////////////////////////////     -->
    <div class="nonprint">
        <form name="frmSearch" method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <!-- $_SERVER['SCRIPT_NAME']; คือการดึงชื่อเอกสารมา เมื่อกด form นี้ให้เกิดaction โหลดหน้าเดิม-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 mt-2">
                        <center>
                            <h1 style="margin-top:15px">รายการขอเพิ่ม user hosxp</h1>
                        </center>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-bordered mt-3">
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
            <hr>
        </form>
    </div>
    <!--  //////////////////////////////////////////////////////////////////////////////////////////////////////////////    -->


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="nonprint">
                    <?php echo  '<p>จำนวนทั้งหมด : ' . $totaldata = mysqli_num_rows($queryalrecord) . ' รายการ</p>'; ?>
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
                                <? if ($_SESSION['status'] == '1') { ?>
                                    <th style="text-align:center;">ตรวจสอบ</th>
                                <? } ?>
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
                                    <td class="<?php if (($result['status'] == 'waiting')) {
                                                    echo 'fontstatusa';
                                                } else echo 'fontstatusb'; ?>" style="text-align:center;"><?php echo $result['status']; ?> </td>
                                    <td style="text-align:center;"><?php echo $result['insertdate_time']; ?> </td>
                                    <td style="text-align:center;"><?php echo $result['enddate_time']; ?> </td>
                                    <? if ($_SESSION['status'] == '1') { ?>
                                        <td>
                                            <center><button class="btn btn-info" data-toggle="modal" data-target="#closejob<?php echo $result['id']; ?>">เพิ่มเติม</button> </center>
                                        </td>
                                    <? } ?>
                                </tr>
                                <script>
                                    // eaktamp
                                    function myFunction() {
                                        var copyText = document.getElementById("myInput");
                                        copyText.select();
                                        copyText.setSelectionRange(0, 99999)
                                        document.execCommand("copy");
                                        // alert("Copied the text: " + copyText.value);
                                    }
                                </script>
                            <?php } ?>
                        <tbody>
                    </table>
                </div>
            </div>
        </div>



        <? foreach ($query as $item) { ?>
            <!--///////////////////////////////////////////// Modal close job  ///////////////////////////////////////////////////////-->
            <div class="modal fade" id="closejob<?php echo  $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="nonprint">
                            <div class="modal-header">
                                <h4 class="modal-title">ตรวจสอบดำเนินการ</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="print">
                                <h4 style="background-color: #878787;color:black;padding:10px;border-style: dotted;border-width: 0.5px;">ใบแจ้งที่: <?php echo $item['id']; ?></h4>
                                <p>วันที่แจ้ง : <?php echo $begin = $item['insertdate_time']; ?>&nbsp;&nbsp;&nbsp; วันที่เริ่มงาน : <?php echo $item['first_day_in_job']; ?></p>

                                <p>ชื่อ-นามสกุล :<?php echo $userregis =  $item['pname'] . $item['fname'] . '    ' . $item['lname']; ?>&nbsp;&nbsp;&nbsp;เพศ : <?php echo $item['gender']; ?></p>
                                <p>ชื่อภาษาอังกฤษ : <?php echo $item['engfullname']; ?></p>
                                <p>Cid : <input class="ccik" type="text" value="<?php echo $item['cid']; ?>" id="myInput" onclick="myFunction()" title="ดับเบิ้ลคลิก = copy"> </p>
                                <p>ปีเกิด : <?php echo $item['birthday']; ?> </p>
                                <p>เลขที่ใบประกอบวิชาชีพ : <?php echo $item['doctor_cert']; ?> </p>
                                <p>วันที่ได้รับอนุญาต : <?php echo $item['accepcert']; ?> </p>
                                <p>วันที่หมดอายุรับอนุญาต : <?php echo $item['expirecert']; ?> </p>
                                <p>ตำแหน่งหลัก : <?php echo $item['jobclass']; ?> </p>
                                <p>แผนก : <?php echo $item['spclty']; ?> </p>
                                <p>เฉพาะทาง : <?php echo $item['speciality']; ?> </p>
                                <p>Providertype : <?php echo $item['providertype']; ?> </p>
                                <p>e-mail : <?php echo $item['emailaddress']; ?> &nbsp;&nbsp;&nbsp;โทรศัพท์ : <?php echo $item['mobilenumber']; ?> </p>
                                <p>user : <?php echo $item['username']; ?>&nbsp;&nbsp;&nbsp; password : <?php echo $item['password']; ?></p>
                                <p>หมายเหตุ : <?php echo $item['note']; ?> </p>
                                <p>เบอร์ภายใน : <?php echo $item['phone_internal']; ?></p>
                                <?php if ($item['it_getrequest'] != null) { ?>
                                    <p>ผู้ดำเนินการ : <?php echo $item['it_getrequest']; ?> </p>
                                <? } else { ?>
                                    <?php
                                    $SQLc = "";
                                    $SQLv = "";
                                    if ($item['first_day_in_job'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "start_date";
                                        } else {
                                            $SQLc += "start_date";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['first_day_in_job'];
                                        } else {
                                            $SQLv += $item['first_day_in_job'];
                                        }
                                    }
                                    if ($item['sex'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "sex";
                                        } else {
                                            $SQLc += "sex";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['gender'] = "ชาย" ? "1" : "2";
                                        } else {
                                            $SQLv += $item['gender'] = "ชาย " ? "1" : "2";
                                        }
                                    }
                                    if ($item['pname'] != null || $item['fname'] != null || $item['lname'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "name";
                                        } else {
                                            $SQLc += "name";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['pname'] . $item['fname'] . ' ' . $item['lname'];
                                        } else {
                                            $SQLv += $item['pname'] . $item['fname'] . ' ' . $item['lname'];
                                        }
                                    }
                                    if ($item['pname'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "pname";
                                        } else {
                                            $SQLc += "pname";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['pname'];
                                        } else {
                                            $SQLv += $item['pname'];
                                        }
                                    }
                                    if ($item['fname'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "fname";
                                        } else {
                                            $SQLc += "fname";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['fname'];
                                        } else {
                                            $SQLv += $item['fname'];
                                        }
                                    }
                                    if ($item['lname'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "lname";
                                        } else {
                                            $SQLc += "lname";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['lname'];
                                        } else {
                                            $SQLv += $item['lname'];
                                        }
                                    }
                                    if ($item['engfullname'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "ename";
                                        } else {
                                            $SQLc += "ename";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['engfullname'];
                                        } else {
                                            $SQLv += $item['engfullname'];
                                        }
                                    }
                                    if ($item['cid'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "cid";
                                        } else {
                                            $SQLc += "cid";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['cid'];
                                        } else {
                                            $SQLv += $item['cid'];
                                        }
                                    }
                                    if ($item['birthday'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "birth_date";
                                        } else {
                                            $SQLc += "birth_date";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['birthday'];
                                        } else {
                                            $SQLv += $item['birthday'];
                                        }
                                    }
                                    if ($item['doctor_cert'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "shortname" . "," . "licenseno";
                                        } else {
                                            $SQLc += "shortname" . "," . "licenseno";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['doctor_cert'] . "," . $item['doctor_cert'];
                                        } else {
                                            $SQLv += $item['doctor_cert'] . "," . $item['doctor_cert'];
                                        }
                                    }
                                    if ($item['accepcert'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "license_issue_date";
                                        } else {
                                            $SQLc += "license_issue_date";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['accepcert'];
                                        } else {
                                            $SQLv += $item['accepcert'];
                                        }
                                    }
                                    if ($item['expirecert'] != null) {
                                        if ($SQLc != "") {
                                            $SQLc += "," . "license_expire_date";
                                        } else {
                                            $SQLc += "license_expire_date";
                                        }
                                        if ($SQLv != "") {
                                            $SQLv += "," . $item['expirecert'];
                                        } else {
                                            $SQLv += $item['expirecert'];
                                        }
                                    }

                                    $doctorposition = " SELECT * FROM frm_res_doctorposition ORDER BY position_name";
                                    $doctorpositions = mysqli_query($con, $doctorposition);
                                    $spclty = " SELECT * FROM frm_res_spclty order by frm_res_id";
                                    $spcltys = mysqli_query($con, $spclty);
                                    $doctor_department = " SELECT * FROM doctor_department ";
                                    $doctor_departments = pg_query($conn, $doctor_department);
                                    $providertype = " SELECT * FROM provider_type";
                                    $providertypes = pg_query($conn, $providertype);

                                    if ($item['jobclass'] != null) {
                                        while ($Result = mysqli_fetch_assoc($doctorpositions)) {
                                            if ($Result['position_name'] == $item['jobclass']) {
                                                if ($SQLc != "") {
                                                    $SQLc += "," . "position_id";
                                                } else {
                                                    $SQLc += "position_id";
                                                }
                                                if ($SQLv != "") {
                                                    $SQLv += "," . $Result['id'];
                                                } else {
                                                    $SQLv += $Result['id'];
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    if ($item['spclty'] != null) {
                                        while ($Result = mysqli_fetch_assoc($spcltys)) {
                                            if ($Result['frm_res_spclty'] == $item['spclty']) {
                                                if ($SQLc != "") {
                                                    $SQLc += "," . "spclty";
                                                } else {
                                                    $SQLc += "spclty";
                                                }
                                                if ($SQLv != "") {
                                                    $SQLv += "," . $Result['frm_res_id'];
                                                } else {
                                                    $SQLv += $Result['frm_res_id'];
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    if ($item['speciality'] != null) {
                                        while ($Result = pg_fetch_assoc($doctor_departments)) {
                                            if ($Result['doctor_department_name'] == $item['speciality']) {
                                                if ($SQLc != "") {
                                                    $SQLc += "," . "doctor_department_id";
                                                } else {
                                                    $SQLc += "doctor_department_id";
                                                }
                                                if ($SQLv != "") {
                                                    $SQLv += "," . $Result['doctor_department_id'];
                                                } else {
                                                    $SQLv += $Result['doctor_department_id'];
                                                }
                                                break;
                                            }
                                        }
                                    }
                                    if ($item['providertype'] != null) {
                                        while ($Result = pg_fetch_assoc($doctor_departments)) {
                                            if ($Result['provider_type_name'] == $item['providertype']) {
                                                if ($SQLc != "") {
                                                    $SQLc += "," . "provider_type_code";
                                                } else {
                                                    $SQLc += "provider_type_code";
                                                }
                                                if ($SQLv != "") {
                                                    $SQLv += "," . $Result['provider_type_code'];
                                                } else {
                                                    $SQLv += $Result['provider_type_code'];
                                                }
                                                break;
                                            }
                                        }
                                    }


                                    while ($Result = pg_fetch_assoc($providertypes)) {
                                        $Result['position_name'];
                                    }
                                    if ($SQLc != "") {
                                        $SQLc += "," . "active";
                                    } else {
                                        $SQLc += "active";
                                    }
                                    if ($SQLv != "") {
                                        $SQLv += "," . "Y";
                                    } else {
                                        $SQLv += "Y";
                                    }
                                    $SQL = "INSERT INTO doctor (" . $SQLc . ") VALUES (" . $SQLv . ");"
                                    ?>

                                    <p>SQL : <?php echo $SQL; ?></p>
                                <? } ?>

                            </div>
                            <?php if ($item['it_getrequest'] == null) { ?>
                                <div class="nonprint">
                                    <hr>
                                    <h4 class="modal-title">ข้อมูลเพิ่มเติม</h4>
                                    <form action="#" method="POST" name='colsejob'>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="assis1">ผู้ดำเนินการ</label>
                                                <select id="inputState" name="txtassisadmin" class="form-control" required>
                                                    <option selected value="">...</option>
                                                    <option value="จิรกร">จิรกร</option>
                                                    <option value="AdminEaktamp">Admin eaktamp</option>
                                                    <option value="AdminFirst">AdminFirst</option>
                                                    <option value="รัชวิทย์">รัชวิทย์</option>
                                                    <option value="ชานิศักดิ์">ชานิศักดิ์</option>
                                                    <option value="ปฐมพงศ์">ปฐมพงศ์</option>
                                                    <option value="ปิยดา">ปิยดา</option>
                                                    <option value="เพ็ญจันทร์">เพ็ญจันทร์</option>
                                                    <option value="อดิศักดิ์">อดิศักดิ์</option>
                                                    <option value="วิภาวดี">วิภาวดี</option>
                                                    <option value="มีข้อมูลในระบบแล้ว">มีข้อมูลในระบบแล้ว</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            <? } ?>
                        </div>

                        <div class="nonprint">
                            <div class="modal-footer">
                                <?php
                                date_default_timezone_set("Asia/Bangkok"); //ตั้งโซนเวลา
                                $month = date('m');
                                $day = date('d');
                                $year = (date('Y') + 543);
                                $TIME = date("H:i:s");   //date("h:i:s a"); แบบมีpm am
                                $today =  $day . '/' . $month . '/' . $year  .  '  ' . $TIME;
                                ?>
                                <input type="hidden" name="status" value="done">
                                <input type="hidden" name="userregis" value="<? echo $userregis; ?>">
                                <input type="hidden" name="idform" value="<? echo $item['id']; ?>">
                                <input type="hidden" name="enddate_time" value="<?php echo $today ?>">
                                <input type="hidden" name="begindate" value="<?php echo $begin ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                <?php if ($item['it_getrequest'] != null) { ?><input type="button" class="btn btn-success" value="Print" target="_blank" onclick="window.print()"><? } ?>
                                <input type="submit" name="closejob" class="btn btn-primary" <?php if ($item['it_getrequest'] != null) {
                                                                                                    echo 'value="ดำเนินการแล้ว"' . 'disabled';
                                                                                                } else echo 'value="บันทึก"' ?>>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

        <? } ?>



        <!--  /////////////////// ส่วนของ paginatorทำ query มาใหม่และนับจำนวนแถว //////////////////     -->
        <?php
        $sql2 = "select * from frm_res_require_login_hosxp order by id desc";
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

        <div class="nonprint">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="checkreg_hosxp.php?page=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span></a>
                    <li class="page-item">
                        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="checkreg_hosxp.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="checkreg_hosxp.php?page=<?php echo $total_page; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span></a>
                </li>
                </ul>
            </nav>
        </div>
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