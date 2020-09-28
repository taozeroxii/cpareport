<!DOCTYPE html>
<html>
<?php
session_start();
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/head.class.php";
include('config/my_con.class.php');
date_default_timezone_set("Asia/Bangkok");
$bm = new Timer;
$bm->start();
for ($i = 0; $i < 100000; $i++) {
    $i;
}
$sql        =  $_GET['sql']; // get ค่าตามsql ที่ต้องการมา
$send_excel =  $_GET['sql']; // get ค่าตามsql ที่ต้องการมาเพื่อเอาไว้ส่งออก excel

$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '" . $sql . "'"; // รับค่าsql มาแล้วเช็คค่าในตารางว่าตรงกับ idไหน แล้วให้เรียกค่าsqlที่เก็บไว้มาใช้ตอนแสดงผลกราฟและตาราง
$res = mysqli_query($con, $topLevelItems);
foreach ($res as $item) {
    $sql_detail = $item['sql_code'];
    $sql_head   = $item['sql_head'];
}

$b = date(("Y/m/d"), strtotime("first day of last month")); //ดึงค่าวันที่วันแรกของเดือนที่แล้ว
$e = date(("Y/m/d"), strtotime("last day of last month")); //ดึงค่าวันที่วันสุดท้ายของเดือนที่แล้วเพื่อเอาไปกำหนดในคำสั่งที่เรียกาจากในฐานว่าข้อมููลช่วงไหนโดยอัตโนมัตื

//เมื่อเข้ามาตอนแรกให้ทำอันนี้เอาไปแสดงผลก่อน
if (isset($_POST['summit']) == null) {
    $query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
    where ov.vstdate between '" . $b . "' and '" . $b  . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
    $showsql = $query;
    $result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
    $result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
    while ($row = pg_fetch_assoc($result)) {
        $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
    }
    for ($i = 0; $i <= 10; $i++) {
        $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
    }
    $message = 'ข้อมูลย้อนหลัง 1 เดือน ช่วงวันที่ระหว่าง :' . $b . ' ถึง ' . $e;
}

//เริ้มการทำงานเมื่อกดปุ่มส่งค่าจากฟอร์มในการสั่งทำ query
if (($_POST['summit']) == '1') {
    $b = date(("Y/m/d"), strtotime("first day of last year"));
    $e = date(("Y/12/31"), strtotime("last year"));
    $query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
    where ov.vstdate between '" . $b . "' and '" . $e . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
    $showsql = $query;
    $result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
    $result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
    while ($row = pg_fetch_assoc($result)) {
        $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
    }
    for ($i = 0; $i <= 10; $i++) {
        $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
    }
    $message = 'ข้อมูลย้อนหลัง 1 ปี ช่วงวันที่ระหว่าง :' . $b . ' ถึง ' . $e;
}
if (($_POST['summit']) == '2') {
    $query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
    where ov.vstdate between '" . $b . "' and '" . $e . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
    $showsql = $query;
    $result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
    $result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
    while ($row = pg_fetch_assoc($result)) {
        $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
    }
    for ($i = 0; $i <= 10; $i++) {
        $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
    }
    $message = 'ข้อมูลย้อนหลัง 1 เดือน ช่วงวันที่ระหว่าง :' . $b . ' ถึง ' . $e;
}
if (($_POST['summit']) == '3') {
    $b = date("Y/m/d");
    $query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
    where ov.vstdate between '" . $b . "' and '" . $b  . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
    $showsql = $query;
    $result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
    $result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
    while ($row = pg_fetch_assoc($result)) {
        $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
    }
    for ($i = 0; $i <= 10; $i++) {
        $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
    }
    $message = 'ข้อมูลวันที่ปัจจุบัน :' . $b;
}
if (($_POST['summit']) == 'submit') {
    //$_POST['begindate']; $_POST['enddate'];
    $query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
    where ov.vstdate between '" . $_POST['begindate'] . "' and '" . $_POST['enddate'] . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
    $showsql = $query;
    $result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
    $result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
    while ($row = pg_fetch_assoc($result)) {
        $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
    }
    for ($i = 0; $i <= 10; $i++) {
        $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
    }
    $message = 'ข้อมูลวันที่:' . $_POST['begindate'] . ' ถึง ' . $_POST['enddate'];;
}
?>

<head>
    <meta charset="UTF-8">
    <script>
        var tpc = ''; // ค่าเริ่มต้นตอนยังไม่กดปุ่ม
        //เรียกใช้ฟังก์ชันเมื่อกดปุ่มให้ค่าเปลี่ยน
        function myFunction0() {
            tpc = 'column';
            console.log(tpc); //ทดสอบแสดงผลหากกดปุ่มว่าค่ามาหรือไม่
            clickok();
        }

        function myFunction1() {
            tpc = 'pie';
            console.log(tpc); //ทดสอบแสดงผลหากกดปุ่มว่าค่ามาหรือไม่
            clickok();
        }

        function myFunction2() {
            tpc = 'line';
            console.log(tpc);
            clickok();
        }

        function myFunction3() {
            tpc = 'area';
            console.log(tpc);
            clickok();
        }

        function myFunction4() {
            tpc = 'bar';
            console.log(tpc);
            clickok();
        }

        // กราฟเริ่มต้นเมื่อโหลดหน้าจอ
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "ผู้มารับบริการ จำแนกตามสิทธิ์"
                },
                data: [{
                    type: 'column', //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: [<?= $sm; ?>]
                }]
            });
            chart.render();
        }
        //หลังจากกดปุ่มให้เรียกใช้ function นี้โดยค่าจะอิงตามปุ่มที่กดใน functionmyfunction 1-4 
        function clickok() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "ผู้มารับบริการ จำแนกตามสิทธิ์ "
                },
                data: [{
                    type: tpc, //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: [<?= $sm; ?>]

                }]
            });
            chart.render();
        }
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <?php // include "config/menuleft.class.php"; 
    ?>

    <section class="content">
        <div class="row col-lg-12 col-12" style="background-color:white;">
            <button onclick="myFunction0()">Column chart</button>
            <button onclick="myFunction1()">Pie chart</button>
            <button onclick="myFunction2()">Line chart</button>
            <button onclick="myFunction3()">area chart</button>
            <button onclick="myFunction4()">bar chart</button>
            <form action="#" method="POST" style="display:inline">
                <button onclick="btnday()" name="summit" value="3">รายวัน</button>
                <button onclick="btnmonth()" name="summit" value="2">รายเดือน</button>
                <button onclick="btnyear()" name="summit" value="1">รายปี</button>
                <input type="date" name="begindate">
                <input type="date" name="enddate">
                <button onclick="btnyear()" name="summit" value="submit" class="btn btn-primary">เลือก</button>
            </form>
            <small style="color:red;"><?= $message; ?></small> <!-- แดสงผลข้อมูลตามช่วงที่กดแสดงข้อมูล -->
            <div id="chartContainer" style="height: 370px; width: 100%;"> </div> <!-- div id เพื่อแสดงผลกราฟบนหน้าจอ-->
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>


        <!--------------------------------------------------  table -------------------------------------------------------->
        <div class="row col-lg-12 col-12" style="margin-top:3em;padding-top:3em;background-color:white;">
            <button class="btn btn-warning" style="float:right" data-toggle="modal" data-target="#Modalshowsql">SQL</button>
            <button class="btn btn-danger" style="float:right" onclick="export_excel()">export</button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <?php
                        $i = pg_num_fields($result);
                        for ($j = 0; $j < $i; $j++) {
                            $fieldname = pg_field_name($result, $j);
                            echo '<th>' . $fieldname . '</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $rw = 0;
                    while ($row_result = pg_fetch_array($result1)) {
                        $rw++;
                    ?>
                        <tr>
                            <?php
                            for ($j = 0; $j < $i; $j++) {
                                $fieldname = pg_field_name($result1, $j);
                                echo '<td>' . $row_result[$fieldname] . '</td>';
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modalshowsql" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="exampleModalLabel">SQL</h5>

                </div>
                <div class="modal-body">
                    <center><textarea value="<?= $showsql ?>" rows="25" cols="55" id="copysql"> <?= $showsql ?></textarea></center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="functionCopysql()">Copy Sql</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>



        <?php //include "config/footer.class.php"; 
        ?>
        <?php include "config/js.class.php" ?>

        <script>
            $(function() {
                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })

            function functionCopysql() {
                var copyText = document.getElementById("copysql");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                //alert("Copied the text: " + copyText.value);
            }
        </script>
        <script type="text/javascript">
            function export_excel() {
                document.location = "export_excel_f001.php?send_excel=<?php echo $send_excel; ?>&datepickers=<?php echo $datepickers; ?>&datepickert=<?php echo $datepickert; ?>";
            }
        </script>
</body>

</html>