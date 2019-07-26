<?php
include('my_con.class.php');
$topLevelItems = " SELECT * FROM cpareport_mainmenu WHERE main_status = '1' ORDER BY main_id,main_order ASC ";
$res=mysqli_query($con,$topLevelItems);
?>
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">เมนูรายงาน MENU REPORT</li>

      <li class="">
        <a href="index.php">
         <i class="fa fa-home text-aqua"></i>
         <span>หน้าหลัก</span> 
       </a>
     </li>
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
               $link_mk =   "<a href=".$mk." title=".$title."><i class='fa fa-files-o text-aqua' ></i>".$sub_menu."</a>";
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
