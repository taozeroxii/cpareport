<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" >
    <script src="js/bootstrap.bundle.min.js" ></script>
    <script src="js/popper.min.js" ></script>
    <script src="js/bootstrap.min.js" ></script>
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
            <div class="col-sm-4 btn-danger">&nbsp;</div>
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