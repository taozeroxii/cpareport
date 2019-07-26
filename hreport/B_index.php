<!DOCTYPE html>
<html>
<?php include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/sql.class.php";
$bm = new Timer; 
$bm->start();
include"config/head.class.php"; 
for( $i = 0 ; $i < 100000 ; $i++ )
{
 $i;
}
?>
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
 
  </div>

  <?php include"config/footer.class.php"; ?>
  <?php include"config/js.class.php" ?>
  <?php include"modal/modal.class.php" ?>
  <script src="hchart/js/highcharts.js"></script>
  <script src="hchart/js/data.js"></script>
  <script src="hchart/js/exporting.js"></script>  
  <script>
    $(function () {

      $('#container').highcharts({
        data: {
        table: 'datatable'
      },
      chart: {
        type: 'column'
      },
      title: {
        text: ' '
      },
      yAxis: {
        allowDecimals: false,
        title: {
          text: 'ค่า'
        }
      },
      tooltip: {
        formatter: function () {
          return '<b>' + this.series.name + '</b><br/>' +
          this.point.y; + ' ' + this.point.name.toLowerCase();
        }
      }
    });
    });
  </script>
  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
</body>
</html>
