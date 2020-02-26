<?php
$connect = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($connect);
pg_set_client_encoding($conn, "utf8");

$data = array();
$query = " SELECT clinic,name FROM clinic WHERE active_status = 'Y' ";
$result = pg_query($query);

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
<!DOCTYPE html>
<html>
<head>
  <title>ปฎิทินแสดงรายการตารางนัด </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/fullcalendar.css" />
  <link rel="stylesheet" href="css/bootstrap.css" />
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/select2.min.css" />
  <link rel="stylesheet" type="text/css" href="css/select2-bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


  <script>
   $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
                //left: 'prev , today , next  ',
                left: 'today , next  ',
                center: 'title',
                //right: 'month,agendaWeek,agendaDay'
                right:'month'
              },
              timeFormat: 'hh:mm',
              navLinks: true, 
              selectable: true,
              selectHelper: true,
              events: 'load.php?cli=คลินิกอายุรกรรม',
              select: function(start) {
                console.log(start);
               //location.reload();
             },
           });
  });
</script>
</head>
<body class="bg">
<!--   <br>

  <br /> -->
  <h2 align="center"><a href="#" ><span class="hdd">ปฎิทินแสดงรายการตารางนัด</span>&nbsp;<span class='hdd' id="clinic">คลินิกอายุรกรรม</span></a></h2>

  <div class="row">
    <div class="col-lg-12">  
     <form name="myForm" id="myForm"  class="form-group" action="" method="GET">
       <div class="col-lg-3"> </div>
       <div class="col-lg-3">      
        <select id="cli" name="cli" class="select2 form-control">
          <?php
          while($row = pg_fetch_array($result)) {
            $cli = $row['name']; 
            echo "<option value='".$cli."'>$cli</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-lg-4">
        <div onclick="formSubmit()" class="btn btn-default">ค้นหาตามคลินิกที่เลือก</div>
        <div onclick="funcholiday()" class="btn btn-danger" data-toggle="modal" data-target="#myModal" title="ตรวจสอบวันหยุดราขการ">วันหยุดราชการ</div>
                <div onclick="funclinicdoctor()" class="btn btn-info" title="">ปฏิทินนัด แยกแพทย์ แยกคลินิก</div>
      </div>
    </div>
  </div>
  <br />
  <div class="container">
   <div id="calendar"></div>
 </div>

 <script src="js/select2.min.js"></script>
 <script>
  function formSubmit(){
    var cli = document.getElementById("cli").value;
    var dataString = '&cli=' + cli;
    $('#clinic').html(cli);
    console.log(dataString);
    jQuery.ajax({
      url: "load.php",
      data: dataString,
      type: "GET",
      success: function(data){
        console.log(data);
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
         events: data
       })
      },
      error: function (err){
        console.log(err)
      }
    });
    return true;    
  }


</script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });  
</script>


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title ttd">วันหยุดราชการ</h4>
      </div>
      <div class="modal-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="">
          <thead>
            <tr class="ttl">
              <th width="18%"><center>วันที่หยุด</center></th>
              <th><center>วัน</center></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            while ($rowr = pg_fetch_array($queryr)) {
              ?>
              <tr>
                <td  class="ttr"><center><?= thaiDate($rowr["holiday_date"]) ?></center></td>
                <td  class="ttr" ><left><?= $rowr["day_name"] ?></left></td>
              </tr>
              <?php $ii++;
            } ?>
          </tbody>
        </table>

      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
  function funclinicdoctor(){
   window.location = "indexd.php";
  }
</script>
</body>
</html>