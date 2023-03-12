<?php
$dir =  'D:\Users\User\Desktop\nodejs_pj\autobackupMysql\autobackup\cpareport';
$destination = "C:nhsoauthen";
$files = scandir($dir);

foreach ($files as $file) {
  if (!is_dir($file)) {
    $source = $dir . '/' . $file;
    $dest = $destination . '/' . $file;
    copy($source, $dest);
  }
}
?>
