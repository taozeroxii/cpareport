<?php
        $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
        $conn = pg_connect($connstring);
        pg_set_client_encoding($conn, "utf8");

        $con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
        mysqli_set_charset($con,"utf8");
?>