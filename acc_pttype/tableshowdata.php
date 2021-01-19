<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ตารางข้อมูล</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="hold-transition sidebar-mini">

    <?php include "./navbar.php" ?>

    <div class="wrapper mt-5">
        <div class="wrapper">
            <?php
            include("../config/my_con.class.php");
            include("../config/pg_con.class.php");

            $getpage = $_GET['page'];
            $inpage = '';

            $Arrayptyhos = [];
            $Arrayptymy = [];

            if ($getpage == 'editptyopd') {
                $sqlgetfrompage = "select * from cpareport_pttype_acc_opd order by pttype";
                $resultquery = mysqli_query($con, $sqlgetfrompage);
                $sqlgethosxp = "select pttype,name from pttype order by pttype";
                $resultqueryhos = pg_query($conn, $sqlgethosxp);
                $cc = 0;
             
                while ($row_result = pg_fetch_assoc($resultqueryhos)) {
                    $cc++;
                    array_push( $Arrayptyhos, $row_result['pttype']);
                }
            } else if ($getpage == 'editptyipd') {
                $sqlgetfrompage = "select * from cpareport_pttype_acc_ipd order by pttype";
                $resultquery = mysqli_query($con, $sqlgetfrompage);
                $sqlgethosxp = "select pttype,name from pttype order by pttype";
                $resultqueryhos = pg_query($conn, $sqlgethosxp);

                while ($row_result = pg_fetch_assoc($resultqueryhos)) {
                    $cc++;
                    array_push( $Arrayptyhos, $row_result['pttype']);
                }
            }

            ?>



            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">แสดงผลข้อมูล <?php echo $getpage; ?></h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                while ($property = mysqli_fetch_field($resultquery)) {
                                                    $index += 1;
                                                    echo '<th>' . $ar[$index] = $property->name . '</th>';
                                                }
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row_result = mysqli_fetch_assoc($resultquery)) {
                                                echo '<tr role="row">';
                                                for ($i = 0; $i < $index; $i++) {
                                                    $colObj = mysqli_fetch_field_direct($resultquery, $i);
                                                    $col = $colObj->name;
                                                    if ($i == 0) {
                                                        array_push( $Arrayptymy, $row_result['pttype']);
                                                        echo
                                                            '<td>
                                                            <a class="btn btn-outline-info" href="./' . $getpage . '.php?pkid=' . $row_result[$col] . ' ">
                                                             <i class="fa fa-edit ">แก้ไข</i></a>&nbsp;&nbsp;&nbsp;' . $row_result[$col] .
                                                                '</td>';
                                                    }
                                                    if ($i > 0) {
                                                        echo '<td>' . $row_result[$col] . '</td>';
                                                    }
                                                }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    
                                    <p style="color:red;">** หมายเหตุ**  สิทธิ pttype ที่มีใน hosxp แต่ยังไม่มีใน mysql ฐานนี้
                                        <?php
                                            $difference = array_diff($Arrayptyhos, $Arrayptymy);
                                            // print_r($result);    
                                            display_array($difference);
                                            
                                            function display_array($array) {
                                                foreach ($array as $el) {
                                                    echo  "  $el   ";
                                                }
                                                echo "\n";
                                            }
                                        ?>
                                     </p>


                               
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


    </div>
    <!-- ./wrapper -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>