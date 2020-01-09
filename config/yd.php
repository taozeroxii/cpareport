<?php
$todate2 = date('m');
$todate3 = date('Y');
$todate4 = date('Y')+1;
$todate5 = date('Y')-1;

if ($todate2 > '10') {
$betweentodate =   $todate3."-10-01' AND '".$todate4."-09-30";
} else {
$betweentodate =   $todate5."-10-01' AND '".$todate3."-09-30";
}
 $yd = $betweentodate;
?>