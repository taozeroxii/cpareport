<?php
include('db.php');
date_default_timezone_set("Asia/Bangkok");
function get_browser_name($user_agent)
{
    if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
    elseif (strpos($user_agent, 'Edge')) return 'Edge';
    elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
    elseif (strpos($user_agent, 'Safari')) return 'Safari';
    elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
    elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer'; 
    return 'Other';
}
$view_browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
$view_comname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$view_date	  =	date("Y-m-d H:i:s");
$view_ip	  = $_SERVER['REMOTE_ADDR'];
$cmax 	  	  = $_GET['cmax'];
$view_key	  =  MD5((rand(99,255255)));
$subItems     = " SELECT cmax,path_link FROM index_menu_cmax WHERE cmax_name = '".$cmax."'  ";
$res          =  mysqli_query($con,$subItems);
 foreach($res as $subItem){
 	  $tcmax     =   $subItem['cmax']+1;
 	  $path_link =   $subItem['path_link'];
 }
 $sql_log   = "INSERT INTO index_menu_cmax_log (view_date, view_ip, view_key,cmax,view_browser,view_comname)
               VALUES ('".$view_date."','".$view_ip."','".$view_key."','".$cmax."','".$view_browser."','".$view_comname."')";
 $query_log = mysqli_query($con,$sql_log);
 $sql = "UPDATE index_menu_cmax SET cmax = '".$tcmax."',cmax_update = '".$view_date."' WHERE cmax_name = '".$cmax."' ";
 	$query = mysqli_query($con,$sql);
 	if($query) {
 	   header('Location:'.$path_link.'');
 	}	
?>