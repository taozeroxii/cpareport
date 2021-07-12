<?php
$target_dir = "PHPExcel/uploads";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

$datetime = date("Ymd");
$var = pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
$new_name =  "myDatas" . $datetime . "." . $var;
$file_path = "PHPExcel/uploads/";
$path_up = $file_path . $new_name;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    // Allow certain file formats
    if ($imageFileType != "xls") {
        echo "ผิดพลาด, โปรอัพโหลดเฉพาะไฟล์นามสกุล  xls.";
        $uploadOk = 0;
    } else {
        if (!file_exists($path_up)) { //หากเจอไฟล์ที่ชื่อเดียวกับหรือคืออัพไฟล์ในวันเดี่ยวกันให้ลบไฟล์เดิมออกก่อน
            unlink('myDatas' . $datetime . $var);
        }

        $done = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $path_up); //เพิ่มไฟล์ลงโฟลเดอร์
        if ($done) { //หากอัพโหลดสำเร็๗ให้เพิ่มข้อมูลลง DB 
            echo ("<script LANGUAGE='JavaScript'> window.alert('Succesfully Updated');  window.location.href='./'; </script>");
        } else {
            echo ("<script LANGUAGE='JavaScript'> window.alert('Updated failer Please Try again');  window.location.href='./'; </script>");
        }
    }
}
