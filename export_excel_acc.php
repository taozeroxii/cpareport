<?php
$todate = date('Ymd_His');
header("Content-Disposition: attachment; filename=ACC_".$todate.".xls");
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
$i_dropdown  =  $_GET['multiplepttype_dropdown']; // select 2 pttype
$host_dropdown = $_GET['multiplehost_dropdown'];// select 2  host



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
                    $sql = str_replace("{host_dropdown}", "$host_dropdown", $sql);
                   
          
                    $result = pg_query($sql);
                  echo  $sql;
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