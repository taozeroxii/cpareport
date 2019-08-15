<?php echo '
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul  class="navbar-nav mr-auto mt-2 mt-lg-0">
      <a class="navbar-brand" href="#">ADMIN</a>
      <a class="nav-link " id="home-tab" data-toggle="tab" href="../" role="tab" aria-controls="home" aria-selected="true">หน้าแรก</a>
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="../test.php" role="tab" aria-controls="profile" aria-selected="false">เพิ่มQuery</a>
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="holiday.php" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </ul> ' ?>
    <? echo "<span  class='new_sql mr-4' >" . 'ผู้ใช้งาน : ' . $_SESSION['fname'] . ' ' . $_SESSION['lname'].' STATUS: ';
     if ($_SESSION['status'] == '1') { echo "admin  </span>";  } ?>
    <? echo '<a href="../logout.php" ><button class="btn-secondary btn-sm " >ออกจากระบบ</button> </a>
  </nav>';?>

