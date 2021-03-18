<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Data Report HosXP</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
<link rel="stylesheet" href="css/q.css">




</head>
<body>

<?php 
include('../config/pg_con.class.php');
//include"config/func.class.php";
//include"config/time.class.php";
//include"config/head.class.php"; 
include('../config/my_con.class.php');
?>


<form class="my-form" method="POST" action="#">
  <div class="container">
    <h1>Query Data Report. </h1>
    <ul>
      <!-- <li>
        <select>
          <option selected disabled>-- Please choose an option --</option>
          <option>Request Quote</option>
          <option>Send Resume</option>
          <option>Other</option>      
        </select>
      </li>
      <li>
        <div class="grid grid-2">
          <input type="text" placeholder="Name" required>  
          <input type="text" placeholder="Surname" required>
        </div>
      </li>
      <li>
        <div class="grid grid-2">
          <input type="email" placeholder="Email" required>  
          <input type="tel" placeholder="Phone">
        </div>
      </li>     -->
      <li>
        <textarea class="" placeholder="" name="sql_q" id="sql_q"  rows="" cols="" autofocus required >SELECT
        </textarea>
      </li>   
      <li>
        <input type="checkbox" id="terms">
        <!-- <label for="terms">ยืนยัน CodeSQL <a href=""></a></label> -->
      </li>  
      <li>
        <div class="grid grid-3">
          <!-- <div class="required-msg">REQUIRED FIELDS</div> -->
          <button class="btn-grid" type="submit" >
          <!-- <button class="btn-grid" type="submit" disabled> -->
            <span class="back">
              <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/email-icon.svg" alt=""> -->
              <span class="front">Q</span>
            </span>
            <span class="front">ค้นหา</span>
          </button>
          <button class="btn-grid" type="reset" >
          <!-- <button class="btn-grid" type="reset" disabled> -->
            <span class="back">
              <!-- <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/eraser-icon.svg" alt=""> -->
              <span class="front">...</span>
            </span>
            <span class="front">Clear</span>
          </button> 
        </div>
      </li>    
    </ul>
  </div>
</form>
<footer>
  <div class="container">
    <!-- <small>Made with <span>❤</span> by <a href="http://georgemartsoukos.com/" target="_blank">George Martsoukos</a> -->
    </small>
  </div>
</footer>

<?php 
$sql_q =  $_POST['sql_q'];

$sql = " $sql_q ";
$result = pg_query($sql);
?>
  <body>
  <table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
                  <?php
                  $i = pg_num_fields($result);
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
                    <tr> 
     <?php
                    for ($j = 0 ; $j < $i ; $j++) {
                      $fieldname = pg_field_name($result, $j);
                      echo '<td>' . $row_result[$fieldname] . '</td>';
                    } 
                    ?>
        </tr> 
    </tbody>
    <?php  
                }
                ?>    
  </table>
</body>











</body>
</html>


<script type="text/javascript">
// const checkbox = document.querySelector('.my-form input[type="checkbox"]');
// const btns = document.querySelectorAll(".my-form button");

// checkbox.addEventListener("change", function() {
//   const checked = this.checked;
//   for (const btn of btns) {
//     checked ? (btn.disabled = false) : (btn.disabled = true);
//   }
// });

$(document).ready(function() {
  var table = $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
    {
      extend: 'excel',
      text: 'Export excel',
      className: 'exportExcel',
      filename: 'Export excel',
      exportOptions: {
        modifier: {
          page: 'all'
        }
      }
    }, 
    {
      extend: 'copy',
      text: '<u>C</u>opie presse papier',
      className: 'exportExcel',
      key: {
        key: 'c',
        altKey: true
      }
    }, 
    {
      text: 'Alert Js',
      className: 'exportExcel',
      action: function(e, dt, node, config) {
        alert('Activated!');
        // console.log(table);

        // new $.fn.dataTable.Buttons(table, {
        //   buttons: [{
        //     text: 'gfdsgfsd',
        //     action: function(e, dt, node, config) {
        //       alert('ok!');
        //     }
        //   }]
        // });
      }
    }]
  });

});
</script>

