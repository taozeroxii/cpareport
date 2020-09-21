<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="Social Buttons for Bootstrap" />
    <meta property="og:description" content="A beautiful replacement for JavaScript's 'alert' for Bootstrap" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://lipis.github.io/bootstrap-sweetalert/" />
    <meta property="og:image" content="http://lipis.github.io/bootstrap-social/assets/bootstrap-sweetalert.png" />

    <title> LOAD EXCEL FILE  </title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.1.js"></script>
    <link href="assets/docs.css" rel="stylesheet">

    <!-- This is what you need -->
    <script src="dist/sweetalert.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <!--.......................-->

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-42119746-3', 'auto');
      ga('send', 'pageview');
    </script>
  </head>
<body>


<?php
set_time_limit(0); 
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('asia/bangkok');

//Connect DB
$mysqli = new mysqli('172.16.0.251','report','report','cpareportdb');
if ($mysqli->connect_errno) {
    die( "Failed to connect to MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8");


$xfile = "gsb_".date('Y_m');
 
//File สำหรับ Import
$inputFileName="excelfile/".$xfile.".xlsx";
 
/** PHPExcel */
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';
 
/** PHPExcel_IOFactory - Reader */
include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
 
 
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  
 
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();
 
$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];
 
$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}
 
$sql = " DELETE FROM gsb_datacheck ";
$res = $mysqli->query($sql);

foreach ($namedDataArray as $resx) {

    $gsb_personid   = $resx['gsb_personid'];
    $pname          = $resx['pname'];
    $fname          = $resx['fname'];
    $lname          = $resx['lname'];
    $gsb_cid        = $resx['gsb_cid'];
    $gsb_startdate  = $resx['gsb_startdate'];
    $gsb_perstatus  = $resx['gsb_perstatus'];
    $gsb_emp_type   = $resx['gsb_emp_type'];
    $gsb_enddate    = $resx['gsb_enddate'];
    $gsb_age        = $resx['gsb_age'];
    $gsb_groupname  = $resx['gsb_groupname'];

   $UNIX_DATE_s = \PHPExcel_Style_NumberFormat::toFormattedString($gsb_startdate, 'DD/MM/YYYY');
   $pp = explode("/", $UNIX_DATE_s);
    $dd  =  str_pad($pp[0],2,'0',STR_PAD_LEFT);
    $mm  =  $pp[1];
    $yy  =  ($pp[2]-543);
    $gsb_startdate = $yy.'-'.$mm.'-'.$dd; 

    $UNIX_DATE_e = \PHPExcel_Style_NumberFormat::toFormattedString($gsb_enddate, 'DD/MM/YYYY');
    $ee = explode("/", $UNIX_DATE_e);
     $ddd  =  str_pad($ee[0],2,'0',STR_PAD_LEFT);
     $mmm  =  $ee[1];
     $yyy  =  ($ee[2]-543);
    $gsb_enddate = $yyy.'-'.$mmm.'-'.$ddd; 

      $query = " INSERT INTO gsb_datacheck (gsb_personid,pname,fname,lname,gsb_cid,gsb_startdate,gsb_perstatus,gsb_emp_type,gsb_enddate,gsb_age,gsb_groupname) 
      VALUES ('$gsb_personid','$pname','$fname','$lname','$gsb_cid','$gsb_startdate','$gsb_perstatus','$gsb_emp_type','$gsb_enddate','$gsb_age','$gsb_groupname')";
      $res_i = $mysqli->query($query); 
}
$mysqli->close();
?>
<script>
  $(window).load(function(){
        swal({
            title: "Success",
            text: "นำเข้าข้อมูล Excel สำเร็จ",
            type: "success",
            // showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "OK",
            // closeOnConfirm: false
            },
        function(){
            location.replace("index.php");
        });
    });

</script>
    <script>
      !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
    </script>
      </body>
</html>
