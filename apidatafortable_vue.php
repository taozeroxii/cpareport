<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 3600');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}
header('X-Powered-By: taotestapi');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$errres = [];
$requestMethod = $_SERVER["REQUEST_METHOD"];

// กรณีแนบ token มากับ header เพื่อมาเช็คด้วย ให้ใชเ curl หรือ axios post ไปเช็ค token 
// $token = null;
// $headers = apache_request_headers();
// if (isset($headers['Authorization'])) {
//     $matches = array();
//     preg_match('/Token token="(.*)"/', $headers['Authorization'], $matches);
//     if (isset($matches[1])) {
//         $token = $matches[1];
//     }
// }

if ($requestMethod == 'POST') {
    //connect postgre
    $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
    $conn = pg_connect($connstring);
    pg_set_client_encoding($conn, "WIN874");

    //connect mysql
    define('DBUSER', 'report');
    define('DBPWD', 'report');
    define('DBHOST', '172.16.0.251');
    define('DBNAME', 'cpareportdb');
    $con = new mysqli(DBHOST, DBPWD, DBPWD, DBNAME);

    // ค่าที่ post มาจาก fontend
    $data = json_decode(file_get_contents('php://input'), true);
    // print_r($data);
    $sqlid =  empty($data["sql"]) ? '' : pg_escape_string($conn, $data["sql"]);
    $date1 =  empty($data["date1"]) ? '' : pg_escape_string($conn, $data["date1"]);
    $date2 =  empty($data["date2"]) ? '' : pg_escape_string($conn, $data["date2"]);
    $sdiag =  empty($data["sdiag"]) ? '' : pg_escape_string($data["sdiag"]);
    $ediag =  empty($data["ediag"]) ? '' : pg_escape_string($data["ediag"]);
    $stime =  empty($data["time1"]) ? '' : pg_escape_string($data["time1"]);
    $etime =  empty($data["time2"]) ? '' : pg_escape_string($data["time2"]);

    if (sizeof($data["kskdepartments"]) > 0) {
        $arcc = 0; //ไว้นับจำนวนช่อง array
        $kskdepartments = '(';
        foreach ($data["kskdepartments"] as $value) {
            $arcc++;
            $kskdepartments .= $value;
            if (sizeof($data["kskdepartments"]) != $arcc) {
                $kskdepartments .= ',';
            }
        }
        $kskdepartments .= ')';
    } else {
        $kskdepartments = "(select depcode from kskdepartment  order by depcode)";
    }

    if (sizeof($data["pttype"]) > 0) {
        $arcc = 0; //ไว้นับจำนวนช่อง array
        $selectpty = '(';
        foreach ($data["pttype"] as $value) {
            $arcc++;
            $selectpty .= $value;
            if (sizeof($data["pttype"]) != $arcc) {
                $selectpty .= ',';
            }
        }
        $selectpty .= ')';
    } else {
        $selectpty = "(select pttype from pttype order by pttype)";
    }

    if (sizeof($data["spclty"]) > 0) {
        $arcc = 0; //ไว้นับจำนวนช่อง array
        $spclty = '(';
        foreach ($data["spclty"] as $value) {
            $arcc++;
            $spclty .= $value;
            if (sizeof($data["spclty"]) != $arcc) {
                $spclty .= ',';
            }
        }
        $spclty .= ')';
    } else {
        $spclty = "(select spclty from spclty order by spclty)";
    }

    if (sizeof($data["ward"]) > 0) {
        $arcc = 0; //ไว้นับจำนวนช่อง array
        $ward = '(';
        foreach ($data["ward"] as $value) {
            $arcc++;
            $ward .= $value;
            if (sizeof($data["ward"]) != $arcc) {
                $ward .= ',';
            }
        }
        $ward .= ')';
    } else {
        $ward = "(select code from ward  order by code)";
    }

    if (sizeof($data["doctor"]) > 0) {
        $arcc = 0; //ไว้นับจำนวนช่อง array
        $doctor = '(';
        foreach ($data["doctor"] as $value) {
            $arcc++;
            $doctor .= $value;
            if (sizeof($data["doctor"]) != $arcc) {
                $doctor .= ',';
            }
        }
        $doctor .= ')';
    } else {
        $doctor = "(select code from doctor  order by code)";
    }

    //ตัวแปรที่ใช้ตอบกลับ ================================================================
    // ชุด table แรก
    $sql_code = '';
    $fieldnames = [];
    $detaildata = [];
    $rowcount = 0;
    $sqlreplace = '';
    // ชุด table สอง
    $sql_subcode_1 = '';
    $fieldnames2 = [];
    $detaildata2 = [];
    $rowcount2 = 0;
    $sqlreplace2 = '';

    $sql = "SELECT * FROM cpareport_sql where sql_file = '$sqlid'";
    $querysqlmenu = mysqli_query($con, $sql);
    while ($mydata  = mysqli_fetch_assoc($querysqlmenu)) { //เอา id ที่ได้รับจากเมนูมาเพื่อดึง query ที่เก็บไว้ใน ฐาน mysql เราเอง
        $sql_code =  $mydata['sql_code'];
        $sql_subcode_1 =  $mydata['sql_subcode_1'];
    }

    // หากมี query
    if ($sql_code != '') {
        $sqlreplace =  $sql_code;
        //เปลียนค่าตามตัวแปร สำหรับชุดข้อมูลแรก
        $sqlreplace = str_replace("{datepickers}", "'" . $date1 . "'", $sqlreplace);
        $sqlreplace = str_replace("{datepickert}", "'" . $date2 . "'", $sqlreplace);
        $sqlreplace = str_replace("{stime}", "'" . $stime . "'", $sqlreplace);
        $sqlreplace = str_replace("{etime}", "'" . $etime . "'", $sqlreplace);
        $sqlreplace = str_replace("{sicd10}", "'" . $sdiag . "'", $sqlreplace);
        $sqlreplace = str_replace("{eicd10}", "'" . $ediag . "'", $sqlreplace);
        $sqlreplace = str_replace("{multiple_room}", $kskdepartments, $sqlreplace);
        $sqlreplace = str_replace("{multiple_pttype}", $selectpty, $sqlreplace);
        $sqlreplace = str_replace("{multiple_spclty}", $spclty, $sqlreplace);
        $sqlreplace = str_replace("{multiple_ward}", $ward, $sqlreplace);
        $sqlreplace = str_replace("{multiple_doctor}", $doctor, $sqlreplace);

        $result = @pg_query($conn, $sqlreplace);

        //ชื่อฟิลล์
        $i = pg_num_fields($result) ?? 0;
        for ($j = 0; $j < $i; $j++) {
            $fieldname = pg_field_name($result, $j);
            array_push($fieldnames, array('name' =>  $fieldname));
        }
        //จำนวนข้อมูลทั้งหมดแถว
        $rowcount = pg_num_rows($result) ?? 0;

        //rows detail data
        $cc = 0;
        while ($row = pg_fetch_assoc($result)) {
            $loop = []; //ตัวแปรเก็บค่ารายละเอียดแต่ละแถว
            for ($j = 0; $j < $i; $j++) { //ชื่อฟิลล์
                $fieldname = pg_field_name($result, $j);
                $loop += array($fieldname => @iconv("tis-620", "utf-8", $row[$fieldname]));
            }
            array_push($detaildata, $loop);
            $cc++;
        }
    }

    if ($sql_subcode_1 != '') {
        $sqlreplace2 =  $sql_subcode_1;
        //เปลียนค่าตามตัวแปร สำหรับชุดข้อมูลแรก
        $sqlreplace2 = str_replace("{datepickers}", "'" . $date1 . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{datepickert}", "'" . $date2 . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{stime}", "'" . $stime . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{etime}", "'" . $etime . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{sicd10}", "'" . $sdiag . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{eicd10}", "'" . $ediag . "'", $sqlreplace2);
        $sqlreplace2 = str_replace("{multiple_room}", $kskdepartments, $sqlreplace2);
        $sqlreplace2 = str_replace("{multiple_pttype}", $selectpty, $sqlreplace2);
        $sqlreplace2 = str_replace("{multiple_spclty}", $spclty, $sqlreplace2);
        $sqlreplace2 = str_replace("{multiple_ward}", $ward, $sqlreplace2);
        $sqlreplace2 = str_replace("{multiple_doctor}", $doctor, $sqlreplace2);

        $result = @pg_query($conn, $sqlreplace2);

        //ชื่อฟิลล์
        $i = pg_num_fields($result) ?? 0;
        for ($j = 0; $j < $i; $j++) {
            $fieldname = pg_field_name($result, $j);
            array_push($fieldnames2, array('name' =>  $fieldname));
        }
        //จำนวนข้อมูลทั้งหมดแถว
        $rowcount2 = pg_num_rows($result) ?? 0;

        //rows detail data
        $cc = 0;
        while ($row = pg_fetch_assoc($result)) {
            $loop = []; //ตัวแปรเก็บค่ารายละเอียดแต่ละแถว
            for ($j = 0; $j < $i; $j++) { //ชื่อฟิลล์
                $fieldname = pg_field_name($result, $j);
                $loop += array($fieldname => @iconv("tis-620", "utf-8", $row[$fieldname]));
            }
            array_push($detaildata2, $loop);
            $cc++;
        }
    }


    //responsedata Object
    $resdata = [
        'command' => "SELECT",
        'fields' => $fieldnames,
        'rowCount' => $rowcount,
        'rows' => $detaildata,
        'sqlreplace' => $sqlreplace,

        'fields2' => $fieldnames2,
        'rowCount2' => $rowcount2,
        'rows2' => $detaildata2,
        'sqlreplace2' => $sqlreplace2
    ];

    http_response_code(200);
    print json_encode($resdata);
} else {
    $errres = array('message' => "METHODS NOT ALLOWS",);
    http_response_code(405);
    json_encode($errres);
}
