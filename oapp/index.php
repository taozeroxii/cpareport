<?php
$connect = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($connect);
pg_set_client_encoding($conn, "utf8");

$data = array();
$query = " SELECT clinic,name FROM clinic WHERE active_status = 'Y' ";
$result = pg_query($query);
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
  <br>

  <br />
  <h2 align="center"><a href="#" ><span class="hdd">ปฎิทินแสดงรายการตารางนัด</span>&nbsp;<span class='hdd' id="clinic">คลินิกอายุรกรรม</span></a></h2>
  <div class="row">
    <div class="col-lg-12">  
     <form name="myForm" id="myForm"  class="form-group" action="" method="GET">
       <div class="col-lg-4"> </div>
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

</body>
</html>