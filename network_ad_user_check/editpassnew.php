<?php
            include 'connect.php';
            date_default_timezone_set('asia/bangkok');
            $user           = $_GET['userid'];
            $status_pass    = "O";
            $date_editpass  = $dateupdate = DATE('Y-m-d H:i:s');
            $ip_add_pass    = $_SERVER['REMOTE_ADDR'];

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@900&display=swap" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/editcss.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <script language="javascript">
function fncSubmit()
{
	if(document.form1.txtPassword.value == "")
	{
		alert('กรุณากรอก รหัสผ่านใหม่ของท่าน');
		document.form1.txtPassword.focus();		
		return false;
	}	
	if(document.form1.txtConPassword.value == "")
	{
		alert('กรุณา กรอกรหัสผ่านใหม่ ทั้ง 2 ช่อง');
		document.form1.txtConPassword.focus();		
		return false;
	}	
	if(document.form1.txtPassword.value != document.form1.txtConPassword.value)
	{
		alert('รหัวผ่านที่ท่านนกรอกไม่ตรงกัน กรุณาตรวจสอบอีกครั้ง');
		document.form1.txtConPassword.focus();		
		return false;
    }	
    
// *************************************

    
// **************************************
	document.form1.submit();
}


</script>

<?php
IF(isset($_POST["txtPassword"])){
if(!empty($_POST["txtPassword"]) && ($_POST["txtPassword"] == $_POST["txtConPassword"])) {
    $txtPassword = test_input($_POST["txtPassword"]);
    $txtConPassword = test_input($_POST["txtConPassword"]);
    if (strlen($_POST["txtPassword"]) <= 7 ) {
        $passwordErr = " ต้องมีอย่างน้อย  8 ตัว !";
    }
    else if(!preg_match("#[0-9]+#",$txtPassword)) {
        $passwordErr = " ต้องมีตัวเลข ไม่น้อยกว่า 1 ตัว !";
    }
    else if(!preg_match("#[A-Z]+#",$txtPassword)) {
        $passwordErr = "ต้องมีตัวอักษรใหญ่ ไม่น้อยกว่า 1 ตัว !";
    }
    else if(!preg_match("#[a-z]+#",$txtPassword)) {
        $passwordErr = "ต้องมีตัวอักษรเล็ก ไม่น้อยกว่า 1 ตัว !";
    } else {


        $query = " UPDATE network_ad_user 
                   SET new_pass = '$txtPassword',status_pass = '$status_pass',date_editpass = '$date_editpass',ip_add_pass = '$ip_add_pass' 
                   WHERE username = '$user' ";  
        $query = mysql_query($query);

 
       echo ("<script LANGUAGE='JavaScript'>
            window.alert('คุณเปลี่ยนรหัสผ่าน User : ".$user." กรูณารอการยืนยัน หรือตรวจสอบข้อมูลอีกครั้ง');
            window.location.href='./';
              </script>");
   
              $line       = "ReSETPass || UserName: ".$user." PassWord: ".$txtPassword." AdminTool: http://172.16.0.251/report/network_ad_user_check/admin_uppass.php ";             
define('LINE_API',"https://notify-api.line.me/api/notify");
define('LINE_TOKEN','jthNhCWSp3XYNZxy5ZF29SecT0zvKuFBs2kmWQb7sWH');

function notify_message($message){

    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array(
        'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
        )
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
    return $res;
}
$res = notify_message($line);



    }
}
echo "<script language='javascript'> alert('$passwordErr');</script>";	
}
?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
            <?php
            $sql      = " SELECT firstname,lastname,username,department,jobtitle 
                        FROM network_ad_user 
                        WHERE 1 = 1 
                        AND username = '$user'  ";
            $query  = mysql_query($sql);
            $result = mysql_fetch_assoc($query);
                    
                        $firstname  = $result['firstname'];
                        $lastname   = $result['lastname'];
                        $username   = $result['username'];
                        $email      = $result['email'];
                        $department = $result['department'];
                        $telephone  = $result['telephone'];
                        $jobtitle   = $result['jobtitle'];
                        $date_editpass = DATE('Y-m-d H:i:s');
                        $ip_add_pass = $_SERVER['REMOTE_ADDR'];
                        $new_pass = "";
                        $status_pass = "";
                        $chksum = "";

            ?>
</head>
<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first hhh">
        แก้ไขรหัสผ่าน USER : <span class="hhc" title="USER ผู้ใช้งาน"><?php echo $username; ?></span>
    </div>

    <form action="#" method="POST" name="form1" id="form1" OnSubmit="return fncSubmit();">
        <input type="text" id="login" class="fadeIn second" name="login" title="ชื่อ-นามสกุล ผู้ใช้งาน " value="<?php echo $firstname."&nbsp;&nbsp;&nbsp;".$lastname; ?>" readonly >
        <input type="text" id="login" class="fadeIn second" name="login" title="ตำแหน่ง" value="<?php echo $jobtitle; ?>" readonly>
        <input type="text" id="login" class="fadeIn second" name="login" title="แผนก / ฝ่าย / หน่วยงาน" value="<?php echo $department; ?>" readonly>
        <input type="text"name="txtPassword" id="txtPassword"   title="" placeholder="ตั้งรหัสผ่านใหม่" autofocus value="<?php echo $txtPassword;?>" autocomplete="off">
        <input type="text" id="txtConPassword" class="fadeIn third" name="txtConPassword" title=""  placeholder="ยืนยันรหัสผ่านใหม่" value="" autocomplete="off">
        <input type="submit" class="fadeIn fourth" value="แก้ไข" >
    </form>

    <div id="formFooter">
      <a class="underlineHover" href="#" data-toggle="modal" data-target="#myModal" title="คลิกอ่าน กรุณาทำความเข้าใจในการใช้งาน ">คำเตือน</a>
    </div>

  </div>
</div>

<?php
function GetMAC(){
        ob_start();
        system('getmac');
        $Content = ob_get_contents();
        ob_clean();
        return substr($Content, strpos($Content,'\\')-20, 17);
                 }

$browserAgent = $_SERVER['HTTP_USER_AGENT'];

?>

<style>
  .ww{
    color: red;
  }
  </style>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="ww">!! ข้อมูลการเปลี่ยนแปลงรหัสผ่าน จะถูกจัดเก็บในระบบตรวจสอบ</span></h4>
      
        </div>
        <div class="modal-body">
          <p>IP Addess : <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
          <p>MAC Addess : <?php echo GetMAC(); ?></p>
          <p>Browser : <?php echo $browserAgent; ;?></p>
          <p>วันที่ : <?php echo $todate = date('Y-m-d');?> </p>
          <p>เวลา : <?php echo $todate = date('H:i:s');?></p>
          <hr>
          <center><span class="ww"> รหัสผ่านสามารถเปลี่ยนแปลงได้ครั้งเดียว | กรุณาตรวจสอบข้อมูลให้ถูกต้องว่าเป็นของท่านจริง</span> </center>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>



</body>
</html> 