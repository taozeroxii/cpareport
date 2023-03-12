<?php
$dir =  'D:\Users\User\Desktop\nodejs_pj\autobackupMysql\autobackup\cpareport';
$files = scandir($dir);
// Loop through the list of files
// foreach ($files as $file) {
//     if ($file == "." || $file == "..") continue;
//     echo $file . "\n";
// }

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the selected file from the form
    $selectedFile = $_POST['file'];
    $filePath = $dir . '/' . $selectedFile;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Get the file information
        $fileName = basename($filePath);
        $fileSize = filesize($filePath);

        // Prepare the headers for download
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/octet-stream");
        header("Content-Length: $fileSize");

        // Read the file and send it to the browser
        readfile($filePath);
        exit;
    } else {
        echo "The selected file does not exist.";
    }
}
?>

<p>ดาวโหลด โครงสร้างและข้อมูล Backup ย้อนหลัง 7 วัน</p>
<!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="file">เลือกไฟล์ Backup Cpareport</label>
    <select name="file">
        <?php
        foreach ($files as $file) {
            if ($file == "." || $file == "..") continue;
            echo "<option value='$file'>$file</option>";
        }
        ?>
    </select>
    <input type="submit" name="submit" value="Download">
</form>