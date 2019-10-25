<!DOCTYPE HTML5>
<html lang="en">

<head>
    <title>เพิ่มผู้ใช้งาน</title>
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
    <link rel="stylesheet" href="css/cssregisterform.css" type="text/css" media="all" /> <!-- Style-CSS -->
    <link href="//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,devanagari,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- //css files -->
    <?php
    include('../config/my_con.class.php');
    include "../config/pg_con.class.php";
    ?>
</head>


<body style="background-color:rgb(146, 235, 149)">
    <!-- main -->
    <?
    $remembername  = '' ;
    $rememberlname  = '';
    $rememberniname  = '';

    $cpareport_depcode = " SELECT * FROM cpareport_department where status_active <> 'N' order by department_id";
    $depcode = mysqli_query($con, $cpareport_depcode);

    $maxmenu = "SELECT MAX(PKID) AS last_id FROM cpareport_userlogin";
    $qrymenu = mysqli_query($con, $maxmenu);
    $rscount = mysqli_fetch_assoc($qrymenu);
    $maxidmenu = $rscount['last_id'] + 1;

    if (isset($_POST['submit'])) {
       /* 
        echo 'fname :' . $_POST['fname'] . '<br> ';
        echo 'lname :' . $_POST['lname'] . '<br> ';
        echo 'user :' . $_POST['username'] . '<br> ';
        echo 'user :' . $_POST['niname'] . '<br> ';
        echo 'password :' . md5($_POST['password']) . '<br> ';
        echo 'status :' . $_POST['status'] . '<br> ';
        echo 'spclty :' . $_POST['spclty'] . '<br> ';
        echo 'menuid :'.$_POST['menuid'].'<br>';
        */
        $remembername  = $_POST['fname'] ;
        $rememberlname  = $_POST['lname'];
        $rememberniname  = $_POST['niname'];

        //เช็ค usermane ห้ามซ้ำ
        $searchuser = " SELECT * FROM cpareport_userlogin where  username = '".$_POST['username'] ."'";
        $have_user_yet = mysqli_query($con, $searchuser);
        $reshave_user_yet = mysqli_fetch_assoc($have_user_yet);
        $reshave_user_yet['PKID'];

        if($reshave_user_yet['PKID'] == null || $reshave_user_yet['PKID']=='')
        {
            $insertsql = "INSERT INTO cpareport_userlogin (PKID,username,password,fname,lname,niname,department,status)
            VALUES ('" . $_POST['menuid'] . "'
            ,'" . $_POST["username"] . "'
            ,'" . md5($_POST["password"]) . "'
            ,'" . $_POST["fname"] . "'
            ,'" . $_POST["lname"] . "'
            ,'" . $_POST["niname"] . "'
            ,'" . $_POST["spclty"] . "'
            ,'" . $_POST["status"] . "'
            )";
            $queryInsert = mysqli_query($con, $insertsql);
    
            if ($queryInsert) {
                echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');window.close();</script>";
            }
        }
        else{echo "<script>alert('มี username นี้อยู่ในระบบแล้ว');</script>";} 
    }
    ?>

    <div class="w3ls-header">
    <a href='javascript:if(confirm("ต้องการปิดหน้านี้หรือไม่?"))self.close()'><input class="btn  btn-secondary btn-block" type="submit" name='กลับหน้าหลัก' value='ปิด' /></a>
        <br> <br><br> <br>
        <div class="header-main" style="  box-shadow: 10px 10px grey;">
            <h2>เพิ่มผู้เข้าใช้งาน</h2>
            <div class="header-bottom">
                <div class="header-right w3agile">
                    <div class="header-left-bottom agileinfo">
                        <form action="#" method="post">
                            <div class="icon1">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="row">
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="ชื่อ" name="fname" value="<? echo $remembername;?>" required="" /></div>
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="นามสกุล" name="lname" value="<? echo $rememberlname;?>"/></div>
                                    <div class="col-4"> <input class="form-control" type="text" placeholder="ชื่อเล่น" name="niname" value="<? echo $rememberniname;?>"/></div>
                                </div>
                            </div>

                            <div class="icon1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="text" placeholder="Username" name="username" required="" />
                            </div>
                            <div class="icon1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <input type="password" placeholder="password" name="password" required="" />
                            </div>
                            <select class="custom-select" name='spclty' required="">
                                <option selecte value=''>แผนก ...</option>
                                <?php
                                while ($Result = mysqli_fetch_assoc($depcode)) {
                                    ?>
                                    <option value="<?php echo $Result['department_id']; ?>">
                                        <?php echo $Result['department_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <hr>

                            <select class="custom-select" name='status' required="">
                                <option selected value=''>การเข้าถึง ...</option>
                                <option value="1">Admin ดูแลจัดการข้อมูลได้</option>
                                <option value="2">super user เข้าดูหน้าข้อมูลลับได้ทั้งหมด</option>
                                <option value="3">users เข้าดูข้อมูลได้ตามแผนก</option>
                            </select>
                            <hr>
                            <input type="hidden" class="form-control" name="menuid" value="<?php echo $maxidmenu; ?>" />
                            <div class="bottom">
                                <input type="submit" name='submit' value="submit" />
                            </div>
                            <p>มีบัญชีอยู่แล้ว<a href="../login.php">LOGIN</a></p>
                            <p><small><a href="../index.php">หากไม่ได้ login จะเข้าใช้งานดูหน้า query ทั่วไปที่เปิดเผยได้->></a></small></p>
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