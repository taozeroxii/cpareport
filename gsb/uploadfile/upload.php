<?php
if(!empty($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "C:/Program Files/Ampps/www/report/gsb/excelfile/".$_FILES['userImage']['name'];

if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<!-- <img src="<?php // echo $targetPath; ?>" width="100px" height="100px" /> -->
<?php
}
}
}
?>