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
$query = "SELECT pt.pttype,pt.name,count(*)as cc FROM ovst ov inner join pttype pt on pt.pttype = ov.pttype 
where ov.vstdate between '" . $b . "' and '" . $e . "' group by pt.name,pt.pttype  order by  cc desc limit 10";
$result = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลกราฟ
$result1 = pg_query($query); //test คำสั่ง sql เพื่อแสดงผลตาราง
while ($row = pg_fetch_assoc($result)) {
    $title[] = '{indexLabel:"' . $row['name'] . '",y:' . $row['cc'] . ',label:"รหัส : ' . $row['pttype'] . '"},'; //วนเก็บค่าที่เป็นสถิติเป็น array แต่ละ
}
for ($i = 0; $i <= 10; $i++) {
    $sm =  $sm . $title[$i]; //นำค่า array title ที่เก็บไว้เอามาต่อกันและนำไปใช้งานใน function สร้างกราฟ
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

        function btnday() {
            var d = new Date();//สร้างตัวแปรเพื่อเรียกใช้ constructor function ของ js
            var text = 'ข้อมูลวันที่ ';
            var datenow =  d.getDate()+'/'+(d.getMonth()+`1`)+'/'+d.getFullYear();
            text += datenow;
            console.log(datenow);
            document.getElementById("dmy").innerHTML = text;
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

    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row col-lg-12 col-12" style="background-color:white;">
                    <button onclick="myFunction0()">Column chart</button>
                    <button onclick="myFunction1()">Pie chart</button>
                    <button onclick="myFunction2()">Line chart</button>
                    <button onclick="myFunction3()">area chart</button>
                    <button onclick="myFunction4()">bar chart</button>
                    <button onclick="btnyear()">รายปี</button>
                    <button onclick="btnmonth()">รายเดือน</button>
                    <button onclick="btnday()">รายวัน</button>
                    <small style="color:red;" id='dmy'>ข้อมูลย้อนหลัง 1 เดือน ตั้งแต่วันที่แรกถึงวันสุดท้ายของเดือนก่อนหน้า </small> <!-- แดสงผลข้อมูลตามช่วงที่กดแสดงข้อมูล -->
                <div id="chartContainer" style="height: 370px; width: 100%;"> </div> <!-- div id เพื่อแสดงผลกราฟบนหน้าจอ-->
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            </div>


            <!--------------------------------------------------  table -------------------------------------------------------->
            <div class="row col-lg-12 col-12" style="margin-top:3em;padding-top:3em;background-color:white;">
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
                        <? $rw = 0;
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

    <?php include "config/footer.class.php"; ?>
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
    </script>
</body>

</html>