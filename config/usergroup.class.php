 <?php require "pg_con.class.php";
	$usergroup = $_GET['selector'];
	if ($usergroup == "usergroup") {
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
