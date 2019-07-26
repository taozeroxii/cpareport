<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=testing.xls");
?>
<html>
<body>
<?php

require "pg_con.class.php";
$sql = $_GET['sql'];
$strSQL = "$sql";
$objQuery = pg_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="100%" border="1">
  	<tr>
        <th>#</th>
        <th>hn</th>
        <th>an</th>
        <th>ชื่อ-สกุล</th>
        <th>regdate</th>
        <th>dchdate</th>
        <th>PDX</th>
        <th>dx0</th>
        <th>dx1</th>
        <th>dx2</th>
        <th>dx3</th>
        <th>dx4</th>
        <th>dx5</th>
        <th>สถานะการจำหน่าย</th>
        <th>สิทธิ์การรักษา</th>
        <th>Ward</th>
    </tr>
<?php
	$rw=0;
		while($objResult = pg_fetch_array($objQuery))
{
	$rw++;
?>
       <tr>
			<td><?php echo $rw; ?></td>
			<td><?php echo $objResult['hn']; ?></td>
			<td><?php echo $objResult['an']; ?></td>
			<td><?php echo $objResult['ptname']; ?></td>
			<td><?php echo $objResult['regdate']; ?></td>
			<td><?php echo $objResult['dchdate']; ?></td>
			<td><?php echo $objResult['pdx']; ?></td>
			<td><?php echo $objResult['dx0']; ?></td>
			<td><?php echo $objResult['dx1']; ?></td>
			<td><?php echo $objResult['dx2']; ?></td>
			<td><?php echo $objResult['dx3']; ?></td>
			<td><?php echo $objResult['dx4']; ?></td>
			<td><?php echo $objResult['dx5']; ?></td>
			<td><?php echo $objResult['dsc_typename'];?></td>
			<td><?php echo $objResult['instname']; ?></td>
			<td><?php echo $objResult['wdname']; ?></td>
     </tr>
<?php
}
?>
</table>
<?php
pg_close($conn);
?>
</body>
</html>
