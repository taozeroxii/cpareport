<?php
        error_reporting(E_ERROR | E_PARSE);
        $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
        // $connstring = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
        $conn = pg_connect($connstring);
        pg_set_client_encoding($conn, "utf8");
