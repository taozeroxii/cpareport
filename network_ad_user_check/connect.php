<?php
$host = '172.16.0.251';
$user = 'report';
$password = 'report';
$database = 'cpareportdb';

mysql_connect($host, $user, $password);
mysql_select_db($database);
mysql_query("SET NAMES UTF8");