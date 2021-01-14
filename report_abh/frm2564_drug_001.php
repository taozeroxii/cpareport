<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <title></title>
</head>

<body>
<br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4> Report-รายการติดตามการใช้ยา-เลือกรายการ </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 btn-info">&nbsp;</div>
            <div class="col-sm-4 ">&nbsp;</div>
            <div class="col-sm-4 ">&nbsp;</div>
        </div>
        <br>
        <form name="register" action="check_drug_001.php" method="GET" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-2"> เลือกวันที่เริ่ม </div>
                <div class="col-sm-3" align="left">
                    <input name="stdate" type="date" required class="form-control" id="stdate" placeholder= />
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-2"> เลือกวันที่สิ้นสุด </div>
                <div class="col-sm-3" align="left">
                    <input name="endate" type="date" class="form-control" id="endate" placeholder="" />
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-3">
                  <center>  <button type="submit" class="btn btn-info" id="btn"><span class="glyphicon glyphicon-ok"></span> ตกลง </button></center>
                </div>

            </div>
        </form>
    </div>

</body>
</html>