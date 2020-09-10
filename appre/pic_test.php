<?php
// header("Content-type : image/jpeg");
// header('Content-Type: image/gif');
//  header('Content-Type: image/png');
// header('Content-Type: image/jpeg');
include "../config/pg_con.class.php";
?>
<!DOCTYPE html>
<html>

<head>
	<!-- <title></title>
	<script src="images/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="images/standalo.css" />
	<link rel="stylesheet" type="text/css" href="images/tabs-acc.css" />
	<meta http-equiv="Content-Type" content="text/html;charset=windows-1252">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet"> -->

</head>

<body>
<?php 
	

		// $sql = " SELECT * FROM patient_image WHERE 1 = 1 limit 1  ";
		// $result = pg_query($sql);
		// while ($row_result = pg_fetch_array($result)) {
        




            $rs = pg_query($conn, "SELECT image FROM patient_image WHERE 1 = 1 limit 1");

            header('Content-type: image/jpeg');
            echo base64_decode($rs);

      //   echo   $image = pg_unescape_bytea(pg_fetch_result($rs, 0, 0));




?>


        <?php      
        /* 
             $image	 = $row_result['image'];
               $escaped = pg_escape_bytea($image);  
             echo base64_decode($image);
             */
        ?>
            <!-- <img src="<?//=$image;?>"> -->
         <?php  
     //   }
		?>

	


</body>

</html>