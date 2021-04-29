<?php
session_start();
$_SESSION['qsql'] = $_POST['sql_q'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/autofill/2.3.5/js/dataTables.autoFill.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/autofill/2.3.5/css/autoFill.dataTables.min.css">
<link rel="stylesheet" href="css/q.css">
</head>
<body>
<?php 
include('../config/pg_con.class.php');
?>
<div class="container">
<h1>Query Data Report PostgresSQL..  <button class="btn btn-info" >
              <span class="" data-toggle="modal" data-target="#myModal">วิธีใช้</span>
          </button>
    </h1>
<form class="my-form" method="POST" action="#">
        <textarea class="col" placeholder="" name="sql_q" id="sql_q" rows="14" cols="100" required autofocus><?php echo $_SESSION['qsql']; ?></textarea>
        <div class="">
          <button class="btn btn-primary btn-block" type="submit">
              <span class="">Query SQL Process...</span>
          </button>
        </div>
  </div>
</form>
</div>
 <hr>
<?php 
$sql_q =  $_POST['sql_q'];
if ($_POST['sql_q'] != "") {
$sql = " $sql_q ";
$result = pg_query($sql);
?>
<div class="container">
  <div class="table-responsive-sm">          
  <table id="example" class="table table-hover">
    <thead>
      <tr class="th">
      <?php $i = pg_num_fields($result);
            for ($j = 0 ; $j < $i ; $j++) {
            $fieldname = pg_field_name($result, $j);
            echo '<th>' . $fieldname . '</th>';
            }
      ?>
      </tr>
    </thead>
    <tbody>
    <? $rw=0;
                while($row_result = pg_fetch_array($result)) 
                { 
                  $rw++;
                  ?>

      <tr class="tr">  
     <?php
                    for ($j = 0 ; $j < $i ; $j++) {
                      $fieldname = pg_field_name($result, $j);
                      echo '<td>' . $row_result[$fieldname] . '</td>';
                    } 
                    ?>
      </tr>
      <?php  
                }
     ?>
    </tbody>
  </table>
  </div>
</div>
<?php
} else {
}
?>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>








</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

