<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tab Styles Inspiration</title>
  <meta name="description" content="Tab Styles Inspiration: A small collection of styles for tabs" />
  <meta name="keywords" content="tabs, inspiration, web design, css, modern, effects, svg" />
  <meta name="author" content="Codrops" />
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/tabs.css" />
  <link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="js/modernizr.custom.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
  <style>
    .nameofinput {
      font-size: 12px;
      float: left;
    }
  </style>
  <!-- 		<svg class="hidden">
			<defs>
				<path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
			</defs>
		</svg> -->
  <div class="container">
    <!-- Top Navigation -->
    <!-- 			<div class="codrops-top clearfix">
				<a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Tutorials/PagePreloadingEffect/"><span>Previous Demo</span></a>
				<span class="right"><a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=19559"><span>Back to the Codrops Article</span></a></span>
			</div> -->
    <!-- 		<header class="codrops-header">
				<h1>Tab Styles Inspiration <span>A small collection of styles for tabs</span></h1>
				<p class="support">Your browser does not support <strong>flexbox</strong>! <br />Please view this demo with a <strong>modern browser</strong>.</p>
			</header> -->
    <section>
      <div class="tabs tabs-style-bar">
        <nav>
          <ul>
            <li><a href="#section-bar-1" class="icon icon-tools"><span> ขอเพิ่มชื่อเข้าใช้งานในระบบ HosXp </span></a></li>
            <li><a href="#section-bar-2" class="icon icon-tools"><span> ขอเพิ่มหัตถการใช้งานในระบบ HosXp </span></a></li>
            <li><a href="#section-bar-3" class="icon icon-tools"><span>ขอเพิ่มLab HosXp</span></a></li>
            <!-- <li><a href="#section-bar-4" class="icon icon-tools"><span>Upload</span></a></li>
							<li><a href="#section-bar-5" class="icon icon-tools"><span>Settings</span></a></li> -->
          </ul>
        </nav>



        <div class="content-wrap border">
          <section id="section-bar-1">
            <div class="container">
              <form action="#" class="form-horizontal">

                <div class="form-group has-success">
                  <div class="row">
                    <div class="col-sm-1">
                      <span class="nameofinput">คำนำหน้า</span>
                      <select class="form-control" id="inputGroupSelect01" name="pname" require>
                        <option selected> ...</option>
                        <option value="1">นาย</option>
                        <option value="2">นาง</option>
                        <option value="3">น.ส.</option>
                        <option value="4">นพ.</option>
                        <option value="5">นศพ.</option>
                        <option value="6">พญ.</option>
                        <option value="7">พทป.</option>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <span class="nameofinput">ชื่อ</span>
                      <input class="form-control" type="text" placeholder="ชื่อ" name="fname" require>
                    </div>
                    <div class="col-sm-3">
                      <span class="nameofinput">นามสกุล</span>
                      <input class="form-control" type="text" placeholder="นามสกุล" name="lname" require>
                    </div>
                    <div class="col-sm-4">
                      <span class="nameofinput">ชื่อภาษาอังกฤษ</span>
                      <input class="form-control" type="text" placeholder="Fullname" name="engfullname">
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-1">
                      <span class="nameofinput">เพศ</span>
                      <select class="form-control" name="gender" require>
                        <option selected> ...</option>
                        <option value="1">ชาย</option>
                        <option value="2">หญิง</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">วันเดือนปีเกิด(คศ.)</span>
                      <input class="form-control" type="date" placeholder="ปีเกิด" name="birthday" require>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">เลขที่บัตรประชาชน</span>
                      <input class="form-control" type="text" placeholder="เลขที่บัตรประชาชน" name="cid" require>
                    </div>

                    <div class="col-sm-2">
                      <span class="nameofinput">ตำแหน่งหลัก</span>
                      <select class="form-control" id="inputGroupSelect01" name="jclass" require>
                        <option selected> โปรดเลือก ..</option>
                        <option value="1">แพทย์</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">แผนกสาขา</span>
                      <select class="form-control" id="inputGroupSelect01" name="jclass" require>
                        <option selected> แผนกสาขา ...</option>
                        <option value="1">Er</option>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">เฉพาะทาง</span>
                      <select class="form-control" name="specialty" require>
                        <option selected> ...</option>
                        <option value="1">ชาย</option>
                        <option value="2">หญิง</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-2">
                      <span class="nameofinput">เลขที่ใบประกอบวิชาชีพ</span>
                      <input class="form-control" type="text" placeholder="เลขที่ใบประกอบวิชาชีพ" name="doctorcert">
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">วันที่เข้าเริ่มงาน</span>
                      <input class="form-control" type="date" placeholder="ปีเกิด" name="birthday" require>
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">ชื่อเข้าใช้งาน Hosxp</span>
                      <input class="form-control" type="text" placeholder="๊User name" name="doctorcert">
                    </div>
                    <div class="col-sm-2">
                      <span class="nameofinput">รหัสผ่าน Hosxp</span>
                      <input class="form-control" type="text" placeholder="๊1234" name="doctorcert" disabled>
                    </div>
                  </div>
                </div>
            </div>
            <hr>
            <button type="button" class="btn btn-success" name="submitform1">แจ้งขอเพิ่มรายการผู้ใช้งาน</button>
            </form>
          </section>





          <section id="section-bar-2">
            <div class="container">
              <form action="" class="form-horizontal">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <span class="nameofinput">หมวดค่ารักษาพยาบาล</span>
                      <select class="form-control" require>
                        <option selected> ...</option>
                        <option value="1">ab</option>
                        <option value="2">abc</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <span class="nameofinput">ชื่อภาษาไทย</span>
                      <input class="form-control" type="text" placeholder="ชื่อ(ไทย)" name="doctorcert">
                    </div>
                    <div class="col-sm-4">
                      <span class="nameofinput">ชื่อภาษาอังกฤษ</span>
                      <input class="form-control" type="text" placeholder="ชื่อ(อังกฤษ)" name="doctorcert">
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-sm-1">
                      <span class="nameofinput">ราคาขาย</span>
                      <input class="form-control" type="text" placeholder="default" name="doctorcert">
                    </div>
                    <div class="col-sm-1">
                      <span class="nameofinput">ราคาทุน</span>
                      <input class="form-control" type="text" placeholder="" name="doctorcert">
                    </div>
                    <div class="col-sm-1">
                      <span class="nameofinput"> Bill code</span>
                      <input class="form-control" type="text" placeholder="" name="doctorcert">
                    </div>
                    <div class="col-sm-1">
                      <span class="nameofinput"> Bill number</span>
                      <input class="form-control" type="text" placeholder="" name="doctorcert">
                    </div>
                    <div class="col-sm-3">
                      <span class="nameofinput">ADP:code</span>
                      <select class="form-control" require>
                        <option selected> ...</option>
                        <option value="1">ab</option>
                        <option value="2">abc</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      <span class="nameofinput">ADP:TYPE</span>
                      <select class="form-control" require>
                        <option selected> ...</option>
                        <option value="1">ab</option>
                        <option value="2">abc</option>
                      </select>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-sm-6">
                      <span class="nameofinput">Product category (สกส.)</span>
                      <select class="form-control" require>
                        <option selected> ...</option>
                        <option value="1">ab</option>
                        <option value="2">abc</option>
                      </select>
                    </div>

                    <div class="col-sm-5">
                      <span class="nameofinput">กลุ่มการรักษา</span>
                      <select class="form-control" require>
                        <option selected> ...</option>
                        <option value="1">ab</option>
                        <option value="2">abc</option>
                      </select>
                    </div>
                  </div>

                  <hr>
                  <div class="row mt-5">
                    <div class="col-2">
                      <fieldset>
                        <legend>ข้าราชการ:</legend>
                        <span class="nameofinput">ข้าราช(ราคา)</span>
                        <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>

                    <div class="col-2">
                      <fieldset>
                        <legend>UCบัตรทอง:</legend>
                        <span class="nameofinput">UC(ราคา)</span>
                        <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-2">
                      <fieldset>
                        <legend>ประกันสังคม:</legend>
                        <span class="nameofinput">ประกันสังคม(ราคา)</span>
                        <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-2">
                      <fieldset>
                        <legend>พรบ:</legend>
                        <span class="nameofinput">พรบ(ราคา)</span>
                        <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-2">
                      <fieldset>
                        <legend>ชำระเงินเอง:</legend>
                        <span class="nameofinput">ชำระเงินเอง(ราคา)</span>
                        <input class="form-control" type="text" placeholder="ตามสิทธิใส่ราคาที่เบิกได้" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-1">
                      <fieldset>
                        <legend>อื่นๆ:</legend>
                        <span class="nameofinput">อื่นๆ(ราคา)</span>
                        <input class="form-control" type="text" placeholder="อื่นๆ" name="doctorcert">
                        <span class="nameofinput">ประเภท</span>
                        <select class="form-control" require>
                          <option selected> ...</option>
                          <option value="1">ตามสิทธิ</option>
                          <option value="2">ชำระเงินเอง(เบิกได้)</option>
                          <option value="3">ชำระเงินเอง(เบิกไม่ได้)</option>
                        </select>
                      </fieldset>
                    </div>
                  </div>
                </div>
            <hr>
            <button type="button" class="btn btn-success">แจ้งขอเพิ่มรายการหัตถการ</button>
            </form>
        </div>
    </section>



    
    <section id="section-bar-3">
      <p>3</p>
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
  </script>
</body>

</html>