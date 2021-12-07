<?php session_start(); ?>
<?php
include("../config/pg_con.class.php");
date_default_timezone_set('asia/bangkok');
function thaiDate($datetime)
{
  if (!is_null($datetime)) {
    @list($date, $time) = explode('T', $datetime);
    @list($Y, $m, $d) = explode('-', $date);
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
      case "04":
      $m = "เม.ย.";
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
$sqlr = " SELECT holiday_date,day_name 
FROM holiday 
WHERE day_name NOT IN ('เสาร์','อาทิตย์')
AND holiday_date > CURRENT_DATE
ORDER BY holiday_date ASC ";
$queryr = pg_query($sqlr);
?>
<!doctype html>
<html>

<head>
<meta charset="utf-8">
  <meta name="author" content="Yui Nakorn">
  <title>วันหยุดในระบบHOSxp</title>
  <link rel="stylesheet" type="text/css" href="css/DT_bst.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/bst.min.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <script src="js/j182.js"></script>
  <script src="js/j-dtb.js"></script>
  <script src="js/DT_bst.js"></script>
</head>

<body>
  <?php if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
    echo "<script>window.location ='../login.php';</script>";
  } ?>
 <?php include 'menu.php';?>

  <hr>
  <div class="phone_head">วันหยุดในระบบ HosXp <span class="not"><sup>* ถ้ามีประกาศหยุดให้เข้าไปเพิ่มในระบบ HosXp มีผลกับการนัดผู้ป่วย</sup></span>
  </div>
</CENTER>
<div class="container" style="margin-top: 10px">
  <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="">
    <thead>
      <tr>
        <th>
          <CENTER>DATE TH</CENTER>
        </th>
        <th>
          <CENTER>DATE </CENTER>
        </th>
        <th>
          <CENTER>NAME </CENTER>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php 
      while ($rowr = pg_fetch_array($queryr)) {
        ?>
        <tr class="odd gradeX hoho">
          <td><?= thaiDate($rowr["holiday_date"]) ?></td>
          <td><?= $rowr["holiday_date"] ?></td>
          <td><?= $rowr["day_name"] ?></td>
        </tr>
        <?php @$ii++;
      } ?>
    </tbody>
  </table>
</div>
<center>
  <div><a href="#">
    <type="button" title="abhai bhubajhr Information Hospital">
    <!-- <font size="3px"><B>INFORMATION<B> </font> -->
    </center>
  </div>
</body>

</html>