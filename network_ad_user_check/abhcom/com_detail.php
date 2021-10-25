<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "config/mysql_con.class.php";
$sessionid = $_SESSION['id'];
if (!$sessionid) {

    Header("Location: login.html");
}

$sql_check = " SELECT *
               FROM com_admin 
               WHERE 1 = 1
               AND id = '$sessionid' ";
$qu_check = mysqli_query($con, $sql_check);
//$cshow = mysqli_fetch_assoc($qu_check);
$cshow = mysqli_fetch_assoc($qu_check);
$user_regis = $cshow['username'];
$fname      = $cshow['fname'];
$lname      = $cshow['lname'];
$todate     = DATE('Y-m-d H:i:s');


$sql_dep = " SELECT *
FROM com_detail as b
LEFT JOIN com_dep as a ON a.dep_id = b.com_depid
order by b.com_id DESC ";
$query = mysqli_query($con, $sql_dep);

$sql_max = " SELECT MAX(com_id)+1 as maxid
FROM com_detail 
ORDER BY  com_name DESC ";
$max = mysqli_query($con, $sql_max);
$maxid = mysqli_fetch_assoc($max);
$max_id = "cpa_" . $maxid['maxid'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Abh Admin 2 - Tables</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/eaktamp.css" rel="stylesheet">

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="css/s2.css" rel="stylesheet">
    <link href="css/chbox.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Abh Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>ABH Dashboard</span></a>
            </li>


            <li class="nav-item ">
                <a class="nav-link" href="group_dep.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ข้อมูลคอมพิวเตอร์ Group</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="com_detail.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ข้อมูลคอมพิวเตอร์ Detail</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fname . " " . $lname; ?></span>
                                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
 -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">

                                <button class="btn btn-primary btn-circle btn-sm" title="เพิ่มรายการ" data-toggle="modal" data-target="#addcom"><i class="fas fa-cart-plus"></i></button>
                                Add Computer <sup></sup>
                            </h6>
                        </div>

                        <!-- Modal ADD -->
                        <div id="addcom" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button class="btn btn-info btn-circle btn-sm"><i class="fas fa-desktop"></i> </button>&nbsp;
                                        เพิ่ม Computer เข้าระบบ &nbsp;&nbsp;<span class="user_h"><?php echo "by : " . $user_regis . "  / $todate"; ?></span>
                                        </span>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">

                                        <form id="fupaddcom" name="fupaddcom" action="addcom.php" method="POST">

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">ชื่อเครื่อง</label>
                                                    <input type="text" class="form-control" id="com_name" name="com_name" value="<?php echo $max_id; ?>" required readonly>
                                                    <input type="hidden" id="com_userregis" name="com_userregis" value="<?php echo $user_regis; ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputPassword4">เลขครุภัณฑ์</label>
                                                    <input type="text" class="form-control" id="com_code" name="com_code" value="" required>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">จัดซื้อปี</label>
                                                    <select id="com_year" class="form-control select2 " name="com_year" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_year ORDER BY com_year DESC";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["com_year"]; ?>">
                                                                <?php echo $list["com_year"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">สถานะ</label>
                                                    <select id="com_status" class="form-control select2 " name="com_status" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_status ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["status_name"]; ?>">
                                                                <?php echo $list["status_name"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">ระบบปฎิบัติการ</label>
                                                    <select id="com_os_m" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true" name="com_os_m" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_os ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["os"]; ?>">
                                                                <?php echo $list["os"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">ประเภท</label>
                                                    <select id="com_type" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_type" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_type ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["com_type"]; ?>">
                                                                <?php echo $list["com_type"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">รุ่น</label>
                                                    <select id="com_brand" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_brand" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_brand ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["brand"]; ?>">
                                                                <?php echo $list["brand"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">VGA</label>
                                                    <select id="com_graphip" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_graphip" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_vga ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["vga"]; ?>">
                                                                <?php echo $list["vga"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">DVD-ROM</label>
                                                    <select id="com_dvdrom" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_dvdrom" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <option value="มี"> มี </option>
                                                        <option value="ไม่มี"> ไม่มี </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputEmail4">CPU</label>
                                                    <select id="com_cpu_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_cpu_m" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_cpu ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["cpu"]; ?>">
                                                                <?php echo $list["cpu"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputEmail4"> CPU GEN </label>
                                                    <input type="text" class="form-control " id="com_cpu" name="com_cpu" value="" placeholder=" ">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">CPU Speed GHz</label>
                                                    <select id="com_ghz" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ghz" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_ghz ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["cpu_ghz"]; ?>">
                                                                <?php echo $list["cpu_ghz"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">RAM</label>
                                                    <select id="com_ram_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ram_m" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_ram ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["ram"]; ?>">
                                                                <?php echo $list["ram"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="inputPassword4">HDD</label>
                                                    <select id="com_hdd_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_hdd_m" required>
                                                        <option value="" selected disabled> เลือกรายการ </option>
                                                        <?php $dep = " SELECT * FROM com_hdd ";
                                                        $qdep = mysqli_query($con, $dep);
                                                        while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                                            <option value="<?php echo $list["hdd"]; ?>">
                                                                <?php echo $list["hdd"]; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4">Note</label>
                                                    <!-- <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="com_note" name="com_note" placeholder=" เพิ่มเติม..."> -->
                                                    <textarea rows="4" class="form-control" id="com_note" name="com_note" value="<?php echo $row_detail['com_note']; ?>"><?php echo $row_detail['com_note']; ?></textarea>

                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-block">เพิ่มข้อมูล</button>
                                        </form>


                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!-- close Add modal -->



                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="btn-primary ">
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-center">ชื่อเครื่อง</th>
                                            <th class="text-center">เลขครุภัณฑ์</th>
                                            <th class="text-center">หน่วยงาน</th>
                                            <th class="text-center">อาคาร</th>
                                            <th class="text-center">ชั้น</th>
                                            <th class="text-center">เบอร์โทรศัพท์</th>
                                            <th class="text-center">เจ้าหน้าที่</th>
                                            <th class="text-center">รายละเอียด</th>
                                            <th class="text-center">Ma</th>
                                            <th style="display: none;">กลุ่ม</th>
                                            <th style="display: none;">ปี</th>
                                            <th style="display: none;">สถานะ</th>
                                            <th style="display: none;">os</th>
                                            <th style="display: none;">type</th>
                                            <th style="display: none;">รุ่น</th>
                                            <th style="display: none;">vga</th>
                                            <th style="display: none;">dvd</th>
                                            <th style="display: none;">cpu</th>
                                            <th style="display: none;">cpu gen</th>
                                            <th style="display: none;">cpu speed</th>
                                            <th style="display: none;">ram</th>
                                            <th style="display: none;">hdd</th>
                                            <th style="display: none;">note</th>
                                            <th style="display: none;">com_id</th>
                                            <th style="display: none;">dep_id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rw == 0;
                                        while ($row = mysqli_fetch_array($query)) {
                                            $comid =  $row['com_id'];
                                            $rw++;
                                        ?>
                                            <tr class="table-hover">
                                                <td class="text-center">
                                                    <?php $com_status = $row['com_status'];

                                                    if ($com_status == "รับเข้าระบบ") {
                                                        $st = "<button class='btn btn-success btn-circle btn-sm'  data-toggle='modal' data-target='#ma_detail$comid' title='รับเข้าระบบ ID : $comid' ><i class='fas fa-cart-arrow-down'></i></button>";
                                                    } elseif ($com_status == "ใช้งาน") {
                                                        $st = "<button class='btn btn-info btn-circle btn-sm' data-toggle='modal' data-target='#ma_detail$comid' title='ใช้งานอยู่ ID : $comid' ><i class='fas fa-check'></i></button>";
                                                    } elseif ($com_status == "ปิดใช้งาน") {
                                                        $st = "<button class='btn btn-warning btn-circle btn-sm' data-toggle='modal' data-target='#ma_detail$comid' title='ไม่ใช่งาน ID : $comid' ><i class='fas fa-calendar-times'></i></button>";
                                                    } elseif ($com_status == "จำหน่าย") {
                                                        $st = "<button class='btn btn-danger btn-circle btn-sm' data-toggle='modal' data-target='#ma_detail$comid' title='จำหน่าย ID : $comid' ><i class='fas fa-backspace'></i></button>";
                                                    }
                                                    echo  $st_show = $st;

                                                    ?>
                                                </td>
                                                <td><?php echo $row['com_name']; ?></td>
                                                <td><?php echo $row['com_code']; ?></td>
                                                <td><?php echo $row['dep_name']; ?></td>
                                                <td><?php echo $row['dep_zone']; ?></td>
                                                <td><?php echo $row['dep_class']; ?></td>
                                                <td><?php echo $row['dep_tel']; ?></td>
                                                <td class="text-center"><?php echo $row['dep_note']; ?></td>
                                                <td class="text-center"><button class="btn btn-success btn-circle btn-sm detailmd"><i class='fas fa-align-right'></i></button></td>
                                                <td class="text-center"><button class="btn btn-warning btn-circle btn-sm " data-toggle="modal" data-target="#my_ma<?php echo $comid; ?>"><i class="fas fa-exclamation-triangle"></i></button></td>
                                                <td style="display:none;"><?php echo $row['dep_group']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_year']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_status']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_os_m']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_type']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_brand']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_graphip']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_dvdrom']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_cpu_m']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_cpu']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_ghz']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_ram_m']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_hdd_m']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_note']; ?></td>
                                                <td style="display:none;"><?php echo $row['com_id']; ?></td>
                                                <td style="display:none;"><?php echo $row['dep_id']; ?></td>
                                            </tr>

                                            <div id="my_ma<?php echo $comid; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="btn btn-info btn-circle btn-sm"><i class="fas fa-desktop"></i> </button>&nbsp;
                                                            บำรุงรักษา เช็ค ซ่อม เปลี่ยนอุปกรณ์ &nbsp;&nbsp;<span class="user_h"><?php echo "by : " . $user_regis . "  / $todate"; ?></span>
                                                            </span>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="fupaddcom" name="fupaddcom" action="ma.php" method="POST">
                                                                <input type="hidden" id="ma_userupdate" name="ma_userupdate" value="<?php echo $user_regis; ?>">
                                                                <input type="hidden" id="ma_comid" name="ma_comid" value="<?php echo $comid; ?>">
                                                                <input type="hidden" id="ma_dateupdate" name="ma_dateupdate" value="<?php echo $todate; ?>">

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-3">
                                                                        ComputerName : <span class="user_h"><?php echo $row['com_name']; ?></span>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        ID Number : <span class="user_h"><?php echo $row['com_code']; ?></span>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        Dep Area : <span class="user_h"><?php echo $row['dep_name']; ?></span>
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        Dep Zone : <span class="user_h"><?php echo $row['dep_zone']; ?></span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <center><span class="not"> <label for="inputPassword4"><span class="not">บันทึกกิจกรรม HardWare</span></label></center>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="eram" id="eram" value="1"> 
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        เพิ่ม เปลี่ยน RAM
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="ehdd" id="ehdd" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        เปลี่ยน HDD
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="epower" id="epower" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        เปลี่ยน Power Supply
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="evga" id="evga" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        เปลี่ยน แก้ไข จอภาพ
                                                                    </div>
                                                                </div>
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="edrive" id="edrive" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        เปลี่ยน Drive DVD
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="eupgrade" id="eupgrade" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        ติดตั้ง Upgrade โปรแกรม
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="ewin" id="ewin" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        ติดตั้ง WIndows
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label class="switch">
                                                                            <input type="checkbox" name="eprinter" id="eprinter" value="1">
                                                                            <span class="slider"></span>
                                                                        </label>
                                                                        ติดตั้ง Printer
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-12">
                                                                    <span class=""> <label for="inputPassword4"><span class="">หมายเหตุ</span></label>
                                                                        <textarea rows="4" class="form-control" id="ma_note" name="ma_note" value="" required></textarea>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary btn-block">บันทึกกิจกรรม</button>

                                                        </div>
                                                        </form>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                            </div>

                            <!--  -->
                            <div id="ma_detail<?php echo $comid; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card mb-4 py-3 border-bottom-info">
                                                    <div class="card-body">
                                                        <button class="btn btn-info btn-circle btn-sm"><i class="fas fa-desktop"></i> </button>&nbsp;
                                                        ชื่อเครื่อง :<span class="user_h"><?php echo $row['com_name']; ?></span>&nbsp;
                                                        ID Number : <span class="user_h"><?php echo $row['com_code']; ?></span>&nbsp;
                                                        Dep Area : <span class="user_h"><?php echo $row['dep_name']; ?></span>&nbsp;
                                                        Dep Zone : <span class="user_h"><?php echo $row['dep_zone']; ?></span>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            $sql_m = " SELECT * FROM com_ma WHERE 1 = 1 AND  com_id = '$comid'  ORDER BY id DESC ";
                                            $q_ma = mysqli_query($con, $sql_m);
                                            $rw == 0;
                                            while ($row_ma = mysqli_fetch_array($q_ma)) {
                                                $rw++;
                                        ?>
                                            <div class="modal-body">
                                                <!-- <div class="row">
                                                    <div class="col-lg-12">
                                                        <?php //echo $rw . " " . $row_ma['note_detail'] . " " . $row_ma['userupdate'] . " " . $row_ma['dateupdate']; ?>
                                                    </div>
                                                </div> -->
                                                <div class="form-row">
                                                                    <div class="form-group col-md-4">
                                                                    <button class="btn btn-warning btn-circle btn-sm"><i class="fas fa-edit"></i> </button>&nbsp;
                                                                       <?php echo "วันที่ : ".$row_ma['dateupdate']." โดย : ".$row_ma['userupdate']; ?>
                                                                    </div>
                                                                    <div class="form-group col-md-4 eshow">
                                                                    <?php 
                                                                            $eram       = $row_ma['eram'];	
                                                                            $ehdd       = $row_ma['ehdd'];	
                                                                            $epower     = $row_ma['epower'];	
                                                                            $evga       = $row_ma['evga'];	
                                                                            $edrive     = $row_ma['edrive'];	
                                                                            $eupgrade   = $row_ma['eupgrade'];	
                                                                            $eprinter   = $row_ma['eprinter'];
                                                                            $ewin       = $row_ma['ewin'];
                                                                    echo "<span class='eshow'>";
                                                                    echo  $eram ? "เปลี่ยนRam | " : " ";
                                                                    echo   $ehdd ? "เปลี่ยนHDD | " : " ";
                                                                    echo   $epower ? "เปลี่ยนPowerSupply | " : " ";
                                                                    echo   $evga ? "เปลี่ยนจอ | " : " ";
                                                                    echo   $edrive ? "เปลี่ยนDriveDVD | " : " ";
                                                                    echo   $eupgrade ? "Upgradโปรแกรม | " : " ";
                                                                    echo   $eupgrade ? "Upgradโปรแกรม | " : " ";
                                                                    echo   $eupgrade ? "Upgradโปรแกรม | " : " ";
                                                                    echo   $ewin ? "UpgradWinDows | " : " ";
                                                                    echo   $eprinter ? "ADDPrinter | " : " ";
                                                                    echo   "</span>";


                                                                    ?>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <?php echo " Note : ".$row_ma['note_detail'];?>
                                                                    </div>
                                                            
                                                                </div>
                                                                <hr>
                                            </div>

                                        <?php } ?>

                                    </div>

                                </div>
                            </div>
                            <!-- show ma -->



                        <?php
                                        }
                        ?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->



        <?php include "modaldetailcom.php" ?>











        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Abh Information Center </span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->





    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-center" id="exampleModalLabel">ต้องการออกจากระบบ ใช่ หรือ ไม่ ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
                <div class="modal-footer">

                    <a class="btn btn-primary" href="login.html">Logout</a>
                    <button class="btn btn-warning" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
    <!-- <script src="js/sb-admin-2.min.js"></script> -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        //If you are rendering a Select2 inside of a modal (Bootstrap 3.x) that has not yet been rendered or opened, you may need to bind to the shown.bs.modal event:
        $('body').on('shown.bs.modal', '.modal', function() {
            $(this).find('select').each(function() {
                var dropdownParent = $(document.body);
                if ($(this).parents('.modal.in:first').length !== 0)
                    dropdownParent = $(this).parents('.modal.in:first');
                $(this).select2({
                    dropdownParent: dropdownParent
                    // ...
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

</body>

</html>