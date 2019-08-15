<?php session_start(); ?>
<?php
include("config.inc.php");
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
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/DT_bst.css">
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
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="../" role="tab" aria-controls="home" aria-selected="true">หน้าแรก</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="../test.php" role="tab" aria-controls="profile" aria-selected="false">เพิ่มQuery</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
    <a href="../logout.php"><button class="btn btn-secondary btn-sm" style="float:right; margin-top:0.2em;">ออกจากระบบ</button> </a>
    <? echo "<span  class='new_sql' style='float:right; margin-top:0.6%; margin-right:2em;'>".'ผู้ใช้งาน : '.$_SESSION['fname'] . ' ' . $_SESSION['lname']; ?> STATUS: <? if ($_SESSION['status'] == '1') { echo "admin"; } ?> </span>
  </ul>







  <hr>
  <div class="phone_head">วันหยุดในระบบ HosXp <span class="not"><sup>* ถ้ามีประกาศหยุดให้เข้าไปเพิ่มในระบบ HosXp มีผลกับการนัดผู้ป่วย</sup></span>
  </div>
</CENTER>
<div class="container" style="margin-top: 10px">
  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">
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
        <?php $ii++;
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