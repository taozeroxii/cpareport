<?php
	$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
	mysqli_set_charset($con,"utf8");

$upload_images = array();
$upload_dir = "uploads/";
foreach($_FILES['images_upload']['name'] as $key=>$val){       
	$file_path = $upload_dir.$_FILES['images_upload']['name'][$key];
	$filename = $_FILES['images_upload']['name'][$key];
	if(is_uploaded_file($_FILES['images_upload']['tmp_name'][$key])) {
		if(move_uploaded_file($_FILES['images_upload']['tmp_name'][$key],$file_path)){
			$upload_images[] = $file_path;
			$insert_sql = "INSERT INTO images(id, file_name, upload_time) 
				VALUES('', '".$filename."', '".time()."')";
			mysqli_query($conn, $insert_sql) or die("database error: ". mysqli_error($conn));
		} 
	}
}
?>