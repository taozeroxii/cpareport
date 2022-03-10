<?php


$servername = "172.16.0.192";
$dbname = "cpahdb";
$username = "iptscanview";
$password = "iptscanview";

try {
    $conn = new PDO("pgsql:host=$servername;dbname=$dbname;options=--client_encoding=UTF8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
