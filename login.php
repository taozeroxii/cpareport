<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>เข้าสู่ระบบ</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>

<body style="font-family: 'Prompt', sans-serif; background-size: cover" background="icon/bgimage.jpg">
    <?php include "config/pg_con.class.php";
    include "config/func.class.php";
    include "config/time.class.php";
    include "config/sql.class.php";
    include 'config/my_con.class.php';
    $bm = new Timer;
    $bm->start();
    include "config/head.index.class.php";
    for ($i = 0; $i < 100000; $i++) {
        $i;
    }
    ?>
    <?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $con->real_escape_string (md5($_POST['password']));
        /*
        $hash = password_hash($password,PASSWORD_BCRYPT);
        echo  $hash;
        */
        $sql = "SELECT * FROM `cpareport_userlogin` WHERE `username` =  '".$username."'  AND `password` = '".$password."'";//query เช็ค user password ตรงไหม

        $result = $con->query($sql);
      
        if($result->num_rows>0){
            $accoutUsser = $result->fetch_assoc();
            $_SESSION['username'] =  $accoutUsser['username'];
            $_SESSION['password'] =  $accoutUsser['password'];
            $_SESSION['fname'] =  $accoutUsser['fname'];
            $_SESSION['lname'] =  $accoutUsser['lname'];
            $_SESSION['niname'] =  $accoutUsser['niname'];
            $_SESSION['status'] =  $accoutUsser['status'];
            $_SESSION['department'] =  $accoutUsser['department'];
            
        if($_SESSION['status'] =='1'){ header('location:admin/index.php'); }
                else { header('location:index.php');}
        if($_SESSION['status'] =='4'){ header('location:gsb/index.php'); }
                else { header('location:index.php');}
        }else{  $message =  "login fail ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง!!!";
         }
    }
    ?>
    
    <div class="cotainer mt-5" style=" opacity: 1;">
        <br><br><br>
        <div class="row mt-5">
            <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-3 mx-auto mt-5 shadow p-3 bg-white rounded">
                <form action="login.php" method="POST">
                    <div class="card">
                        <div class="card-header text-center">เข้าสู่ระบบ</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">USER NAME</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">PASSWORD</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <hr>
                            <input type="submit" name="submit" class="btn btn-primary" value="LOGIN">
                            <input type="reset" name="set" class="btn btn-warning" value="RESET">
                            <a href="index.php" class="mt-5" style="float:right;">กลับหน้าหลัก</a>
                        </div>
                        <div class="text-center"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?echo '<center><p style = "margin-top:10px;color:red">'.$message.'</p></center>';?>




    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>

</html>