<?php
include('my_con.class.php');
$topLevelItems = " SELECT * FROM cpareport_mainmenu WHERE main_status = '1' ORDER BY main_order ASC ";
$res=mysqli_query($con,$topLevelItems);
session_start();

if (isset($_SESSION['username']) != "" || isset($_SESSION['username']) != null) {
  $useronline = session_id();
  $time = time();
  $statusOnOf = 'online';
  $sql2 = "SELECT * FROM useronline where username = '".$_SESSION['username']."'";
  $result2 = mysqli_query($con,$sql2);
  $num = mysqli_num_rows($result2);

  if($num > 0){
      $checkuseronline = ("UPDATE useronline set status = '" .$statusOnOf . "' where  username = '".$_SESSION['username'] ."'");
      $Qstatus = mysqli_query($con, $checkuseronline);
      mysqli_query($con, $Qstatus);
      //$ud = ("UPDATE useronline set time_online = '" . $time. "'where session = '".$useronline."' AND  username = '".$_SESSION['username'] ."'");
      //$uf = mysqli_query($con, $ud);
      // mysqli_query($con, $uf);
  }
  else{
     echo $insertstatus = ("INSERT INTO useronline (username,status) VALUES ('" .$_SESSION['username']. "','online')");
      $Qinsertstatus = mysqli_query($con, $insertstatus);
      //$insertlog = ("INSERT INTO useronline (session,time_online,username) VALUES ('" . $useronline. "','" . $time. "','" .$_SESSION['username']. "')");
      //$Qinsertlog = mysqli_query($con, $insertlog);
  }
  //$timecheck = time() - 900;//ทุก 15 นาที
  $selectuserstatusonline = "select * from useronline where status = 'online'";
  $result2 = mysqli_query($con,$sql2);
  $countuseronline = mysqli_num_rows($result2);
}
?>
  <div class="wrapper ">
    <header class="main-header header ">
      <a href="#" class="logo">
        <span class="logo-mini"><b>r</b>CPA</span>
        <span class="logo-lg"><b>Re</b>port Hospital</span>
      </a>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <? if (isset($_SESSION['username']) != "" || isset($_SESSION['username']) != null) {?>
          จำนวนผู้ใช้งาน <?echo $countuseronline?> ท่าน 
          <?}?>
        </a>
    </div>

    <ul class="nav navbar-nav navbar-right">
    <script> function closeWin() {  window.close()} </script>
    <?php  if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
              echo  ' <li><a href="login.php" onclick="closeWin()" target="_blank"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> LOGIN </a></li>';
            }else {
              if(($_SESSION['status']) == "1"){echo '<li><a href="admin/"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> ADMIN </a></li>';}
              echo  '  <li><a title="ADMIN LOGIN "><span class="glyphicon"></span>ผู้ใช้งาน: '.$_SESSION['fname'].' '.$_SESSION['lname'].'</a></li> 
              <li><a href="logout.php"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> LOGOUT </a></li>';
            }
         ?>
    </ul>
  </div>
</nav>

    <!--Navbar -->
  </header>
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <!-- <li class="header">เมนูรายงาน MENU REPORT</li> -->
<li class="header">
      <div class="search-container">
        <form action="report/../s_report.php" name="s" id="s" method="get">
          <input type="text" placeholder=" ! ค้นหารายงาน... " name="search_menu">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </li>

      <li class="">
        <a href="index.php">
         <i class="fa fa-home text-aqua"></i>
         <span>หน้าหลัก</span> 
       </a>
     </li>
<!--      <li class="">
      <a href="/report_20190801/" target="_blank" title="รายงานเดิม กำลังปรับปรุงเข้าไปไว้ในหน้าแรก">
       <i class="fa fa-user text-aqua"></i>
       <span>REPORT_OLD</span> 
     </a>
   </li> -->
   <?php 
   foreach($res as $item) {
    $id_main = $item['main_name'];
    $id_sub  = $item['main_id'];
    ?>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-folder text-aqua"></i>
        <span><?php echo $id_main; ?></span> 
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right text-aqua"></i>
        </span>
      </a>
      <?php
      $subItems =" SELECT *  FROM cpareport_menu WHERE menu_main = '".$id_sub."' AND menu_status = '1' ORDER BY menu_order ASC ";
      $res2=mysqli_query($con,$subItems);
      ?>
      <ul class="treeview-menu">
        <?php
        foreach($res2 as $subItem) {
          $sub_menu   = $subItem['menu_sub'];
          $title      = $subItem['menu_title'];
          $mk         = $subItem['menu_link'];
          $mf         = $subItem['menu_file'];
          ?>
          <li>
            <?php
            if ($mf <> "") {
             $link_mk =   "<a href=".$mk."?sql=".$mf." title=".$title."><i class='fa fa-files-o text-aqua' ></i>".$sub_menu."</a>";
           }else
           if($mf == ""){
             $link_mk =   "<a href=".$mk." title=".$title." target='_blank'><i class='fa fa-files-o text-aqua' ></i>".$sub_menu."</a>";
           }
           echo  $link_mk;
           ?>

         </li>
         <?php
       }
       ?> 
     </ul> 
   </li>
   <?php 
 }
 ?>
</ul>  
</section>
</aside>
