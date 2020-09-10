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
    if (!is_null($datetime)) {
        list($date, $time) = split('T', $datetime);
        list($Y, $m, $d) = split('-', $date);
        $Y = $Y;
        switch ($m) {
            case "01":
                $m = "ม.ค.";
                break;
            case "02":
                $m = "ก.พ.";
                break;
            case "03":
                $m = "มี.ค.";
                break;
            case "04":
                $m = "เม.ย.";
                break;
            case "05":
                $m = "พ.ค.";
                break;
            case "06":
                $m = "มิ.ย.";
                break;
            case "07":
                $m = "ก.ค.";
                break;
            case "08":
                $m = "ส.ค.";
                break;
            case "09":
                $m = "ก.ย.";
                break;
            case "10":
                $m = "ต.ค.";
                break;
            case "11":
                $m = "พ.ย.";
                break;
            case "12":
                $m = "ธ.ค.";
                break;
        }
        return $d . " " . $m . " " . $Y . "";
    }
    return "";
}

function thdate($datetime)
{
    if (!is_null($datetime)) {
        list($date, $time) = split('T', $datetime);
        list($Y, $m, $d) = split('-', $date);
        $Y = $Y + 543;
        switch ($m) {
            case "01":
                $m = "ม.ค.";
                break;
            case "02":
                $m = "ก.พ.";
                break;
            case "03":
                $m = "มี.ค.";
                break;
            case "04":
                $m = "เม.ย.";
                break;
            case "05":
                $m = "พ.ค.";
                break;
            case "06":
                $m = "มิ.ย.";
                break;
            case "07":
                $m = "ก.ค.";
                break;
            case "08":
                $m = "ส.ค.";
                break;
            case "09":
                $m = "ก.ย.";
                break;
            case "10":
                $m = "ต.ค.";
                break;
            case "11":
                $m = "พ.ย.";
                break;
            case "12":
                $m = "ธ.ค.";
                break;
        }
        return $d . " " . $m . " " . $Y . "";
    }
    return "";
}

$sql = "   SELECT *,firstname,lastname,username,department,jobtitle,new_pass
           FROM network_ad_user  
           WHERE 1 = 1 
           AND flage <> '2'
           AND (firstname  like '%{$_POST['itemname']}%' OR  CONCAT(firstname,' ',lastname)  like '%%{$_POST['itemname']}%%')
           OR  lastname   like '%{$_POST['itemname']}%'
           OR  department like '%{$_POST['itemname']}%'
           OR  chksum     like '%{$_POST['itemname']}%'
            ";


$value = $_POST['itemname'];

if ( $value != NULL) {





    $query = mysql_query($sql);
?>

    <body>
        <div class="col-md-12">
            <table class="table table-bordered ta">
                <thead>
                    <tr class="detail">
                        <th style="text-align: center;">#</th>
                        <th style="text-align: center;">ชื่อ</th>
                        <th style="text-align: center;">สกุล</th>
                        <th style="text-align: center;">User</th>
                        <th style="text-align: center;">กลุ่มงาน</th>
                        <th style="text-align: center;">ตำแหน่ง</th>
                        <th style="text-align: center;">สถานะ</th>
<!-- ############################################################################################################################# -->  
<!-- ส่วนที่เปลี่ยนรหัวผ่านได้ 20200910-->                      
                        <!-- <th style="text-align: center;">รีเซ็ตรหัสผ่านใหม่</th> -->
<!-- ############################################################################################################################# -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($result = mysql_fetch_assoc($query)) { ?>
                        <tr class="list">
                            <td><?php echo $i; ?>.</td>
                            <td><?php echo $result['firstname']; ?></td>
                            <td><?php echo $result['lastname']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['department']; ?></td>
                            <td><?php echo $result['jobtitle']; ?></td>
                            <td>
                                <?php $cs  = $result['flage'];
                                if ($cs == "1") {
                                    $cs =  "<span class='cs1'>เปิดใช้งาน</span>";
                                } elseif ($cs == "0") {
                                    $cs =  "<span class='cs2'>รอยืนยันการใช้งาน</span>";
                                } elseif ($cs == "3") {
                                    $cs =  "<span class='cs3'>ปิดใช้งาน</span>";
                                }
                                echo $cs;
                                ?>
                            </td>

 <!-- ############################################################################################################################# -->
<!-- ส่วนที่เปลี่ยนรหัวผ่านได้ 20200910 -->
                         
                    <!-- <td> -->
                        <?php 
                              /*      $status_pass = $result['status_pass'];
                                if ($status_pass == "N") {   
                               */     
                                   ?>
                            <!-- <center>  
                                    <a href="editpassnew.php?userid=<?php //echo $result['username']; ?>" target="" rel="noopener noreferrer" title=""> 
                                        <button type="button" class="btn btn-primary" ><span class="glyphicon glyphicon-refresh"></span> เปลี่ยนรหัสผ่าน </button>
                                    </a>
                            </center> -->
                                           
                        <?php  //  } else if ($status_pass == "O" ) {                                                 
                                  ?>
                            <!-- <center>  
                                    <a href="#" target="" rel="noopener noreferrer" title=""> 
                                        <button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-refresh"></span> กำลังรีเซ็ตรหัส </button>
                                    </a>
                            </center>                                              -->
                        <?php //  } else if ($status_pass == "Y" ) {  
                                 ?> 
                            <!-- <center>  
                                    <a href="#" target="" rel="noopener noreferrer" title=""> 
                                        <button type="button" class="btn btn-danger" ><span class="glyphicon glyphicon-refresh"></span> รหัสใหม่แล้ว </button>
                                    </a>
                            </center> -->
                       <?php
                                     //           } 
                        ?>
                        <!-- </td> -->
<!-- ############################################################################################################################# -->

                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        <?php
    } else {
        echo "<script type='text/javascript'>alert('คุณไม่ได้ระบุชื่อ หรือ นามสกุล หรือ หน่วยงาน อย่างใดอย่างหนึ่ง เพื่อค้นหา!')</script>";
    }
        ?>
        </div>

    </body>

</html>