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
        .bb {
            box-sizing: border-box;
            /* width: 80%; */
            /* background: #85C1E9; */
            text-align: center;
            border-radius: 12px;
            padding: 0.3%;
            margin: 0.1%;
            font-size: 1em;
            ;

        }
    </style>
</head>

<body>
    <div class="w3-container w3-teal">
        <h1>IP Addess Fix Cpa Hospital.
            <button data-toggle="modal" data-target="#myModal" class="btn btn-dark "><b> Vlan Help Zone NetWork</b> </button>
            <form method='GET' action='index.php'>
                <button class="btn btn-warning" name="vlan" type="submit" value=""><b> main </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="5','8,','20','22','24','25','26','27','28','29','31','32','36','43','44','50"><b> All </b> </button>
                <!-- <button class="btn btn-warning" name="" type="" value="nullv"><b> ว่าง </b> </button>
                <button class="btn btn-warning" name="" type="" value="openv"><b> ใช้งาน </b> </button> -->
                <button class="btn btn-warning" name="vlan" type="submit" value="20"><b> 20 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="22"><b> 22 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="24"><b> 24 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="25"><b> 25 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="26"><b> 26 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="27"><b> 27 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="28"><b> 28 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="29"><b> 29 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="31"><b> 31 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="32"><b> 32 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="36"><b> 36 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="43"><b> 43 </b> </button>
                <button class="btn btn-warning" name="vlan" type="submit" value="44"><b> 44 </b> </button>
            </form>
        </h1>
    </div>

    <br>
    <?php

    //$nullv = $_GET['nullv'];
    //$openv = $_GET['openv'];

     $vlangroup =  $_GET['vlan'];
 
     $nullvlan = "20";

    if ($vlangroup != "") {
        $vlan = $vlangroup; 
       } else {
        $vlan = $nullvlan;
      }
     $vlan = $vlan;
   

    $query = " SELECT * 
               FROM network_ipfix_zone 
               WHERE vlan in ('$vlan') 
               -- AND flage = 'Y'
               ORDER BY vlan ASC,num_group ASC ";
    $result = mysqli_query($connect, $query);
    ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

                <?php
                $flage = $row['flage'];
                if ($flage == "Y") {
                ?>
                    <!-- <div class="col-2 bb"> -->
                    <button title="<?php echo $row["ipaddess"]; ?> ว่าง ใช้งานได้ " name="edit" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-primary  edit_data col-1 bb"> <?php echo $row["ipaddess"]; ?></button>
                    <!-- </div> -->
                <?php
                } else {
                ?>
                    <!-- <div class="col-2 bb"> -->
                    <button title="<?php echo $row["ipaddess"]; ?> มีคนครอบครอง" name="view" value="<?php echo $row["id"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-danger  view_data col-1 bb "> <?php echo $row["ipaddess"]; ?></button>
                    <!-- </div> -->
                <?php
                }
                ?>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
<style>
    .tt {
        display: table;

        width: 100%;
    }

    .ttr {
        border-color: coral;
        border: 1px solid #CCD1D1;
        padding: 1%;
        font-weight: bold;
    }
</style>

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                <h4 class="modal-title">VLAN ZONE CHECK</h4>
            </div>
            <div class="modal-body" id="">
                <table class="tt">
                    <tr class="ttr">
                        <td>V2020</td>
                        <td>20</td>
                        <td>อาคารเฉลิมพระเกียรติฯ</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2022 </td>
                        <td>22</td>
                        <td>อาคารชวนโปรดทิพย์</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2024</td>
                        <td>24</td>
                        <td>อาคารสุวัทนา</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2025</td>
                        <td>25</td>
                        <td>อาคาร สูติกรรมพิเศษ 114เตียง</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2026 </td>
                        <td>26</td>
                        <td>อาคารแผนไทย</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2027 </td>
                        <td>27</td>
                        <td>อาคารอาชีวะ อาชีวเวชกรรม</td>
                    </tr>
                    <tr class="ttr">
                        <td>V2028 </td>
                        <td>28</td>
                        <td>อาคาร 75 ปี</td>
                    </tr>
                    <tr class="ttr">
                        <td> V2029 </td>
                        <td>29</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2031 </td>
                        <td>31</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2032 </td>
                        <td>32</td>
                        <td>อาคารอุติเหตุฉุกเฉิน</td>
                    </tr>
                    <tr class="ttr">
                        <td> V2036 </td>
                        <td>36</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2043 </td>
                        <td>43</td>
                        <td></td>
                    </tr>
                    <tr class="ttr">
                        <td> V2044</td>
                        <td>44</td>
                        <td>อาคาร สูติกรรมเก่า เพชรัตน์-สุวัทนา</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label>IP Addess || วันที่ขอใช้ <?php echo $today; ?></label>
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