<?php
/*
 * connection database
 */
include "../config/pg_con.class.php";
include "../config/func.class.php";
include "../config/time.class.php";
include "../config/head.class.php"; 
include '../config/my_con.class.php';
/*
 * check POST
 */
$categorie_id = isset($_POST['categories']) ? $_POST['categories'] : "";
$Query = "SELECT * FROM cpareport_menu where menu_main = '{$categorie_id}' order by menu_order";
$res=mysqli_query($con,$Query);
$Rows = mysqli_num_rows($res);


/*while ($Result = mysqli_fetch_assoc($res)) {
	echo "<option value=\"" . $Result['menu_order'] . "\">" . $Result['menu_sub'] .($Rows+1)."</option>";
}
*/

echo "<option value=\"" . ($Rows+1) . "\">".($Rows+1)."</option>";