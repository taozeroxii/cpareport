<?php
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$today =  date('Y-m-d');

//server
$query = " SELECT * 
FROM network_check_server 
WHERE 1=1
ORDER BY id ASC ";
$result = mysqli_query($connect, $query);

//SW
$querys = " SELECT * 
FROM network_check_swicth 
WHERE 1=1
ORDER BY id ASC ";
$results = mysqli_query($connect, $querys);

//UPS
$queryu = " SELECT * 
FROM network_check_ups 
WHERE 1=1
ORDER BY id ASC ";
$resultu = mysqli_query($connect, $queryu);

?>

<!DOCTYPE html>
<html>

<head>
    <title>IP Addess Fix Cpa Hospital 2020 </title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="st.css">

</head>

<body>
    <h3 class="text-center hhh">CHECK : SERVER | NETWORK | SWITCH | UPS | TEMP | ELECTRIC <h3>
            <div class="container-fluid text-center">
                <h3 class="text-center hh3">Mode Server .<h3>
                        <div class="container">
                            <div class="row">
                                <?php while ($row = mysqli_fetch_array($result)) {
                                    $exp = $row['server_expdate'];
                                    if ($exp > $today) {
                                ?>
                                        <div class="col-md-3">
                                            <div class="square-service-block-aa">
                                                <a href="#">
                                                    <div class="ssb-icon-aa"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                    <h2 class="ssb-title-aa"><?php echo $row["server_ip"]; ?></h2>
                                                    
                                                </a>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-3">
                                            <div class="square-service-block-bb">
                                                <a href="#">
                                                    <div class="ssb-icon-bb"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                    <h2 class="ssb-title-bb"><?php echo $row["server_ip"]; ?></h2>
                                                </a>
                                            </div>
                                        </div>

                                <?php
                                    }
                                }
                                ?>

                            </div>
                        </div>

                        <!--  -->

                        <hr>
                        <div class="container-fluid text-center">
                            <h3 class="text-center hh3">Mode Switch.<h3>
                                    <div class="container">
                                        <div class="row">
                                            <?php while ($rows = mysqli_fetch_array($results)) {
                                                $exp = $rows['sw_expdate'];
                                                if ($exp > $today) {
                                            ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-cc">
                                                            <a href="#">
                                                                <div class="ssb-icon-cc"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-cc"><?php echo $rows["sw_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-dd">
                                                            <a href="#">
                                                                <div class="ssb-icon-dd"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-dd"><?php echo $rows["sw_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                        </div>
                        <hr>
                        <div class="container-fluid text-center">
                            <h3 class="text-center hh3">Mode UPS.<h3>
                                    <div class="container">
                                        <div class="row">
                                            <?php while ($rowu = mysqli_fetch_array($resultu)) {
                                                $exp = $rowu['ups_expdate'];
                                                if ($exp > $today) {
                                            ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-ee">
                                                            <a href="#">
                                                                <div class="ssb-icon-ee"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-ee"><?php echo $rowu["ups_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-ff">
                                                            <a href="#">
                                                                <div class="ssb-icon-ff"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-ff"><?php echo $rowu["ups_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>

                                            <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                    </div>
                        </div>

</body>

</html>


