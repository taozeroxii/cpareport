 <?php require "pg_con.class.php";
	$cli = $_GET['selector'];
	if ($cli == "cli") {
		$result = pg_query("SELECT * FROM officer_group WHERE officer_group_name like '%%แพทย์%%'");
		$resultArray = array();
		while ($row = pg_fetch_assoc($result)) {
			$resultArray[] =  array(
				'officer_group_id' => $row['officer_group_id'],
				'officer_group_name'   => $row['officer_group_name'],
			);
		}
		echo json_encode($resultArray);
	}
	?>
