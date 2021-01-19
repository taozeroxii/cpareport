<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel</title>
</head>

<body>
    <?php
    include("../config/my_con.class.php");
    include("../config/pg_con.class.php");
    $todate = date('Ymd_His');
    header("Content-Disposition: attachment; filename=export_mapfinance".$todate.".xls");

    $sql_file = $_GET['sql_file'];
    $sqlgethosxp = "";
    $selectQuery_fromdb = "select cs.*,cmt.menu_type_id,cmt.menu_type_name_th from cpareport_sql  cs LEFT JOIN cpareport_menu_type cmt on cmt.menu_type_id = cs.sql_type where cs.sql_file ='$sql_file'";
    $query_fromGet = mysqli_query($con, $selectQuery_fromdb);

    while ($sql_selecthos = mysqli_fetch_assoc($query_fromGet)) {
        $sqlhead      = $sql_selecthos['sql_head'];
        $sqltype      = $sql_selecthos['menu_type_name_th'];
        $sqltypeid    = $sql_selecthos['menu_type_id'];
        $sqlgethosxp  = $sql_selecthos['sql_code']; // ดึง query เพื่อ replace
    }

    $datepickers    = $_GET['datepickers'];
    $datepickert    = $_GET['datepickert'];
    $multiplepttype = $_GET['multiple_pttype'];
    $multipleSpclty = $_GET['multiple_spclty'];
    $multipleward   = $_GET['multiple_ward'];


    $sqlgethosxp = str_replace("{datepickers}", "'$datepickers'", $sqlgethosxp);
    $sqlgethosxp = str_replace("{datepickert}", "'$datepickert'", $sqlgethosxp);
    $sqlgethosxp = str_replace("{multiple_pttype}", "$multiplepttype", $sqlgethosxp);
    $sqlgethosxp = str_replace("{multiple_spclty}", "$multipleSpclty", $sqlgethosxp);
    $sqlgethosxp = str_replace("{multiple_ward}", "$multipleward", $sqlgethosxp);
    $resultqueryhos =   pg_query($conn, $sqlgethosxp);
    ?>

    <div class="container">
        <table id="example1" class="table-responsive table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <?php
                    $i = pg_num_fields($resultqueryhos);
                    for ($j = 0; $j < $i; $j++) {
                        $fieldname = pg_field_name($resultqueryhos, $j);
                        echo '<th>' . $fieldname . '</th>';
                    }
                    ?>
                    <th>acc_code</th>
            </thead>

            <?php
            while ($property2 = pg_fetch_assoc($resultqueryhos)) {
                $rw++;
                $checktd = 0;
                echo '<tr>';
                $pttype =  $property2['pttype'];
                $hospmain =  $property2['hospmain'];
                for ($j = 0; $j < $i; $j++) {
                    $fieldname = pg_field_name($resultqueryhos, $j);
                    echo '<td >' . $property2[$fieldname] . " " . '</td> ';
                }
                //เช็คประเภท OPD IPD เพื่อเอาไปmap กับสิทธิการเงิน
                if ($sqltypeid != '1') {
                    $sqlgetfrompage = "select pttype,name,hospmain,op_acccode from cpareport_pttype_acc_ipd where pttype = '$pttype' AND ( hospmain = '$hospmain' OR hospmain is null)";
                } else {
                    $sqlgetfrompage = "select pttype,name,hospmain,op_acccode from cpareport_pttype_acc_opd where pttype = '$pttype' AND ( hospmain = '$hospmain' OR hospmain is null)";
                }

                $resultquery = mysqli_query($con, $sqlgetfrompage);
                while ($property = mysqli_fetch_assoc($resultquery)) {
                    if (($property['pttype'] == $property2['pttype']) && (($property['hospmain'] == $property2['hospmain']) || $property['hospmain'] == null)) {
                        $checktd = 1;
                        echo "<td> " . $property['op_acccode'] .  '</td>';
                    }
                }
                if ($checktd == 0) {
                    echo "<td>  </td>";
                }
            }
            ?>
        </table>

    </div>
</body>

</html>