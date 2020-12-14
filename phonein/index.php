<?php include("config.inc.php"); 
if($_GET['del']){
		$sql_del = "DELETE FROM phone_tbl WHERE phone_id = '$_GET[del]' ";	
		mysql_query($sql_del);	
		echo "<meta http-equiv='refresh' content='0;url=index.php?admin'>";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="Yui Nakorn">
<title>PB สมุดโทรศัพท์ รพ.</title>
<link rel="stylesheet" type="text/css" href="css/DT_bst.css">
<link rel="stylesheet" type="text/css" href="css/bst.min.css">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<style>
body{
  font-family: 'Kanit', sans-serif;
  /* background-color: #E8F8F0; */
}
.cc {
	border-top:solid #CCC 1px;
	width: 960px;
	margin: 100px auto 30px auto;
	padding: 20px auto;	
	text-align: center;
}
.phone_head{
text-align: center;
width: 100%;
padding: 1%;
margin: 1%;
font-size: 1.6em;
font-weight: bold;
color: #17A589;
font-family: 'Kanit', sans-serif;
}
.hoho:hover{
background: #0A7885;
cursor: pointer;
color: #fff;
font-size: 1.2em;
}
.tel_ole:hover{
  color: #DD1C65;
  cursor: pointer;
}
.tel_ole{
  color: #43A28F;
  cursor: pointer;
}
.hcon{
  color: #0A7885;
  background-color: #D5F5E3;
  font-size: 1.2em;
}

</style>
<script src="js/j182.js"></script>
<script src="js/j-dtb.js"></script>
<script src="js/DT_bst.js"></script>
<script language="JavaScript">
function chkdel(){if(confirm('  กรุณายืนยันการลบอีกครั้ง !!!  ')){
	return true;
}else{
	return false;
}
}
</script>
</head>
<body>
    <div class="phone_head">เบอร์โทรศัพท์ โรงพยาบาลเจ้าพระยาอภัยภูเบศร 
      <!-- <span class="tel_ole" title="รายชื่อเบอร์โทรเว็บเก่า"><a href="http://172.16.0.3/phone" target="_blank"> &nbsp;[ สมุดเดิม ]</a></span> -->
    </div>

</CENTER><div class="container" style="margin-top: 6px">
  <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
    <thead>
      <tr class="hcon">
        <th>ลำดับ</th>
        <th>คลิกนิก/แผนก/หน่วยงาน</th>
        <th>เบอร์โทร</th>
        <th>อาคาร/ตึก/ชั้น</th>
        <th>ประเภท</th>
        <th>จัดการ</th>
      </tr>
    </thead>
    <tbody>
      <?php 
			$sqlr = "SELECT * FROM phone_tbl p
				  	 LEFT JOIN phone_type t ON t.type_id = p.type_id
             WHERE p.type_id <> '4'
					 ORDER BY p.phone_id ASC";
			$queryr = mysql_query($sqlr);
			$ii = 1;
			 
			while($rowr = mysql_fetch_array($queryr)) {
				$i = str_pad($ii,4,"0",STR_PAD_LEFT);
	 ?>
      <tr class="odd gradeX hoho">
        <td><CENTER><?=$i?></CENTER></td>
        <td><?=$rowr["name"]?></td>
        <td class="tel"><left><b><?=$rowr["phone_num"]?></b></left></td>
        <td class="center"><?=$rowr["nickname"]?></td>
        <td class="center">
          <span class="label 
          <?php if($rowr["type_id"]=="1") echo "btn btn-success btn-block"; 
			else if($rowr["type_id"]=="2") echo "btn btn-danger btn-block";
			else if($rowr["type_id"]=="3") echo "btn btn-warning btn-block";
			else if($rowr["type_id"]=="4") echo "btn btn-inverse btn-block"; 
		 ?>
     <!-- ">
          <?php echo $rowr["type_name"]?>
          </span>
        </td>
        <td class="center">
             <a class="btn btn-info btn-block" href="?editid=<?=$rowr['phone_id']?>#edit"> แก้ไข </a>
          <?php if(isset($_GET['admin'])){ ?>
          <a class="btn btn-danger btn-block" data-toggle="modal" href="?del=<?=$rowr["phone_id"]?>" OnClick="return chkdel();"> 
            <i class="icon-remove icon-white"></i> ลบ </a>
          <? }?>
        </td>
      </tr>
      <?php  $ii++;	} // ปิด while นอก ?>
    </tbody>
  </table>
  <div id="static" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
      <p>Would you like to continue with some arbitrary task?</p>
      <p>del === <?=$_GET[del];?>
      </p>
    </div>
    <div class="modal-footer">
      <button type="button" data-dismiss="modal" class="btn">Cancel</button>
      <button type="button" data-dismiss="modal" class="btn btn-primary">Continue Task</button>
    </div>
  </div>
  <form action="index.php#add" method="get">
    <div style="margin-top:10px;">
      <button  class="btn btn-info" type="submit"> <i class="icon-plus-sign icon-white"></i> เพิ่มเบอร์ </button>
      <input name="amount" type="text" class="input-mini"  id="amount" placeholder="" style="margin-bottom:0; text-align:right;" value="1" maxlength="1" >
      รายการ </div>
  </form>
</div>
<!-- ////////////////////////////////// close container-->

<?php if(isset($_GET['amount']) && $_GET['amount'] > 0) { 
 	$amount = $_GET['amount'];
 	if($amount <= 9)  $amount = $amount;
	else if ($amount > 9)  $amount = 9;
	else $amount = 0;
 	$i = 1;
 ?>
<div id="add" class="container">
  <form action="added.php" method="post" class="form-horizontal">
    <fieldset>
      
      <!-- Form Name -->
      <legend>เพิ่มเบอร์โทรศัพท์</legend>
      <?php 	while ($i<=$amount) { ?>
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label">ชื่อ </label>
        <div class="controls">
          <input  name="name<?=$i?>" type="text" placeholder="บุคคล/หน่วยงาน" class="input-xlarge" required>
        </div>
      </div>
      
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" >เบอร์โทร </label>
        <div class="controls">
          <input  name="phone_num<?=$i?>" type="text" placeholder="" class="input-xlarge" required>
          <p class="help-block">ใส่ได้หลายเบอร์ เช่น 112,115,508</p>
        </div>
      </div>
      
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" >ชื่อเรียก </label>
        <div class="controls">
          <input  name="nickname<?=$i?>" type="text" placeholder="" class="input-xlarge">
          <p class="help-block">ชื่อเล่น ชื่อเรียกไม่เป็นทางการ ใส่ได้หลายชื่อ เพื่อง่ายต่อการค้นหาของท่านเอง </p>
        </div>
      </div>
      
      <!-- Multiple Radios -->
      <div class="control-group">
        <label class="control-label" for="radios">ประเภท </label>
        <div class="controls">
          <label class="radio">
            <input type="radio" name="radios<?=$i?>" id="radios-0<?=$i?>" value="1"  checked="checked">
            เบอร์ภายใน </label>
          <label class="radio">
            <input type="radio" name="radios<?=$i?>" id="radios-1<?=$i?>" value="2" >
            เบอร์นอก </label>
          <label class="radio">
            <input type="radio" name="radios<?=$i?>" id="radios-2<?=$i?>" value="3" >
            ใช้บ่อย </label>
          <!--     <label class="radio">
      <input type="radio" name="radios<?//=$i?>" id="radios-3<?//=$i?>" value="4" >
      สำคัญ
    </label>  ไม่เปิดใช้งาน --> 
        </div>
      </div>
      <hr>
      <? $i++; }   // close while ?>
      <!-- Button -->
      <div class="control-group">
        <label class="control-label" for=""></label>
        <div class="controls">
          <button id="" name="" class="btn btn-success">บันทึก</button>
          <a class="btn btn" href="index.php">ยกเลิก</a> </div>
      </div>
      <input name="amounth" type="hidden" value="<?=$amount?>">
    </fieldset>
  </form>
</div>
<!-- // close add form -->
<?php 
				} // close if amount
 ?>
<div id="edit" class="container">
  <form action="edited.php" method="post" class="form-horizontal">
    <fieldset>
      <?php 	
$sql_edit = "SELECT * FROM phone_tbl WHERE phone_id = '$_GET[editid]'";
$query_edit = mysql_query($sql_edit);
$rowe = mysql_fetch_array($query_edit);

if(isset($_GET['editid'])){
  
?>
      <!-- Form Name -->
      <legend>แก้ไข</legend>
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label">ชื่อ </label>
        <div class="controls">
          <input  name="name" type="text" required class="input-xlarge" placeholder="บุคคล/หน่วยงาน" value="<?=$rowe['name']?>">
        </div>
      </div>
      
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" >เบอร์โทร </label>
        <div class="controls">
          <input  name="phone_num" type="text" required class="input-xlarge" placeholder="" value="<?=$rowe['phone_num']?>">
          <p class="help-block">ใส่ได้หลายเบอร์ เช่น 112,115,508</p>
        </div>
      </div>
      
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" >ชื่อเรียก </label>
        <div class="controls">
          <input  name="nickname" type="text" class="input-xlarge" placeholder="" value="<?=$rowe['nickname']?>">
          <p class="help-block">ชื่อเล่น ชื่อเรียกไม่เป็นทางการ ใส่ได้หลายชื่อ เพื่อง่ายต่อการค้นหาของท่านเอง </p>
        </div>
      </div>
      
      <!-- Multiple Radios -->
      <div class="control-group">
        <label class="control-label" for="radios">ประเภท </label>
        <div class="controls">
          <label class="radio">
            <input type="radio" name="radios" id="radios-0" value="1" <? if($rowe['type_id']==1) echo "checked='checked'"; ?>>
            เบอร์ภายใน </label>
          <label class="radio">
            <input type="radio" name="radios" id="radios-1" value="2" <? if($rowe['type_id']==2) echo "checked='checked'"; ?> >
            เบอร์นอก </label>
          <label class="radio">
            <input type="radio" name="radios" id="radios-2" value="3" <? if($rowe['type_id']==3) echo "checked='checked'"; ?>>
            ใช้บ่อย </label>
            <label class="radio">
            <input type="radio" name="radios" id="radios-3" value="4" <? if($rowe['type_id']==4) echo "checked='checked'"; ?>>
            ยกเลิก </label>
     <!-- ไม่เปิดใช้งาน  -->
        </div>
      </div>
      <input name="phone_id" type="hidden" value="<?=$rowe['phone_id']?>">
      <hr>
      
      <!-- Button -->
      <div class="control-group">
        <label class="control-label" for=""></label>
        <div class="controls">
          <button id="" name="" class="btn btn-success">บันทึก</button>
          <a class="btn btn" href="index.php">ยกเลิก</a> </div>
      </div>
      <input name="amounth" type="hidden" value="<?=$amount?>">
    </fieldset>
  </form>
</div>
<!-- // close edit form -->
<? } //ปิดฟอร์ม edit?>
<script type="text/javascript">

  $(function(){

    $.fn.modalmanager.defaults.resize = true;

    $('[data-source]').each(function(){
      var $this = $(this),
        $source = $($this.data('source'));

      var text = [];
      $source.each(function(){
        var $s = $(this);
        if ($s.attr('type') == 'text/javascript'){
          text.push($s.html().replace(/(\n)*/, ''));
        } else {
          text.push($s.clone().wrap('<div>').parent().html());
        }
      });
      
      $this.text(text.join('\n\n').replace(/\t/g, '    '));
    });

    prettyPrint();
  });
</script> 

<!--#########################################-->

<script id="dynamic" type="text/javascript">
$('.dynamic .demo').click(function(){
  var tmpl = [
    // tabindex is required for focus
    '<div class="modal hide fade" tabindex="-1">',
      '<div class="modal-header">',
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>',
        '<h3>Modal header</h3>', 
      '</div>',
      '<div class="modal-body">',
        '<p>Test</p>',
      '</div>',
      '<div class="modal-footer">',
        '<a href="#" data-dismiss="modal" class="btn">Close</a>',
        '<a href="#" class="btn btn-primary">Save changes</a>',
      '</div>',
    '</div>'
  ].join('');
  
  $(tmpl).modal();
});
</script>
<!--##########################-->

<script id="ajax" type="text/javascript">

var $modal = $('#ajax-modal');

$('.ajax .demo').on('click', function(){
  // create the backdrop and wait for next modal to be triggered
  $('body').modalmanager('loading');

  setTimeout(function(){
     $modal.load('modal_ajax_test.html', '', function(){
      $modal.modal();
    });
  }, 1000);
});

$modal.on('click', '.update', function(){
  $modal.modal('loading');
  setTimeout(function(){
    $modal
      .modal('loading')
      .find('.modal-body')
        .prepend('<div class="alert alert-info fade in">' +
          'Updated!<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '</div>');
  }, 1000);
});

</script>
<center><div><a href="#"> <type="button" title="abhai bhubajhr Information Hospital" ><font size="3px"><B>Information Hospital<B> </font></center></div>
</body>
</html>