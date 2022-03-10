<?php
// header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once "./connect.php";
$requestMethod = $_SERVER["REQUEST_METHOD"];
if ($requestMethod == 'GET') {
    $sql = "SELECT o1.hn,o1.vn,concat ( pt.pname, pt.fname, ' ', pt.lname ) AS patientname,pt.birthday,
	CONCAT ( o2.rxdate, ' ', o2.rxtime ) AS presctime,o3.NAME AS doctor,	o1.spclty AS cliniccode,
	CONCAT ( s.NAME, ' / ', K.department ) AS clinicname,o2.icode AS itemcode,d.NAME AS itemname,
	o2.qty,d.units,CONCAT ( d2.name1, d2.name2, d2.name3 ) 
FROM	ovst o1
	JOIN patient pt ON o1.hn = pt.hn
	JOIN opitemrece o2 ON o1.vn = o2.vn
	JOIN opduser o3 ON o2.staff = o3.loginname
	JOIN kskdepartment K ON o2.dep_code = K.depcode
	JOIN spclty s ON o1.spclty = s.spclty
	JOIN drugitems d ON o2.icode = d.icode
	JOIN drugusage d2 ON o2.drugusage = d2.drugusage WHERE o1.vstdate BETWEEN '2022-03-10' AND '2022-03-10' limit 10";

    $statement = $conn->query($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
   // print_r($result);

    if (count($result)) {
        $response = array(
            'status' => true,
            'response' => $result
        );
        http_response_code(200);
        echo json_encode($response);
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
}
