<?php
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$today =  date('Y-m-d');
$ttime =  date('H:i:s');
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row["s_id"]; ?>">
                                                    <div class="ssb-icon-aa"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                    <h2 class="ssb-title-aa"><?php echo $row["server_ip"]; ?></h2>

                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal<?php echo $row["s_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-aa" id="frm-aa" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $row["s_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-aa" name="btn-aa" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-md-3">
                                            <div class="square-service-block-bb">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row["s_id"]; ?>">
                                                    <div class="ssb-icon-bb"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                    <h2 class="ssb-title-bb"><?php echo $row["server_ip"]; ?></h2>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal<?php echo $row["s_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-bb" id="frm-bb" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $row["s_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-bb" name="btn-bb" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
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
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rows["w_id"]; ?>">
                                                                <div class="ssb-icon-cc"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-cc"><?php echo $rows["sw_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal<?php echo $rows["w_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-cc" id="frm-cc" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $rows["w_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-cc" name="btn-cc" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-dd">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rows["w_id"]; ?>">
                                                                <div class="ssb-icon-dd"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-dd"><?php echo $rows["sw_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal<?php echo $rows["w_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-dd" id="frm-dd" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $rows["w_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-dd" name="btn-dd" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
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
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rowu["u_id"]; ?>">
                                                                <div class="ssb-icon-ee"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-ee"><?php echo $rowu["ups_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal<?php echo $rowu["u_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-ee" id="frm-ee" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $rowu["u_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-ee" name="btn-ee" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="col-md-3">
                                                        <div class="square-service-block-ff">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rowu["u_id"]; ?>">
                                                                <div class="ssb-icon-ff"><i class="fa fa-desktop" aria-hidden="true"></i></div>
                                                                <h2 class="ssb-title-ff"><?php echo $rowu["ups_name"]; ?></h2>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="exampleModal<?php echo $rowu["u_id"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">บันทึกการตรวจสอบระบบ <?php echo "Date : <sup>".$today." ".$ttime."</sup>";?></h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="" name="frm-ff" id="frm-ff" method="POST">
                                                            <div class="mb-3">
                                                                <div id="radioBtn" class="btn-group ">
                                                                    <a class="btn btn-primary btn-lg active" data-toggle="cstatus" data-title="Y"><i class="fa fa-check" aria-hidden="true"></i> ปกติ </a>
                                                                    <a class="btn btn-danger btn-lg notActive" data-toggle="cstatus" data-title="N"><i class="fa fa-times" aria-hidden="true"></i> ผิดปกติ</a>
                                                                </div>
                                                                <input type="hidden" name="cstatus" id="cstatus" value="Y" >
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="form-control" id="msg" name="msg" placeholder="บันทึกเพิ่มเติม"></textarea>
                                                            </div>
                                                            <input type="hidden" name="id_device" id="id_device" value="<?php echo $rowu["u_id"]; ?>" >
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" id="btn-ff" name="btn-ff" class="btn btn-primary btn-block">บันทึกสถานะ</button>
                                                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">ยกเลิก</button>

                                                    </div>
                                                </div>
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
<script>
    $('#radioBtn a').on('click', function() {
        var sel = $(this).data('title');
        var tog = $(this).data('toggle');
        $('#' + tog).prop('value', sel);

        $('a[data-toggle="' + tog + '"]').not('[data-title="' + sel + '"]').removeClass('active').addClass('notActive');
        $('a[data-toggle="' + tog + '"][data-title="' + sel + '"]').removeClass('notActive').addClass('active');
    })
</script>



<script type="text/javascript">
		$(document).ready(function() {	
			$("#btn-aa").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-aa").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message); 
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});
	
			$("#btn-bb").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-bb").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message);
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});

			$("#btn-cc").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-cc").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message); 
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});
	
			$("#btn-dd").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-dd").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message); 
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});
		
			$("#btn-ee").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-ee").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message); 
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});
	
			$("#btn-ff").click(function() {
					$.ajax({
					   type: "POST",
					   url: "datacheck.php",
					   data: $("#frm-ff").serialize(),
					   success: function(result) {
							if(result.status == 1) // Success
							{
								alert(result.message); 
                                location.reload();
							}
							else // Err
							{
								alert(result.message);
                                location.reload();
							}
					   }
					 });
			});
		});
</script>

</html>