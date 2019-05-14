 <?php require "pg_con.class.php";
 	$ins = $_GET['selector'];
    if($ins == "ins"){
    	$result= pg_query(" SELECT * FROM pttype ORDER BY pttype ASC ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'pttype' => $row['pttype'],
							 'name'  => $row['name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>