<?php include("config.inc.php"); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Yui Nakorn">
  <title>ยา</title>
  <link rel="stylesheet" type="text/css" href="css/DT_bst.css">
  <link rel="stylesheet" type="text/css" href="css/bst.min.css">
  <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/j-dtb.js"></script>
  <script src="js/DT_bst.js"></script>
</head>
<body>
  <p> </p>
  <div class="headmain">รูปยาเม็ดเปลือยในโรงพยาบาลเจ้าพระยาอภัยภูเบศร</div>
  <div class="container" style="margin-top: 10px; width: 95%;">
    <table cellpadding="0" cellspacing="0" border="0" class="table " id="example">


      <p> </p>
      <thead>
        <tr class="headsub">
         <th> </th>
       </tr>
     </thead>
     <tbody>
      <?php 
      $sqlr = "SELECT * FROM drug_picfile";
      $queryr = mysqli_query($mysqli,$sqlr);
      //  $ii = 1;
      while($rowr = mysqli_fetch_array($queryr)) {
      //  $i = str_pad($ii,2,"0",STR_PAD_LEFT);
        ?>

        <tr class="odd gradeX">
          <? $pic =$rowr["file"]?>
          <? $drug_name =$rowr["name"]?>
          <td><div class="bp"><img class="pic" src="picdrug/<?=$pic;?>" title="ชื่อยา : <?=$drug_name;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$rowr["name"]?></div></td>
        </tr>

        <?php  $ii++;	} ?>
      </tbody>
    </table>
  </div>

  <center><div><a href="#"> <type="button" title="abhai bhubajhr Information Hospital" ><font size="3px"><B>By:eaktamp<B> </font></center></div>

</body>
</html>