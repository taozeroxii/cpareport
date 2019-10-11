<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CODE ERROR F43 </title>
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lumen/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
  <style>
    body { 
      background-color: #fafafa;
      font-family: 'Kanit', sans-serif; 
    }
    .container { 
      margin: 150px auto; 
    }
    .hh{
      text-align: center;
      font-size: 1.2em;
      font-weight: bold;
    }
  </style>
</head>
<?php 
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con,"utf8");
$sql = " SELECT * FROM f43_check_code_error Order BY id ASC";
$res = mysqli_query($con, $sql);
?>
<body>
  <div id="jquery-script-menu">
    <div class="jquery-script-center">
<!-- <ul>
<li><a href="https://www.jqueryscript.net/table/table-rows-search.html">Download This Plugin</a></li>
<li><a href="https://www.jqueryscript.net/">Back To jQueryScript.Net</a></li>
</ul> -->
<div class="jquery-script-ads"><script type="text/javascript"><!--
  google_ad_client = "ca-pub-2783044520727903";
  google_ad_slot = "2780937993";
  google_ad_width = 728;
  google_ad_height = 90;
</script>
<script type="text/javascript"
src="https://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<div class="jquery-script-clear"></div>
</div>
</div>
<div class="container">
  <h1>Check Code Error F43 <sup>โค้ด Error F43 แฟ้มส่งออก </sup></h1>
  <input type="text" id="input" placeholder="Search " class="form-control">
  <table id="table" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="hh">Id_Code</th>
        <th class="hh">Code_Name</th>
        <th class="hh">File_name</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $rw == 0;
      foreach ($res as $item) {
        $rw++;
        ?>
        <tr>
          <td><?php echo $item['id_code']; ?></td>
          <td><?php echo $item['code_name']; ?></td>
          <td><?php echo $item['file_name']; ?></td>
        </tr>
        <?php
      } ?>
    </tbody>

  </table>
</div>
</body>
<script  src="table_search.js"></script>
<script>

  $('#input').keyup(function () {
    table_search($('#input').val(),$('#table tbody tr'),'012');
  });


</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>
