<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <title></title>
</head>
<body>

<?php
date_default_timezone_set("Asia/Bangkok");
include "config/my_con.class.php";

 $ipupdate    = $_SERVER['REMOTE_ADDR'];
 $dateupdate  = date('Y-m-d H:i:s');
 $age       = $_POST['age'];
 $sex       = $_POST['sex'];
 $quser      = $_POST['quser'];
 $q1        = $_POST['q1'];
 $q2        = $_POST['q2'];
 $q3        = $_POST['q3'];
 $q4        = $_POST['q4'];
 $other     = $_POST['other'];
 $token     = $_POST['token'];
 $q         = $_POST['q'];
$sql = "INSERT INTO question_detail (dateupdate,ipupdate,sex,age,quser,q1,q2,q3,q4,other,token,q) 
VALUES ('$dateupdate','$ipupdate','$sex','$age','$quser','$q1','$q2','$q3','$q4','$other','$token','$q')";
$query = mysqli_query($con, $sql);
?>

<script>
//Swal.fire('ขอบคุณที่ให้ความร่วมมือ');


let timerInterval
Swal.fire({
  title: 'ขอขอบคุณที่ให้ความร่วมมือ',
  html: '<b></b> Loading...',
  timer: 1000,
  timerProgressBar: true,
  willOpen: () => {
    Swal.showLoading()
    timerInterval = setInterval(() => {
      const content = Swal.getContent()
      if (content) {
        const b = content.querySelector('b')
        if (b) {
          b.textContent = Swal.getTimerLeft()
        }
      }
    }, 100)
  },
  onClose: () => {
    clearInterval(timerInterval)
    window.location="qchart.php?/cpa.informaion.go.th#!@##$%^&*()*()";
  }
}).then((result) => {
  if (result.dismiss === Swal.DismissReason.timer) {
    console.log('I was closed by the timer')
  }
})
</script>
<?php
mysqli_close($con);
?>
</body>
</html>