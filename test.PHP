<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add query</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <?php
    include "config/pg_con.class.php";
    include "config/func.class.php";
    include "config/head.class.php";
    include('config/my_con.class.php');
    ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <?php
    date_default_timezone_set("Asia/Bangkok"); //ตั้งโซนเวลา
    $month = date('m');
    $day = date('d');
    $year = (date('Y'));
    $TIME = date("H:i:s");   //date("h:i:s a"); แบบมีpm am
    $today = $year . '-' . $month . '-' . $day . '  ' . $TIME;

    $sql = " SELECT * FROM cpareport_mainmenu WHERE main_status = '1' AND main_type != '16' ORDER BY main_order ASC ";
    $querymenu = mysqli_query($con,$sql);

    $sql2 = " SELECT * FROM cpareport_report WHERE report_status = '1'  ORDER BY report_id ASC  ";
    $queryform = mysqli_query($con,$sql2);
    ?>




    <?php if (isset($_POST['submit'])) {
      /*  echo $_POST['id'] . '<br> ';
        echo $_POST['sql_names'] . '<br> ';
        echo $_POST['sql_file'] . '<br>';
        echo $_POST['textquery'] . '<br>';
        echo $_POST['textquerycode1'] . '<br>';
        echo $_POST['textquerycode2'] . '<br>';
        echo $_POST['textquerycode3'] . '<br>';
        echo $_POST['sql_type'] . '<br>';
        echo $_POST['sql_link'] . '<br>';
        echo $_POST['sql_heads'] . '<br>';
        echo $_POST['insertdate'] . '<br>';
        echo $_POST['sql_status'] . '<br><br>';

        echo $_POST['menuid'] . '<br>';
        echo $_POST['mainmenu'] . '<br>';
        echo $_POST['menu_sub'] . '<br>';
        echo $_POST['menu_order'] . '<br>';
        echo $_POST['menu_link'] . '<br>'; */

        $insertsql = "INSERT INTO cpareport_sql (sql_id,sql_name,sql_file,sql_code,sql_subcode_1,sql_subcode_2,sql_subcode_3,sql_type,sq_link,sql_head,sql_updatedate,sql_userupdate,sql_status)
        VALUES ('" . $_POST["id"] . "'
        ,'" . $_POST["sql_names"] . "'
        ,'" . $_POST["sql_file"] . "'
        ,'" . addslashes($_POST["textquery"])."'
        ,'" . addslashes($_POST["textquerycode1"]) . "'
        ,'" . addslashes($_POST["textquerycode2"]) . "'
        ,'" . addslashes($_POST["textquerycode3"]) . "'
        ,'" . $_POST["sql_type"] . "'
        ,'" . $_POST["sql_link"] . "'
        ,'" . $_POST["sql_heads"] . "'
        ,'" . $_POST["insertdate"] . "'
        ,'" . $_POST["sql_userupdate"] . "'
        ,'" . $_POST["sql_status"] . "'
        )";


        $insertsql2 = "INSERT INTO cpareport_menu (id,menu_main,menu_sub,menu_link,menu_file,menu_title,menu_order,menu_status,menu_userupdate,menu_datetimeupdate)
        VALUES ('" . $_POST["id"] . "'
        ,'" . $_POST["mainmenu"] . "'
        ,'" . $_POST["menu_sub"] . "'
        ,'" . $_POST["menu_link"] . "'
        ,'" . $_POST["sql_file"] . "'
        ,'" . $_POST["sql_heads"] . "'
        ,'" . $_POST["menu_order"] . "'
        ,'" . $_POST["sql_status"] . "'
        ,'" . $_POST["sql_userupdate"] . "'
        ,'" . $_POST["insertdate"] . "'
        )";

        $queryInsert = mysqli_query($con, $insertsql);
        $queryInsert2 = mysqli_query($con, $insertsql2);

        if ($queryInsert && $queryInsert2 ) {
            echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');window.location=test.php;</script>";
            //echo "<script>window.location='test.php';</script>";
        }
        else  
            if($queryInsert){ echo "<script>alert('queryInsert ผิดพลาด');window.location=test.php;</script>";}
           else if($queryInsert2){ echo "<script>alert('queryInsert2 ผิดพลาด');window.location=test.php;</script>";}
           
    }
    //กำหนดค่า pk ของการแจ้งซ่อมโดยให้A นำหน้าตามด้วยปีและเดือนที่ลงข้อมูลเลขจะรัน + 1 ต่อจากค่าสุดท้ายใน sql
    $code = "sql_0";
    $sqllinkN = "report";
    //$yearMonth = substr(date("Y") + 543, -2) . date("m");

    //query MAX ID 
    $maxmenu = "SELECT MAX(id) AS last_id FROM cpareport_menu";
    $qrymenu = mysqli_query($con, $maxmenu);
    $rscount = mysqli_fetch_assoc($qrymenu);
    $maxidmenu = $rscount['last_id'] + 1;


    $sqlmaxid = "SELECT MAX(sql_id) AS last_id FROM cpareport_sql";
    $qry = mysqli_query($con, $sqlmaxid);
    $rs = mysqli_fetch_assoc($qry);
    $maxId = $rs['last_id'];
    //$maxId = substr($rs['last_id'], -4);  //ข้อมูลนี้จะติดรหัสตัวอักษรด้วย ตัดเอาเฉพาะตัวเลขท้ายนะครับ
    //$maxId = 237;   //<--- บรรทัดนี้เป็นเลขทดสอบ ตอนใช้จริงให้ ลบ! ออกด้วยนะครับ
    $maxId = ($maxId + 1);
    $nextId = 'sql_0'.$maxId;
    $sql_link = $sqllinkN.$maxId;
    ?>

    <div class="wrapper">
        <header class="main-header">
            <a href="#" class="logo">
                <span class="logo-mini"><b>r</b>CPA</span>
                <span class="logo-lg"><b>Re</b>port Hospital</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
            </nav>
        </header>
        <?php include "config/menuleft.class.php"; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $sql_head; ?>
                </h1>
            </section>
            <section class="content">

                <div class="container">
                    <div class="card ">
                        <div class="card-body">
                            <h5 class="card-title">ADD QUERYs || SQL file : <?php echo $maxId; ?> DATETIME: <?php echo $today; ?></h5>
                            <hr>
                            <form action="#" method="POST">
                                <span>ส่วนของ query:cpareport_sql</span>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="hidden" class="form-control" name="id" value=" <?php echo $maxId; ?>" />
                                        <span class="input-group-text">SQL names</span>
                                        <input type="text" class="form-control" name="sql_names" placeholder="เช่น DH0101" required />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">SQL head (คำที่แสดงในใบรีพอร์ทในหน้านั้น)</span>
                                        <input type="text" class="form-control" name="sql_heads" placeholder="เช่น รายงานการ..." value="" required />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">SQL file</span>
                                        <input type="hidden" class="form-control" name="sql_file" value="<?php echo$nextId; ?>" />
                                        <input type="text" class="form-control" name="sql_file" value="<?php echo $nextId; ?>" disabled />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">SQL link</span>
                                        <input type="hidden" class="form-control" name="sql_link" value="<?php echo$sql_link; ?>" />
                                        <input type="text" class="form-control" name="sql_link" value="<?php echo $sql_link; ?>" disabled />
                                    </div>
                                </div>


                                <div class="mt-3 mb-3">
                                    <span class="input-group-text" id="">Query *ควรเปลี่ยนค่าตัวแปล Query ที่ต้องมีการเลือกก่อนบันทึก* </span>
                                    <textarea name='textquery' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code MAIN OR A..." required></textarea>
                                    <textarea name='textquerycode1' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_1  OR B..."></textarea>
                                    <textarea name='textquerycode2' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_2  OR B..."></textarea>
                                    <textarea name='textquerycode3' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_3 "></textarea>
                                </div>

                                <br>

                                <hr><span>ส่วนของเมนูซ้ายมือ cpareport_menu</span>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <span class="input-group-text">แฟ้ม</span>
                                        <select class="form-control" name="mainmenu" id="mainmenu" required>
                                            <option value="" selected>main_menu</option>
                                            <?php while ($rmainmenu = mysqli_fetch_assoc($querymenu)) { ?>
                                                <option value="<?php echo $rmainmenu['main_type']; ?>"><?php echo $rmainmenu['main_name']; ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="col-3">

                                        <span class="input-group-text">หัวข้อย่อย</span>
                                        <input type="text" class="form-control" name="menu_sub" placeholder="menu_sub" required>
                                    </div>
                                    <div class="col-1">
                                        <span class="input-group-text">เลขลำดับ</span>
                                        <input type="number" class="form-control" name="menu_order" required/>
                                    </div>
                                    <div class="col-4">
                                        <span class="input-group-text">form</span>
                                        <select class="form-control" name="menu_link" id="inputGroupSelect01" required>
                                            <option value="" selected>menu_link</option>
                                            <?php while ($rqueryform = mysqli_fetch_assoc($queryform)) { ?>
                                                <option value="<?php echo $rqueryform['report_name']; ?>" title="<?php echo $rqueryform['note']; ?>"><?php echo $rqueryform['report_name']; ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" class="form-control" name="menuid" value="<?php echo $maxidmenu; ?>" />
                                    <input type="hidden" class="form-control" name="insertdate" value="<?php echo $today; ?>" /><!-- ใส่ค่าใน 2 ตารางวันเวลาที่เพิ่มข้อมูล-->
                                    <input type="hidden" class="form-control" name="sql_userupdate" value="admin" /><!-- เอาชื่อผู้ login ไปใส่ -->
                                    <input type="hidden" class="form-control" name="sql_status" value="1" />
                                    <input type="hidden" class="form-control" name="sql_type" value="1" />
                                </div>
                        </div>
                        <hr>
                        <center> <button class="btn btn-info btn-block" style="font-size:24px" name="submit" type="submit"><i class="fa fa-save"></i> บันทึก </button></center>
                    </div>
                    </form>
                </div>


        </div>
        <?php include "config/footer.class.php"; ?>
        <?php include "config/js.class.php" ?>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>

</html>