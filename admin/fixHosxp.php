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
      case "01": $m = "ม.ค.";
        break;
      case "02":$m = "ก.พ.";
        break;
      case "03":$m = "มี.ค.";
        break;
      case "04":$m = "เม.ย.";
        break;
      case "05": $m = "พ.ค.";
        break;
      case "06": $m = "มิ.ย.";
        break;
      case "07": $m = "ก.ค.";
        break;
      case "08": $m = "ส.ค.";
        break;
      case "09": $m = "ก.ย.";
        break;
      case "10": $m = "ต.ค.";
        break;
      case "11": $m = "พ.ย.";
        break;
      case "12":  $m = "ธ.ค.";
        break;
    }
    return $d . " " . $m . " " . $Y . "";
  }
  return "";
}
$sqlr = " SELECT DISTINCT b.loginname,a.computername
,date(a.ksklogintime) as cdate
,to_char(a.ksklogintime, 'HH24:MI:SS') as ctime
,a.department,a.ip_address,b.name
FROM onlineuser as a
INNER JOIN opduser as b ON a.kskloginname = b.loginname
WHERE date(a.ksklogintime) = CURRENT_DATE
ORDER BY cdate,ctime DESC ";
$queryr = pg_query($sqlr);

$sql = " SELECT DISTINCT b.loginname,a.computername
,date(a.ksklogintime) as cdate
,to_char(a.ksklogintime, 'HH24:MI:SS') as ctime
,a.department,a.ip_address,b.name
FROM onlineuser as a
INNER JOIN opduser as b ON a.kskloginname = b.loginname
WHERE date(a.ksklogintime) = CURRENT_DATE
ORDER BY cdate,ctime DESC
LIMIT 1 ";
$q = pg_query($sql);
$r = pg_fetch_array($q);
$new_nuer = $r['name'] . " | " . $r['loginname'] . " | " . $r['computername'] . " | " . $r['ip_address'] . " | " . $r['department'] . " | " . thaiDate($r['cdate']) . " | " . $r['ctime'];
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="author" content="Yui Nakorn">
    <title>รวมปัญหาHOSxp</title>
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
    <?php include 'menu.php'; ?>

    <div class="container-ful">
        <div class="row">

        </div>
        <div class="row">
            <div class="container col-lg-10" style="margin-top: 10px">
                <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                    <thead>
                        <tr>
                            <th>
                                <CENTER> รายการ </CENTER>
                            </th>
                            <th>
                                <CENTER> เพิ่มเติม </CENTER>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php  //  $ii = 1;
                       // while ($rowr = pg_fetch_array($queryr)) {
                            //   $i = str_pad($ii,4,"0",STR_PAD_LEFT);
                            ?>
                        <tr class="odd gradeX hoho">
                            <!-- <td><CENTER><?= $i ?></CENTER></td> -->
                            <td><?= $rowr[""] ?></td>
                            <td><?= $rowr[""] ?></td>
                        </tr>
                        <?php $ii++;
                       // } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>