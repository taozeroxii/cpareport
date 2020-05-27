<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.css">
    <link rel="stylesheet" type="text/css" href="pems/css/style.css">
    <link href="fontawesome-free-5.13.0-web/css/all.css" rel="stylesheet"> 
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>
    <div class="uk-container uk-padding">
        <!-- <div>Check Bill Book </div> -->
        <form name="form1" style=" margin-top:15%;" action="#" method="post">
            <div class="uk-width-1-2@m">
                <label class="h2"> เล่มที่ <i class="fas fa-address-card"></i></label>
                <input type="text" name="book_number" value="" placeholder="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required />
            </div>
            <div class="uk-width-1-2@m">
                <label class="h2">เลขที่ </label>
                <input type="text" name="bill_number" value=""  placeholder="" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" required />
            </div>
            <button class="button" type="submit" style="vertical-align:middle;font-size:16px;margin-top:20px" name="submit" value="submit"><span> Check</span></button>
        </form>
    </div>

   <?php
 include 'config/func.class.php';
 include 'config/pg_con.class.php';

    $book_number = $_POST['book_number'];
    $bill_number = $_POST['bill_number'];

 if (($book_number) <> "" &&  ($bill_number) <> ""  ) {

    $sql = " SELECT concat ( P.pname, P.fname, ' ', P.lname ) AS patient_name,
    rc.NAME AS credit_card_type_name,
    y.NAME AS pttype_name,
    fp.finance_pay_type_name,
    p.hn,
    o.NAME AS staff_name ,r.rcpt_print_trans_head_id
    FROM    rcpt_print r
    LEFT OUTER JOIN patient P ON P.hn = r.hn
    LEFT OUTER JOIN opduser o ON o.loginname = r.bill_staff
    LEFT OUTER JOIN pttype y ON y.pttype = r.pttype
    LEFT OUTER JOIN finance_pay_type fp ON fp.finance_pay_type_id = r.finance_pay_type_id
    LEFT OUTER JOIN rcpt_credit_card_type rc ON rc.credit_card_id = r.credit_card_id 
    WHERE 1 = 1 
    AND r.book_number = '".$book_number."' 
    AND r.bill_number = '".$bill_number."' 
    ORDER BY r.bill_date_time ";
    $resulta = pg_query($conn, $sql);
    $row_result = pg_fetch_array($resulta);

    $patient_name = $row_result['patient_name'];
    $hn           = $row_result['hn'];
    $head_id      = $row_result['rcpt_print_trans_head_id'];

 if ($head_id <> "" ) {

    $sql = " SELECT r1.* ,
    concat ( o1.officer_pname, o1.officer_fname, ' ', o1.officer_lname ) AS officer_name 
    FROM    rcpt_print_trans_head r1
    LEFT OUTER JOIN officer o1 ON o1.officer_id = r1.officer_id 
    WHERE 1 = 1 
    AND r1.rcpt_print_trans_head_id = '".$head_id."' ";
    $row = pg_query($conn, $sql);
    $result = pg_fetch_array($row);
   
    $trans_date  = $result['trans_date'];
    $trans_staff = $result['trans_staff'];
    $trans_time  = $result['trans_time'];
    
   ?>
</body>

<div class="divTable nono">
<div class=table>
    <div class=tr>
    <div  class="td">ชื่อ-นามสกุล</div>
    <div  class="td">HN</div>
    <div class="td">วันที่</div>
    <div  class="td">เวลา</div>
    <div  class="td">เวลา</div>
    <div  class="td">เวลา</div>
    <div  class="td">User</div>
    </div>
    <div class=tr>
    <div class="td"><?php echo $patient_name; ?></div>
    <div class="td"><?php echo $hn; ?></div>
  <div class="td"><?php echo thaidate($trans_date); ?></div>
  <div class="td"><?php echo $trans_time; ?></div>
   <div class="td"><?php echo $trans_time; ?></div>
    <div class="td"><?php echo $trans_time; ?></div>
  <div class="td"><?php echo $trans_staff; ?></div>
    </div>
</div>

</div>
<?php
}else{
 echo "<div class='nono'>ไม่มีข้อมูลนะจ๊ะ</div>";
}
?>

<?php
}else{
 echo " ";
}
?>
</html>
<style>
    body {
        min-height: 96.9vh;
        padding: 15px;
        color: #0E6655;
    }
    input {
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        height: 40px;
        vertical-align: middle;
        display: inline-block;
        line-height: 38px;
    }
    .divTable
    {
        display:  table;
        width:auto;
        background-color:#eee;
        border:1px solid  #666666;
        border-spacing:5px;
        text-align: left;
    }
    .divRow
    {
     display:table-row;
     width:auto;
 }
 .divCell
 {
     text-align: left;
    float:left;
    display:table-column;
   /* width:200px;*/
    background-color:#ccc;
}
.nono{
    width: 100%;
    text-align: center;
    font-size: 1.6em;
    font-weight: bold;
    color: #0E6655;
}

.table {
    width: 100%;
    display: table;
}
.tr {
    display: table-row;
}
.td {
    display: table-cell
}
</style>