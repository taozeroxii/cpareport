<?php
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'excel') {
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=export.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
}
// $week;
$min; //หน่วยนาทีที่น้อยที่สุดต่อวัน
$max; //หน่วยนาทีที่มากที่สุดต่อวัน
$User; //ใคร
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// $week = $_POST["week"];
	$min = $_POST["Min"];
	$max = $_POST["Max"];
	$User = $_POST["subject"];
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>P4P</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>



<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<br /><br /><br />
				<h4> P4P </h4>
				<p>
					<a href="?act=excel" class="btn btn-primary"> Export->Excel </a>
				</p>
				<form name="form" id="form" action="" method="post">
					<select name="subject" id="subject">
						<option value="0" <?php echo $User == null ? 'selected="selected"' : '' ?>>ใครเอ่ย...</option>
						<option value="1" <?php echo $User == 1 ? 'selected="selected"' : '' ?>>เอก</option>
						<option value="2" <?php echo $User == 2 ? 'selected="selected"' : '' ?>>ผึ้ง</option>
						<option value="3" <?php echo $User == 3 ? 'selected="selected"' : '' ?>>เต๋า</option>
						<option value="4" <?php echo $User == 4 ? 'selected="selected"' : '' ?>>เบียร์</option>
						<option value="5" <?php echo $User == 5 ? 'selected="selected"' : '' ?>>มาร์ค</option>
						<option value="6" <?php echo $User == 6 ? 'selected="selected"' : '' ?>>เฟิส</option>
						<option value="7" <?php echo $User == 7 ? 'selected="selected"' : '' ?>>โอ</option>
						<option value="8" <?php echo $User == 8 ? 'selected="selected"' : '' ?>>ดอย</option>
					</select>

					<br><br>
					สุ่ม เวลางานต่อวัน: <input type="number" placeholder="Min.." name="Min" value="<?php echo $min != null ? $min : '' ?>"> -
					<input type="number" placeholder="Max.." name="Max" value="<?php echo $max != null ? $max : '' ?>">
					<br>(วันละ 7 ชม. (420 นาที))<br>
					<input type="submit" value="Random">
				</form>
				<!-- <button onClick="window.location.reload();">Random</button> -->

				<table border="1" class="table table-hover">
					<tbody>
						<?php
						$UserEven[1] = [
							0, // 1
							1, // 2
							0, // 3
							1, // 4
							1, // 5
							1, // 6
							1, // 7
							0, // 8
							0, // 9
							0, // 10
							0, // 11
							0, // 12
							1, // 13
							1, // 14
							0, // 15
							0, // 16
							1, // 17
							1, // 18
							0, // 19
							0, // 20
							0, // 21
							1, // 22
							1, // 23
							1, // 24
							1, // 25
							1, // 26
							0, // 27
							0, // 28
							0, // 29
							0, // 30
							1, // 31
							0, // 32
							0, // 33
							0, // 34
							0, // 35
							0, // 36
							0, // 37
							0, // 38
							0, // 39
							0, // 40
							0, // 41
							0, // 42
							1, // 43
							0, // 44
							1, // 45
							1, // 46
							0, // 47
							0, // 48
							1, // 49
							1, // 50
							0, // 51
							1, // 52
							1, // 53
							0, // 54
						];
						$UserEven[3] = [
							0, // 1
							1, // 2
							1, // 3
							1, // 4
							1, // 5
							1, // 6
							1, // 7
							0, // 8
							0, // 9
							0, // 10
							0, // 11
							0, // 12
							1, // 13
							1, // 14
							0, // 15
							0, // 16
							1, // 17
							1, // 18
							1, // 19
							0, // 20
							0, // 21
							0, // 22
							1, // 23
							0, // 24
							0, // 25
							0, // 26
							0, // 27
							0, // 28
							0, // 29
							0, // 30
							1, // 31
							0, // 32
							0, // 33
							0, // 34
							0, // 35
							0, // 36
							0, // 37
							0, // 38
							0, // 39
							0, // 40
							0, // 41
							0, // 42
							0, // 43
							0, // 44
							0, // 45
							0, // 46
							0, // 47
							0, // 48
							0, // 49
							1, // 50
							0, // 51
							0, // 52
							1, // 53
							0, // 54
						];
						$UserEven[4] = [
							0,
							1,
							0,
							0,
							1,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							1,
							1,
							1,
							1,
							1,
							1,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
							0,
						];
						$UserEven[5] = [
							0, // 1
							1, // 2
							0, // 3
							1, // 4
							1, // 5
							1, // 6
							1, // 7
							0, // 8
							0, // 9
							0, // 10
							0, // 11
							0, // 12
							1, // 13
							1, // 14
							0, // 15
							0, // 16
							1, // 17
							0, // 18
							0, // 19
							0, // 20
							0, // 21
							0, // 22
							1, // 23
							0, // 24
							0, // 25
							0, // 26
							0, // 27
							0, // 28
							0, // 29
							0, // 30
							0, // 31
							0, // 32
							0, // 33
							0, // 34
							0, // 35
							0, // 36
							0, // 37
							0, // 38
							0, // 39
							0, // 40
							0, // 41
							0, // 42
							1, // 43
							0, // 44
							0, // 45
							0, // 46
							0, // 47
							0, // 48
							0, // 49
							0, // 50
							0, // 51
							1, // 52
							0, // 53
							0, // 54
						];
						$UserEven[6] = [
							0, // 1
							1, // 2
							1, // 3
							1, // 4
							1, // 5
							1, // 6
							1, // 7
							0, // 8
							0, // 9
							0, // 10
							1, // 11
							0, // 12
							1, // 13
							1, // 14
							0, // 15
							0, // 16
							1, // 17
							0, // 18
							0, // 19
							0, // 20
							0, // 21
							0, // 22
							1, // 23
							1, // 24
							0, // 25
							0, // 26
							0, // 27
							0, // 28
							0, // 29
							0, // 30
							1, // 31
							0, // 32
							0, // 33
							0, // 34
							0, // 35
							0, // 36
							0, // 37
							0, // 38
							0, // 39
							0, // 40
							0, // 41
							0, // 42
							0, // 43
							0, // 44
							0, // 45
							0, // 46
							0, // 47
							0, // 48
							0, // 49
							1, // 50
							0, // 51
							0, // 52
							1, // 53
							0, // 54
						];
						$UserEven[8] = [
							0, // 1
							1, // 2
							1, // 3
							1, // 4
							1, // 5
							1, // 6
							1, // 7
							0, // 8
							1, // 9
							1, // 10
							0, // 11
							0, // 12
							0, // 13
							1, // 14
							0, // 15
							0, // 16
							1, // 17
							0, // 18
							0, // 19
							0, // 20
							0, // 21
							1, // 22
							1, // 23
							1, // 24
							0, // 25
							0, // 26
							0, // 27
							0, // 28
							0, // 29
							0, // 30
							0, // 31
							0, // 32
							0, // 33
							0, // 34
							0, // 35
							0, // 36
							0, // 37
							0, // 38
							0, // 39
							0, // 40
							0, // 41
							0, // 42
							0, // 43
							0, // 44
							0, // 45
							0, // 46
							0, // 47
							0, // 48
							0, // 49
							0, // 50
							0, // 51
							0, // 52
							0, // 53
							0, // 54
						];
						$even = [
							0, // 1
							30, // 2
							30, // 3
							5, // 4
							10, // 5
							15, // 6
							5, // 7
							30, // 8
							60, // 9
							20, // 10
							60, // 11
							60, // 12
							60, // 13
							60, // 14
							20, // 15
							60, // 16
							30, // 17
							60, // 18
							60, // 19
							0, // 20
							60, // 21
							30, // 22
							30, // 23
							120, // 24
							10, // 25
							30, // 26
							75, // 27
							150, // 28
							120, // 29
							60, // 30
							15, // 31
							240, // 32
							120, // 33
							45, // 34
							60, // 35
							15, // 36
							120, // 37
							60, // 38
							30, // 39
							15, // 40
							180, // 41
							120, // 42
							10, // 43
							60, // 44
							60, // 45
							60, // 46
							60, // 47
							0, // 48
							30, // 49
							30, // 50
							60, // 51
							30, // 52
							30, // 53
							120, // 54
						];

						$sum = 0;
						$num = 0;
						$arrayScore = [];
						for ($j = 0; $j < 31; $j++) {
							//echo $sum;
							//for ($j = 0; $j < 5; $j++) {
							while (true) {
								$num++;
								for ($i = 0; $i < 54; $i++) {
									if ($i == 2) $arrayScore[$i][$j] = (intval(rand(0, 10) / 10) * $even[$i] * $UserEven[$User][$i]);
									else if ($i == 42) $arrayScore[$i][$j] = ((rand(0, 6)) * $even[$i] * $UserEven[$User][$i]);
									else if ($even[$i] <= 5) $arrayScore[$i][$j] = ((rand(0, 12)) * $even[$i] * $UserEven[$User][$i]);
									else if ($even[$i] >= 60) $arrayScore[$i][$j] = ((rand(0, 1)) * $even[$i] * $UserEven[$User][$i]);
									else $arrayScore[$i][$j] = (rand(0, 3)) * $even[$i] * $UserEven[$User][$i];

									$sum = $sum + $arrayScore[$i][$j];
								}
								if (($sum >= $min && $sum <= $max) || $sum == 0) {
									echo $sum . ' | ';
									break;
								} else {
									$sum = 0;
								}
							}
						}
						echo '<br>รอบในการสุ่ม : ' . $num;
						for ($j = 0; $j < 31; $j++) {
							$arrayScore[1][$j] /= 30;
							$arrayScore[2][$j] /= 30;
							$arrayScore[3][$j] /= 5;
							$arrayScore[4][$j] /= 10;
							$arrayScore[5][$j] /= 15;
							$arrayScore[6][$j] /= 5;
							$arrayScore[7][$j] /= 30;
							$arrayScore[8][$j] /= 60;
							$arrayScore[9][$j] /= 20;
							$arrayScore[10][$j] /= 60;
							$arrayScore[12][$j] /= 60;
							$arrayScore[13][$j] /= 60;
							$arrayScore[14][$j] /= 20;
							$arrayScore[15][$j] /= 60;
							$arrayScore[16][$j] /= 30;
							$arrayScore[17][$j] /= 60;
							$arrayScore[18][$j] /= 60;
							$arrayScore[20][$j] /= 60;
							$arrayScore[21][$j] /= 30;
							$arrayScore[22][$j] /= 30;
							$arrayScore[23][$j] /= 120;
							$arrayScore[24][$j] /= 10;
							$arrayScore[25][$j] /= 30;
							$arrayScore[26][$j] /= 75;
							$arrayScore[27][$j] /= 150;
							$arrayScore[28][$j] /= 120;
							$arrayScore[29][$j] /= 60;
							$arrayScore[31][$j] /= 240;
							$arrayScore[32][$j] /= 120;
							$arrayScore[33][$j] /= 45;
							$arrayScore[34][$j] /= 60;
							$arrayScore[35][$j] /= 15;
							$arrayScore[36][$j] /= 120;
							$arrayScore[38][$j] /= 30;
							$arrayScore[39][$j] /= 15;
							$arrayScore[40][$j] /= 180;
							$arrayScore[41][$j] /= 120;
							$arrayScore[44][$j] /= 30;
							$arrayScore[48][$j] /= 30;
							$arrayScore[53][$j] /= 120;
						}
						?><br>@
						<?php
						for ($i = 1; $i < 54; $i++) {
						?>
							<tr>
								<?php
								for ($j = 0; $j < 31; $j++) {
								?>
									<td><? echo $arrayScore[$i][$j] == 0 ? ' ' : intval($arrayScore[$i][$j]) ?></td>


								<?php

								}
								?>
							</tr>
						<?php
						}
						?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>