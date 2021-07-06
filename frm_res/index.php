<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <?php session_start(); ?>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>แบบฟอร์มแจ้งขอเพิ่มรายการในHosxp</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
  <meta name="description" content="Tab Styles Inspiration: A small collection of styles for tabs" />
  <meta name="keywords" content="tabs, inspiration, web design, css, modern, effects, svg" />
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/tabs.css" />
  <link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
  <script src="js/modernizr.custom.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="jquery-1.11.1.min.js" type="text/javascript"></script>

  <!-- eaktamp -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    
  <script type="text/javascript">
    $(document).ready(function() {
      $('#incomes').change(function() {
        $.ajax({
          type: 'POST',
          data: {
            incomes: $(this).val()
          },
          url: 'submenu/select_menu_income.php',
          success: function(data) {
            $('#menuincomes').html(data);
          }
        });
        return false;
      });
    });
  </script>


  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/datepicker-th.js"></script>


</head>


<body style="font-family: 'Prompt', sans-serif;">
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
    <a class="navbar-brand" href="../index.php">Report</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link " href="checkreg_hosxp.php">หน้ารายการคำขอ <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active" href="#">เพิ่มผู้ใช้งานHosxp</a>
        <a class="nav-item nav-link disabled" href="#" tabindex="-1" style="float:right" aria-disabled="true">Disabled</a>
      </div>
  </nav>


  <style>
    .nameofinput {
      font-size: 12px;
      float: left;
    }

    .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 15px;
    }
  </style>

  <br><br>
  <?php
  include('../config/my_con.class.php');
  include('../config/pg_con.class.php');
  date_default_timezone_set("Asia/Bangkok");
  //echo     $datenow  =  date("d/m/").(date("Y")+543).date(" H:i:s");
  $todate  =  date("d/m/").(date("Y")+543);

  $doctorposition = " SELECT * FROM frm_res_doctorposition ORDER BY position_name";
  $doctorpositions = mysqli_query($con, $doctorposition);

  $spclty = " SELECT * FROM frm_res_spclty order by frm_res_id";
  $spcltys = mysqli_query($con, $spclty);

  $doctor_department = " SELECT * FROM doctor_department ";
  $doctor_departments = pg_query($conn, $doctor_department);

  $income = " SELECT * FROM frm_res_income ";
  $incomes = mysqli_query($con, $income);

  $adp_type = " SELECT * FROM frm_res_adp_type ";
  $adp_types = mysqli_query($con, $adp_type);

  $adp_code = " SELECT * FROM frm_res_adp_code ";
  $adp_codes = mysqli_query($con, $adp_code);

  $product_category = " SELECT * FROM frm_res_product_category ";
  $product_categorys = mysqli_query($con, $product_category);

  $nondrugitems_type = " SELECT * FROM nondrugitems_type";
  $nondrug_item_type_names = pg_query($conn, $nondrugitems_type);

  $providertype = " SELECT * FROM provider_type";
  $providertypes = pg_query($conn, $providertype);
  /*
ทำเช็ค  เวลากดเลือกหมวดค่ารักษาพยาบาลที่เป็น lab แล้ว ให้เพิ่มช่องใส่พวกชื่อlab e code specimen กลุ่ม
หากเพิ่มค่ารักษาพยาบาลที่ต้องเช็คราคาผานศูนย์สิทธิให้แสดงปุ่ม print form เพื่อเอาลายเซ็นว่าผ่านตรวจสอบแล้ว
สามารถเช็คตาม ID ใบได้
*/

  ?>


  <?php if (isset($_POST['submitform1'])) {
    /*
    echo $_POST['pname']; echo '<br>';
    echo $_POST['fname'];  echo '<br>';
    echo $_POST['lname'];  echo '<br>';
    echo $_POST['engfullname'];  echo '<br>';
    echo $_POST['gender'];  echo '<br>';
    echo $_POST['birthday'];  echo '<br>';
    echo $_POST['cid'];  echo '<br>';
    echo $_POST['jclass'];  echo '<br>';
    echo $_POST['spcltys'];  echo '<br>';
    echo $_POST['specialty'];  echo '<br>';
    echo $_POST['doctorcert'];  echo '<br>';
    echo $_POST['firstdayonjob'];  echo '<br>';
    echo $_POST['emailaddress'];  echo '<br>';
    echo $_POST['username']; echo '<br>';
    echo $_POST['accepcert']; echo '<br>';
    echo $_POST['expirecert']; echo '<br>';
    echo $_POST['mobilephone']; echo '<br>';
    echo $_POST['Providertype']; echo '<br>';
     */
    date_default_timezone_set("Asia/Bangkok");
    $datenow  =  date("d/m/").(date("Y")+543).date(" H:i:s");

    $checkcid = "select * from frm_res_require_login_hosxp where cid = '" . $_POST['cid'] . "'";
    $querycheckcid = mysqli_query($con, $checkcid);
    $havecid = mysqli_fetch_assoc($querycheckcid);

    $checkcidhosxp = "select * from doctor where cid = '" . $_POST['cid'] . "'";
    $querycheckcidhosxp = pg_query($conn, $checkcidhosxp);
    $havecidhosxp = pg_fetch_assoc($querycheckcidhosxp);
 
    $checkusername = "select * from officer where officer_login_name = '" . $_POST['username'] . "'";
    $checkusernames = pg_query($conn, $checkusername);
    $haveusers = pg_fetch_assoc($checkusernames);


     $valksk = $_POST['note'];

     foreach ($valksk as $dep) {
        $ksk .="" .$dep. ",";
      }
      $ksk = rtrim($ksk,',');
      $decode = $ksk;

    

    if ($havecid == null && $haveusers == null ){// &&  $havecidhosxp == null เอาส่วนเช็คว่ามี cid ในระบบ hosxp ออกเพื่อให้ผู้ใช้งานกรอกข้อมูลสมัครเข้ามาได้แม้มีข้อมูลชื่อตัวเองในระบบแล้วเพราะบางคนอาจยังไม่มีรหัสแต่มีชื่อในระบบ
      $insertsql = "INSERT INTO frm_res_require_login_hosxp (pname,fname,lname,engfullname,gender,birthday,cid,jobclass,spclty,speciality,doctor_cert,first_day_in_job,emailaddress,username,password,status,insertdate_time,accepcert,expirecert,mobilenumber,providertype,note,phone_internal)
      VALUES ('" . $_POST["pname"] . "'
      ,'" . $_POST["fname"] . "'
      ,'" . $_POST["lname"] . "'
      ,'" . $_POST["engfullname"] . "'
      ,'" . $_POST["gender"] . "'
      ,'" . $_POST["birthday"] . "'
      ,'" . $_POST["cid"] . "'
      ,'" . $_POST["jclass"] . "'
      ,'" . $_POST["spcltys"] . "'
      ,'" . $_POST["specialty"] . "'
      ,'" . $_POST["doctorcert"] . "'
      ,'" . $_POST["firstdayonjob"] . "'
      ,'" . $_POST["emailaddress"] . "'
      ,'" . $_POST["username"] . "'
      ,'1234'
      ,'waiting'
      ,'" . $datenow . "'
      ,'" . $_POST['accepcert']. "'
      ,'" . $_POST['expirecert'] . "'
      ,'" .  $_POST['mobilephone']. "'
      ,'" . $_POST['Providertype']. "'
      ,'" . $decode. "'
      ,'" . $_POST['phoneinternal']. "'
      )";

      $queryInsert = mysqli_query($con, $insertsql);
// echo $insertsql;
      if ($queryInsert) {
        echo "<script>alert('แจ้งข้อมูลไปยังผู้ดูแลระบบเรียบร้อย');window.location=index.php;</script>";
        //echo "<script>window.location='test.php';</script>";
        // LINE API NOTIFY//
       function send_line_notify($message, $token)
        {
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          $result = curl_exec($ch);
          curl_close($ch);
          return $result;
        }

        $message = "\r\n" .
          'วันที่ขอเพิ่ม :' .$datenow . "\r\n" .
          'ชื่อ :' . $_POST["pname"] . " " .  $_POST["fname"] . "  " .  $_POST["lname"] . "\r\n" .
          'สถานะ : รอดำเนินการ';
        $token = 'd5zh3iN8q18hw1cTYxIJc2eS4OlZBOCMq6VOySo2u3z';
       send_line_notify($message, $token);
      } else   echo "<script>alert('มีการแจ้งข้อมูลนี้ไปแล้ว');window.location=index.php;</script>";
    } else   echo "<script>alert('มีข้อมูลในระบบแล้วหรือเคยแจ้งไปแล้ว');window.location=index.php;</script>";
  }


  /////////////////// เช็คเก็บข้อมูลผู้เข้าชม sql นั้นๆ เพื่อเก็บ session นับจำนวน view  //////////////////////////////
  $sql 		=  $_GET['sql'];
  include "../config/timestampviewer.php"; //เรียกไฟล์ในส่วนที่ทำงานนับจำนวนผู้กดเข้ามาหน้า sql นั้นๆ
  ?>


  <div class="container">
    <section>
      <div class="tabs tabs-style-bar" style="background-color:white">
        <nav>
          <ul>
            <li><a href="#section-bar-1" class="icon icon-tools"><span> ขอเพิ่มชื่อเข้าใช้งานในระบบ HosXp </span></a></li>
            <li><a href="#section-bar-2" class="icon icon-tools"><span> ขอเพิ่มค่ารักษาพยาบาลใช้งานในระบบ HosXp </span></a></li>
          </ul>
        </nav>
        <div class="content-wrap border">
          <section id="section-bar-1">
            <div class="container">
              <form action="#" method="POST" class="form-horizontal">
                <div class="form-group has-success">
                  <div class="row">
                    <div class="col-sm-2">
                      <span class="nameofinput">คำนำหน้า</span>
                      <select class="form-control" id="inputGroupSelect01" name="pname" required>
                        <option  value="" selected>pname</option>
                        <option value="นาย">นาย</option>
                        <option value="นาง">นาง</option>
                        <option value="น.ส.">น.ส.</option>
                        <option value="นพ.">นพ.</option>
                        <option value="นศพ.">นศพ.</option>
                        <option value="พญ.">พญ.</option>
                        <option value="พทป.">พทป.</option>
                        <option value="พญ.">ทพ.</option>
                        <option value="พทป.">ทพญ.</option>
                      </select>
                    </div>
 
                    <div class="col-sm-3">
                      <span class="nameofinput">ชื่อ</span>
                      <input class="form-control" type="text" placeholder="ชื่อ" name="fname" pattern="^[ก-๏\s]+$" required>
                    </div>
                    <div class="col-sm-3">
                      <span class="nameofinput">นามสกุล</span>
                      <input class="form-control" type="text" placeholder="นามสกุล" name="lname" pattern="^[ก-๏\s]+$" required>
                    </div>
                    <div class="col-sm-4">
                      <span class="nameofinput">ชื่อสกุลภาษาอังกฤษ</span>
                      <input class="form-control" type="text" placeholder="ชื่อสกุลภาษาอังกฤษ" pattern="^[a-zA-Z\s]+$" name="engfullname" required>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-1">
                      <span class="nameofinput">เพศ</span>
                      <select class="form-control" name="gender" required>
                        <option selected> gender </option>
                        <option value="ชาย">ชาย</option>
                        <option value="หญิง">หญิง</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <span class="nameofinput">วันเดือนปีเกิด(พศ.)</span>
                      <input class="form-control"  type="text" id="date-of-birth" autocomplete="off" value="<?php echo $todate;?>" name="birthday" required>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">เลขที่บัตรประชาชน</span>
                      <input class="form-control" type="text" maxlength="13" minlength="13" pattern="[0-9]{1,}"  placeholder="เลขที่บัตรประชาชน(cid)" name="cid" maxlength="13" required>
                    </div>

                    <div class="col-sm-2">
                      <span class="nameofinput">ตำแหน่งหลัก</span>
                      <select class="form-control" name="jclass" required>
                        <option value="" selected>โปรดเลือก ..</option>
                        <?php while ($Result = mysqli_fetch_assoc($doctorpositions)) { ?>
                          <option value="<?php echo $Result['position_name']; ?>">
                            <?php echo $Result['position_name']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">แผนกสาขา(sp)</span>
                      <select class="form-control" name="spcltys" required>
                        <option value="" selected>โปรดเลือก ..</option>
                        <?php while ($Result = mysqli_fetch_assoc($spcltys)) { ?>
                          <option value="<?php echo $Result['frm_res_spclty']; ?>">
                            <?php echo $Result['frm_res_spclty']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">เฉพาะทาง</span>
                      <select class="form-control" name="specialty" require>
                        <option selected> เฉพาะทาง specialty</option>
                        <option value="" selected>โปรดเลือก ..</option>
                        <?php while ($Result = pg_fetch_assoc($doctor_departments)) { ?>
                          <option value="<?php echo $Result['doctor_department_name']; ?>">
                            <?php echo $Result['doctor_department_name']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="row mt-3">
                      <div class="col-sm-3">
                          <span class="nameofinput">วันที่เข้าเริ่มงาน</span>
                          <input class="form-control"  type="text" id="day-of-job" autocomplete="off" name="firstdayonjob" value="<?php echo $todate;?>" required>
                        </div>
                        <div class="col-sm-3">
                          <span class="nameofinput">เลขที่ใบประกอบวิชาชีพ</span>
                          <input class="form-control" type="text" placeholder="เลขที่ใบประกอบวิชาชีพ" name="doctorcert">
                        </div>
                        <div class="col-sm-3">
                          <span class="nameofinput">วันที่ออกใบอนุญาต</span>
                          <input class="form-control"  type="text" id="day-of-accepcert" autocomplete="off" name="accepcert" value="<?php echo $todate;?>" >
                        </div>
                        <div class="col-sm-3">
                          <span class="nameofinput">วันที่หมดอายุอนุญาต</span>
                          <input class="form-control"  type="text" id="day-of-expirecert" autocomplete="off" name="expirecert" value="<?php echo $todate;?>" >
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3">
                          <span class="nameofinput">email</span>
                          <input class="form-control" type="email" name="emailaddress">
                        </div>
                        <div class="col-sm-3">
                          <span class="nameofinput">โทรศัพท์</span>
                          <input class="form-control" type="text" placeholder="08xxxxxxxxx" maxlength="10" name="mobilephone">
                        </div>
                        <div class="col-sm-4">
                          <span class="nameofinput">ชื่อเข้าใช้งาน Hosxp <small style="color:red;">**เฉพาะภาษาอังกฤษพิมเล็กและเลข a-z,0-9**</small></span>
                          <input class="form-control" type="text" placeholder="๊User name" name="username" required>
                        </div>
                        <div class="col-sm-2">
                          <span class="nameofinput">รหัสผ่าน Hosxp</span>
                          <input class="form-control" type="text" placeholder="๊1234" name="" disabled>
                        </div>
                    </div>
               
                  <div class="row mt-3">
                  <div class="col-sm-3">
                      <span class="nameofinput">Provider type</span>
                      <select class="form-control" name="Providertype" require>
                        <option value="" selected>โปรดเลือก ..</option>
                        <?php while ($Result = pg_fetch_assoc($providertypes)) { ?>
                          <option value="<?php echo $Result['provider_type_name']; ?>">
                            <?php echo $Result['provider_type_name']; ?>
                          </option>
                        <?php } ?>
                      </select>
                    </div>


                    <!-- <div class="col-sm-6">
                      <span class="nameofinput">เลขห้องที่เข้าใช้งาน วิธีดูเลขที่ห้องคลิกปุ่มสีแดง -><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#imginfo"><i class="glyphicon glyphicon-list"></i></button></span>
                      <input class="form-control" type="text" placeholder="ระบุตัวเลข หรือ ชื่อห้องที่ต้องการใช้งาน (สามารถระบุได้หลายห้อง)" name = "note" required></input>
                    </div> -->

                    <?php
                      $ksk = " SELECT depcode,department FROM kskdepartment WHERE depcode_active = 'Y' ";
                      $dep = pg_query($conn, $ksk);
                    ?>
                    <div class="col-sm-6">
                      <span class="nameofinput">ห้องที่เข้าใช้งาน วิธีดูเลขที่ห้องคลิกปุ่มสีแดง *เลือกได้มากกว่า 1 รายการ</span>
                      <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#imginfo" title="คลิกดูภาพตัวอย่าง">
                      <i class="glyphicon glyphicon-list"></i></button></span>
                            <select class="note related-post form-control" name="note[]" multiple title="เลือกห้องที่เข้าใช้งาน เลือกได้มากกว่า 1 รายการ">
                            
                            <?php 
                                while ($kskdep = pg_fetch_assoc($dep)) {
                                ?>
                                    <option value="<?php echo $kskdep['depcode'];?>"><?php echo $kskdep['department'];?></option>
                                    <?php
                                }
                                ?>
                         </select>
                    </div>

                    <div class="col-sm-3">
                          <span class="nameofinput">เบอร์ติดต่อภายใน</span>
                          <input class="form-control" type="text" placeholder="xxxx" name="phoneinternal">
                        </div>
                  </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success" name="submitform1" value="submitform1">แจ้งขอเพิ่มรายการผู้ใช้งาน</button>
            </form>
          </section>


          <div class="modal fade" id="imginfo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="width:70%;">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">รูปตัวอย่าง</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img src="../admin/img/detailroom.png" width="100%" alt="ไม่สามารถโหลดภาพได้">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>


          </div>


          <section id="section-bar-2">
            <? if ($_SESSION['status'] == '1') { ?>
              <span style="font-size:14px;float:left">**หากราคาเท่ากันทุกสิทธิใส่แค่ราคาขายอย่างเดียว**</span><br>
              <div class="container">
                <form action="#" class="form-horizontal">

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-4">
                        <span class="nameofinput">หมวดค่ารักษาพยาบาล **</span>
                        <select class="form-control" name='incomes' id="incomes" require>
                          <option selected>หมวดค่ารักษาพยาบาล(income)...</option>
                          <?php while ($Result = mysqli_fetch_assoc($incomes)) { ?>
                            <option value="<?php echo $Result['frm_res_income_id']; ?>">
                              <?php echo $Result['frm_res_name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-6 col-sm-4">
                        <span class="nameofinput">ชื่อภาษาไทย **</span>
                        <input class="form-control" type="text" placeholder="ชื่อ(ไทย)" name="incomenameth" require>
                      </div>
                      <div class="col-6 col-sm-4">
                        <span class="nameofinput">ชื่อภาษาอังกฤษ</span>
                        <input class="form-control" type="text" placeholder="ชื่อ(อังกฤษ)" name="incomenameen">
                      </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-6 col-sm-1">
                        <span class="nameofinput">ราคาขาย **</span>
                        <input class="form-control" type="text" placeholder="default" name="sell" require>
                      </div>
                      <div class="col-6 col-sm-1">
                        <span class="nameofinput">ราคาทุน</span>
                        <input class="form-control" type="text" placeholder="" name="budget">
                      </div>
                      <div class="col-6 col-sm-1">
                        <span class="nameofinput"> Bill code</span>
                        <input class="form-control" type="text" placeholder="" name="billcode">
                      </div>
                      <div class="col-6 col-sm-1">
                        <span class="nameofinput"> Bill number</span>
                        <input class="form-control" type="text" placeholder="" name="billnumber">
                      </div>
                      <div class="col-6 col-sm-3">
                        <span class="nameofinput">ADP:code</span>
                        <select class="form-control" name="nhso_apd_code_name">
                          <option selected>nhso_adp_code_name </option>
                          <?php while ($Result = mysqli_fetch_assoc($adp_codes)) { ?>
                            <option value="<?php echo $Result['nhso_adp_code'] . ' ' . $Result['nhso_adp_code_name']; ?>">
                              <?php echo $Result['nhso_adp_code'] . ' ' . $Result['nhso_adp_code_name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-6 col-sm-5">
                        <span class="nameofinput">ADP:TYPE</span>
                        <select class="form-control" name="nhso_apd_type_name">
                          <option selected>nhso_adp_type </option>
                          <?php while ($Result = mysqli_fetch_assoc($adp_types)) { ?>
                            <option value="<?php echo $Result['nhso_adp_type_name']; ?>">
                              <?php echo $Result['nhso_adp_type_name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mt-3">
                      <div class="col-6 col-sm-6">
                        <span class="nameofinput">Product category (สกส.)</span>
                        <select class="form-control" name="sks_product_category_name">
                          <option selected>sks_product_category_name </option>
                          <?php while ($Result = mysqli_fetch_assoc($product_categorys)) { ?>
                            <option value="<?php echo $Result['sks_product_category_name']; ?>">
                              <?php echo $Result['sks_product_category_name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-6 col-sm-6">
                        <span class="nameofinput">กลุ่มการรักษา</span>
                        <select class="form-control" require>
                          <option selected>non_drug_item_type_names </option>
                          <?php while ($Result = pg_fetch_assoc($nondrug_item_type_names)) { ?>
                            <option value="<?php echo $Result['nondrugitems_type_name']; ?>">
                              <?php echo $Result['nondrugitems_type_name']; ?>
                            </option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>


                    <? // รับค่าจากช่อง income ส่งค่า id income ไปหน้า select menuincome เพื่อเช็คค่า่ในตารางว่าป็น lab ไหมหากใช่ห้แสดงข้อมูลที่ต้องกรอกเพิ่มเติมและีเทรินข้อมูลหน้านั้นกลับมาที่ if menuincomes
                    ?>
                    <div class="row" id="menuincomes"></div>
                    <? // รับค่าจากช่อง income ส่งค่า id income ไปหน้า select menuincome เพื่อเช็คค่า่ในตารางว่าป็น lab ไหมหากใช่ห้แสดงข้อมูลที่ต้องกรอกเพิ่มเติมและีเทรินข้อมูลหน้านั้นกลับมาที่ if menuincomes
                    ?>

                    <hr>
                    <div class="row mt-5">
                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>ข้าราชการ:</legend>
                          <span class="nameofinput">ข้าราช(ราคา)</span>
                          <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe1" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>

                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>UCบัตรทอง:</legend>
                          <span class="nameofinput">UC(ราคา)</span>
                          <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe2" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>ประกันสังคม:</legend>
                          <span class="nameofinput">ประกันสังคม(ราคา)</span>
                          <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe3" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>พรบ:</legend>
                          <span class="nameofinput">พรบ(ราคา)</span>
                          <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe4" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>ชำระเงินเอง:</legend>
                          <span class="nameofinput">ชำระเงินเอง(ราคา)</span>
                          <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe5" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>
                      <div class="col-6 col-lg-2">
                        <fieldset>
                          <legend>อื่นๆ:</legend>
                          <span class="nameofinput">อื่นๆ(ราคา)</span>
                          <input class="form-control" type="text" placeholder="อื่นๆ" name="doctorcert">
                          <span class="nameofinput">ประเภท</span>
                          <select class="form-control" name="tepe6" require>
                            <option selected> ...</option>
                            <option value="1">ตามสิทธิ</option>
                            <option value="2">ชำระเงินเอง(เบิกได้)</option>
                            <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                          </select>
                        </fieldset>
                      </div>
                    </div>
                    <div class="row mt-5">
                      <div class="col-11 col-lg-12">
                        <span class="nameofinput">หมายเหตุ</span>
                        <input class="form-control" type="text" placeholder="รายละเอียดเพิ่มเติม หรือ lab profile ระบุ รายการ เป็นข้อๆ ฯลฯ " name="note">
                      </div>
                    </div>
                    <div class="row mt-5 ">
                      <div class="col-11 col-lg-12">
                        <input type="checkbox" name="vehicle11" id="vehicle11" value="ส่งเบิกสกสOPD" style=" width: 25px;  height: 25px; ">
                        <label for="vehicle11">ส่งเบิก สกส.OPD </label>&nbsp;
                        <input type="checkbox" name="vehicle12" id="vehicle12" value="ส่งเบิกสกสIPD" style=" width: 25px;  height: 25px; ">
                        <label for="vehicle12">ส่งเบิก สกส.IPD</label>&nbsp;
                      </div>
                    </div>

                  </div>
                  <hr>
                  <button type="button" class="btn btn-success" name="submitform2">แจ้งขอเพิ่มรายการ</button>
                </form>
              </div>

            <? } else echo 'ปิดใช้งาน(เฉพาะ admin)'; ?>
          </section>

          <!-- 	<section id="section-bar-4"><p>4</p></section>
						<section id="section-bar-5"><p>5</p></section> -->
        </div>
      </div>
    </section>

  </div>
  <script src="js/cbpFWTabs.js"></script>
  <script>
    (function() {
      [].slice.call(document.querySelectorAll('.tabs')).forEach(function(el) {
        new CBPFWTabs(el);
      });
    })();

    $.datepicker.setDefaults( $.datepicker.regional[ "th" ] );
      var currentDate = new Date();

      currentDate.setYear(currentDate.getFullYear() + 543);
        // Birth date
        $("#date-of-birth").datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: '+443:+543',
          dateFormat: 'dd/mm/yy',
          onSelect: function(date) {
            $("#edit-date-of-birth").addClass('filled');
          }
        });

        $("#day-of-job").datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: '+443:+543',
          dateFormat: 'dd/mm/yy',
          onSelect: function(date) {
            $("#edit-day-of-job").addClass('filled');
          }
        });
        
        $("#day-of-accepcert").datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: '+443:+543',
          dateFormat: 'dd/mm/yy',
          onSelect: function(date) {
            $("#edit-day-of-accepcert").addClass('filled');
          }
        });




        $("#day-of-expirecert").datepicker({
          changeMonth: true,
          changeYear: true,
          yearRange: '+443:+555',
          dateFormat: 'dd/mm/yy',
          setDate: '01/01/2563',
          onSelect: function(date) {
            $("#edit-day-of-accepcert").addClass('filled');
          }
        });



        $(document).ready(function() {
            $('.note').select2();
        });

       //$('#date-of-birth').datepicker("setDate",currentDate );
       // $('#date-of-job').datepicker("setDate",currentDate );
  </script>
  <!-- <script src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js">//เช็คตัอักษร</script>
  <script src="https://unpkg.com/bootstrap@4.1.0/dist/js/bootstrap.min.js">//เช็คตัอักษร</script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>