 <?php require "pg_con.class.php";
 	$clinic = $_GET['selector'];
    if($clinic == "clinic"){
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