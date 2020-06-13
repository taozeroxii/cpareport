<?php require "pg_con.class.php";
 	$glab = $_GET['selector'];
    if($glab == "glab"){
    	$result= pg_query("SELECT * FROM lab_items_group ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'lab_id' => $row['lab_items_group_code'],
							 'lab_group_name'  => $row['lab_items_group_name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>