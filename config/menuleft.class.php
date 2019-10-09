<?php
include('my_con.class.php');
$topLevelItems = " SELECT * FROM cpareport_mainmenu WHERE main_status = '1' ORDER BY main_order ASC ";
$res=mysqli_query($con,$topLevelItems);
session_start();
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
        </a>
    </div>

    <ul class="nav navbar-nav navbar-right">
    <?php  if (isset($_SESSION['username']) == "" || isset($_SESSION['username']) == null) {
         echo 
         '<li><a href="login.php"  target="_blank"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> Admin </a></li>
         <li><a href="loginuser.php"  target="_blank"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> LOGIN </a></li>';
       }else echo  '<li><a title="ADMIN LOGIN "><span class="glyphicon"></span>'.$_SESSION['fname'].' '.$_SESSION['lname'].'</a></li> 
       <li><a href="logout.php"  title="ADMIN LOGIN "><span class="glyphicon glyphicon-log-in"></span> LOGOUT </a></li>';
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
