<?php
include "db.php";
if (isset($_POST['search'])) {
   $id_code = $_POST['search'];
   $Query = "SELECT * FROM f43_check_code_error WHERE id_code LIKE '$id_code%%' ";
   $ExecQuery = MySQLi_query($con, $Query);
   mysqli_set_charset($con,"utf8");
   echo '
<ul>
   ';
   while ($Result = MySQLi_fetch_array($ExecQuery)) {
       ?>
   <!-- <li onclick='fill("<?php// echo $Result['id_code']; ?>")'> -->
   <a>
       <?php echo $Result['id_code']." ".$Result['code_name']." ".$Result['file_name']; ?>
   <!-- </li> -->
   <hr>
 </a>
   <?php
}}
?>
</ul>