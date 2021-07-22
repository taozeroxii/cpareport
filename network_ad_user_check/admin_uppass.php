<?php
date_default_timezone_set('asia/bangkok');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- https://www.formget.com/submit-form-using-ajax-php-and-jquery/ -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Active Directory Admin Repass Update|</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Shrikhand" rel="stylesheet"> -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="eak.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <script src="add_ajax_script.js"></script>
    <script type='text/javascript'>
        function check_email(elm) {
            var regex_email = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
            if (!elm.value.match(regex_email)) {
                alert('กรุณาตรวจสอบ Email ให้ถูกต้อง');
            } else {
                //alert('you email true');
            }
        }
    </script>

    <meta property="og:title" content="Social Buttons for Bootstrap" />
    <meta property="og:description" content="A beautiful replacement for JavaScript's 'alert' for Bootstrap" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://lipis.github.io/bootstrap-sweetalert/" />
    <meta property="og:image" content="http://lipis.github.io/bootstrap-social/assets/bootstrap-sweetalert.png" />

    <title> LOAD EXCEL FILE </title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.1.js"></script>
    <link href="assets/docs.css" rel="stylesheet">

    <!-- This is what you need -->
    <script src="dist/sweetalert.js"></script>
    <link rel="stylesheet" href="dist/sweetalert.css">
    <!--.......................-->
    <style>
        body {
            background-color: #000;
            color: #fff;
        }

        .detail {
            background-color: #D33306;
        }

        .inp {
            border-top: none;
            border-left: none;
            border-right: none;
            background-color: transparent;
            cursor: copy;
        }
    </style>

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-42119746-3', 'auto');
        ga('send', 'pageview');
    </script>
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
           AND status_pass = 'O'  
            ";
$query = mysql_query($sql);
?>

<body>

    <br>
    <hr>
    <div class="cen">

        <body style="text-align:center;">
            <h1 style="color:green;">
                Admin Update User Authentication Reset Password.
            </h1>
    </div>

    <div class="cen"> <span class="war">
    </div>

    <hr>
    <div class="container-fuild ">
        <div class="row">
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
                            <th style="text-align: center;">รหัสเริ่มต้น</th>
                            <th style="text-align: center;">รหัสผ่านใหม่</th>
                            <th style="text-align: center;">ยืนยันการ Update</th>
                            <!-- <th style="text-align: center;">รีเซ็ตรหัสผ่านใหม่</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($result = mysql_fetch_assoc($query)) { ?>
                            <tr class="">
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
                                <td><?php echo $result['password']; ?></td>

                                <?php $newpass = $result['new_pass']; ?>
                                <td>
                                    <style>
                                        .smm {
                                            font-size: 0.00000000000001px;
                                            color: #fff;
                                        }
                                    </style>
                                    <div class="smm" title="คลิก Copy Update AD "><?php echo $newpass; ?>
                                        <button onclick="copy(this)" class="btn btn-block btn-danger"><?php echo $newpass; ?></button>
                                    </div>
                                </td>

                                <?php
                                $status_pass = $result['status_pass'];
                                $username    = $result['username'];
                                ?>
                                <td>
                                    <div class="text-center" id="main_content">
                                        <button type="button" title="คลิกเมื่อทำการ update ในระบบ AD แล้ว" class="btn btn-success btn-block view_data glyphicon glyphicon-refresh" id="<?php echo $username; ?>">&nbsp;Update&nbsp;รหัส</button>
                                    </div>
                                </td>

                            </tr>
                        <?php $i++;
                        } ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <hr>
    <?php
    $sql_add = " SELECT flage,firstname,lastname,username
                   ,email,department,`password`
                   ,status_pass,telephone,jobtitle,company
             FROM network_ad_user
             WHERE flage = '0'  
            ";
    $query_add = mysql_query($sql_add);
    ?>
    <div class="cen">

        <body style="text-align:center;">
            <h1 style="color:green;">
                ADD USER AD NEW.
            </h1>
    </div>

    <div class="container-fuild ">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered ta">
                    <thead>
                        <tr class="detail">
                            <th style="text-align: center;">#</th>
                            <th style="text-align: center;">firstname</th>
                            <th style="text-align: center;">lastname</th>
                            <th style="text-align: center;">username</th>
                            <th style="text-align: center;">password</th>
                            <th style="text-align: center;">telephone</th>
                            <th style="text-align: center;">email</th>
                            <th style="text-align: center;">jobtitle</th>
                            <th style="text-align: center;">department</th>
                            <th style="text-align: center;">company</th>
                            <th style="text-align: center;">flage</th>
                            <th style="text-align: center;">เพิ่มรายการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($result_add = mysql_fetch_assoc($query_add)) { ?>
                            <tr class="">
                                <td><?php echo $i; ?>.</td>
                                <td> <input class="inp" title="Copy Link" type="text" id="copy_this" value='<?php echo  $result_add['firstname']; ?>' onclick="copyTo(this)" /></td>
                                <td><input type="text" value="<?php echo $result_add['lastname']; ?>" class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['username']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['password']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['telephone']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['email']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['jobtitle']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['department']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><input type="text" value="<?php echo $result_add['company']; ?>"  class="inp" onclick="copyTo(this)"></td>
                                <td><?php echo $result_add['flage']; ?></td>

                                <td>
                                    <div class="text-center" id="main_content">
                                        <a href="add_newuser.php?username=<?php echo $result_add['username']; ?>">
                                            <button type="button" title="คลิกเมื่อทำการ update ในระบบ AD แล้ว" class="btn btn-info btn-block add_data" id="<?php echo $username; ?>">&nbsp;เพิ่ม&nbsp;</button>
                                    </div>
                                    </a>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>

<script>
    function copyTo(input) {
        input.select();
        document.execCommand("copy");
    }

    function copy(clickedBtn) {
        clickedBtn.value = "Copied to clipboard";
        clickedBtn.disabled = false;
        //   clickedBtn.style.color = 'white';
        //   clickedBtn.style.background = 'gray';
        //New Code
        copyToCliboard(clickedBtn.previousSibling);

    }

    function copyToCliboard(el) {
        if (document.body.createTextRange) {
            var range = document.body.createTextRange();
            range.moveToElementText(el);
            range.select();
        } else {
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(el);
            selection.removeAllRanges();
            selection.addRange(range);
        }
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        // alert("Copied the text: " + range ); 
        swal("Copy รหัสใหม่ แล้ว", " " + range + " ", "success");
    }
</script>
<script>
    ! function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            p = /^http:/.test(d.location) ? 'http' : 'https';
        if (!d.getElementById(id)) {
            js = d.createElement(s);
            js.id = id;
            js.src = p + '://platform.twitter.com/widgets.js';
            fjs.parentNode.insertBefore(js, fjs);
        }
    }(document, 'script', 'twitter-wjs');
</script>

<script>
    $(document).ready(function() {
        $('.view_data').click(function() {
            var uid = $(this).attr("id");
            swal({
                    title: "ต้องการ Update รายการนี้ ?",
                    text: "ใช่ หรือ ไม่ !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ไม่ใช่",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        swal({
                                title: "Update",
                                text: "รายการนี้สำเร็จ!",
                                type: "success"
                            },
                            function() {
                                location.reload();
                            }
                        );
                        $.ajax({
                            url: "update_passnew.php",
                            method: "post",
                            data: {
                                id: uid
                            },
                            success: function(data) {}

                        });
                    } else {
                        swal("ยกเลิก", " การ Update รายการนี้ ", "error");
                    }
                })
        });
    });
</script>