<?php
include('g_sql.php');
?>

<!DOCTYPE html>
<html style="height: 100%">
   <head>
       <meta charset="utf-8">
   </head>
   <body style="height: 50%; margin: 0">
     
       <div id="admit_cur" style="height: 100%"></div>

       <script type="text/javascript" src="js/echarts.min.js"></script>
       <script type="text/javascript">
				var dom = document.getElementById("admit_cur");
				var myChart = echarts.init(dom);

				var seriesData = <?=json_encode($admit_cur)?>;
				
				option = {
					title : {
						text: 'จำนวน Admit',
						subtext: 'ข้อมูล ณ .....................................',
						x:'center'
					},
					tooltip : {
						trigger: 'item',
						formatter: "{a} <br/>{b} : {c} ({d}%)"
					},

					series : [
						{
							name: 'ผู้ป่วยรับ ADMIT',
							type: 'pie',
							data: seriesData,
							itemStyle: {
								emphasis: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)'
								}
							}
						}
					]
				};

				if (option && typeof option === "object") {
					myChart.setOption(option, true);
				}
       </script>
       
   </body>
</html>