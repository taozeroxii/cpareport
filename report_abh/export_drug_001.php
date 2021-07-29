<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "conn/pg_con.class.php";
 $stdate = $_GET['stdate'];
 $endate = $_GET['endate'];
 $drug   = $_GET['drug'];
 $typein = $_GET['typein'];
 if (isset($stdate)) {
}else{
header('location: frm2564_drug_001.php');
exit();
}

$todate = date('Ymd_His');
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Export_Drug_".$todate.".xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    .colh{
        color: #0E6655;
        background-color: #D4E6F1;
        font-weight: bold;
    }
    </style>
</head>
<body>
<?php
    $drug = $_GET['drug'];
    if (isset($drug)) {
        $sql_detail = " SELECT 
			 CASE
				WHEN op.an <> '' THEN 'IPD'
				ELSE 'OPD'
			 END AS OPD_IPD_Type
		 ,op.vstdate
		 ,op.rxdate
		 ,op.rxtime
		 ,op.icode
		 ,concat(dg.name,' ',dg.strength,'  (',dg.units,')') AS drug
		 ,op.hn
		 ,op.vn
		 ,op.an
		 ,concat(pa.pname,' ',pa.fname,'  ',pa.lname) AS full_name
		 ,pa.cid
		 ,Extract(YEAR FROM Age(CURRENT_DATE, pa.birthday)) AS age_y
		 ,CASE WHEN COALESCE(op.finance_number,'') <> '' THEN op.qty ELSE op.qty-COALESCE(m.return_qty,0) END AS qty
		 ,concat(pa.addrpart,' ', t.full_name) AS ptaddress
		 ,a.admdate
		 ,pt.name AS pttypename
		 ,d.name AS doctorname
		 ,CASE WHEN d.licenseno LIKE '%-%' THEN d.shortname ELSE d.licenseno END AS licenseno 
		--  ,CONCAT(oo.icd10,' ',ioo.name) AS diag_opd
		 --,CONCAT(ii.icd10,' ',iii.name) AS diag_ipd
     from opitemrece op 
     LEFT JOIN medreturn_ipd m ON op.hos_guid = m.opi_guid AND m.return_qty > 0 AND m.confirm_return = 'Y' 
     LEFT JOIN patient pa ON pa.hn = op.hn 
     LEFT JOIN drugitems dg ON dg.icode = op.icode 
     LEFT JOIN an_stat a ON a.an=op.an  
	 LEFT JOIN iptdiag ii ON ii.an = op.an 
	 LEFT JOIN icd101 as iii ON iii.code = ii.icd10
	 LEFT JOIN ovstdiag oo ON oo.vn = op.vn 
	 LEFT JOIN icd101 as ioo ON ioo.code = oo.icd10
     LEFT JOIN doctor d ON d.code=op.doctor 
     LEFT JOIN pttype pt ON pt.pttype=op.pttype 
     LEFT JOIN thaiaddress t ON pa.tmbpart = t.tmbpart AND pa.amppart = t.amppart AND pa.chwpart = t.chwpart 
     WHERE 1 = 1
	 	 AND op.rxdate BETWEEN '$stdate' AND '$endate' 
	 	 AND op.icode IN ('$drug')
		 AND $typein
     AND op.icode IN (SELECT icode 
		FROM drugitems 
		WHERE concat(name,' ',strength,'  (',units,')') IN( SELECT concat(d.name,' ',d.strength,'  (',d.units,')') AS dname 
        FROM drugitems d, opitemrece o 
    WHERE o.icode = d.icode AND o.rxdate BETWEEN '$stdate' AND '$endate' 
		GROUP BY dname 
		ORDER BY dname)) AND d.code NOT IN(SELECT code FROM doctor WHERE LOWER(name) LIKE '%bms%') AND op.hn NOT IN(SELECT hn FROM patient WHERE LOWER(fname) LIKE '%ทดสอบ%')
    ORDER BY drug,op.rxdate,op.rxtime ";
        $result = pg_query($sql_detail);
    ?>
      <div class="container-fulid">
    <div class="row">
            <div class="col-sm-12">
    <div class="table">
								<table id="" class="table" border="1px">
									<thead>
										<tr>
											<?php
											$i = pg_num_fields($result);
											for ($j = 0 ; $j < $i ; $j++) {
												$fieldname = pg_field_name($result, $j);
												echo '<th class="colh">' . $fieldname . '</th>';
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
													echo '<td>' . " ".$row_result[$fieldname] . '</td>';
												} 
												?>
											</tr>
											<?php  
										}
										?>                                   
									</tbody>
								</table>			
							</div>
<?php }?>
                            </div>
</body>
</html>