<?php session_start(); ?>
<?php include("config.inc.php");include('../config/my_con.class.php'); ?>
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
            <input type="text" class="form-control" id="namelist" aria-describedby="emailHelp" placeholder="ชื่อรายการ key word" required />
          </div>
          <div class="form-group">
            <label for="Info">รายละเอียด</label>
            <textarea type="text" class="form-control" id="Info" placeholder="รายละเอียดปัญหา" required></textarea>
          </div>
          <div class="form-group">
            <label for="fix">วิธีแก้ไขปัญหาเบื้องต้น</label>
            <textarea type="text" class="form-control" id="fix" placeholder="วิธีแก้ไขปัญหาเบื้องต้น" required></textarea>
          </div>
          <div class="form-group">
            <label for="namelist">link Google Doc วิธีแก้ไขปัญหาแบบละเอียด</label>
            <input type="text" class="form-control" id="namelist" aria-describedby="emailHelp" placeholder="เช่นhttps://drive.google.com/file" required />
          </div>
          <button type="submit" class="btn btn-primary" name="Submit" value="ยืนยัน">Submit</button>
        </form>
      </div>


      <div class="col">
        <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
          <thead>
            <tr>
              <th  class="col">
                <CENTER> รายละเอียดปัญหา </CENTER>
              </th>
              <th>
                <CENTER> วิธีแก้ </CENTER>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php  while ($rowr = mysqli_fetch_assoc($queryr)) { ?>
            <tr class="odd gradeX hoho">
              <!-- <td><CENTER><?= $i ?></CENTER></td> -->
              <td><?= $rowr["list"] ?></td>
              <td> <a href="<?echo  $rowr["link"]; ?>" target="blank">View</a></td>
             
            </tr>
            <?php $ii++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>



</body>

</html>