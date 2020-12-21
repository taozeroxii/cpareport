<?php
$todate = date('Ymd_His');
//header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export".$todate.".xls");
?>
<html>
<body>
    <?php
    require "config/pg_con.class.php";
    include('config/my_con.class.php');
//รับค่าตัวแปรจากform ดึงค่ามา
$sql            = $_GET['send_excel'];
$datepickers    = $_GET['datepickers'];
$datepickert    = $_GET['datepickert'];
$i_dropdown     = $_GET['i_dropdown'];
$ward_dropdown  = $_GET['ward_dropdown'];
$beginage       = $_GET['beginage'];
$endage         = $_GET['endage'];
$d_doctor       =  $_GET['d_doctor'];
$dental_diag    =  $_GET['dental_diag'];
$room           =  $_GET['room'];
$diag_1         =  $_GET['diag_1'];
$diag_2         =  $_GET['diag_2'];
$multiward_dropdown =  $_GET['multiward_dropdown']; // select 2 ward
$multiplespclty_dropdown = $_GET['multiplespclty_dropdown'];// select 2 spclty
// ส่วนฟอร์มยา
$timeindrug     =  $_GET['timeindrug'];
$timeoutdrug    =  $_GET['timeoutdrug'];
$user_k    =  $_GET['userdrug'];
$pct_dropdown    =  $_GET['pct_dropdown'];//SPCLTY แผนก
$u_group_dropdown    =  $_GET['usergroup_dropdown'];//SPCLTY usergroup

$l_dropdown  = $_GET['l_dropdown']; //labgroup


$topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
$res=mysqli_query($con,$topLevelItems);
//วนหา sql จากไฟล์ที่กดเข้ามาและแทนที่ตัวแปรใน query กับค่าที่ส่งมา
foreach($res as $item) {
    $sql_detail = $item['sql_code'];
}
                    $sql = " $sql_detail ";
                    $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
                    $sql = str_replace("{datepickert}", "'$datepickert'", $sql);
                    $sql = str_replace("{i_dropdown}", "$i_dropdown", $sql);
                    $sql = str_replace("{ward_dropdown}", "'$ward_dropdown'", $sql);
                    $sql = str_replace("{beginage}", "$beginage", $sql);
                    $sql = str_replace("{endage}", "$endage", $sql);
                    $sql = str_replace("{d_doctor}", "$d_doctor", $sql);
                    $sql = str_replace("{diag_dental}", "$dental_diag", $sql);
                    $sql = str_replace("{kskdepartment}", "$room", $sql);

                    $sql = str_replace("{diag_1}", "'$diag_1'", $sql);
                    $sql = str_replace("{diag_2}", "'$diag_2'", $sql);

                    $sql = str_replace("{time_in}", "'$timeindrug'", $sql);
                    $sql = str_replace("{time_out}", "'$timeoutdrug'", $sql);
                    $sql = str_replace("{user_k}", "'$user_k'", $sql);
                    $sql = str_replace("{pct_dropdown}", "'$pct_dropdown '", $sql);
                    $sql = str_replace("{usergroup_dropdown}", "$u_group_dropdown", $sql);

                    $sql = str_replace("{multiward_dropdown}", "$multiward_dropdown", $sql);
                    $sql = str_replace("{multiplespclty_dropdown}", "$multiplespclty_dropdown", $sql);

                    $sql = str_replace("{lab_group}", " $l_dropdown", $sql);  
                                  
          
                    $result = pg_query($sql);
    ?>
    <table width="100%" border="1">
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
            <?php $rw=0;
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
        </table>
        <?php
        pg_close($conn);
        ?>
    </body>
    </html>