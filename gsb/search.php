<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<?php
include 'connect.php';
date_default_timezone_set('asia/bangkok');
function thaiDate($datetime)
{
   if(!is_null($datetime))
   {
     list($date,$time) = split('T',$datetime);
     list($Y,$m,$d) = split('-',$date);
     $Y = $Y;
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

function thdate($datetime)
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

$sql = "   SELECT *,date(gsb_update) as du ,time(gsb_update) as dt
           FROM gsb_datacheck
           WHERE 1 = 1 
           AND fname   like '%{$_POST['itemname']}%'
           OR  lname   like '%{$_POST['itemname']}%'
           OR  gsb_cid like '%{$_POST['itemname']}%' ";
                    if($_POST['itemname']!= NULL) {
                        $query = mysql_query($sql);
                        ?>
                        <body>
                            <div class="col-md-12">
                                <table class="table table-bordered ta">
                                    <thead>
                                        <tr class="detail">
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center;">PersonID</th>
                                            <th style="text-align: center;">ชื่อ-สกุล</th>
                                            <th style="text-align: center;">อายุ (ปี)</th>
                                            <th style="text-align: center;">เลขที่บัตรประชาชน</th>
                                            <th style="text-align: center;" >วันที่เริ่ม</th>
                                            <th style="text-align: center;" >วันที่สิ้นสุด</th>
                                            <th style="text-align: center;" >ประเภท</th>
                                            <th style="text-align: center;" >สถานที่</th>
                                          

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; while ($result = mysql_fetch_assoc($query)) { ?>
                                        <tr class="list" title="ข้อมูลนำเข้าวันที่ <?php echo thdate($result['du'])." เวลา ".$result['dt']." น."; ?>">
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $result['gsb_personid'];?></td>
                                            <td><?php echo $result['pname']."".$result['fname']."&nbsp;&nbsp;".$result['lname'];?></td>
                                            <td style="text-align: center;"><?php echo $result['gsb_age'];?></td>
                                            <td><?php echo $result['gsb_cid'];?></td>
                                            <td><?php echo thaiDate($result['gsb_startdate']);?></td>
                                            <td><?php echo thaiDate($result['gsb_enddate']);?></td>
                                            <td><?php echo $result['gsb_emp_type'];?></td>
                                            <td><?php echo $result['gsb_groupname'];?></td>

                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                                <?php    }
                                else
                                {
                                    echo "<script type='text/javascript'>alert('คุณไม่ได้ระบุข้อมูลที่ต้องการค้นหา กรุณาระบุข้อมูลอย่างใดอย่างหนึ่ง เพื่อค้นหา!')</script>";
                                }
                                ?>
                            </div>
                        </body>
                        </html>