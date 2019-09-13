 <?php require "pg_con.class.php";
 	$icd = $_GET['selector'];
    if($pct == "icd"){
    	$result= pg_query(" SELECT * FROM icd9cm1 ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'code' => $row['code'],
							 'name'   => $row['name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>