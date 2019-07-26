<!DOCTYPE html>
<html>
<head>
  <title></title>

<!-- <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
<script type="text/javascript"> -->
<!-- // $(function(){
//  setInterval(function(){ // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
//   // 1 วินาที่ เท่า 1000
//   // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 3 วินาที
//   var getData=$.ajax({ // ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
//     url:"gdata.php",
//     data:"cc",
//     async:false,
//     success:function(getData){
//             console.log(getData);

//      $("#showData").html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง

//     }
//   }).responseText;
//  },3000); 
// });
 -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var shownIds = new Array();

            setInterval(function(){
                $.get("realtime_opd.php", function(data){
                    data = $.parseJSON(data);
                            $("#showData").html(data);
                });
            }, 5000);
        });
    </script>
</head>


<body>
<div id="showData"></div>
</body>
</html>