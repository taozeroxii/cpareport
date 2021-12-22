<?php include("config.inc.php"); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="author" content="Yui Nakorn">
    <title> บัญชียา รวมทุก รพช. 63 </title>
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
        color: #D35400;
        font-family: 'Kanit', sans-serif;
    }

    .hoho:hover {
        background: #F0BEEE;
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
    .iim{
      width: 20px;
      height: 20px;
    }
    .ttr{
      background: #004535;
      color: #FFF;
      font-weight: bold;
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
    <div class="phone_head">บัญชียาโรงพยาบาลชุมชน รวมทุก รพช. 63
      
    </div>
    <div class="container-fluid" style="margin-top: 10px">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="example"   style="margin-top: 20px">        
            <thead>
                <tr class="ttr">
                    <th><CENTER> ลำดับ </CENTER></th>
                    <th><CENTER> ชื่อยา </CENTER></th>
                    <th><CENTER> รูปแบบ/ความแรง </CENTER></th>
                    <th><CENTER> category level 1 </CENTER></th>
                    <th> <CENTER> category level 2 </CENTER></th>
                    <th><CENTER> กบินทร์บุรี </CENTER></th>
                    <th> <CENTER> บ้านสร้าง </CENTER></th>
                    <th><CENTER>ประจันตคาม </CENTER></th>
                    <th> <CENTER> ศรีมหาโพธิ </CENTER></th>
                    <th> <CENTER> นาดี </CENTER></th>
                    <th> <CENTER> ศรีมโหสถ </CENTER></th>
                </tr>
            </thead>
            <tbody>
                <?php 
			$sqlr = "SELECT * FROM drug_data  WHERE flage = 'Y' ";
			$queryr = mysqli_query($mysqli ,$sqlr);
			$ii = 1;
			while($rowr = mysqli_fetch_array($queryr)) {
				$i = str_pad($ii,3,"0",STR_PAD_LEFT);
	 ?>
                <tr class="odd gradeX hoho">
                    <td><CENTER><?=$i?></CENTER></td>
                    <td><?=$rowr["name"]?></td>
                    <td><?=$rowr["formatstr"]?></td>
                    <td><?=$rowr["category_level_a"]?></td>
                    <td><?=$rowr["category_level_b"]?></td>

                    <td><CENTER>
                      <?php $k = $rowr["k"];
                           if ($k == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $c = $rowr["c"];
                           if ($c == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $p = $rowr["p"];
                           if ($p == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $s = $rowr["s"];
                           if ($s == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $n = $rowr["n"];
                           if ($n == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $h = $rowr["h"];
                           if ($h == "1") {
                        echo " <img src='img/t.png' alt='' class='iim'> ";  
                      } else {
                        echo " <img src='img/f.png' alt='' class='iim'>  ";
                      }
                      ?>
                    </CENTER></td>

                </tr>
                <?php  $ii++;	};?>
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