<?php session_start(); ?>
<!DOCTYPE HTML5>
<html lang="en">

<head>
    <title>เปลี่ยนรหัสผ่านระบบรายงาน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Account Register Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- css files -->
    <link rel="stylesheet" href="../admin/css/cssregisterform.css" type="text/css" media="all" /> <!-- Style-CSS -->
    <link href="//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,devanagari,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- //css files -->
    <?php
    include('/my_con.class.php');
    include("/pg_con.class.php");
    /////////////////// เช็คเก็บข้อมูลผู้เข้าชม sql นั้นๆ เพื่อเก็บ session นับจำนวน view  //////////////////////////////
    $sql 	=  $_GET['sql']; // get ค่า sqlมาจาก link ที่ดึงข้อมูในฐานไปเพิ่มเข้าตารางนับจำนวน
    include "/timestampviewer.php";//เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ
    ?>
</head>


<body style="background-color:rgb(146, 235, 149)">
    <!-- main -->
    <?
    $cpareport_depcode = " SELECT * FROM cpareport_department where status_active <> 'N' order by department_id";
    $depcode = mysqli_query($con, $cpareport_depcode);
    /////////////////// เช็คlogin  //////////////////////////////
    if ((isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null)) {
        echo "<script>alert('โปรดเข้าสู่ระบบเพื่อดูข้อมูล');window.location ='../index.php';</script>";
    }



    if (isset($_POST['submit'])) {
        $newpassword  =  md5($_POST['password']);
        $opassword  =  md5($_POST['opassword']);
        $newniname  =  ($_POST['niname']);
        if($opassword == $_SESSION['password'] ){
            $Updatepassword = 'UPDATE cpareport_userlogin SET password = "'.$newpassword .'" ,niname = "'.$newniname.'"  WHERE username = "'.$_SESSION['username'].'"';
            $queryUpdate = mysqli_query($con, $Updatepassword);
            if($queryUpdate){
                $message = '<hr/><p style="color:GREEN;">ดำเนินการเรียบร้อย โปรดเข้าสู่ระบบอีกครั้ง</p>';
                session_destroy();
            }
        }
        else $message = '<hr/><p style="color:red;">รหัสผ่านไม่ถูกต้อง</p>';
     
    }
    ?>


    <div class="w3ls-header">
        <a href='javascript:if(confirm("ต้องการปิดหน้านี้หรือไม่?"))self.close()'><input class="btn  btn-secondary btn-block" type="submit" name='กลับหน้าหลัก' value='ปิด' /></a>
        <br> <br><br> <br>
        <div class="header-main" style="  box-shadow: 10px 10px grey;">
            <h2>เปลี่ยนรหัสผ่านระบบรายงาน</h2>
            <div class="header-bottom">
                <div class="header-right w3agile">
                    <div class="header-left-bottom agileinfo">
                        <form action="#" method="post">
                            <div class="icon1">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="row">
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="ชื่อ" name="fname" value="<? echo $_SESSION['fname']; ?>" disabled /></div>
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="นามสกุล" name="lname" value="<? echo $_SESSION['lname']; ?>" disabled /></div>
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="ชื่อเล่น" name="niname" value="<? echo $_SESSION['niname']; ?>" /></div>
                                </div>
                            </div>

                            <div class="icon1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Username" name="username" value='<?php echo $_SESSION['username']; ?>' disabled />
                            </div>
                            <div class="icon1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="password" placeholder="รหัสผ่านเดิม" name="opassword" required="" />
                            </div>
                            <div class="icon1">
                            <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="password" placeholder="รหัสผ่านใหม่" name="password" required="" />
                            </div>
                            <select class="custom-select" name='spclty' required="">
                                <?php while ($Result = mysqli_fetch_assoc($depcode)) {
                                    if ($_SESSION['department'] == $Result['department_id']) {
                                        $depname = $Result['department_name'];
                                    }
                                } ?>
                                <option selecte><? echo $depname; ?> </option>
                            </select>
                            <hr>
                            <div class="bottom">
                                <input type="submit" name='submit' value="submit" />
                                **หากเปลี่ยนชื่อหรือแผนกแจ้ง 3148 3149**
                                <?php echo $message;?>
                                <hr>
                                <center><a href="../index.php">กลับสู่หน้าหลัก</a></center>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--header end here-->
</body>

</html>