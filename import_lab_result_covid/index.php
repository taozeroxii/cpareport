<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cv-19 import lab result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fulid" style="padding:50px">
        <hr>
        <h1> นำเข้าข้อมูล lab result จากไฟล์ excel </h1>
        <p> โปรดอัพโหลดไฟล์ที่เป็น excel 97-2003 เท่านั้น</p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select .xls to upload :
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" class="btn btn-primary" value="Upload" name="submit">
        </form>
        <hr>
        <a href="./PHPExcel/PHPExcelReadToMySQL.php"> <button class="btn btn-danger">... Update Data ...</button></a>
        <button class="btn btn-warning" onclick="myFunction()">... Clear Data ลบข้อมูลทั้งหมด...</button>
        <a href="./tableshowdata.php"> <button class="btn btn-success">... ตรวจสอบข้อมูลในฐานข้อมูล คลิ๊ก !! ...</button></a>
        <hr>
        <p class="mt-5"> ขั้นตอนการอัพโหลดข้อมูล</p>
        <p> 1. นำไฟล์ excel ที่ export จากโปรแกรม lab ชื่อไฟล์จะเป็นประมาณ speciment_export_1625887017860 มาเปิดและบันทึกใหม่ให้เป็น excel 97-2003 worksheet</p>
        <p> 2.ทำการอัพโหลดไฟล์ขึ้น server โดยการเลือกไฟล์และ กด upload </p>
        <p> 3.หลังจากทำการอัพโหลดไฟล์สำเร็จแล้วให้ทำการกด updateข้อมูล เพื่อปรับปรุงข้อมูลในฐานข้อมูลให้ตรงกับใน excel ไฟล์ที่ทำการอัพโหลดไป</p>
        <p>*************************************************************************************************************************************************************</p>
        <p style="color:red">**โปรดเลือกไฟล์อัพโหลดที่ถูกต้องและใช้ข้อมูลทั้งหมดจากไฟล์อัพโหลดได้เลย**</p>
        <p style="color:green">**การ Update Data จะอิงจากไฟล์ล่าสุดที่ทำการ upload ขึ้น server ไว้ โดยโปรแกรมจะล้างข้อมูลเดิมทั้งหมดออกและนำเข้าใหม่ทั้งหมด**</p>
    </div>
    <script>
        function myFunction() {
            var check =   confirm("ยืนยันลบข้อมูลทั้งหมดหรือไม่");
            if(check === true){
                console.log("ลบ")
                window.location.assign("./cleardata.php")
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>