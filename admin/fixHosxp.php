<?php session_start(); ?>
<<<<<<< HEAD
<?php include("config.inc.php");include('../config/my_con.class.php'); ?>
=======
<?php include("config.inc.php");
include('../config/my_con.class.php'); ?>
>>>>>>> feb4ad4463a5df8458c44bf6452d626387e1b1d9
<!doctype html>

<head>
  <title>รวมปัญหาHOSxp</title>
  <meta charset="utf-8">
  <meta name="author" content="Yui Nakorn">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="css/bst.min.css" />
  <script src="js/j182.js"></script>
  <script src="js/j-dtb.js"></script>
  <script src="js/DT_bst.js"></script>
</head>

<body>
  <?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
    echo "<script>window.location ='../login.php';</script>";
<<<<<<< HEAD
  } ?>
  <?php
  $sqlr = " SELECT *  FROM cpareport_solving_problems ";
  $queryr = mysqli_query($con,$sqlr);
  ?>





  <?php include 'menu.php'; ?>
  <div class="container-fulid border" style="padding:20px">
    <div class="row">
      <div class="col-lg-3 col-12 border " style="margin-left:5px">
        <form class="mt-3" action="#" method="POST">
          <div class="form-group">
            <h3>เพิ่มรายการ</h3>
            <label for="namelist">ชื่อรายการ</label>
            <input type="text" class="form-control" id="namelist" aria-describedby="emailHelp" placeholder="ชื่อรายการ" required />
          </div>
          <div class="form-group">
            <label for="Info">รายละเอียด</label>
            <textarea type="text" class="form-control" id="Info" placeholder="รายละเอียดปัญหา" required></textarea>
          </div>
          <div class="form-group">
            <label for="namelist">link Google Doc </label>
            <input type="text" class="form-control" id="namelist" aria-describedby="emailHelp" placeholder="เช่น https://docs.google.com/document/d/1p" required />
          </div>
          <button type="submit" class="btn btn-primary" name="Submit" value="ยืนยัน">Submit</button>
        </form>
      </div>

=======
  }
  $sqlr = " SELECT *  FROM cpareport_solving_problems ";
  $queryr = mysqli_query($con, $sqlr);
  ?>




  <?php
  if (isset($_POST['Submit'])) {
    //echo $_POST["id"].$_POST["namelist"]. $_POST["Info"] . $_POST["linkdoc"] ;
    $insertsql = "INSERT INTO cpareport_solving_problems (fixid,namelist,list,link)
              VALUES ('" . $_POST["id"] . "'
              ,'" . $_POST["namelist"] . "'
              ,'" . $_POST["Info"]    . "'
              ,'" . $_POST["linkdoc"] . "' )";
    $queryInsert = mysqli_query($con, $insertsql);
    if ($queryInsert) {
      echo "<script>alert('เพิ่มข้อมูลเรียบร้อย');window.Location=fixHosxp.php;</script>";
    } else {
      // echo "<script>alert('มีการเพิ่มข้อมูลนี้แล้ว');window.Location=fixHosxp.php;</script>";
    }
  }

  $maxmenu = "SELECT MAX(fixid) AS last_id FROM cpareport_solving_problems";
  $qrymenu = mysqli_query($con, $maxmenu);
  $rscount = mysqli_fetch_assoc($qrymenu);
  $maxidmenu = $rscount['last_id'] + 1;
  ?>


  <?php include 'menu.php'; ?>
  <div class="container-fulid border" style="padding:20px">
    <div class="row">
      <div class="col-lg-3 col-12 border " style="margin-left:5px">
        <form class="mt-3" action="#" method="POST">
          <div class="form-group">
            <h3>เพิ่มรายการ <? echo $maxidmenu; ?></h3>
            <label for="namelist">ชื่อรายการ</label>
            <input type="text" class="form-control" id="namelist" name='namelist' aria-describedby="emailHelp" placeholder="ชื่อรายการ" required />
          </div>
          <div class="form-group">
            <label for="Info">รายละเอียด</label>
            <textarea type="text" class="form-control" id="Info" name='Info' placeholder="รายละเอียดปัญหา" required></textarea>
          </div>
          <div class="form-group">
            <label for="linkdoc">link Google Doc </label>
            <input type="hidden" name="id" value="<? echo $maxidmenu; ?>">
            <input type="text" class="form-control" id="linkdoc" name='linkdoc' aria-describedby="emailHelp" placeholder="เช่น https://docs.google.com/document/d/1p" required />
          </div>
          <button type="Submit" class="btn btn-secondary btn-block" name="Submit" value="submit">เพิ่ม</button>
        </form>
      </div>

>>>>>>> feb4ad4463a5df8458c44bf6452d626387e1b1d9

      <div class="col">
        <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
          <thead>
            <tr>
<<<<<<< HEAD
            <th  >
                <CENTER>ชื่อรายการ </CENTER>
              </th>
              <th  class="col">
                <CENTER> รายละเอียดปัญหา </CENTER>
              </th>
              <th>
                <CENTER> วิธีแก้ </CENTER>
=======
              <th>
                <CENTER>ชื่อรายการ </CENTER>
              </th>
              <th class="col">
                <CENTER> รายละเอียดปัญหา </CENTER>
              </th>
              <th>
                <CENTER> แก้ไข </CENTER>
              </th>
              <th>
                <CENTER> เพิ่มเติม </CENTER>
>>>>>>> feb4ad4463a5df8458c44bf6452d626387e1b1d9
              </th>
            </tr>
          </thead>
          <tbody>
<<<<<<< HEAD
            <?php  while ($rowr = mysqli_fetch_assoc($queryr)) { ?>
            <tr class="odd gradeX hoho">
              <!-- <td><CENTER><?= $i ?></CENTER></td> -->
              <td><?= $rowr["namelist"] ?></td>
              <td><?= $rowr["list"] ?></td>
              <td> <a href="<?echo  $rowr["link"]; ?>" target="blank">View</a></td>
             
            </tr>
            <?php $ii++; } ?>
=======
            <?php while ($rowr = mysqli_fetch_assoc($queryr)) { ?>
            <tr class="odd gradeX hoho">
              <td><?= $rowr["namelist"] ?></td>
              <td><?= $rowr["list"]; ?></td>
              <td>
                <button type="Submit" class="btn btn-warning" name="Submit" value="edit">Edit<?= $rowr["fixid"] ?></button>
              </td>
              <td>
                <a href="<? echo  $rowr["link"]; ?>" target="blank">
                  <button type="Submit" class="btn btn-success" name="Submit" value="edit">
                    View</button>
                </a>
              </td>
            </tr>
            <?php $ii++;
            } ?>
>>>>>>> feb4ad4463a5df8458c44bf6452d626387e1b1d9
          </tbody>
        </table>
      </div>
    </div>
  </div>



</body>

</html>