<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> </title>
	<script type="text/javascript" src="jquery-1.4.2.js"></script>
	<script type="text/javascript" src="class/pdfobject.min.js"></script>
	<script type="text/javascript" src="class/pdfobject.js"></script>
	<style>
		.tabLayout{display: block;width: 300px;padding: 20px 10px;border: #C0C0C0 1px solid;}
		#menu-1,#menu-2,#menu-3,#menu-4,#menu-5,#menu-6,#menu-7,#menu-8,#menu-9{display: block;float: left;text-decoration: none;color: green;padding: 10px 20px;border: none; font-weight: bold;}
		.clear{clear: both;}

		.container { height: 600px; width: 1200px;}
		.pdfobject { border: 1px solid #666; }
		.hh{
			text-align: center
			;color:#055828; 
			font-weight: bold;
		}

	</style>
	<script>
		$(document).ready(function(){
			for(var i=2;i<=9;i++){
				$("#tab-"+i).css({'display':'none'});
			}
			$("#menu-1").css({'border':'#C0C0C0 0px solid','border-bottom':'none'});
			$('a').click(function(){
				var idName=$(this).attr('id');
				var splitNum=idName.split('-');
				var num=splitNum[1];
				for(var i=1;i<=9;i++){
					if(i==num){
						$("#menu-"+i).css({'border':'#19B85C 2px solid','border-bottom':'none'});
						$("#tab-"+i).css({'display':'block'});
					}else{
						$("#menu-"+i).css({'border':'none'});
						$("#tab-"+i).css({'display':'none'});
					}
				}
			});
		});
	</script>
</head>
<body>
<div class="hh">บัญชียาโรงพยาบาลชุมชน 61</div>
<hr>
	<a href="javascript: void();" id="menu-1">บช.ที่มีร่วมกัน</a>
	<a href="javascript: void();" id="menu-2">เรียงตามตัวอักษร</a>
	<a href="javascript: void();" id="menu-3">respiratory</a>
	<a href="javascript: void();" id="menu-4">กบินทร์บุรี</a>
	<a href="javascript: void();" id="menu-5">บ้านสร้าง</a>
	<a href="javascript: void();" id="menu-6">ประจันตคาม</a>
	<a href="javascript: void();" id="menu-7">ศรีมหาโพธิ</a>
	<a href="javascript: void();" id="menu-8">นาดี</a>
	<a href="javascript: void();" id="menu-9">ศรีสโหสถ</a>
	<br class="clear" />

	<div id="tab-1" class="container pdfobject"></div>
	<div id="tab-2" class="container pdfobject"></div>
	<div id="tab-3" class="container pdfobject"></div>
	<div id="tab-4" class="container pdfobject"></div>
	<div id="tab-5" class="container pdfobject"></div>
	<div id="tab-6" class="container pdfobject"></div>
	<div id="tab-7" class="container pdfobject"></div>
	<div id="tab-8" class="container pdfobject"></div>
	<div id="tab-9" class="container pdfobject"></div>

	<script>PDFObject.embed("filesubhos/1.pdf", "#tab-1");</script>
	<script>PDFObject.embed("filesubhos/2.pdf", "#tab-2");</script>
	<script>PDFObject.embed("filesubhos/3.pdf", "#tab-3");</script>
	<script>PDFObject.embed("filesubhos/4.pdf", "#tab-4");</script>
	<script>PDFObject.embed("filesubhos/5.pdf", "#tab-5");</script>
	<script>PDFObject.embed("filesubhos/6.pdf", "#tab-6");</script>
	<script>PDFObject.embed("filesubhos/7.pdf", "#tab-7");</script>
	<script>PDFObject.embed("filesubhos/8.pdf", "#tab-8");</script>
	<script>PDFObject.embed("filesubhos/9.pdf", "#tab-9");</script>

</body>
</html>