 <?php require "pg_con.class.php";
 	$cli = $_GET['selector'];
    if($cli == "cli"){
    	$result= pg_query(" SELECT* FROM clinic order by clinic");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'clinic' => $row['clinic'],
							 'name'   => $row['name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>
