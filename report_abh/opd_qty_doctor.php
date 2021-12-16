<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
include "conn/pg_con.class.php";
/*
$stdate = $_GET['stdate'];
$endate = $_GET['endate'];
if (isset($stdate)) {
    }else{
    header('location: frm2564_drug_001.php');
    exit();
    }
*/

$sql = " SELECT code,name,licenseno
FROM doctor
WHERE licenseno LIKE 'ว%%'
AND name NOT LIKE '%%ไม่ระบุ%%'
AND name NOT LIKE '%%(-ยกเลิก)%%' 
AND licenseno <> 'ว99999'
AND name NOT LIKE '%%แพทย์Intern%%'
AND name NOT LIKE '%%(%%'
ORDER BY fname ASC ";
$res = pg_query($sql);



$sql_room = " SELECT *  FROM kskdepartment 
WHERE  department NOT LIKE '%%(ยกเลิก)%%' 
AND department NOT LIKE '%%หอ%%'
AND department_active = 'Y'
AND department NOT LIKE '%%กลับบ้าน%%'
ORDER BY depcode DESC ";
$res_room = pg_query($sql_room);

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

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.css"/> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
    
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.23/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    
    <title>Report-จำนวนออกตรวจแพทย์ ระบุแพทย์ เลือกห้องตรวจ ระบุช่วงวันที่วันที่</title>
<style>
.sss{
  color: red;
}
</style>
</head>

<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h4>Report-จำนวนออกตรวจแพทย์ ระบุแพทย์ เลือกห้องตรวจ ระบุช่วงวันที่วันที่ </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 ">&nbsp;</div>
            <div class="col-sm-4 btn-warning">&nbsp;</div>
            <div class="col-sm-4 ">&nbsp;</div>
        </div>
        <br>
        <form name="register" action="#" method="GET" class="form-horizontal">
            
        <div class="row">
            <div class="col-sm-2">
            วันที่เริ่ม <input name="stdate" type="date"  class="form-control" value="" id="stdate" placeholder=""  required/>
            </div>
            <div class="col-sm-2">
            วันที่สิ้นสุด <input name="endate" type="date" class="form-control" id="endate" value="" placeholder=""  required/>
            </div>
            <div class="col-sm-3">เลือกแพทย์
                    <select id="select-testing" class="selectpicker form-control " name="doctor" data-live-search="true" title="เลือกรายการ" required>
                    <?php while ($list = pg_fetch_assoc($res)) { ?>
                            <option value="<?php echo $list["code"]; ?>">
                                <?php echo $list["name"]."  ".$list["licenseno"]; ?>
                            </option>
                        <?php } ?>
                    </select>
            </div>

            <div class="col-sm-3">เลือกห้องตรวจ
                    <select id="select-testing" class="selectpicker form-control " name="room" data-live-search="true" title="เลือกรายการ" required>
                    <?php while ($list_room = pg_fetch_assoc($res_room)) { ?>
                            <option value="<?php echo $list_room["depcode"]; ?>">
                                <?php echo $list_room["department"]; ?>
                            </option>
                        <?php } ?>
                    </select>
            </div>


            <div class="col-sm-2">&nbsp;&nbsp;
                <button type="submit" class="form-control btn btn-info " id="btn"><span class="glyphicon glyphicon-ok"></span>ค้นหารายการ</button> 
                </div>
        </div>

        </form>
    </div>
    </div>

    <?php
    
    $stdate   = $_GET['stdate'];
    $endate   = $_GET['endate']; 
    $doctor   = $_GET['doctor'];
    $room     = $_GET['room'];
    

    if (isset($stdate)) {


        $sql_detail = " SELECT
        o.vstdate,
            o.vsttime,
        kk3.department AS main_department_name,
        -- oq.doctor_list_text as doctor_name,
        doc.name as doctor_names,
        o.hn,
        CAST ( concat ( P.pname, P.fname, ' ', P.lname ) AS VARCHAR ( 250 ) ) AS patient_name,
        i3.an AS admit_an
    FROM ovst o
        LEFT OUTER JOIN vn_stat v ON v.vn = o.vn
        LEFT JOIN doctor as doc ON doc.code = o.doctor 
        LEFT OUTER JOIN opdscreen oc ON oc.vn = o.vn
        LEFT OUTER JOIN patient P ON P.hn = o.hn
        LEFT OUTER JOIN pttype T ON T.pttype = o.pttype
        LEFT OUTER JOIN icd101 i ON i.code = v.main_pdx
        LEFT OUTER JOIN spclty s ON s.spclty = o.spclty
        LEFT OUTER JOIN ovstist sti ON sti.ovstist = o.ovstist
        LEFT OUTER JOIN ovstost st ON st.ovstost = o.ovstost
        LEFT OUTER JOIN ovst_seq oq ON oq.vn = o.vn
        LEFT OUTER JOIN opduser ou1 ON ou1.loginname = oq.pttype_check_staff
        LEFT OUTER JOIN ovst_nhso_send oo1 ON oo1.vn = o.vn
        LEFT OUTER JOIN kskdepartment K ON K.depcode = o.cur_dep
        LEFT OUTER JOIN kskdepartment k2 ON k2.depcode = oq.register_depcode
        LEFT OUTER JOIN kskdepartment kk3 ON kk3.depcode = o.main_dep
        LEFT OUTER JOIN hospital_department hd ON hd.ID = oq.hospital_department_id
        LEFT OUTER JOIN sub_spclty ssp ON ssp.sub_spclty_id = oq.sub_spclty_id
        LEFT OUTER JOIN pt_walk pw ON pw.walk_id = oc.walk_id
        LEFT OUTER JOIN patient_opd_file pf ON pf.hn = o.hn
        LEFT OUTER JOIN kskdepartment k3 ON k3.depcode = pf.last_depcode
        LEFT OUTER JOIN visit_type vt ON vt.visit_type = o.visit_type
        LEFT OUTER JOIN ipt i3 ON i3.vn = o.vn
        LEFT OUTER JOIN opduser ou ON ou.loginname = o.staff
        LEFT OUTER JOIN pt_priority p3 ON p3.ID = o.pt_priority
        LEFT OUTER JOIN pt_subtype ps1 ON ps1.pt_subtype = o.pt_subtype
        LEFT OUTER JOIN pttype_check_status pcs ON pcs.pttype_check_status_id = oq.pttype_check_status_id 
    WHERE o.vstdate BETWEEN '$stdate' AND '$endate' 
        AND ( o.anonymous_visit IS NULL OR o.anonymous_visit = 'N' ) 
        AND kk3.depcode = '$room'
         AND o.doctor = '$doctor'
         
    ORDER BY o.vstdate,o.vsttime DESC ";
        $result = pg_query($sql_detail);
       // echo $sql_detail;
    ?>
    <br>
      <div class="container">
    <div class="row">
            <div class="col-sm-12">
          <center> 
                    <!-- <button type="text" class="btn btn-info" id="asd" onclick="export_home()">
                     <span class="glyphicon glyphicon-ok"></span> เลือกช่วงวันที่ใหม่ </button>&nbsp; -->

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
<?php 
 }
?>
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
    $('#example').DataTable(
      {
					'paging'      : true,
					'lengthChange': true,
					'searching'   : true,
					'ordering'    : true,
					'info'        : true,
					'autoWidth'   : true
				}
    );
} );

       function export_excel(){
			document.location = "export_doctor_room.php?stdate=<?php echo $stdate; ?>&endate=<?php echo $endate; ?>&doctor=<?php echo $doctor; ?>&room=<?php echo $room; ?>";
        } 
        </script>























</body>
</html>