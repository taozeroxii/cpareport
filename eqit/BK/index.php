<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">

                <a href="#" class="navbar-brand">
                    <img src="images/6.jpg" alt="logo" width="130" height="80"> iT Equipment (แบบฟอร์มขอยืมอุปกรณ์คอมพิวเตอร์)
                </a>
            </div>
        </nav>
    </header>
    <div class="container">
    รายการอุปกรณ์
    <hr>
        <div class="col-12">   
            <form class="row g-2 needs-validation" novalidate>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-com" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-com">คอมพิวเตอร์</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>

                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-ups" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-ups">สำรองไฟ (UPS)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (ตัว)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-mouse" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-mouse">เม้าส์ (Mouse)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (อัน)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-key" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-key">คีย์บอร์ด (Keyboard)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (อัน)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-sw" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-sw">สวิต (Switch Hub)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (ตัว)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-mini" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-mini">มินิคีย์ออส (Minikiosk)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="btn-check" name="1" id="btn-check-outlined-print" autocomplete="off">
                    <label class="btn btn-outline-primary d-grid gap-2" for="btn-check-outlined-print">เครื่องพิมพ์ (Printer)</label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>

        <hr>
        ข้อมูลผู้ขอเบิกอุปกรณ์
    <hr>
            <form class="row g-2 needs-validation" novalidate>
            <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>

                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (ตัว)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
 
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (อัน)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
       
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (อัน)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
     
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (ตัว)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
     
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
      
                <div class="col-md-2">
                    <input type="text" class="form-control" id="validationCustom02" value="" placeholder="จำนวน (เครื่อง)" required>
                </div>
                <div class="col-md-4">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" placeholder="หมายเลขครุภัณฑ์" required>
                    </div>
                </div>
        </div>




    <!-- <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Submit form</button>
            </div> -->
    </form>


    </div>

</body>

</html>