<!DOCTYPE html>
<html>

<head>
  <title></title>
</head>

<body>
  <?php
  date_default_timezone_set("Asia/Bangkok");
  include("config/my_con.class.php");
  $token_check = mt_rand(100, 999) . mt_rand(100, 999);

  //เอาค่าที่รับมาจาก radio มา suustring แต่ละตัวที่ขั้นด้วย | เก็บไว้ในตัวแปร data เป็น array แต่ละช่อง
  $string = $_POST['dateapp'];//ประกาษเก็บค่าที่รับมา
  $arrposition = strpos($string, "|");//หาตำแหน่งแรกที่เป็นตัว | จากโจทย์จะได้เป็น 10
  $arrpositionSub =   $string;// เก็บค่าตัวแปรไว้วนเปลี่ยนแปลงค่าตาม forloop
  for ($i = 0; $i <= 5; $i++) {//วนรอบเก็บค่าค่าที่ส่งมามี4แถว
    if ($arrposition != 0) {//เมื่อค่าแรกไม่ใช่ 0 ซึ่งปกติจะเป็ฯ 10 เสมอ | หลังวันที่ เช่น 2020-06-01| จะเป็นตัวที่ 11
      $data[$i] = substr($arrpositionSub, 0, $arrposition); //ตัดเอคำที่อย่หน้า | ในรอบแรกมาเก็บในdata
      $arrpositionSub = substr($arrpositionSub,$arrposition+1, 1000000);// เอาตัวแปร arrpositionSub รับค่าที่ตัดออกมาตัวแรก โดย arrpositionSub = ค่าstring ที่รับมาจากหน้าแรก ตัดส่วนแรกซึ่งคือวันที่ออกไป
    }
    if($arrposition == 0){ $data[5] = $arrpositionSub;}//รอบสุดท้ายค่า cid มันจะไม่มี | จึงเป็น0 เช็คเก็บแบบธรรมดาเลย
    $arrposition = strpos($arrpositionSub, "|").'<br>';//ทำงานครบให้ค่าตำแหน่งที่จะตัดเปลี่ยนไปตามค่าล่าสุด
    echo 'this is arr ['.$i.'] '.$data[$i] . '<br>';//แสดงผลค่าในอาเรย์ที่เก็บ
  }

  $date_appoint   = $data[0];
  $clinic_appoint = $data[1];
  $doctor_appoint = trim($data[2]);
  $doctor_appoint  = str_replace("  "," ",$doctor_appoint);//เกิดปัญหาinsert ชื่อสกุลเป็น2เคาะ เจอ2เคาะให้เปลี่ยนเป็ฯเคาะเดียว
  $hn             = $data[3];
  $cid            = $data[4];
  $oapp_id        = $data[5]; // เพิ่ม oapp_id
  $app_status     = "1";
  $updatedate     = DATE('Y-m-d');
  //echo  $date_appoint . '<br/>' . $clinic_appoint . '<br/>' . $doctor_appoint . '<br>';

  $searchdata = " SELECT * FROM  web_data_appoint WHERE oapp_id <> '$oapp_id'
                 -- WHERE hn = '$hn' and cid = '$cid' and date_appoint = '$date_appoint' 
                  --AND clinic_appoint = '$clinic_appoint' and doctor_appoint = '$doctor_appoint'
                 ";

  $check_have_data = mysqli_query($con, $searchdata);
  $countrow = mysqli_num_rows($check_have_data);
  echo   $searchdata.'<br>';

  if ($countrow <= 0) {
    $log = "INSERT INTO web_data_appoint (hn,cid,oapp_id,token_check,date_appoint,clinic_appoint,doctor_appoint,app_status,updatedate) 
          VALUES ('$hn','$cid','$oapp_id','$token_check','$date_appoint','$clinic_appoint','$doctor_appoint','$app_status','$updatedate')  ";
    $query = mysqli_query($con, $log);
    echo $log;
    //header("Location: complete.php?cid=$cid&token_check=$token_check");
    header("Location: complete.php?token_check=$token_check");
    mysqli_close($con);
  } else {
    echo "<script>javascript:alert('เคยบันทึกอนุมัติรายการนี้ไปแล้ว!');window.location='app.php';</script>";
  }
  ?>
</body>

</html>