<html>
<head>
<title>****************************************</title>

<link rel="stylesheet" type="text/css" href="st.css">

</head>
<body>

<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<form name="form1" method="post" action="" enctype="multipart/form-data">
<div class="file-upload">
  <button class="file-upload-btn"><a href="/report/admin/f43/document.php" target="_blank"><<<-------DETAIL------->>>>>></a></button>

  <div class="image-upload-wrap">
    <input class="file-upload-input"  name="filUpload"  type='file' onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>ลากรูปภาพที่ต้องการ upload หรือคลิกเพื่อเลือกรูปภาพ</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
  <hr>
    <button class="file-upload-btn" type="submit">Upload</button>
</div>


<!-- <form name="form1" method="post" action="" enctype="multipart/form-data">
	<input type="file" name="filUpload"><br>
	<input name="btnSubmit" type="submit" value="Submit">
</form> -->
</body>

<?php
	   $fname  = DATE('YmdHis').".jpg";
	  //$fname   = $_FILES["filUpload"]["name"];
	 // $fname   = $_FILES["filUpload"]["name"];

	if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"fileupload/".$fname))
	{
		echo "<center class='ok'>OK Upload<br></center>";

		//*** Insert Record ***//
		$objConnect = mysql_connect("172.16.0.251","report","report") or die("Error Connect to Database");
		$objDB   = mysql_select_db("cpareportdb");

		$todate  = DATE('y-m-d H:i:s');
		$strSQL  = "INSERT INTO f43_imgdoc (name,file_name,type_img,status_id,dateupdate,text_b,text_c,text_h)"; 
		$strSQL .= "VALUES ('f43','".$fname."','OK','1','".$todate."','Y','Y','Y')";
		$objQuery = mysql_query($strSQL);		
	}
?>
<script type="text/javascript">
	function readURL(input) {
  if (input.files && input.files[0]) {

    var reader = new FileReader();

    reader.onload = function(e) {
      $('.image-upload-wrap').hide();

      $('.file-upload-image').attr('src', e.target.result);
      $('.file-upload-content').show();

      $('.image-title').html(input.files[0].name);
    };

    reader.readAsDataURL(input.files[0]);

  } else {
    removeUpload();
  }
}

function removeUpload() {
  $('.file-upload-input').replaceWith($('.file-upload-input').clone());
  $('.file-upload-content').hide();
  $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function () {
		$('.image-upload-wrap').addClass('image-dropping');
	});
	$('.image-upload-wrap').bind('dragleave', function () {
		$('.image-upload-wrap').removeClass('image-dropping');
});
</script>
</body>
</html>