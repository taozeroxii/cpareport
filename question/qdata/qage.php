<?php
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");
include "../config/my_con.class.php";
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
} else {
    $data_points = array();


    $result = mysqli_query($con, " SELECT b.q_agename as age,count(*) AS total 
                                    FROM question_detail AS a
                                    INNER JOIN question_age AS b ON a.age = b.id
                                    GROUP BY a.age ; ");

    while ($row = mysqli_fetch_array($result)) {
           $point = array("label" => $row['age'], "y" => $row['total']);

        array_push($data_points, $point);
    }

    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}

mysqli_close($con);
?>