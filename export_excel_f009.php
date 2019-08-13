<?php
$todate = date('Ymd_His');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export".$todate.".xls");
?>
<!DOCTYPE html>
<html>
<?php
include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";
include"config/head.class.php"; 
include('config/my_con.class.php');
$bm = new Timer; 
$bm->start();
for( $i = 0 ; $i < 100000 ; $i++ )
{
    $i;
}

$sql        =  $_GET['sql'];
$send_excel =  $_GET['sql'];
$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
foreach($res as $item) {
    $sql_detail = $item['sql_code'];
    $sql_head   = $item['sql_head'];
}


                $datepickers   = $_POST['datepickers'];
                $datepickert   = $_POST['datepickert'];
                $dep_dropdown   = $_POST['c_department'];    

                if($datepickers != "--") {
                    $sql = " $sql_detail ";
                    $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
                    $sql = str_replace("{datepickert}", "'$datepickert'", $sql);
                    $sql = str_replace("{dep_dropdown}", "'$dep_dropdown'", $sql);
                    $result = pg_query($sql);
                    ?>
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <?php
                                            $i = pg_num_fields($result);
                                            for ($j = 0 ; $j < $i ; $j++) {
                                                $fieldname = pg_field_name($result, $j);
                                                  echo '<th  bgcolor="##1790DE" >' . $fieldname . '</th>';
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
                                            <?php  
                                        }
                                        ?>                                   
                                    </tbody>
                                </table>            

                <?php 
            }
            ?>

    <script type="text/javascript">
        function export_excel()
        {
            document.location = "export_excel_f009.php?send_excel=<?php echo $send_excel; ?>";
        }
    </script>


</body>
</html>