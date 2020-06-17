<?php
$host = '172.16.0.251';
$user = 'report';
$password = 'report';
$database = 'cpareportdb';

$connection =  mysql_connect($host, $user, $password);
$db = mysql_select_db($database ,$connection);
mysql_query("SET NAMES UTF8");
