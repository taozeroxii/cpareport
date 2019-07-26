<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";

if ($_POST['submit'] != "") {


    $datepickers    = $_POST['datepickers'];
    list($m, $d, $Y)  = split('/', $datepickers);
    $datepickers    = trim($Y) . "-" . trim($m) . "-" . trim($d);

    $datepickert    = $_POST['datepickert'];
    list($m, $d, $Y)  = split('/', $datepickert);
    $datepickert    = trim($Y) . "-" . trim($m) . "-" . trim($d);


    $sql = "SELECT  er.name,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '1' then 1 else 0 end ) as day_1 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '2' then 1 else 0 end ) as day_2 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '3' then 1 else 0 end ) as day_3 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '4' then 1 else 0 end ) as day_4 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '5' then 1 else 0 end ) as day_5 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '6' then 1 else 0 end ) as day_6 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '7' then 1 else 0 end ) as day_7 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '8' then 1 else 0 end ) as day_8 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '9' then 1 else 0 end ) as day_9 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '10' then 1 else 0 end ) as day_10 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '11' then 1 else 0 end ) as day_11 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '12' then 1 else 0 end ) as day_12 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '13' then 1 else 0 end ) as day_13 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '14' then 1 else 0 end ) as day_14 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '15' then 1 else 0 end ) as day_15 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '16' then 1 else 0 end ) as day_16 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '17' then 1 else 0 end ) as day_17 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '18' then 1 else 0 end ) as day_18 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '19' then 1 else 0 end ) as day_19 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '20' then 1 else 0 end ) as day_20 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '21' then 1 else 0 end ) as day_21 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '22' then 1 else 0 end ) as day_22 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '23' then 1 else 0 end ) as day_23 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '24' then 1 else 0 end ) as day_24 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '25' then 1 else 0 end ) as day_25 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '26' then 1 else 0 end ) as day_26 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '27' then 1 else 0 end ) as day_27 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '28' then 1 else 0 end ) as day_28 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '29' then 1 else 0 end ) as day_29 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '30' then 1 else 0 end ) as day_30 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) = '31' then 1 else 0 end ) as day_31 ,
        sum(case when EXTRACT(day from dc.begin_date_time::date ) BETWEEN '1' AND '31' then 1 else 0 end ) as Sum


        FROM doctor_operation dc
        inner join er_oper_code er on dc.er_oper_code = er.er_oper_code
        where  date(dc.begin_date_time) between '" . $_POST['datepickers'] . "' AND  '" . $_POST['datepickert'] . "'
        group by er.name
        ORDER BY sum desc";

    $result = pg_query($sql);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>PostgreSQL PHP Querying Data Demo</title>
    <? include('config/head.class.php') ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>r</b>CPA</span>
                <span class="logo-lg"><b>Re</b>port Hospital</span>
            </a>
            <nav class="navbar d-flex justify-content-start"">
                    <a href=" #" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </a>
            </nav>
        </header>

        <?php include "config/menuleft.class.php"; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="row-12">
                    <h3> ยอดหัตถการผู้ป่วยนอกที่มีการทำรายการทั้งหมดในแต่ละวัน <?php if ($_POST['submit'] != "") { echo 'วันที่ ' . thaiDate($datepickers) . ' ถึง '; } ?> <?php if ($_POST['submit'] != "") { echo thaiDate($datepickert);  } ?> </h3>
                </div>
                <hr>
            </section>

            <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">
                                    <div class="container">
                                        <form class="form-inline" method="POST" action="query.php">
                                            <input type="text" class="form-control" id="datepickers" placeholder="วันที่เริ่ม" name="datepickers" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                            <input type="text" class="form-control" id="datepickert" placeholder="วันที่สิ้นสุด" name="datepickert" data-provide="datepicker" data-date-language="th" autocomplete="off">
                                            <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
                                        </form>

                                    </div>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ชื่อหัตถการ</th>
                                    <?php for ($days = 1; $days <= 31; $days++) { ?>
                                        <th><?php echo $days; ?></th>
                                    <?php } ?>
                                    <th>รวม</th>
                                </tr>
                            </thead>
                            <?php if ($_POST['submit'] != "") { ?>
                                <tbody>
                                    <?php while ($row_result = pg_fetch_array($result)) { ?>
                                        <tr>
                                            <td><?php echo  $row_result['name']; ?></td>
                                            <?php for ($dd = 1; $dd <= 31; $dd++) { ?>
                                                <td><?php echo  $row_result['day_' . $dd]; ?></td>
                                            <?php } ?>

                                            <td><?php echo  $row_result['sum']; ?></td>
                                        </tr>
                                    <?php  }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php include "config/js.class.php" ?>
</body>

</html>