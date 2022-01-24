<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$today =  date('Y-m-d');
$ttime =  date('H:i:s');
$query = " SELECT * FROM eqit_minikiosk WHERE 1=1 AND mini_status = 'Y' ";
$result = mysqli_query($connect, $query);

$query_s = " SELECT * FROM eqit_mini_data WHERE 1=1 AND end_date IS NULL ";
$result_s = mysqli_query($connect, $query_s);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/sty.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="w3-container">
  <button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-black">Mini Kiosk</button>
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2>รายการ Mini Kiosk ที่ถูกยืม</h2>
      </header>
      <div class="w3-container">
      <?php $rw_s = 0;
                        while ($row_S = mysqli_fetch_array($result_s)) {
                            $rw_S++;
                        ?>
        <p>
        <?php echo  $row_S['mini_name']." ".$row_S['eq_datestart']." ".$row_S['eq_dep']." ".$row_S['eq_fname']." ".$row_S['eq_positiont']." ".$row_S['eq_note']; ?>
                                <?php } ?>
                                </p>
      </div>
      <footer class="w3-container w3-teal">
        <p> </p>
      </footer>
    </div>
  </div>
</div>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php
                $rw = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $rw++;
                ?>
                    <div class="col-md-6 col-lg-3 hover-div" data-toggle="modal" data-target="#staticBackdrop<?php echo $row['mini_name']; ?>">
                        <div class="card mx-30">
                            <img src="<?php echo "img/" . $row['keycode']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['mini_name']; ?>&nbsp;</h5>
                                <h6><?php echo $row['id_number']; ?>&nbsp;</h6>
                                <p class="card-text status-mini">
                                    <?php
                                    $mini_out_status = $row['mini_out_status'];
                                    if ($mini_out_status == "OK") {
                                        echo "<span class='sok'>พร้อมใช้งาน</span>";
                                    } else {
                                        echo "<span class='son'>ถูกยืมใช้งานอยู่</span>";
                                    }
                                    ?>
                                </p>
                                <!-- <div class="socials">
                                    <a href="#"><i class="fa fa-check-square-o"></i></a>
                                    <a href="#"><i class="fa fa-wifi"></i></a>
                                    <a href="#"><i class="fa fa-thumb-tack"></i></a>
                                    <a href="#"><i class="fa fa-info-circle"></i></a>
                                </div> -->
                            </div>
                        </div> <br>
                    </div>

                    <?php if ($mini_out_status == "OK") {  ?>
                        <!-- Addfrmstart -->
                        <div class="modal fade lg" id="staticBackdrop<?php echo $row['mini_name']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mo" id="staticBackdropLabel"><?php echo $row['mini_name']; ?>&nbsp;&nbsp;<sup><span class="nid"><?php echo $row['id_number']; ?></span></sup></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="frm-data" id="frm-data" method="POST" action="addsavemini.php">
                                            <input type="hidden" class="form-control" name="mini_name" id="mini_name" value="<?php echo $row['mini_name']; ?>">

                                            <div class="form-row">
                                                <div class="col-4">

                                                    <input type="text" class="form-control" name="eq_fname" id="eq_fname" value="" placeholder="ชื่อผู้ยืม" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" name="eq_lname" id="eq_lname" value="" placeholder="นามสกุลผู้ยืม" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" name="eq_tel" id="eq_tel" value="" placeholder="เบอร์โทรศัพท์" required>
                                                </div>
                                            </div>&nbsp;
                                            <div class="form-row">
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="eq_position" id="eq_position" value="" placeholder="ตำแหน่ง" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" name="eq_dep" id="eq_dep" value="" placeholder="หน่วยงาน" required>
                                                </div>
                                            </div>&nbsp;
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <input type="text" class="form-control" placeholder="วันที่ยืม" readonly>
                                                </div>
                                                <div class="col-3">
                                                    <input type="date" class="form-control" name="eq_datestart" id="eq_datestart" value="<?php echo $today; ?>" placeholder="วันที่ได้รับอุปกร์/หรือวันที่ยืม" required>
                                                </div>
                                                <div class="col-7">
                                                    <input type="text" class="form-control" name="eq_note" id="eq_note" value="" placeholder="จุดประสงค์ในการยืม" required>
                                                </div>
                                            </div>&nbsp;
                                            <div class="form-row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control" name="eq_fsend" id="eq_fsend" value="" placeholder="ผู้ให้ยืม" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" name="eq_fopsition" id="eq_fopsition" value="" placeholder="ตำแหน่ง" required>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" class="form-control" value="ศูนย์คอมพิวเตอร์" readonly>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" value="" name="submit" id="submit" class="btn btn-primary">บันทึกรายการยืม</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- Addfrmend -->
                    <?php } else { ?>

                        <div class="modal fade lg" id="staticBackdrop<?php echo $row['mini_name']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mo" id="staticBackdropLabel"><?php echo "<span class='mmh'> รายละเอียดผู้ยืม : </span>" . $row['mini_name']; ?>&nbsp;&nbsp;<sup><span class="nid"><?php echo $row['id_number']; ?></span></sup></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form name="frm-data" id="frm-data" method="POST" action="inkmini.php">
                                            <input type="hidden" class="form-control" name="mini_name" id="mini_name" value="<?php echo $row['mini_name']; ?>">
                                            <?php $a  = $row['mini_name'];
                                            $q   = " SELECT * FROM eqit_mini_data WHERE 1=1 AND mini_name = '$a' AND end_date IS NULL ";
                                            $res = mysqli_query($connect, $q);
                                            $ro  = mysqli_fetch_array($res);
                                            $pdf_file = $ro['eq_file'];

                                            ?>
                                            <form name="frm-data" id="frm-data" method="POST" action="addsavemini.php">
                                                <input type="hidden" class="form-control" name="mini_name" id="mini_name" value="<?php echo $ro['mini_name']; ?>">

                                                <div class="form-row">
                                                    <div class="col-4">

                                                        <input type="text" class="form-control" name="eq_fname" id="eq_fname" value="" placeholder="<?php echo $ro['eq_fname']; ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="eq_lname" id="eq_lname" value="" placeholder="<?php echo $ro['eq_lname']; ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="eq_tel" id="eq_tel" value="" placeholder="<?php echo $ro['eq_tel']; ?>" readonly>
                                                    </div>
                                                </div>&nbsp;
                                                <div class="form-row">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="eq_position" id="eq_position" value="" placeholder="<?php echo $ro['eq_position']; ?>" readonly>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="eq_dep" id="eq_dep" value="" placeholder="<?php echo $ro['eq_dep']; ?>" readonly>
                                                    </div>
                                                </div>&nbsp;
                                                <div class="form-row">
                                                    <div class="col-2">
                                                        <input type="text" class="form-control" placeholder="วันที่ยืม" readonly>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" name="eq_datestart" id="eq_datestart" value="<?php echo $ro['eq_datestart']; ?>" placeholder="วันที่ได้รับอุปกร์/หรือวันที่ยืม" readonly>
                                                    </div>
                                                    <div class="col-2">
                                                        <input type="text" class="form-control" placeholder="จุดประสงค์" readonly>
                                                    </div>
                                                    <div class="col-5">
                                                        <input type="text" class="form-control" name="eq_note" id="eq_note" value="" placeholder="<?php echo $ro['eq_note']; ?>" readonly>
                                                    </div>
                                                </div>&nbsp;
                                                <div class="form-row">
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="eq_fsend" id="eq_fsend" value="" placeholder="<?php echo $ro['eq_fsend']; ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" name="eq_fopsition" id="eq_fopsition" value="" placeholder="<?php echo $ro['eq_fopsition']; ?>" readonly>
                                                    </div>
                                                    <div class="col-4">
                                                        <input type="text" class="form-control" value="ศูนย์คอมพิวเตอร์" readonly>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-row">
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="วันที่ส่งคืน" readonly>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="date" class="form-control" name="end_date" id="end_date" value="<?php echo $today; ?>" placeholder="" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" name="eq_from_name" id="eq_from_name" value="" placeholder="ผู้ส่งคืน" required>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" name="eq_to_name" id="eq_to_name" value="" placeholder="ผู้รับคืน" required>
                                                    </div>
                                                </div>&nbsp;
                                                <div class="form-row">
                                                    <div class="col-3">
                                                        <input type="text" class="form-control" placeholder="สถานะอุปกรณ์ที่ส่งคืน" readonly>
                                                    </div>
                                                    <div class="col-3">
                                                        <select class="form-control" name="check_device" id="check_device">
                                                            <option value="1">ปกติ</option>
                                                            <option value="2">ชำรุด</option>
                                                            <option value="3">ไม่ครบ</option>
                                                            <option value="4">เสียหาย</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="text" class="form-control" name="device_note" id="device_note" value="" placeholder="ระบุเพิ่มเติม">
                                                    </div>
                                                </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="" value="" name="" id="" class="btn btn-info" onclick="location.href='pdf/<?php echo $pdf_file; ?>.pdf'">พิมพ์ใบยืม</button>
                                        <button type="submit" value="" name="submit" id="submit" class="btn btn-primary">ส่งคืนอุปกรณ์</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </form>

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


    <script language="javascript">
        // $(document).ready(function() {

        //     $("#submit").click(function() {

        //         var mini_name = $("#mini_name").val();
        //         var eq_fname = $("#eq_fname").val();
        //         var eq_lname = $("#eq_lname").val();
        //         var eq_tel = $("#eq_tel").val();
        //         var eq_position = $("#eq_position").val();
        //         var eq_dep = $("#eq_dep").val();
        //         var eq_datestart = $("#eq_datestart").val();
        //         var eq_note = $("#eq_note").val();
        //         var eq_fsend = $("#eq_fsend").val();
        //         var eq_fopsition = $("#eq_fopsition").val();

        //         var dataString = 'mini_name=' + mini_name + '&eq_fname=' + eq_fname + '&eq_lname=' + eq_lname + '&eq_tel=' + eq_tel + '&eq_position=' + eq_position + '&eq_dep=' + eq_dep + '&eq_datestart=' + eq_datestart + '&eq_note=' + eq_note + '&eq_fsend=' + eq_fsend + '&eq_fopsition=' + eq_fopsition;

        //         if (mini_name == '') {
        //             swal("ไม่พบ ID");
        //             return false;
        //         } else {
        //             $.ajax({
        //                 type: "POST",
        //                 url: "addsavemini.php",
        //                 data: dataString,
        //                 cache: false,
        //                 success: function(result) {
        //                     console.log(result);
        //                     if (result.statusCode = 200) {
        //                         swal("Success", "บันทึกข้อมูลสำเร็จ");
        //                          window.location = "index.php";
        //                     } else {
        //                         swal("Error", "ไม่สามารถรายการได้");
        //                     }
        //                 }
        //             });
        //         }
        //         return false;
        //     });
        // });
    </script>

</body>

</html>