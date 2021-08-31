<div id="myModal<?php echo $row['com_id']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-info btn-circle btn-sm">
                    <i class="fas fa-info-circle"></i>
                </button>&nbsp;
                <span class="btn-h"> ข้อมูล รายละเอียด แก้ไขรายการ ล่าสุด <?php echo $row['com_dateupdate']; ?></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php
                $com_id = $row['com_id'];
                $sql_deteil = " SELECT * 
                                                                            FROM com_detail as b 
                                                                            LEFT JOIN com_dep as a ON a.dep_id = b.com_depid 
                                                                            WHERE 1 = 1
                                                                            AND b.com_id = '$com_id'
                                                                            ";
                $query_detail = mysqli_query($con, $sql_deteil);
                $row_detail = mysqli_fetch_array($query_detail);
                ?>

                <form id="editcom" name="editcom" action="editcom.php" method="POST">
                    <input type="hidden" id="com_id" name="com_id" value="<?php echo $row_detail['com_id']; ?>">
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="inputPassword4" class="">หน่วยงาน</label>
                            <select id="dep_name" class="form-control select2 " style="width: 100%;" tabindex="-1" name="dep_name" required>
                                <option value="<?php echo $row_detail['dep_id'] . "|" . $row_detail['dep_name']; ?>" selected> <?php echo $row_detail['dep_name'] ? $row_detail['dep_name'] : " เลิอก "; ?> </option>
                                <?php $dep = " SELECT * FROM com_dep ";
                                $qdep = mysqli_query($con, $dep);
                                while ($list = mysqli_fetch_assoc($qdep)) {
                                ?>
                                    <option value="<?php echo $list["dep_id"] . "|" . $list["dep_name"]; ?>">
                                        <?php echo $list["dep_name"]; ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="inputPassword4" class="">อาคาร</label>
                            <input type="text" class="form-control" id="dep_zone" value="<?php echo $row_detail['dep_zone']; ?>" readonly placeholder="Sync Auto">

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4" class="">ชั้น</label>
                            <input type="text" class="form-control" id="dep_class" value="<?php echo $row_detail['dep_class']; ?>" readonly placeholder="Sync Auto">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4" class="">เบอร์โทร.</label>
                            <input type="text" class="form-control" id="tel" value="<?php echo $row_detail['dep_tel']; ?>" readonly placeholder="Sync Auto">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4" class="">กลุ่ม</label>
                            <input type="text" class="form-control" id="dep_group" value="<?php echo $row_detail['dep_group']; ?>" readonly placeholder="Sync Auto">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4" class="">ชื่อเครื่อง</label>
                            <input type="text" class="form-control" id="com_name" name="com_name" value="<?php echo $row_detail['com_name']; ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4" class="">เลขครุภัณฑ์</label>
                            <input type="text" class="form-control" id="com_code" name="com_code" value="<?php echo $row_detail['com_code']; ?>" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">จัดซื้อปี</label>
                            <select id="com_year" class="form-control select2 " name="com_year" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="<?php echo $row_detail['com_year']; ?>" selected> <?php echo $row_detail['com_year']; ?> </option>
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
                            <select id="com_status" class="form-control select2 select2-hidden-accessible" name="com_status" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="<?php echo $row_detail['com_status']; ?>" selected><?php echo $row_detail['com_status'] ? $row_detail['com_status'] : " เลือกรายการ "; ?></option>
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
                            <select id="com_os_m" class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true" name="com_os_m" required>
                                <option value="<?php echo $row_detail['com_os_m']; ?>" selected> <?php echo $row_detail['com_os_m']; ?> </option>
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
                            <select id="com_type" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_type" required>
                                <option value="<?php echo $row_detail['com_type']; ?>" selected> <?php echo $row_detail['com_type']; ?> </option>
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
                            <select id="com_brand" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_brand" required>
                                <option value="<?php echo $row_detail['com_brand']; ?>" selected> <?php echo $row_detail['com_brand']; ?> </option>
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
                            <select id="com_graphip" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_graphip" required>
                                <option value="<?php echo $row_detail['com_graphip']; ?>" selected> <?php echo $row_detail['com_graphip']; ?> </option>
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
                            <select id="com_dvdrom" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_dvdrom" required>
                                <option value="<?php echo $row_detail['com_dvdrom']; ?>" selected> <?php echo $row_detail['com_dvdrom']; ?> </option>
                                <option value="มี">มี</option>
                                <option value="ไม่มี">ไม่มี</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">CPU</label>
                            <select id="com_cpu_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_cpu_m" required>
                                <option value="<?php echo $row_detail['com_cpu_m']; ?>" selected> <?php echo $row_detail['com_cpu_m']; ?> </option>
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
                            <input type="text" class="form-control" id="com_cpu" name="com_cpu" value="<?php echo $row_detail['com_cpu']; ?>" placeholder="">

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputPassword4">CPU Speed GHz</label>
                            <select id="com_ghz" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ghz" required>
                                <option value="<?php echo $row_detail['com_ghz']; ?>" selected> <?php echo $row_detail['com_ghz']; ?> </option>
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
                            <select id="com_ram_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_ram_m" required>
                                <option value="<?php echo $row_detail['com_ram_m']; ?>" selected> <?php echo $row_detail['com_ram_m']; ?> </option>
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
                            <select id="com_hdd_m" class="form-control select2 " style="width: 100%;" tabindex="-1" name="com_hdd_m" required>
                                <option value="<?php echo $row_detail['com_hdd_m']; ?>" selected> <?php echo $row_detail['com_hdd_m']; ?> </option>
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
                            <select id="dep_note" class="form-control select2 select2-hidden-accessible " name="dep_note" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
                                <option value="<?php echo $row_detail['dep_note']; ?>" selected> <?php echo $row_detail['dep_note'] ? $row_detail['dep_note'] : " เลิอก "; ?> </option>
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
                            <textarea rows="4" class="form-control" id="com_note" name="com_note" value="<?php echo $row_detail['com_note']; ?>"><?php echo $row_detail['com_note']; ?></textarea>
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