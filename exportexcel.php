<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excel</title>
</head>

<body>
    <?php
    include("./config/my_con.class.php");
    include("./config/pg_con.class.php");
    $todate = date('Ymd_His');
    header("Content-Disposition: attachment; filename=export".$todate.".xls");
    $sql = $_POST['sendsql'];
    $sql = strtoupper(str_replace("SELECTDATA", 'SELECT', $sql));  // แปลง select กลับมาเพื่อ query มาทำตาราง export excel
    $sql = strtoupper (str_replace("FROMTABLES", 'FROM', $sql));   // แปลง select กลับมาเพื่อ query มาทำตาราง export excel
    $resultqueryhos = pg_query($conn, $sql);
    ?>

    <div class="container">
        <table width="100%" border="1">
            <thead>
                <tr>
                    <?php
                    $i = pg_num_fields($resultqueryhos);
                    for ($j = 0; $j < $i; $j++) {
                        $fieldname = pg_field_name($resultqueryhos, $j);
                        echo '<th  bgcolor="#1abc9c" >' . $fieldname . '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php $rw = 0;
                while ($row_result = pg_fetch_array($resultqueryhos)) {
                    $rw++;
                ?>
                    <tr>
                        <?php
                        for ($j = 0; $j < $i; $j++) {
                            $fieldname = pg_field_name($resultqueryhos, $j);
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
    </div>
</body>

</html>