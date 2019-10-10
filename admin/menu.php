<?php echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<ul  class="navbar-nav mr-auto mt-2 mt-lg-0">
<a class="navbar-brand" href="../">Report</a>
<a class="nav-link " id="home-tab" data-toggle="tab" href="index.php" role="tab" aria-controls="home" aria-selected="true">หน้าแรก</a>
<a class="nav-link" id="profile-tab" data-toggle="tab" href="addquery.php" role="tab" aria-controls="profile" aria-selected="false">เพิ่มQuery</a>
<a class="nav-link" id="profile-tab" data-toggle="tab" href="sql_edit.php" role="tab" aria-controls="profile" aria-selected="false">แก้ไขQuery(main_sql)</a>
<a class="nav-link" id="contact-tab" data-toggle="tab" href="holiday.php" role="tab" aria-controls="contact" aria-selected="false">วันหยุด HOSxp</a>
<a class="nav-link" id="contact-tab" data-toggle="tab" target="blank" href="https://trello.com/abhaihelphos/home" role="tab" aria-controls="contact" aria-selected="false">รวมปัญหาต่างๆ </a>
<a class="nav-link" id="contact-tab" data-toggle="tab" target="blank" href="http://172.16.0.251/monitor/" role="tab" aria-controls="contact" aria-selected="false">Network Monitor </a>
</ul> ' ?>
<? echo "<span  class='new_sql mr-4' >" . 'ผู้ใช้งาน : ' . $_SESSION['fname'] . ' ' . $_SESSION['lname'].' STATUS: ';
if ($_SESSION['status']=='1') { echo "admin  </span>";  } ?>
<? echo '<a href="../logout.php" ><button class="btn-secondary btn-sm " >ออกจากระบบ</button> </a>
</nav>';?>


