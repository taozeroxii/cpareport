 <?php
require "pg_con.class.php";
 	$icd101 = $_GET['selector'];
    if($icd101 == "icd101"){
    	$result= pg_query(" SELECT * from icd101 limit 1000");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'code' => $row['code'],
							 'name'  => $row['name'],
							 );
 		} 
 		echo json_encode($resultArray);
    }
   
 ?>