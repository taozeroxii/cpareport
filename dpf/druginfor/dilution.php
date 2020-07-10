<?php include("config.inc.php"); 
?>
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
      <style>
.button {
  background-color: #4CAF50; /* Green */
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

.button4:hover {background-color: #e7e7e7;}

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
<div class="phone_head">Incompat-stability-ยาฉีด 63  <hr>

<a href="incompatibility.php"> <button class="button button2" title="เลือกหัวข้อรายการ"> IV incompatibility</button></a>&nbsp;&nbsp;&nbsp;
        <a href="dilution.php"> <button class="button button3" title="เลือกหัวข้อรายการ">ความคงตัวยาฉีด</button></a>

      
    </div>
    <div class="container-fluid" style="margin-top: 10px">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered " id="example"   style="margin-top: 20px">        
            <thead>
                   <tr class="ttr">
                    <th><CENTER> ลำดับ </CENTER></th>
                    <th><CENTER> Trade </CENTER></th>
                    <th><CENTER> Generic  </CENTER></th>
                    <th><CENTER> ความแรง </CENTER></th>
                    <th> <CENTER> สารละลายที่ใช้ผสม (Reconstitution) </CENTER></th>
                    <th><CENTER> ความคงตัว อุณหภูมิห้อง </CENTER></th>
                    <th> <CENTER> ความคงตัว2 ตู้เย็น 2-8 องศา </CENTER></th>
                    <th><CENTER>วิถีการให้ยา </CENTER></th>
                    <th> <CENTER> Dilution for IV </CENTER></th>
                    <th> <CENTER> ความคงตัว3 อุณหภูมิห้อง </CENTER></th>
                    <th> <CENTER> ความคงตัว4 ตู้เย็น 2-8 องศา </CENTER></th>
                </tr>
            </thead>
            <tbody>
                <?php 
			$sqlr = "SELECT trade,generic,speeddrug,recon,tempc,ice228,stdrug,dilu,icedefile,ice428 FROM drug_iv_dilution  WHERE flage = '1' ";
			$queryr = mysql_query($sqlr);
			$ii = 1;
			while($rowr = mysql_fetch_array($queryr)) {
				$i = str_pad($ii,3,"0",STR_PAD_LEFT);
	 ?>
                <tr class="odd gradeX hoho">
                    <td><CENTER><?=$i?></CENTER></td>
                    <td><?=$rowr["trade"]?></td>
                    <td><?=$rowr["generic"]?></td>
                    <td><?=$rowr["speeddrug"]?></td>
                    <td><?=$rowr["recon"]?></td>
                    <td><CENTER>
                      <?php $tempc = $rowr["tempc"];
                           if ($tempc == "0") {
                        echo " <img src='img/f.png' alt='' class='iim'> ";  
                      } else {
                        echo $tempc;
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $ice228 = $rowr["ice228"];
                           if ($ice228 == "0") {
                        echo " <img src='img/f.png' alt='' class='iim'> ";  
                      } else {
                        echo $ice228;
                      }
                      ?>
                    </CENTER></td>
                    <td><?=$rowr["stdrug"]?></td>
                    <td><?=$rowr["dilu"]?></td>
                    <td><CENTER>
                      <?php $icedefile = $rowr["icedefile"];
                           if ($icedefile == "0") {
                        echo " <img src='img/f.png' alt='' class='iim'> ";  
                      } else {
                        echo $icedefile;
                      }
                      ?>
                    </CENTER></td>
                    <td><CENTER>
                      <?php $ice428 = $rowr["ice428"];
                           if ($ice428 == "0") {
                        echo " <img src='img/f.png' alt='' class='iim'> ";  
                      } else {
                        echo $ice428;
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