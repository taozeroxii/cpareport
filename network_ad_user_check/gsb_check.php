<?php //session_start(); ?>
<?php
include('../config/my_con.class.php');
date_default_timezone_set('asia/bangkok');
function thaiDate($datetime)
{
  if (!is_null($datetime)) {
    list($date, $time) = split('T', $datetime);
    list($Y, $m, $d) = split('-', $date);
    $Y = $Y + 543;
    switch ($m) {
      case "01":
        $m = "ม.ค.";
        break;
      case "02":
        $m = "ก.พ.";
        break;
      case "03":
        $m = "มี.ค.";
        break;
      case "04":$m = "เม.ย.";
        break;
      case "05":
        $m = "พ.ค.";
        break;
      case "06":
        $m = "มิ.ย.";
        break;
      case "07":
        $m = "ก.ค.";
        break;
      case "08":
        $m = "ส.ค.";
        break;
      case "09":
        $m = "ก.ย.";
        break;
      case "10":
        $m = "ต.ค.";
        break;
      case "11":
        $m = "พ.ย.";
        break;
      case "12":
        $m = "ธ.ค.";
        break;
    }
    return $d . " " . $m . " " . $Y . "";
  }
  return "";
}
  $sqlr = " SELECT * FROM gsb_datacheck ";
  $queryr = mysqli_query($con, $sqlr);

?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="author" content="Yui Nakorn">
  <title>หน้าแรก</title>
  <link rel="stylesheet" type="text/css" href="css/DT_bst.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bst.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <script src="js/j182.js"></script>
  <script src="js/j-dtb.js"></script>
  <script src="js/DT_bst.js"></script>
 
</head>

<body>
  <?php //if ((isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null)|| $_SESSION['status']!='1') {
   // echo "<script>window.location ='../login.php';</script>";
  //}
   ?>

  <?php //include "menu.php"; ?>

  <hr>
  <div class="phone_head">GSB <br>
    <hr><?php// echo "<span class='new_u'>ผู้ใช้งานล่าสุด </span><span class='new_sql'>" . $new_nuer . "</span>"; ?></hr>

  </div>
  </CENTER>
  <div class="container col-lg-10" style="margin-top: 10px">
    <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
      <thead>
        <tr>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
          <th><center> test </center></th>
        </tr>
      </thead>
      <tbody>

        <?php 
        while ($rowr = mysqli_fetch_array($queryr)) {
          ?>

        <tr class="odd gradeX hoho">
          <td><?php echo $rowr['gsb_personid']; ?></td>
          <td><?php echo $rowr['pname']; ?></td>
          <td><?php echo $rowr['fname']; ?></td>
          <td><?php echo $rowr['lname']; ?></td>
          <td><?php echo $rowr['gsb_age']; ?></td>
          <td><?php echo $rowr['gsb_cid']; ?></td>
          <td><?php echo $rowr['gsb_emp_type']; ?></td>
          <td><?php echo $rowr['gsb_startdate']; ?></td>
          <td><?php echo $rowr['gsb_enddate']; ?></td>
          <td><?php echo $rowr['gsb_groupname']; ?></td>
        </tr>
        <?php 
        } 
        ?>
      </tbody>
    </table>
  </div>
  <center>
    <div><a href="#">
        <type="button" title="abhai bhubajhr Information Hospital">
          <font size="3px"><B>By:Information<B> </font>
  </center>
  </div>
</body>
</html>