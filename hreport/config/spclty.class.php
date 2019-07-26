 <?php require "pg_con.class.php";
 	$pct = $_GET['selector'];
    if($pct == "pct"){
    	$result= pg_query(" SELECT * FROM spclty WHERE active_status = 'Y' ORDER BY spclty ASC ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'spclty' => $row['spclty'],
							 'name'   => $row['name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>