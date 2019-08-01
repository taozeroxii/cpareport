<?php
$todate = date('Ymd_His');
//header("Content-type: application/vnd.ms-excel");
//header("Content-Disposition: attachment; filename=export".$todate.".xls");
?>
<html>
<body>
    <?php
    require "config/pg_con.class.php";
    include('config/my_con.class.php');

    $sql                = $_GET['send_excel'];
    $datepickers        = $_GET['datepickers'];
    $datepickert        = $_GET['datepickert'];
    
   $c_department       = $_GET['c_department'];
   $c_pttype           = $_GET['c_pttype'];


    $topLevelItems = " SELECT sql_code,sql_head FROM cpareport_sql WHERE sql_file = '".$sql."'";
    $res=mysqli_query($con,$topLevelItems);
    foreach($res as $item) {
        $sql_detail = $item['sql_code'];
    }
    $sql = " $sql_detail ";
    $sql = str_replace("{datepickers}", "'$datepickers'", $sql);
    $sql = str_replace("{datepickert}", "'$datepickert'", $sql);
    if(sizeof($c_department )>0){
        $sql .= " AND o.main_dep in (";
        foreach ($c_department as $value) {
            $sql .="'" .$value. "',";
        }
        $sql = rtrim($sql,',');
        $sql .= ") ";
    }
    if(sizeof($c_pttype )>0){
        $sql .= " AND o.pttype in (";
        foreach ($c_pttype as $value) {
            $sql .="'" .$value. "',";
        }
        $sql = rtrim($sql,',');
        $sql .= ") ";
    }
    $sql .= " ORDER BY  o.vsttime ASC ";
    $result = pg_query($sql);
   echo $sql;
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
        </table>
        <?php
        pg_close($conn);
        ?>
    </body>
    </html>