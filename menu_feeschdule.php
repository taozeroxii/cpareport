<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php
    include "./config/my_con.class.php";
    ?>

    <div class="container">
        <h1>Fee schdule</h1>

        <div class="row">


            <div class="col-6 ">
                <p>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-dark  btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        ทันตกรรม
                    </button>
                </div>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <a href="http://172.16.0.251/report/report_form_multipleselect.php?sql=sql_0161" target="blank" style="color: black;"> 6-12 ปี sealant เคลือบหลุมร่องฟัน ในเด็กวัยเรียน อายุ 6-12 ปี(ซี่)</a>
                        <hr>
                        <a href="http://172.16.0.251/report/report_form_multipleselect.php?sql=sql_0162" target="blank" style="color: black;"> 4-12 ปี ทาเคลือบ </a>
                        <hr>
                        <a href="http://172.16.0.251/report/report_form_multipleselect.php?sql=sql_0163" target="blank" style="color: black;"> ANC ตรวจ + ขูดหินปูน</a>
                        <hr>
                    </div>
                </div>
            </div>


            <div class="col-6">
            <p>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-dark  btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                        แผนไทย
                    </button>
                </div>
                </p>
                <div class="collapse" id="collapseExample2">
                    <div class="card card-body">
                        <a href="" style="color: black;"> test</a>
                        <hr>
                        <a href="" style="color: black;"> test</a>
                        <hr>
                    </div>
                </div>
            </div>







        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>


</html>