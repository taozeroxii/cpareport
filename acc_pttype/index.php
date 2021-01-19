<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php 
        include "navbar.php"; 
        include("../config/my_con.class.php");

        $reportmenyu = "select cm.*,sql_file,sql_type from cpareport_menu  cm  inner  join cpareport_sql cs on cs.sql_file = cm.menu_file and cs.sql_mapacc_type = '1' ";
        $qreportmenyu = mysqli_query($con, $reportmenyu );
    ?>

    <div class="container">
        <div class="accordion mt-5" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            รายงานที่ map สิทธิกับบัญชี &nbsp;<hilight style="color:red">* หมายเหตุ ไม่ควรดึงข้อมูลมากๆในครั้งเดียว !!* </hilight>
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="container">
                        <div class="list-group">
                        <?php   while ($property = mysqli_fetch_assoc($qreportmenyu)) {?>
                            <a href="./form1.php?sql_file=<?php echo $property['menu_file']?>">
                            <button type="button" class="list-group-item list-group-item-action" ><?php echo $property['id'].' : '.$property['menu_title'];?> </button></a>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        test#2
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                       test
                    </div>
                </div>
            </div>

        </div>



</body>

</html>