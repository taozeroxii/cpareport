<!DOCTYPE html>
<html>
<?php include"config/head.class.php"; 
include('config/my_con.class.php');
$hdetail  = " SELECT * FROM cpareport_link_out ORDER BY id DESC ";
$row=mysqli_query($con,$hdetail);
?>
<style type="text/css">
  .hhh {
    color: #34495E;
    font-weight: bold;
    font-size: 1.6em;
  }
  .iconweb,p{
    padding: 1%;
    margin: 1%;
    width: 120px;
    height: 120px;
    text-align: center;

  }
</style>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="#" class="logo">
        <span class="logo-mini"><b>r</b>CPA</span>
        <span class="logo-lg"><b>Re</b>port Hospital</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
      </nav>
    </header>
    <?php include "config/menuleft.class.php"; ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
         LINK GROUP ONLINE 
       </h1>
     </section>
     <section class="content">

      <div class="row">
        <?php 
        foreach($row as $item) {
              $name_link =   $item['name_link'];
              $img_link  =   $item['img_link'];
              $path_link  =   $item['path_link'];
              $title_link  =   $item['title_link'];
         ?>
         <div class="col-md-2">  
          <div data-toggle="popover" data-container="body" data-trigger="hover" data-placement="top" data-original-title="" >
            <a href="<?php echo $path_link; ?>" target="_blank" title="<?php echo $title_link; ?>">
              <img src="<?php echo $img_link; ?>" alt="" class="iconweb">
              <p><?php echo $name_link; ?></p>
            </a>
          </div>
        </div>
        <?php
      }
      ?>
    </div>


<!--


      
      <div class="row">
        <div class="col-md-6">
          <a href="https://hdcservice.moph.go.th/hdc/main/index.php" class="btn btn-app" target="_blank">
            <span class="hhh"> <i class="glyphicon glyphicon-hand-right">   </i> HDC (Health Data Center) กระทรวงสาธารณสุข</span>
          </a>                                                                                                
        </div>
        <div class="col-md-6">
          <a href="http://www.chi.or.th/" class="btn btn-app" target="_blank">
            <span class="hhh">  <i class="glyphicon glyphicon-hand-right">  </i> สำนักงานสารสนเทศบริการสุขภาพ</span>
          </a>                                                                                                
        </div>
      </div>  

      <div class="row">
        <div class="col-md-6">
          <a href=" http://eclaim.nhso.go.th/webComponent/" class="btn btn-app" target="_blank">
            <span class="hhh"> <i class="glyphicon glyphicon-hand-right">   </i> eclaim </span>
          </a>                                                                                                
        </div>
        <div class="col-md-6">
          <a href="http://www.cpa.go.th/" class="btn btn-app" target="_blank">
            <span class="hhh">  <i class="glyphicon glyphicon-hand-right">  </i> เว็บไซต์โรงพยาบาล</span>
          </a>                                                                                                
        </div>
      </div>  
      <div class="row">
        <div class="col-md-6">
          <a href="https://www.moph.go.th/" class="btn btn-app" target="_blank">
            <span class="hhh"> <i class="glyphicon glyphicon-hand-right">   </i> กระทรวงสาธษรณสุข </span>
          </a>                                                                                                
        </div>
        <div class="col-md-6">
          <a href="config/goto_UpToDate.php" class="btn btn-app" target="_blank">
            <span class="hhh">  <i class="glyphicon glyphicon-hand-right">  </i> UpTpDate</span>
          </a>                                                                                                
        </div>
      </div>  
    -->


  </section>        
</div>

<?php include"config/footer.class.php"; ?> 
<?php include"config/js.class.php" ?>
</body>
</html>
