<?php?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bst.min.css">

        <script src="js/j182.js"></script>
		<script src="js/j-dtb.js"></script>
		<script src="js/DT_bst.js"></script>

<title>เพิ่มเบอร์โทรศัพท์</title>
</head>

<body>
<form action="added.php" method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>เพิ่มเบอร์โทรศัพท์</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">ชื่อ</label>
  <div class="controls">
    <input id="name" name="name" type="text" placeholder="บุคคล/หน่วยงาน" class="input-xlarge" required>
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="phone_num">เบอร์โทร</label>
  <div class="controls">
    <input id="phone_num" name="phone_num" type="text" placeholder="" class="input-xlarge" required>
    <p class="help-block">ใส่ได้หลายเบอร์ เช่น 112,115,508</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="nickname">ชื่อเรียก</label>
  <div class="controls">
    <input id="nickname" name="nickname" type="text" placeholder="" class="input-xlarge">
    <p class="help-block">ชื่อเล่น ชื่อเรียกไม่เป็นทางการ ใส่ได้หลายชื่อ เพื่อง่ายต่อการค้นหาของท่านเอง </p>
  </div>
</div>

<!-- Multiple Radios -->
<div class="control-group">
  <label class="control-label" for="radios">ประเภท</label>
  <div class="controls">
    <label class="radio" for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="1"  checked="checked">
      เบอร์ภายใน
    </label>
    <label class="radio" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="2" >
      เบอร์นอก
    </label>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <button id="" name="" class="btn btn-info">บันทึก</button>
  </div>
</div>

</fieldset>
</form>


</body>
</html>