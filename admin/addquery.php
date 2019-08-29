<!DOCTYPE html>
<?php session_start(); ?>
<html>

<link rel="stylesheet" type="text/css" href="css/DT_bst.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bst.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <script src="js/j182.js"></script>
  <script src="js/j-dtb.js"></script>
  <script src="js/DT_bst.js"></script>
  
    <?php
    include "../config/pg_con.class.php";
    include "../config/func.class.php";
    include "../config/head.class.php";
    include('../config/my_con.class.php');
    ?>


    <script src="jquery-1.11.1.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#categories').change(function() {
                $.ajax({
                    type: 'POST',
                    data: {
                        categories: $(this).val()
                    },
                    url: 'select_menu.php',
                    success: function(data) {
                        $('#products').html(data);
                    }
                });
                return false;
            });
        });
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
        echo "<script>window.location ='login.php';</script>";
    } ?>

    <?php
    date_default_timezone_set("Asia/Bangkok"); //ตั้งโซนเวลา
    $month = date('m');
    $day = date('d');
    $year = (date('Y'));
    $TIME = date("H:i:s");   //date("h:i:s a"); แบบมีpm am
    $today = $year . '-' . $month . '-' . $day . '  ' . $TIME;

    $cpareport_mainmenu = " SELECT * FROM cpareport_mainmenu order by main_id";
    $mainmenu = mysqli_query($con, $cpareport_mainmenu);

    $sql2 = " SELECT * FROM cpareport_report WHERE report_status = '1'  ORDER BY report_id ASC  ";
    $queryform = mysqli_query($con, $sql2);
    ?>




    <?php if (isset($_POST['submit'])) {
        /*  
        echo 'id :'.$_POST['id'] . '<br> ';
        echo 'sql_names :'.$_POST['sql_names'] . '<br> ';
        echo 'sql_file  :'.$_POST['sql_file'] . '<br>';
        echo 'textquery  :'.$_POST['textquery'] . '<br>';
        echo 'textquerycode1  :'.$_POST['textquerycode1'] . '<br>';
        echo 'textquerycode2  :'.$_POST['textquerycode2'] . '<br>';
        echo 'textquerycode3 : '.$_POST['textquerycode3'] . '<br>';
        echo 'sql_type :'.$_POST['sql_type'] . '<br>';
        echo 'sql_link :'.$_POST['sql_link'] . '<br>';
        echo 'sql_heads :'.$_POST['sql_heads'] . '<br>';
        echo 'insertdate  :'.$_POST['insertdate'] . '<br>';
        echo 'sql_status :'.$_POST['sql_status'] . '<br><br>';

        echo 'menuid :'.$_POST['menuid'] . '<br>';
        echo 'mainmenu :'.$_POST['categories'] . '<br>';
        echo 'menu_sub :'.$_POST['menu_sub'] . '<br>';
        echo 'menu_title : '.$_POST["menu_title"] . '<br>';
        echo 'menu_order :'.$_POST['products'] . '<br>';
        echo 'menu_link :'.$_POST['menu_link'] . '<br>';
        */

        $insertsql = "INSERT INTO cpareport_sql (sql_id,sql_name,sql_file,sql_code,sql_subcode_1,sql_subcode_2,sql_subcode_3,sql_type,sq_link,sql_head,sql_updatedate,sql_userupdate,sql_status)
        VALUES ('" . $_POST["id"] . "'
        ,'" . $_POST["sql_names"] . "'
        ,'" . $_POST["sql_file"] . "'
        ,'" . addslashes($_POST["textquery"]) . "'
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
        VALUES ('" . $_POST["menuid"] . "'
        ,'" . $_POST["categories"] . "'
        ,'" . $_POST["menu_sub"] . "'
        ,'" . $_POST["menu_link"] . "'
        ,'" . $_POST["sql_file"] . "'
        ,'" . $_POST["menu_title"] . "'
        ,'" . $_POST["products"] . "'
        ,'" . $_POST["sql_status"] . "'
        ,'" . $_POST["sql_userupdate"] . "'
        ,'" . $_POST["insertdate"] . "'
        )";

        $queryInsert = mysqli_query($con, $insertsql);
        $queryInsert2 = mysqli_query($con, $insertsql2);

        if ($queryInsert && $queryInsert2) {
            echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');window.location=test.php;</script>";
            //echo "<script>window.location='test.php';</script>";
        } else  
            if ($queryInsert) {
                echo "<script>alert('queryInsert ผิดพลาด');window.location=test.php;</script>";
            }else if ($queryInsert2) {
                echo "<script>alert('queryInsert2 ผิดพลาด');window.location=test.php;</script>";
            }
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
    $nextId = 'sql_0' . $maxId;
    $sql_link = $sqllinkN . $maxId;
    ?>


    <div class="wrapper">
        <?php include "/menu.php"; ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $sql_head; ?>
                </h1>
            </section>
            <section class="content">
                <div class="container col-lg-8">
                    <div class="card ">
                        <div class="card-body">
                            <h5 class="card-title">ADD QUERYs || SQL file : <?php echo $maxId; ?> DATETIME: <?php echo $today; ?>
                                <a style="float:right" href="../index.php">เข้าสู่หน้าหลัก REPORT</a>
                            </h5>

                            <form action="#" method="POST">
                                <hr><span>ส่วนของเมนูซ้ายมือ cpareport_menu</span>
                                <div class="row">
                                    <div class="col-4">
                                        <span class="input-group-text">แฟ้ม</span>
                                        <select name="categories" id="categories" class="form-control">
                                            <option value="">เลือกข้อมูลหมวดหมู่ main_name</option>
                                            <?php
                                            while ($Result = mysqli_fetch_assoc($mainmenu)) {
                                                ?>
                                            <option value="<?php echo $Result['main_id']; ?>">
                                                <?php echo $Result['main_name']; ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <span class="input-group-text">ชื่อหัวข้อย่อย</span>
                                        <input type="text" class="form-control " name="menu_sub" placeholder="menu_sub" required>
                                    </div>
                                    <div class="col-2">
                                        <span class="input-group-text">เมื่อเอาเมาส์ชี้หัวข้อย่อย</span>
                                        <input type="text" class="form-control" name="menu_title" placeholder="menu_title" required>
                                    </div>
                                    <div class="col-1">
                                        <span class="input-group-text">เมนูที่</span>
                                        <select class="form-control" name="products" id="products">
                                            <option value="0">0</option>
                                        </select>

                                    </div>
                                    <div class="col-3">
                                        <span class="input-group-text">form</span>
                                        <select class="form-control" name="menu_link" id="inputGroupSelect01" required>
                                            <option value="" selected>menu_link</option>
                                            <?php while ($rqueryform = mysqli_fetch_assoc($queryform)) { ?>
                                            <option value="<?php echo $rqueryform['report_name']; ?>" title="<?php echo $rqueryform['note']; ?>"><?php echo $rqueryform['report_name']; ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <span>ส่วนของ query:cpareport_sql</span>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="hidden" class="form-control" name="id" value=" <?php echo $maxId; ?>" />
                                        <span class="input-group-text">SQL names(ชื่อQUERY)</span>
                                        <input type="text" class="form-control" name="sql_names" placeholder="เช่น DH0101" required />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">คำที่แสดงในใบรีพอร์ทในหน้านั้น </span>
                                        <input type="text" class="form-control" name="sql_heads" placeholder="SQL HEAD" value="" required />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">SQL file</span>
                                        <input type="hidden" class="form-control" name="sql_file" value="<?php echo $nextId; ?>" />
                                        <input type="text" class="form-control" name="sql_file" value="<?php echo $nextId; ?>" disabled />
                                    </div>
                                    <div class="col-lg-3">
                                        <span class="input-group-text">SQL link</span>
                                        <input type="hidden" class="form-control" name="sql_link" value="<?php echo $sql_link; ?>" />
                                        <input type="text" class="form-control" name="sql_link" value="<?php echo $sql_link; ?>" disabled />
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <span class="input-group-text" id="">Query *ควรเปลี่ยนค่าตัวแปร Query ที่ต้องมีการเลือกก่อนบันทึก* ช่วงวันที่ {datepickers} and {datepickert} คลินิก  {c_department} วอร์ด{ward_dropdown}</span>
                                    <textarea name='textquery' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code MAIN OR A..." required></textarea>
                                    <textarea name='textquerycode1' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_1  OR B..."></textarea>
                                    <textarea name='textquerycode2' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_2  OR B..."></textarea>
                                    <textarea name='textquerycode3' class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="sql_code_3 "></textarea>


                                    <br>
                                    <input type="hidden" class="form-control" name="menuid" value="<?php echo $maxidmenu; ?>" />
                                    <input type="hidden" class="form-control" name="insertdate" value="<?php echo $today; ?>" /><!-- ใส่ค่าใน 2 ตารางวันเวลาที่เพิ่มข้อมูล-->
                                    <input type="hidden" class="form-control" name="sql_userupdate" value="admin" /><!-- เอาชื่อผู้ login ไปใส่ -->
                                    <input type="hidden" class="form-control" name="sql_status" value="1" />
                                    <input type="hidden" class="form-control" name="sql_type" value="1" />
                                </div>
                                <center> <button class="btn btn-info btn-block" style="font-size:24px" name="submit" type="submit"><i class="fa fa-save"></i> บันทึก </button></center>
                        </div>
                    </div>
                </div>
                </form>
        </div>


    </div>
 
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>

</html>