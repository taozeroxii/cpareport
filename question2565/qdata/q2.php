<?php
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");
include "../config/my_con.class.php";
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
} else {
    $data_points = array();


    $result = mysqli_query($con, " SELECT b.lever_name as qq ,count( b.lever_name ) AS sumq1
    FROM question_detail as a
    INNER JOIN question_level as b ON a.q2 = b.level_number
    GROUP BY  qq 
    -- ORDER BY sumq1 DESC
     ");

    while ($row = mysqli_fetch_array($result)) {
           $point = array("label" => $row['qq'], "y" => $row['sumq1']);

        array_push($data_points, $point);
    }

    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}

mysqli_close($con);
?>