<div id="my_ma<?php echo $row['dep_id']; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button class="btn btn-info btn-circle btn-sm"><i class="fas fa-info-circle"></i> </button>&nbsp;
                                                            <span class="btn-h"><?php echo $row['dep_name'] . " " . $row['dep_zone'] . " " . $row['dep_class'] . " โทร. " . $row['dep_tel']; ?>
                                                            </span>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $dep_id = $row['dep_id'];
                                                            $sql_deteil = " SELECT * FROM com_detail WHERE com_depid = ' $dep_id' ";
                                                            $query_detail = mysqli_query($con, $sql_deteil);
                                                            ?>
                                                            <div class="row row-header">

                                                                <div class="col-lg-3">เลขครุภัณฑ์</div>
                                                                <div class="text-center col-lg-2">จัดซื้อปี</div>
                                                                <div class="text-center col-lg-5">เพิ่มรายการ บำรุง/ซ่อม/รายการนี้</div>
                                                                <div class="text-center col-lg-2">บันทึกการบำรุงรักษา</div>
                                                            </div>
                                                            <br>
                                                            <?php
                                                            // $rw_detail = 0;
                                                            // while ($row_detail = mysqli_fetch_array($query_detail)) {
                                                            //     $rw_detail++;
                                                            //     $yps =  $row_detail['com_code'];
                                                            //     $year_pay = substr($yps, 14, 2);
                                                            //     $sta = $row_detail['com_status'];

                                                            ?>
                                                                <div class="row row-table">

                                                                    <div class="col-lg-3"><?php echo $row_detail['com_code']; ?></div>
                                                                    <div class="text-center col-lg-2"><?php echo $year_pay; ?></div>
                                                                    <div class="text-center col-lg-5"><input type="text"></div>
                                                                    <div class="text-center col-lg-2"> <button class="btn btn-info btn-icon-split">
                                                                            <span class="icon text-white-50">
                                                                                บันทึกกิจกรรม
                                                                            </span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                           // }
                                                            ?>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>