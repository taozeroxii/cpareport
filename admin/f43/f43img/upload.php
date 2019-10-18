<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<script type="text/javascript" src="jquery_upload.js"></script>
</head>
<body>
<div class="container">
	<h2>Upload Multiple Images with Progress Bar using jQuery, PHP and MySQL</h2>		
	<form method="post" name="image_upload_form" id="image_upload_form" enctype="multipart/form-data" action="image_upload.php">   
    <label>Choose Multiple Images to Upload</label>
    <input type="file" name="images_upload[]" id="image_upload" multiple >    
	</form>
	<br>
	<div class="progress" style="display:none;">
		<div class="bar"></div >
		<div class="percent">0%</div >
	</div>
	<div id="status"></div>		
</div>

</body>
</html>