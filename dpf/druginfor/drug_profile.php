<?php include("config.inc.php");
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="Yui Nakorn">
    <title>บัญชีรายการยา โรงพยาบาลเจ้าพระยาอภัยภูเบศร 2565 </title>
    <link rel="stylesheet" type="text/css" href="css/DT_bst.css">
    <link rel="stylesheet" type="text/css" href="css/bst.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }

        .cc {
            border-top: solid #CCC 1px;
            width: 960px;
            margin: 100px auto 30px auto;
            padding: 20px auto;
            text-align: center;
        }

        .phone_head {
            text-align: center;
            width: 100%;
            padding: 1%;
            margin: 1%;
            font-size: 1.4em;
            font-weight: bold;
            color: green;
            font-family: 'Kanit', sans-serif;
        }

        .hoho:hover {
            background: #F4D3AB;
            cursor: pointer;
            color: #000;
            font-weight: bold;
        }

        .tel_ole:hover {
            color: #DD1C65;
            cursor: pointer;
        }

        .tel_ole {
            color: #43A28F;
            cursor: pointer;
        }

        .iim {
            width: 20px;
            height: 20px;
        }

        .ttr {
            background: #0C1E66;
            color: #FFF;
            font-weight: bold;
        }
    </style>
    <style>
        .button {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            font-weight: bold;
        }

        .button1 {
            background-color: white;
            color: black;
            border: 2px solid #4CAF50;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
        }

        .button2 {
            background-color: white;
            color: black;
            border: 2px solid #008CBA;
        }

        .button2:hover {
            background-color: #008CBA;
            color: white;
        }

        .button3 {
            background-color: white;
            color: black;
            border: 2px solid #f44336;
        }

        .button3:hover {
            background-color: #f44336;
            color: white;
        }

        .button4 {
            background-color: white;
            color: black;
            border: 2px solid #e7e7e7;
        }

        .button4:hover {
            background-color: #e7e7e7;
        }

        .button5 {
            background-color: white;
            color: black;
            border: 2px solid #555555;
        }

        .button5:hover {
            background-color: #555555;
            color: white;
        }
    </style>
    <script src="js/j182.js"></script>
    <script src="js/j-dtb.js"></script>
    <script src="js/DT_bst.js"></script>
    <script language="JavaScript">
        function chkdel() {
            if (confirm('  กรุณายืนยันการลบอีกครั้ง !!!  ')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="phone_head">บัญชีรายการยา โรงพยาบาลเจ้าพระยาอภัยภูเบศร 2565
        <hr>

        <a href="drug_profile.php"> <button class="button button2" title="เลือกหัวข้อรายการ"> บัญชีรายการยา </button></a>&nbsp;&nbsp;&nbsp;
        <a href="drug_ng.php"> <button class="button button3" title="เลือกหัวข้อรายการ"> บัญชี ง. </button></a>

    </div>
    <div class="container-fluid" style="margin-top: 10px">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="example" style="margin-top: 20px">
            <thead>

                <tr class="ttr">
                        <th><CENTER>ID</CENTER></th>
                        <th><CENTER>name_drug</CENTER></th>
                        <th><CENTER>name_system</CENTER></th>
                        <th><CENTER>therapeutic_main_gr</CENTER></th>
                        <th><CENTER>therapeutic_sub_gr</CENTER></th>
                        <th><CENTER>drug_detail</CENTER></th>
                        <th><CENTER>drug_laver</CENTER></th>
                        <th><CENTER>drug_qty</CENTER></th>
                        <th><CENTER>drug_group</CENTER></th>
                        <th><CENTER>drug_group_detail</CENTER></th>
                        <th><CENTER>uc</CENTER></th>
                        <th><CENTER>sss</CENTER></th>
                        <th><CENTER>ocf</CENTER></th>
                        <th><CENTER>doctor_add</CENTER></th>
                        <th><CENTER>note</CENTER></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlr = "SELECT name_drug,name_system,therapeutic_main_gr,therapeutic_sub_gr,
                drug_detail,drug_laver,drug_qty,drug_group,drug_group_detail,uc,sss,ocf,doctor_add,
                note,drug_group_type,drug_status,dateupdate  
                FROM drug_acc  WHERE 1 = 1 AND drug_status = 'Y' AND drug_group_type = 'Y'";
                $queryr = mysqli_query($mysqli, $sqlr);
                $ii = 1;
                while ($rowr = mysqli_fetch_array($queryr)) {
                    $i = str_pad($ii, 3, "0", STR_PAD_LEFT);
                ?>
                    <tr class="odd gradeX hoho">
                        <td>
                            <CENTER><?= $i ?></CENTER>
                        </td>
                        <td><?= $rowr["name_drug"] ?></td>
                        <td><?= $rowr["name_system"] ?></td>
                        <td><?= $rowr["therapeutic_main_gr"] ?></td>
                        <td><?= $rowr["therapeutic_sub_gr"] ?></td>
                        <td><?= $rowr["drug_detail"] ?></td>
                        <td><?= $rowr["drug_laver"] ?></td>
                        <td><?= $rowr["drug_qty"] ?></td>
                        <td><?= $rowr["drug_group"] ?></td>
                        <td><?= $rowr["drug_group_detail"] ?></td>
                        <td><?= $rowr["uc"] ?></td>
                        <td><?= $rowr["sss"] ?></td>
                        <td><?= $rowr["ocf"] ?></td>
                        <td><?= $rowr["doctor_add"] ?></td>
                        <td><?= $rowr["note"] ?></td>


                    </tr>
                <?php $ii++;
                }; ?>
            </tbody>
        </table>

    </div>

    <center>
        <div><a href="#">
                <type="button" title="abhai bhubajhr Information Hospital">
                    <font size="3px"><B>Information Hospital<B> </font>
    </center>
    </div>
</body>

</html>