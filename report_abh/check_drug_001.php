<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "conn/pg_con.class.php";
$stdate = $_GET['stdate'];
$endate = $_GET['endate'];
if (isset($stdate)) {
    }else{
    header('location: frm2564_drug_001.php');
    exit();
    }

$sql = " SELECT icode,name 
FROM drugitems 
WHERE concat(name,' ',strength,'  (',units,')') 
IN( SELECT concat(d.name,' ',d.strength,'  (',d.units,')') AS dname 
FROM drugitems d, opitemrece o 
WHERE o.icode = d.icode 
AND o.rxdate BETWEEN '$stdate' AND '$endate' 
GROUP BY dname 
ORDER BY dname) ";
$res = pg_query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.js"></script>

    <title>Report-รายการติดตามการใช้ยา-เลือกรายการ</title>

</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4> Report-รายการติดตามการใช้ยา-เลือกรายการ </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 ">&nbsp;</div>
            <div class="col-sm-4 btn-info">&nbsp;</div>
            <div class="col-sm-4 ">&nbsp;</div>
        </div>
        <br>
        <form name="register" action="#" method="GET" class="form-horizontal">
            
        <div class="row">
            <div class="col-sm-3 ">
            วันที่เริ่ม <input name="stdate" type="date" required class="form-control" value="<?php echo $stdate; ?>" id="stdate" placeholder="" readonly />
            </div>
            <div class="col-sm-3">
            วันที่สิ้นสุด <input name="endate" type="date" class="form-control" id="endate" value="<?php echo $endate; ?>" placeholder="" readonly />
            </div>
            <div class="col-sm-3">เลือกรายการยา
                    <select name="drug" class="form-control select2" required>
                        <option value="" selected disabled>-เลือกรายการยา-</option>
                        <?php while ($list = pg_fetch_assoc($res)) { ?>
                            <option value="<?php echo $list["icode"]; ?>">
                                <?php echo $list["icode"] . " " . $list["name"]; ?>
                            </option>
                        <?php } ?>
                    </select>
            </div>
            <div class="col-sm-3">&nbsp;&nbsp;
                <button type="submit" class="form-control btn btn-info" id="btn"><span class="glyphicon glyphicon-ok"></span> ค้นหารายการ  </button> </div>
        </div>
        </form>
    </div>
    </div>

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
     from opitemrece op 
     LEFT JOIN medreturn_ipd m ON op.hos_guid = m.opi_guid AND m.return_qty > 0 AND m.confirm_return = 'Y' 
     LEFT JOIN patient pa ON pa.hn = op.hn 
     LEFT JOIN drugitems dg ON dg.icode = op.icode 
     LEFT JOIN an_stat a ON a.an=op.an  
     LEFT JOIN doctor d ON d.code=op.doctor 
     LEFT JOIN pttype pt ON pt.pttype=op.pttype 
     LEFT JOIN thaiaddress t ON pa.tmbpart = t.tmbpart AND pa.amppart = t.amppart AND pa.chwpart = t.chwpart 
     WHERE 1 = 1
	 	 AND op.rxdate BETWEEN '$stdate' AND '$endate' 
	 	 AND op.icode IN ('$drug')
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
    <br>
      <div class="container">
    <div class="row">
            <div class="col-sm-12">
          <center> 
                    <button type="text" class="btn btn-info" id="asd" onclick="export_home()">
                     <span class="glyphicon glyphicon-ok"></span> เลือกช่วงวันที่ใหม่ </button>&nbsp;

                      <button type="text" class="btn btn-success" id="asd" onclick="export_excel()">
                     <span class="glyphicon glyphicon-ok"></span> Export File Excel </button>&nbsp;

                     <button type="text" class="btn btn-warning" id="mm" data-toggle="modal" data-target="#myModal" >
                     <span class="glyphicon glyphicon-ok"></span> SQL Code </button>
                     </center> 
               <br>

    <div class="table-responsive">
								<!-- <table id="detail-table" class="table table-responsive-md table-hover "> -->
                                <table id="example" class="table  table-hover">
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
							<!-- </div> -->
<?php }?>
                            </div>
     
      <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">SQL Query Code</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          <code>
        <?php
        echo $sql_detail;
        ?>
        </code>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>                      

        <script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
  
       function export_excel(){
			document.location = "export_drug_001.php?stdate=<?php echo $stdate; ?>&endate=<?php echo $endate; ?>&drug=<?php echo $drug; ?>";
        }
        
        function export_home(){
			document.location = "frm2564_drug_001.php";
		}
        </script>























</body>
</html>