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

/*
//SWITCH
$query = " SELECT * 
FROM network_switch 
WHERE 1=1
AND check_monitor ='Y'
ORDER BY vlan ASC,num_group ASC ";
$result = mysqli_query($connect, $query);


//UPS
$query = " SELECT * 
FROM network_ups 
WHERE 1=1
AND check_monitor ='Y'
ORDER BY vlan ASC,num_group ASC ";
$result = mysqli_query($connect, $query);
*/


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
    <style>
        h1 {
            /* color: green; */
            text-align: center;
        }

        div.one {
            margin-top: 40px;
            text-align: center;
        }

        button {
            margin-top: 10px;
        }

        body {
            background-color: #000;
            /* color: #CCD1D1; */
        }

        hr {
            height: 1px;
            background-color: #ccc;
            border: none;
        }

        .hh3 {
            color: greenyellow;
        }

        .hh1 {
            color: #18C0F0;
        }

        .bb {
            font-size: 0.8em;
        }

        .hhh {
            text-align: center;
            color: #566573;
        }
    </style>
</head>

<body>
    <h3 class="text-center hhh">CHECK : SERVER | NETWORK | SWITCH | UPS | TEMP | ELECTRIC <h3>
            <div class="container-fluid text-center">
                <h3 class="text-center hh3">Mode Server .<h3>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                                $exp = $row['server_expdate'];
                            if ($exp > $today) {
                        ?>
                                <button class="btn btn-info  col-md-2 bb"><?php echo $row["server_ip"]; ?></button>
                            <?php
                            } else {
                            ?>
                                <button class="btn btn-danger  col-md-2 bb"><?php echo $row["server_ip"]; ?></button>
                        <?php
                            }
                        }
                        ?>
            </div>
            <hr>
            <div class="container-fluid text-center">
                <h3 class="text-center hh3">Mode Switch.<h3>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {

                        ?>

                            <button title="<?php echo $row["ipaddess"]; ?> ว่าง ใช้งานได้ " name="edit" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-info  edit_data col-md-2 bb text-left">
                                <?php echo $row["ipaddess"]; ?>
                            </button>
                        <?php
                        }

                        ?>
            </div>
            <hr>
            <div class="container-fluid text-center">
                <h3 class="text-center hh3">Mode UPS.<h3>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <button title="<?php echo $row["ipaddess"]; ?> ว่าง ใช้งานได้ " name="edit" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-info  edit_data col-md-2 bb  text-left">
                                <?php echo $row["ipaddess"]; ?>
                            </button>
                        <?php
                        }
                        ?>
            </div>

</body>

</html>




<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">ผลการตรวจสอบระบบ</h4>
                <h6><?php echo $today; ?></h6>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label>สถานะตรวจเช็ค</label>
                    <input type="text" name="ipaddess" id="ipaddess" class="form-control" readonly />
                    <br />
                    <label>หมายเหตุ</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                    <br />
                    <input type="hidden" name="employee_id" id="employee_id" />
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success btn-lg btn-block" />
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#add').click(function() {
            $('#insert').val("Insert");
            $('#insert_form')[0].reset();
        });
        $(document).on('click', '.edit_data', function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                dataType: "json",
                success: function(data) {
                    $('#ipaddess').val(data.ipaddess);
                    $('#updatedate').val(data.updatedate);
                    $('#telephone').val(data.telephone);
                    $('#location').val(data.location);
                    $('#note').val(data.note);
                    $('#employee_id').val(data.id);
                    $('#insert').val("Update");
                    $('#add_data_Modal').modal('show');
                }

            });
        });
        $('#insert_form').on("submit", function(event) {
            event.preventDefault();
            if ($('#ipaddess').val() == "") {
                alert("ipaddess is required");
                //  } else if ($('#updatedate').val() == '') {
                //      alert("updatedate is required");
            } else if ($('#telephone').val() == '') {
                alert("telephone is required");
            } else if ($('#location').val() == '') {
                alert("location is required");
            } else if ($('#note').val() == '') {
                alert("note is required");
            } else {
                $.ajax({
                    url: "insert.php",
                    method: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#insert').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#employee_table').html(data);
                        location.reload();
                    }
                });
            }
        });
        $(document).on('click', '.view_data', function() {
            var employee_id = $(this).attr("id");
            if (employee_id != '') {
                $.ajax({
                    url: "select.php",
                    method: "POST",
                    data: {
                        employee_id: employee_id
                    },
                    success: function(data) {
                        $('#employee_detail').html(data);
                        $('#dataModal').modal('show');

                    }
                });
            }
        });
    });
</script>