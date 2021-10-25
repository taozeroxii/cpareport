<?php
ob_start();
date_default_timezone_set('asia/bangkok');
function thaiDate($datetime)
{
 if(!is_null($datetime))
 {
   list($date,$time) = split('T',$datetime);
   list($Y,$m,$d) = split('-',$date);
   $Y = $Y+543;
   switch($m)
   {
    case "01":$m = "ม.ค."; break;
    case "02":$m = "ก.พ."; break;
    case "03":$m = "มี.ค."; break;
    case "04":$m = "เม.ย."; break;
    case "05":$m = "พ.ค."; break;
    case "06":$m = "มิ.ย."; break;
    case "07":$m = "ก.ค."; break;
    case "08":$m = "ส.ค."; break;
    case "09":$m = "ก.ย."; break;
    case "10":$m = "ต.ค."; break;
    case "11":$m = "พ.ย."; break;
    case "12":$m = "ธ.ค."; break;
  }
  return $d." ".$m." ".$Y."";
}
return "";
}

function thaiDateFULL($datetime)
{
 if(!is_null($datetime))
 {
   list($date,$time) = split('T',$datetime);
   list($Y,$m,$d) = split('-',$date);
   $Y = $Y+543;
   switch($m)
   {
    case "01":$m = "มกราคม"; break;
    case "02":$m = "กุมภาพันธ์"; break;
    case "03":$m = "มีนาคม"; break;
    case "04":$m = "เมษายน"; break;
    case "05":$m = "พฤษภาคม"; break;
    case "06":$m = "มิถุนายน"; break;
    case "07":$m = "กรกฎาคม"; break;
    case "08":$m = "สิงหาคม"; break;
    case "09":$m = "กันยายน"; break;
    case "10":$m = "ตุลาคม"; break;
    case "11":$m = "พฤศจิกายน"; break;
    case "12":$m = "ธันวาคม"; break;
  }
  return $d." ".$m." ".$Y."";
}
return "";
}

function thaiDate_shut($datetime)
{
 if(!is_null($datetime))
 {
   list($date,$time) = split('T',$datetime);
   list($Y,$m,$d) = split('-',$date);
   $Y = $Y+543;
   switch($m)
   {
    case "01":$m = "มกราคม"; break;
    case "02":$m = "กุมภาพันธ์"; break;
    case "03":$m = "มีนาคม"; break;
    case "04":$m = "เมษายน"; break;
    case "05":$m = "พฤษภาคม"; break;
    case "06":$m = "มิถุนายน"; break;
    case "07":$m = "กรกฎาคม"; break;
    case "08":$m = "สิงหาคม"; break;
    case "09":$m = "กันยายน"; break;
    case "10":$m = "ตุลาคม"; break;
    case "11":$m = "พฤศจิกายน"; break;
    case "12":$m = "ธันวาคม"; break;
  }
  return $m." ".$Y."";
}
return "";
}

?>