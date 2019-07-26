<?php   $ward_dropdown   = $_GET['ward'];  
        $wardname = $_GET['wardname'];
$todate = date('Y-m-d');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$wardname."_".$todate.".xls");
?>

<?php include"config/pg_con.class.php";
include"config/func.class.php";
include"config/time.class.php";

        $sql_dep = " SELECT name FROM ward WHERE ward = '". $ward_dropdown ."'";
        $result_dep = pg_query($sql_dep);
        $row_dep = pg_fetch_array($result_dep);
        $showward = $row_dep['ward']." ". $row_dep['name'];

          $sql = " SELECT ipt.hn as  hn,
                    ipt.an,
                    CAST (concat ( patient.pname, patient.fname, ' ', patient.lname ) AS VARCHAR ( 250 )) AS ชื่อผู้ป่วย,
                    ipt.regdate AS วันที่รับเข้า,
                    ipt.regtime AS เวลารับเข้า,
                    w.name AS หอผู้ป่วย,
                    pcs.pttype_check_status_name AS สถานะสิทธิ์,
                    ptt.NAME AS สิทธิ,
                    roomno.NAME AS ประเภทห้อง,
                    iptadm.bedno AS เลขที่เตียง
     FROM	ipt	
     LEFT OUTER JOIN spclty ON spclty.spclty = ipt.spclty
       LEFT OUTER JOIN iptadm ON iptadm.an = ipt.an
       LEFT OUTER JOIN bedno bn ON bn.bedno = iptadm.bedno
       LEFT OUTER JOIN patient ON patient.hn = ipt.hn
        LEFT OUTER JOIN roomno ON roomno.roomno = iptadm.roomno
       LEFT OUTER JOIN ipt_pttype_check ic ON ic.an = ipt.an
       LEFT OUTER JOIN pttype_check_status pcs ON pcs.pttype_check_status_id = ic.pttype_check_status_id
       LEFT OUTER JOIN ward w ON w.ward = ipt.ward
       LEFT OUTER JOIN ipt_pttype ip1 ON ip1.an = ipt.an 	AND ip1.pttype_number = 1
       LEFT OUTER JOIN pttype ptt ON ptt.pttype = ip1.pttype
     WHERE	1 = 1 
       AND ipt.dchdate IS NULL
       AND ipt.ward = '".$ward_dropdown ."'
       ORDER BY	ipt.regdate,	ipt.regtime ";
          $result = pg_query($sql);
?>
<!DOCTYPE html>
<html>
<body>
<?php echo $showward; ?>
                <table border="1" width="100%">
                  <thead>
                  <tr>
              <?php
                $i = pg_num_fields($result);
                for ($j = 0 ; $j < $i ; $j++) {
                  $fieldname = pg_field_name($result, $j);
                  echo '<th>' . $fieldname . '</th>';
                }
              ?>
             </tr> 
                 </thead>
                 <tbody>
                  <? $rw=0;
                  while($row_result = pg_fetch_array($result)) 
                  { 
                    $rw++;
                    ?>
                    <tr>
                <?php
                  for ($j = 0 ; $j < $i ; $j++) {
                  $fieldname = pg_field_name($result, $j);
                  echo '<td>' . $row_result[$fieldname] . '</td>';
                } 
                ?>
              </tr>
                    <?php  
                  }
                  ?>                                   
                </tbody>
              </table>
</body>
</html>
