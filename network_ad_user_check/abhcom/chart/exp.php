<?php
	$database_host 			= '172.16.0.21';
	$database_username 		= 'root';
	$database_password 		= 'Cpa@10665';
	$database_name 			= 'cpadb';
	$mysqli = new mysqli($database_host, $database_username, $database_password, $database_name);
	$mysqli->set_charset("utf8");
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	$get_data = $mysqli->query(" SELECT YEAR(com_exp) as name,COUNT(*) as y
                                    FROM com_detail
                                    WHERE 1 = 1
                                    AND com_exp IS NOT NULL
                                    GROUP BY name
                                    ORDER BY name DESC ");
                                    
	while($data = $get_data->fetch_assoc()){
		
		$result[] = $data;
	}
		
	echo $json = json_encode( $result, JSON_NUMERIC_CHECK);
?>