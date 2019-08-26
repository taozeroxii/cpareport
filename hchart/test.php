<?php
$connstring = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($connstring);
pg_set_client_encoding($conn, "utf8");
if ($conn->connect_error) {
	die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
$sql = " SELECT  CASE 
          WHEN date_part('MONTH' ,i.dchdate) = 1 THEN 'ม.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 2 THEN 'ก.พ.' 
          WHEN date_part('MONTH' ,i.dchdate) = 3 THEN 'มี.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 4 THEN 'เม.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 5 THEN 'พ.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 6 THEN 'มิ.ย'
          WHEN date_part('MONTH' ,i.dchdate) = 7 THEN 'ก.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 8 THEN 'ส.ค'
          WHEN date_part('MONTH' ,i.dchdate) = 9 THEN 'ก.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 10 THEN 'ต.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 11 THEN 'พ.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 12 THEN 'ธ.ค.'
          ELSE '-'
          END AS md 
          ,date_part('MONTH' ,i.dchdate) as dm
          ,date_part('YEAR' ,i.dchdate) as yy
          ,ROUND(avg(adjrw),4) cmi
         FROM ipt i
					left join pttype p1 on i.pttype = p1.pttype
         WHERE i.dchdate between '2019-01-01' AND '2019-12-31'
         GROUP BY md,dm ,yy 
         ORDER BY yy,dm ASC ";
			$stmt = $con->prepare($sql);
			$stmt ->execute();
			$result = $stmt->get_result();
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body> -->
	<div id="container" style="min-width: 110px; height: 150px; margin: 0 auto"></div>
	<table class="table" id="datatable">
		<thead>
			<tr>
				<th>เดือน</th>
				<th>ค่า CMI</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while($result = pg_fetch_array($query))
			{
				$cmi = $result['cmi'];
				?>
				<tr>
				<td><?php echo $result['md']; ?></td>
				<td><?php echo $cmi = ($cmi) ? $cmi : "0" ; ?></td>
				</tr>
				<?php
			}
			?>	
		</tbody>
	</table>
	<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>	
	<script>
		$(function () {

			$('#container').highcharts({
				data: {
				table: 'datatable'
			},
			chart: {
				type: 'column'
			},
			title: {
				text: ' '
			},
			yAxis: {
				allowDecimals: false,
				title: {
					text: 'ค่า'
				}
			},
			tooltip: {
				formatter: function () {
					return '<b>' + this.series.name + '</b><br/>' +
					this.point.y; + ' ' + this.point.name.toLowerCase();
				}
			}
		});
		});
	</script>
	
</body>
</html>