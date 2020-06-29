<?php
 function sql_con(){
   $pdo =  new PDO('mysql:host=172.18.2.2;dbname=cpa19db', "webcvhost", "WebCpa10665Hos!", 
 		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 	return $pdo;
 }
 
/*
$host= "localhost" ;
$userr="web";
$pwd= "@HAbhai#infor|10665!" ;
$dbname="complaint";
$obj_con = mysqli_connect($host,$userr,$pwd,$dbname);
	mysqli_set_charset($obj_con,"utf8");
if(!$obj_con)  {
          echo  "<h3> ERROR  :  ERROR CONNECT DATABASE</h3>" ;
          exit ();
}
*/
?>
