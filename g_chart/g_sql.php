<?php 
 /*include('../config/pg_con.class.php');
 	if (!$conn) {
 		die("Connection failed: " . mysqli_connect_error());
 	}
*/
	$sql = "SELECT b.name AS bward,count(a.an) AS cc 
		FROM ipt AS a 
		INNER JOIN ward AS b ON b.ward = a.ward
		WHERE  regdate = CURRENT_DATE 
		GROUP BY bward 
		LIMIT 10";
	
	$result = pg_query($conn, $sql);
	$admit_cur = [];
	if (pg_num_rows($result) > 0) {
		
		while($row = pg_fetch_assoc($result)) {
			$admit_cur[] = [
				'name' => $row['bward'],
				'value' => $row['cc']
			];
		}
	}
	pg_close($conn);

?>