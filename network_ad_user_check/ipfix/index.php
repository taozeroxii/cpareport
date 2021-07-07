<?php
date_default_timezone_set('asia/bangkok');
$connect = mysqli_connect("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($connect, "utf8");
$today =  date('Y-m-d H:i:s');

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
    </style>
</head>

<body>
    <div class="container-fluid text-center">
        <h1 class="hh1">Mode Vlan Group Cpa Hospital & Config Network. </h1>
        <button class="btn btn-info col-md-3" onclick="window.open('dashboard.php');" name="" type="" value=""><b> Dashboard </b> </button>
        <button class="btn btn-success col-md-3" onclick="window.open('check.php');" name="" type="" value=""><b> Monitor Check </b> </button>
        <button data-toggle="modal" data-target="#myModal" class="btn btn-dark col-md-3"><b>VLAN CHECK Gatway Subnet DNS</b> </button>
    </div>
    <div class="container">
        <form method='GET' action='index.php'>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value=""><b> main </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="0','1','2','4','5','8,','20','21','22','24','25','26','27','28','29','31','32','36','43','44','76','80','50"><b> All </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="170"><b> Public </b> </button>
            <button class="btn btn-danger col-md-2" name="vlan" type="submit" value="serv"><b> Server </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="8','14"><b> Other </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="76"><b> Wifi 76 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="vpn"><b>Clinic 304 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="0"><b> 0 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="1"><b> 1 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="2"><b> 2 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="4"><b> 4 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="5"><b> 5 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="20"><b> 20 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="21"><b> 21 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="22"><b> 22 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="24"><b> 24 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="25"><b> 25 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="26"><b> 26 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="27"><b> 27 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="28"><b> 28 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="29"><b> 29 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="31"><b> 31 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="32"><b> 32 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="36"><b> 36 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="40"><b> 40 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="43"><b> 43 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="44"><b> 44 </b> </button>
            <button class="btn btn-warning col-md-2" name="vlan" type="submit" value="80"><b> 80 </b> </button>

        </form>

    </div>
    <hr>
    <h3 class="text-center hh3">Mode IP Addess Fix Cpa Hospital.<h3>
            <br>
            <?php
            $vlangroup =  $_GET['vlan'];
            $nullvlan = "20";
            if ($vlangroup != "") {
                $vlan = " vlan in ('$vlangroup') ";
            } else {
                $vlan = " vlan in ('$nullvlan') ";
            }

            $vlan = $vlan;
            $query = " SELECT * 
               FROM network_ipfix_zone 
               WHERE $vlan 
               ORDER BY vlan ASC,num_group ASC ";
            $result = mysqli_query($connect, $query);
            ?>

            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>

                            <?php
                            $flage = $row['flage'];
                            if ($flage == "Y") {
                            ?>

                                <button title="<?php echo $row["ipaddess"]; ?> ว่าง ใช้งานได้ " name="edit" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-info  edit_data col-md-2 bb"> <?php echo $row["ipaddess"]; ?></button>

                            <?php
                            } else {
                            ?>

                                <button title="<?php echo $row["ipaddess"]; ?> มีคนครอบครอง" name="view" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-danger  view_data col-md-2 bb"> <?php echo $row["ipaddess"]; ?></button>

                            <?php
                            }
                            ?>





                        <?php
                        }
                        ?>

                    </div>

                </div>

            </div>

</body>

</html>
<style>
    .tt {
        display: table;

        width: 100%;

    }

    .trr {
  font-size: 0.6em;
    }

    .fo {
        color: #000;
    }
</style>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">Data VLAN CHECK Gatway Subnet DNS</h4>
            </div>
            <?php
            $sql1 = " SELECT * FROM network_vlan_subnet ";
            $sql_row = mysqli_query($connect, $sql1);
            ?>
            <div class="modal-body" id="">
              
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">location</th>
                            <th scope="col">Vlan</th>
                            <th scope="col">IP</th>
                            <th scope="col">Gateway</th>
                            <th scope="col">Subnet</th>
                            <th scope="col">DNS1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row_sub = mysqli_fetch_array($sql_row)) {
                        ?>
                            <tr class="trr">
                                <th scope="row"><?php echo $row_sub['location']; ?></th>
                                <td><?php echo $row_sub['vlan']; ?></td>
                                <td><?php echo $row_sub['ip']; ?></td>
                                <td><?php echo $row_sub['gateway']; ?></td>
                                <td><?php echo $row_sub['location']; ?></td>
                                <td title="DNS1 Default 172.16.0.62 | DNS2 Fix Random 1 IP [1.1.1.1 | 8.8.8.8 | 8.8.4.4]"><?php echo $row_sub['dns1'] . " | 1.1.1.1"; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div id="dataModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <!-- <h4 class="modal-title">ทดสอบ</h4> -->
            </div>
            <div class="modal-body" id="employee_detail">
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<div id="add_data_Modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">เพิ่มข้อมูล IP Addess Fix</h4>
                <h6><?php echo $today; ?></h6>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label>IP Addess</label>
                    <input type="text" name="ipaddess" id="ipaddess" class="form-control" readonly />
                    <br />
                    <label>ตำแหน่ง IP Addess</label>
                    <input type="text" name="location" id="location" class="form-control" value="ทดสอบ" />
                    <br />
                    <label> เบอร์โทรศัพท์</label>
                    <input type="text" name="telephone" id="telephone" class="form-control" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" />
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