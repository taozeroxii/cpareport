<?php require "pg_con.class.php";
 	$host = $_GET['selector'];
    if($host == "host"){
    	$result= pg_query(" SELECT hospcode,concat(hospcode,' ',hosptype,name) AS hostname FROM hospcode WHERE chwpart = '25' ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'hospcode' => $row['hospcode'],
							 'hostname'   => $row['hostname'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>
