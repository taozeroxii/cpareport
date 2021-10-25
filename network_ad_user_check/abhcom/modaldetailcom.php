   <!-- Modal Detail -->
   <div id="detailmds" class="modal fade" role="dialog">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-header">
                   <button class="btn btn-info btn-circle btn-sm">
                       <i class="fas fa-info-circle"></i>
                   </button>&nbsp;
                   <span class="btn-h"> ข้อมูล รายละเอียด แก้ไขรายการ <?php echo "<span class='user_h'> by ".$user_regis." / ".$todate."</span>" ; ?></span>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body">


                   <form id="editcom" name="editcom" action="editcom.php" method="POST">
                       <input type="hidden" id="comid" name="com_id" value="">
                       <input type="hidden" id="com_userupdate" name="com_userupdate" value="<?php echo $user_regis;?>">

                       
                       <div class="form-row">
                           <div class="form-group col-md-3">
                               <label for="inputPassword4" class="">หน่วยงาน</label>
                               <select id="depid" class="form-control select2 " style="width: 100%;" tabindex="-1" name="dep_name" required>
                                   <option id="depid" value="" selected>โปรดเลือก</option>
                                   <?php $dep = " SELECT * FROM com_dep ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) {
                                    ?>
                                       <option value="<?php echo $list["dep_id"]; ?>">
                                           <?php echo $list["dep_name"]; ?>
                                       </option>
                                   <?php }
                                    ?>
                               </select>
                           </div>


                           <div class="form-group col-md-3">
                               <label for="inputPassword4" class="">อาคาร</label>
                               <input type="text" class="form-control" id="depzone" value="<?php echo $row_detail['dep_zone']; ?>" readonly placeholder="Sync Auto">
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4" class="">ชั้น</label>
                               <input type="text" class="form-control" id="depclass" value="<?php echo $row_detail['dep_class']; ?>" readonly placeholder="Sync Auto">
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4" class="">เบอร์โทร.</label>
                               <input type="text" class="form-control" id="tel" value="<?php echo $row_detail['dep_tel']; ?>" readonly placeholder="Sync Auto">
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4" class="">กลุ่ม</label>
                               <input type="text" class="form-control" id="depgroup" value="<?php echo $row_detail['dep_group']; ?>" readonly placeholder="Sync Auto">
                           </div>
                       </div>

                       <div class="form-row">
                           <div class="form-group col-md-4">
                               <label for="inputEmail4" class="">ชื่อเครื่อง</label>
                               <input type="text" class="form-control" id="comname" name="com_name" readonly>
                           </div>
                           <div class="form-group col-md-4">
                               <label for="inputPassword4" class="">เลขครุภัณฑ์</label>
                               <input type="text" class="form-control" id="comcode" name="com_code" value="" required>
                           </div>

                           <div class="form-group col-md-2">
                               <label for="comyear">จัดซื้อปี</label>
                               <select id="comyear" class="form-control select2 " name="com_year" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                   <option id="comyear" value="" selected> </option>
                                   <?php $dep = " SELECT * FROM com_year ORDER BY com_year DESC";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["com_year"]; ?>">
                                           <?php echo $list["com_year"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>

                           <div class="form-group col-md-2">
                               <label for="inputPassword4" class="">สถานะ</label>
                               <select id="comstatus" class="form-control select2" name="com_status" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                   <option value="" selected>เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_status ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["status_name"]; ?>">
                                           <?php echo $list["status_name"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                       </div>

                       <div class="form-row">
                           <div class="form-group col-md-4">
                               <label for="inputEmail4">ระบบปฎิบัติการ</label>
                               <select id="comosm" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true" name="com_os_m" required>
                                   <option value="" selected>เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_os ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["os"]; ?>">
                                           <?php echo $list["os"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">ประเภท</label>
                               <select id="comtype" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_type" required>
                                   <option value="" selected>เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_type ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["com_type"]; ?>">
                                           <?php echo $list["com_type"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">รุ่น</label>
                               <select id="combrand" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_brand" required>
                                   <option value="" selected>เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_brand ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["brand"]; ?>">
                                           <?php echo $list["brand"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">VGA</label>
                               <select id="comgraphip" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_graphip" required>
                                   <option value="" selected>เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_vga ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["vga"]; ?>">
                                           <?php echo $list["vga"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">DVD-ROM</label>
                               <select id="comdvdrom" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_dvdrom" required>
                                   <option value="" selected>เลือกรายการ </option>
                                   <option value="มี">มี</option>
                                   <option value="ไม่มี">ไม่มี</option>

                               </select>
                           </div>
                       </div>


                       <div class="form-row">
                           <div class="form-group col-md-2">
                               <label for="inputEmail4">CPU</label>
                               <select id="comcpum" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_cpu_m" required>
                                   <option value="" selected> เลือกรายการ</option>
                                   <?php $dep = " SELECT * FROM com_cpu ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["cpu"]; ?>">
                                           <?php echo $list["cpu"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputEmail4"> CPU GEN </label>
                               <input type="text" class="form-control" id="comcpu" name="com_cpu" value="" placeholder="">

                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">CPU Speed GHz</label>
                               <select id="comghz" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ghz" required>
                                   <option value="" selected>เลือกรายการ </option>
                                   <?php $dep = " SELECT * FROM com_ghz ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["cpu_ghz"]; ?>">
                                           <?php echo $list["cpu_ghz"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4">RAM</label>
                               <select id="comramm" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ram_m" required>
                                   <option value="" selected> เลือกรายการ </option>
                                   <?php $dep = " SELECT * FROM com_ram ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["ram"]; ?>">
                                           <?php echo $list["ram"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>

                           <div class="form-group col-md-2">
                               <label for="inputPassword4">HDD</label>
                               <select id="comhddm" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_hdd_m" required>
                                   <option value="" selected> เลือกรายการ </option>
                                   <?php $dep = " SELECT * FROM com_hdd ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["hdd"]; ?>">
                                           <?php echo $list["hdd"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>

                           </div>
                           <div class="form-group col-md-2">
                               <label for="inputPassword4" class="">ผู้ดูแล</label>
                               <select class="form-control select2 select2-hidden-accessible " name="dep_note" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                   <option id="depnote" selected>โปรดเลือก</option>
                                   <?php $dep = " SELECT * FROM com_job ";
                                    $qdep = mysqli_query($con, $dep);
                                    while ($list = mysqli_fetch_assoc($qdep)) { ?>
                                       <option value="<?php echo $list["job"]; ?>">
                                           <?php echo $list["job"]; ?>
                                       </option>
                                   <?php } ?>
                               </select>
                           </div>

                       </div>
                       <div class="form-row">
                           <div class="form-group col-md-12">
                               <label for="inputPassword4" class="">Note</label>
                               <textarea rows="4" class="form-control" id="comnote" name="com_note" value="<?php echo $row_detail['com_note']; ?>"><?php echo $row_detail['com_note']; ?></textarea>
                           </div>
                       </div>
                       <br>
                       <div class="form-row">
                           <div class="form-group col-md-6">
                               <button type="submit" id="submitcom" name="submitcom" class="btn btn-primary btn-block">ปรับปรุงรายการ</button>
                           </div>
                           <div class="form-group col-md-6">
                               <button type="" id="" name="" class="btn btn-warning btn-block" data-dismiss="modal">ปิด</button>
                           </div>
                       </div>


                   </form>
               </div>
               <br>
           </div>
       </div>
   </div>
   <!-- close detail modal -->




   <script>
       //ส่งค่าเข้า modal ดึงจากตารางแสดงผล
       $(document).ready(function() {
           $('.detailmd').on('click', function() {
               $('#detailmds').modal('show');

               $tr = $(this).closest('tr');

               var data = $tr.children("td").map(function() {
                   return $(this).text();
               }).get();

               console.log(data);
               $('#comname').val(data[1]);
               $('#comcode').val(data[2]);
               $('#depname').val(data[3]);
               $('#depzone').val(data[4]);
               $('#depclass').val(data[5]);
               $('#tel').val(data[6]);
               $('#depnote').val(data[7]).html(data[7]);
               $('#depgroup').val(data[10]);
               $('#comyear').val(data[11]);
               $('#comstatus').val(data[12]);
               $('#comosm').val(data[13]);
               $('#comtype').val(data[14]);
               $('#combrand').val(data[15]);
               $('#comgraphip').val(data[16]);
               $('#comdvdrom').val(data[17]);
               $('#comcpum').val(data[18]);
               $('#comcpu').val(data[19]);
               $('#comghz').val(data[20]);
               $('#comramm').val(data[21]);
               $('#comhddm').val(data[22]);
               $('#comnote').val(data[23]);
               $('#comid').val(data[24]);
               $('#depid').val(data[25]);
           });
       });
   </script>