 <?php 	require "pg_con.class.php";
 	$doctor = $_GET['selector'];
    if($doctor == "doctor"){
    	$result= pg_query(" SELECT * from doctor WHERE name not like '%%ยกเลิก%%' AND name not like '%%BMS%%'  AND active = 'Y' ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'code' => $row['code'],
							 'name'  => $row['name'],
							 'licenseno'  => $row['licenseno'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>