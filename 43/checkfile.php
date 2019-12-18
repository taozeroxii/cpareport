<?php
include('../config/my_con.class.php');
$n_id 	  = $_GET['note_id'];
$subItems = " SELECT *  FROM cpareport_hosnote WHERE note_id = '".$n_id."' ";
$res      = mysqli_query($con,$subItems);
foreach($res as $subItem){
	  echo $cn =   $subItem['note_count']+1;
}
$sql = "UPDATE cpareport_hosnote SET note_count = '".$cn."' WHERE note_id = '".$n_id."' ";
	$query = mysqli_query($con,$sql);

	if($query) {
	   header('Location: file/'.$n_id.'.pdf');
	}
?>