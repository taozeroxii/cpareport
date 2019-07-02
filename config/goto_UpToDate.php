<?php
	$h = 934;
	$g = 49325898;
	$d = "257902_PHP";
	$n = time();
	$c = gmdate("imdH", $n);
	$c = $c - 10000;
	$c = ($c * $h) - $g;
	$urlArgs = "";
	$prefix = "?";
	foreach ($_GET as $k => $v) {
		$urlArgs .= $prefix . $k . "=" . $v;
		$prefix = '&';
	}
?>
<html>
	<head>
		<script language="javascript">
		function go() {
			var key = document.getElementById("key").value;
			
			if (!isNaN(key)) {
				document.getElementById('submitButton').value=
					"Redirecting to " + document.uptodate.action + " ... please wait.";
				document.uptodate.submit();
			} else {
				alert("This UpToDate portal is not installed correctly.  Please contact your systems administrator");
				return false;
			}
		}
		</script>
	</head>
	<body onload="go();">
		<form method="POST" action="http://www.uptodate.com/online/portalLogin.do<?php echo $urlArgs ?>" name="uptodate" onsubmit="go();">
			<input type="hidden" value="<?php echo $d ?>" name="portal">
			<input type="hidden" value="<?php echo $c ?>" name="key" id="key">
			<input type="submit" value="UpToDate" id="submitButton">
		</form>
	</body>
</html>
