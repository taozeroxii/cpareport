<?php
session_start();
include('my_con.class.php');
date_default_timezone_set("Asia/Bangkok");
$subItems = " SELECT *  FROM drug_frm2 WHERE status_frm = 'Y' ORDER BY id DESC ";
$res      = mysqli_query($con, $subItems);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon_img/favicon.ico">
    <title>Menu Abh Help Version 2022.3</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="tootip.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
 
</head>
<style>
    .card:hover {
        background: #D5DBDB;
    }

    .img-wh {
        width: 58px;
        height: 54px;
        border-radius: 10px;
    }

    .fo {
        color: #fff;
        font-size: 1.4em;
    }

    body {
        background: #5cb59c;
        /* -webkit-animation: colorchange 60s infinite; */
        /* animation: colorchange 60s infinite; */
    }

    @-webkit-keyframes colorchange {
        0% {
            background: #E5E8E8;
        }

        25% {
            background: #5cb59c;
        }

        50% {
            background: #FAE5D3;
        }

        75% {
            background: #D4E6F1;
        }

        100% {
            background: #E8DAEF;
        }
    }

    @keyframes colorchange {
        0% {
            background: #E5E8E8;
        }

        25% {
            background: #5cb59c;
        }

        50% {
            background: #FAE5D3;
        }

        75% {
            background: #D4E6F1;
        }

        100% {
            background: #E8DAEF;
        }
    }
    .sidebar-wrapper{
        background: #0E6655;
        
    }
    .ffff{
        color: #FFF;
    }
</style>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo ">
                            <a href="#" class="ffff">
                                <img src="assets/vendors/svg-loaders/circles.svg " class="me-4" style="width: 3rem" alt="audio">Drug
                            </a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h4>แบบฟอร์มการใช้ยาบัญชี จ2</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="row">
                        <?php
                        foreach ($res as $subItem) {
                            $name_frm  = $subItem['name_frm'];
                            $frm_drug  = $subItem['frm_drug'];
                            $file_drug  = $subItem['file_drug'];
             
                        ?>
                            <div class="col-6 col-lg-6 col-md-6">
                                <a href="<? echo "frmdrug2/".$frm_drug."".$file_drug; ?>" target="_blank" rel="">
                                    <div class="card">
                                        <div class="card-body px-6 py-4-5">
                                            <div class="row">
                                              
                                                <div class="col-md-12">
                                                    <h6 class="font-extrabold mb-0"><?php echo $name_frm; ?></h6>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>