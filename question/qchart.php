<?php
date_default_timezone_set("Asia/Bangkok");
$ipaddress = $_SERVER['REMOTE_ADDR'];
$datelog = date('Y-m-d H:i:s');
date_default_timezone_set("Asia/Bangkok");
include "config/my_con.class.php";

$query = " SELECT count(*) as qsum  FROM question_detail ";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$qsum =  $row['qsum'];



$inx_sql_a = " SELECT b.quest_name ,count(b.quest_name) as qsum  
FROM question_index as a
INNER JOIN question_quest as b ON b.main_quest = a.main_quest
AND a.main_quest = 'a'
GROUP BY b.quest_name ";
$res_a = mysqli_query($con, $inx_sql_a);
$row_a = mysqli_fetch_array($res_a);
$qsum_a =  $row_a['qsum'];

$inx_sql_b = " SELECT b.quest_name ,count(b.quest_name) as qsum  
FROM question_index as a
INNER JOIN question_quest as b ON b.main_quest = a.main_quest
AND a.main_quest = 'b'
GROUP BY b.quest_name ";
$res_b = mysqli_query($con, $inx_sql_b);
$row_b = mysqli_fetch_array($res_b);
$qsum_b =  $row_b['qsum'];

$qorther = " SELECT  other  FROM question_detail WHERE other <> ' ' ORDER BY id DESC ";
$sult = mysqli_query($con, $qorther);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="60;"url="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปความพึงพอใจสารสนเทศ</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="css/qcss.css">
    <title>Question</title>
    <script src="js/jquery.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <script type="text/javascript">
        CanvasJS.addColorSet("col1",
            [
                "#E3003E",
                "#062C75",
                "#D90B0B",
                "#40AE20",
                "#CEA716"
            ]);

        CanvasJS.addColorSet("mf",
            [
                "#240C9C",
                "#E3003E",
                "#2980B9",
                "#DE3A02",
                "#2ECC71"
            ]);

        CanvasJS.addColorSet("c1",
            [
                "#062C75",
                "#D90B0B",
                "#40AE20",
                "#CEA716"
            ]);
        CanvasJS.addColorSet("c2",
            [
                "#F39C12",
                "#2980B9",
                "#2ECC71",
                "#A569BD"
            ]);
        CanvasJS.addColorSet("c3",
            [
                "#C311C6",
                "#5E75DF",
                "#CED70E",
                "#71C45D"
            ]);
        CanvasJS.addColorSet("c4",
            [
                "#7F049C",
                "#D90B0B",
                "#40AE20",
                "#CEA716"
            ]);

        $(document).ready(function() {
            $.getJSON("qdata/qsex.php", function(sex) {
                var chart = new CanvasJS.Chart("sex", {
                    colorSet: "mf",
                    theme: "light2", // "light1", "dark1", "dark2"
                    culture: "es",
                    title: {
                        fontSize: 20,
                        text: "จำนวนการตอบแบบสอบแยกตามเพศ"

                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: "",
                    },
                    data: [{
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} ({y})",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "pie",
                        dataPoints: sex
                    }]
                });
                chart.render();
            });
        });
        $(document).ready(function() {
            $.getJSON("qdata/qage.php", function(age) {
                var chart = new CanvasJS.Chart("age", {
                    colorSet: "col1",
                    theme: "light2", // "light1", "dark1", "dark2"
                    title: {
                        fontSize: 18,
                        text: "จำนวนการตอบแบบสอบแยกตามช่วงอายุ"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} ({y})",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "doughnut",
                        dataPoints: age
                    }]
                });
                chart.render();
            });
        });
        $(document).ready(function() {
            $.getJSON("qdata/quser.php", function(quser) {
                var chart = new CanvasJS.Chart("quser", {
                    colorSet: "mf",
                    theme: "light2", // "light1", "dark1", "dark2"
                    title: {
                        fontSize: 18,
                        text: "จำนวนการตอบแบบสอบแยกตามประเภทบุคลากร"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: ""
                    },
                    data: [{
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} ({y})",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "doughnut",
                        dataPoints: quser
                    }]
                });
                chart.render();
            });
        });


        $(document).ready(function() {
            $.getJSON("qdata/q1.php", function(q1) {
                var chart = new CanvasJS.Chart("q1", {
                    theme: "light2", // "light1", "dark1", "dark2"
                    colorSet: "c1",
                    title: {
                        fontSize: 15,
                        text: "ความสะดวกรวดเร็วในการเข้าถึงระบบสารสนเทศ"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: "",
                        labelFontSize: 20,
                        labelFontColor: "dimGrey"
                    },
                    axisX: {
                        labelAngle: -30,

                    },
                    data: [{
                        indexLabelFontSize: 25,
                        indexLabelFontFamily: "Lucida Console",
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        legendText: "{label}",
                        indexLabelFontSize: 12,
                        indexLabel: "{y}",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "column",
                        dataPoints: q1
                    }]
                });
                chart.render();
            });
        });

        $(document).ready(function() {
            $.getJSON("qdata/q2.php", function(q2) {
                var chart = new CanvasJS.Chart("q2", {
                    theme: "light2", // "light1", "dark1", "dark2"
                    colorSet: "c2",
                    title: {
                        fontSize: 15,
                        text: "ข้อมูลเป็นปัจจุบันและถูกต้อง"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: "",
                        labelFontSize: 20,
                        labelFontColor: "dimGrey"
                    },
                    axisX: {
                        labelAngle: -30
                    },
                    data: [{
                        indexLabelFontSize: 25,
                        indexLabelFontFamily: "Lucida Console",
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        legendText: "{label}",
                        indexLabelFontSize: 12,
                        indexLabel: "{y}",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "column",
                        dataPoints: q2
                    }]
                });
                chart.render();
            });
        });
        $(document).ready(function() {
            $.getJSON("qdata/q3.php", function(q3) {
                var chart = new CanvasJS.Chart("q3", {
                    theme: "light2", // "light1", "dark1", "dark2"
                    colorSet: "c3",
                    title: {
                        fontSize: 15,
                        text: "การจัดหมวดหมู่ให้ง่ายต่อการค้นหา และทำความเข้าใจ"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: "",
                        labelFontSize: 20,
                        labelFontColor: "dimGrey"
                    },
                    axisX: {
                        labelAngle: -30
                    },
                    data: [{
                        indexLabelFontSize: 25,
                        indexLabelFontFamily: "Lucida Console",
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        legendText: "{label}",
                        indexLabelFontSize: 12,
                        indexLabel: "{y}",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "column",
                        dataPoints: q3
                    }]
                });
                chart.render();
            });
        });
        $(document).ready(function() {
            $.getJSON("qdata/q4.php", function(q4) {
                var chart = new CanvasJS.Chart("q4", {
                    theme: "light2", // "light1", "dark1", "dark2"
                    colorSet: "c4",
                    title: {
                        fontSize: 13,
                        text: "สามารถนำระบบสารสนเทศไปใช้ให้เกิดประโยชน์แก่หน่วยงาน"
                    },
                    toolTip: {
                        shared: true
                    },
                    axisY: {
                        title: "",
                        labelFontSize: 20,
                        labelFontColor: "dimGrey"
                    },
                    axisX: {
                        labelAngle: -30
                    },
                    data: [{
                        indexLabelFontSize: 25,
                        indexLabelFontFamily: "Lucida Console",
                        toolTipContent: "{label}<br/>{name} <strong>{y}</strong> ครั้ง ",
                        legendText: "{label}",
                        indexLabelFontSize: 12,
                        indexLabel: "{y}",
                        name: " ตอบแบบสอบถาม จำนวน ",
                        type: "column",
                        dataPoints: q4
                    }]
                });
                chart.render();
            });
        });
    </script>
</head>
</head>

<body>
    <header class="header-navigation" id="header">
        <nav>
            <span>ผลการสำรวจความพึงพอใจของผู้ใช้บริการระบบสารสนเทศ โรงพยาบาลเจ้าพระยาอภัยภูเบศร ประจำปีงบประมาณ 2563</span>
        </nav>
    </header>

    <br><br><br> <br><br>
    <div class="container-fluid ">
        <h1 class="detail-dd">จำนวนผู้ตอบแบบสอบถามความพึงพอใจทั้งหมด <?php echo "<span class='qsum'>" . $qsum . "</span> ครั้ง"; ?> &nbsp;&nbsp;
            <span class='qqq'> ผลสำรวจความพึงพอใจ ก่อนทำแบบสำรวจ </span> <img src="img/et.png" class="iimg" alt=""> <span class='ec'><?php echo $qsum_a; ?> </span> <span class='qqq'> ครั้ง พึงพอใจ </span>
            &nbsp;&nbsp; <img src="img/ef.png" class="iimg" alt=""> <span class='ef'> <?php echo $qsum_b; ?> </span> <span class='qqq'> ครั้ง ไม่พึงพอใจ</span>

        </h1>
        <hr>
        <div class="row">
            <div class="col-md-4 detail">
                <div id="sex" style="width: 550px; height: 320px;"></div>
            </div>
            <div class="col-md-4 detail">
                <div id="age" style="width: 550px; height: 320px;"></div>
            </div>
            <div class="col-md-4 detail">
                <div id="quser" style="width: 550px; height: 320px;"></div>
            </div>
        </div>
        <hr>
        <h1 class="detail-dd"> </h1>
        <div class="row">
            <div class="col-md-3 detail">
                <div id="q1" style="width: 400px; height: 220px;"></div>
            </div>
            <div class="col-md-3 detail">
                <div id="q2" style="width: 400px; height: 220px;"></div>
            </div>
            <div class="col-md-3 detail">
                <div id="q3" style="width: 400px; height: 220px;"></div>
            </div>
            <div class="col-md-3 detail">
                <div id="q4" style="width: 400px; height: 220px;"></div>
            </div>
        </div>

        <hr>

        <h1 class="detail-dd"> </h1>
        <div class="row">
            <div class="col-md-4 detail text-center">
                <!-- <div id="" > <button type=""  name="" class="btn btn-outline-info btn-block" ></button></div> -->
            </div>
            <div class="col-md-4 detail text-center">
                <div id=""> <button type="" name="" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#exampleModalCenter">ข้อเสนอแนะ</button></div>
            </div>
            <div class="col-md-4 detail text-center">
                <!-- <div id="" > <button type=""  name="" class="btn btn-outline-info btn-block" > </button></div> -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title hmod" id="exampleModalLongTitle ">ข้อเสนอแนะ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $rw = 0;
                        while ($qrow = mysqli_fetch_array($sult)) {
                            $rw++;
                            echo "<div class='mod'>" . $rw . " : " . $qrow['other'] . "<div><hr>";
                        }
                        ?>
                    </div>
                    <!-- <div class="modal-footer ">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                </div>
            </div>
        </div>


</body>

</html>