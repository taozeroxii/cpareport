<?
//Config DB
$connstring = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($connstring);
pg_set_client_encoding($conn, "utf8");
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con, "utf8");
//--------------------------------------------------------------------------------------------
/*
$y = 2019;
$m = 1-1;
if($m<1){$m = 12; $y--;}
echo $y.' '.$m;
*/
date_default_timezone_set("Asia/Bangkok");
$Y  =  date(("Y"),strtotime("last month"));
$M  = date(("m"),strtotime("last month"));
$YMDbegin = date("Y-m-d", strtotime("first day of previous month")); // วันที่เริ่ม strtotime("first day of previous month") ตัวแปรเก็บค่าไปแทนที่ช่วงวันที่เริ่มต้นใน query 
$enddayofmonth = "SELECT (date_trunc('month', '$YMDbegin'::date) + interval '1 month' - interval '1 day')::date AS end_of_month"; //คำสั่งรัน query เพื่อเอาค่าวันที่เดือนที่แล้วไปหาวันสุดท้ายของเดือน หรือใช้ strtotime("last day of previous month") ก็ได้
$resultenddayofmonth = pg_query($conn,$enddayofmonth);
$enddate = pg_fetch_assoc($resultenddayofmonth);
$kpi_dateupdate = date("Y-m-d H:i:s");
$end_date_of_month = $enddate['end_of_month'] ;//เช็คค่าวันที่สุดท้ายของเดือน

//---------------- query ดึชุดคำสั่ง SQL จ่ก DB และแทนที่วันเดือนปีเป็นเดือนก่อนหน้าของวันที่กดป่มปัจจุบันอัพเดททุกๆ 1 เดือน------
echo 'รายเดือน<br>';
$serch1timepermonth = " SELECT * FROM cpareport_kpi_sql WHERE kpi_type = 'Y' AND kpi_event = '1';";
$ronetimepermonth = mysqli_query($con, $serch1timepermonth);
$kpi_ym = $Y.'-'.$M;
$kpi_status   = 1;

foreach ($ronetimepermonth as $sql1time) {
    $permonth = $sql1time['kpi_sql_a'];
    $permontB = $sql1time['kpi_sql_b'];
    $kpicode  = $sql1time['kpi_code'];
    $kpi_cal  = $sql1time['kpi_cal'];
    $resultkpi = 0;
    // แทนที่ข้อความช่วงวันที่ A และ B 
    $sql_a = " $permonth ";
    $sql_a = str_replace("{datepickers}", "'$YMDbegin'", $sql_a);
    $sql_a = str_replace("{datepickert}", "'$end_date_of_month'", $sql_a);
    $sql_b = " $permontB ";
    $sql_b = str_replace("{datepickers}", "'$YMDbegin'", $sql_b);
    $sql_b = str_replace("{datepickert}", "'$end_date_of_month'", $sql_b);
    
    // query SQL A count a and insert a  b on database mysql
    if( $permonth != null ){//เช็ค sql ว่ามีค่าใน db เก็บชุดคำสั่งไหม
        $result_a = pg_query($conn,$sql_a);
        $suma = pg_fetch_assoc($result_a );
        $Rsuma = $suma['a'];
        //echo  $kpicode.'<br>cal_A:'.$Rsuma .'<br>';
    }

    // query SQL B count a and insert a  b on database mysql
    if( $permontB != null){
        $result_b = pg_query($conn,$sql_b);
        $sumB = pg_fetch_assoc($result_b );
        $RsumB = $sumB['b'];
        //echo  'cal_B:'.$RsumB .'<br>';
    }

    if( $Rsuma != null && $RsumB != null ||$Rsuma != '' && $RsumB != '' )
    { 
        if( $kpi_cal == '1'){
            @$resultkpi = ($Rsuma/$RsumB)*100;
            @$resultkpisub = number_format($resultkpi,2);
            //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
        }
        if( $kpi_cal == '2'){
            @$resultkpi = $Rsuma/$RsumB;
            @$resultkpisub = number_format($resultkpi,2);
            //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
        }
    }
    echo 'kpicode: '.$kpicode.' kpi_a: '.$Rsuma.' kpi_b: '.$RsumB.' kpi_c : '.number_format($resultkpi,2).' inserttime: '.$kpi_dateupdate.' kpi_ym: '.$kpi_ym.' kpi_year: '.$Y.' status: '.$kpi_status.'<br>';
    //ใช้คำสั่ง Insert ข้อมูลในเดือนก่อนหน้าของเดือนที่กด Update 
    $checkkpi = " SELECT * FROM cpareport_kpi_data where  kpi_code = '".$kpicode."' AND kpi_ym = '$kpi_ym' "; // queryดูใน kpicodeว่าเดือนนั้นๆเคย insert ไปรึยัง หากยังให้เพิ่มลงฐาน
    $have_checkkpi_yet = mysqli_query($con, $checkkpi);
    $reshave_kpi_yet = mysqli_fetch_assoc($have_checkkpi_yet);
    $reshave_kpi_yet['kpi_ym'];
    $reshave_kpi_yet['kpi_code'].'<br>';
    if( $reshave_kpi_yet['kpi_ym'] == null ||  $reshave_kpi_yet['kpi_ym']==''){
         $QueryInsertkpi_data = "INSERT INTO cpareport_kpi_data SET
         kpi_code =   '" . $kpicode. "',
         kpi_ym = '" .$kpi_ym. "',
         kpi_year = '" .$Y. "',
         kpi_month = '" .$M. "',
         kpi_cal_a = '" .$Rsuma. "',
         kpi_cal_b = '" .$RsumB. "',
         kpi_cal_c = '" .$resultkpisub. "',
         kpi_status = '" .$kpi_status. "',
         kpi_dateupdate = '" .$kpi_dateupdate. "'";
         $ResultInsert = mysqli_query($con,$QueryInsertkpi_data);
    }
        if( $reshave_kpi_yet['kpi_ym'] == $kpi_ym){ // if เช็คค่าหากมีการเพิมข้อมูลไปแล้วในเดือนนั้นเป็นช่วงวันแรกๆและข้อมูลอาจมีการเปลี่ยนแปลงช่วงสิ้นเดือนจะทำการ update ข้อมูลล่าสุดเข้าไปแทน
        $QueryUpdatekpi_data = "UPDATE cpareport_kpi_data SET
        kpi_code =   '" . $kpicode. "',
        kpi_ym = '" .$kpi_ym. "',
        kpi_year = '" .$Y. "',
        kpi_month = '" .$M. "',
        kpi_cal_a = '" .$Rsuma. "',
        kpi_cal_b = '" .$RsumB. "',
        kpi_cal_c = '" .$resultkpisub. "',
        kpi_status = '" .$kpi_status. "',
        kpi_dateupdate = '" .$kpi_dateupdate. "' where kpi_code = '".$kpicode."' AND kpi_ym = '". $reshave_kpi_yet['kpi_ym']."' ";
        $ResultUpdate = mysqli_query($con,$QueryUpdatekpi_data);
    }
}


//---------------- query ดึชุดคำสั่ง SQL จ่ก DB และแทนที่วันเดือนปีเป็นเดือนก่อนหน้าของวันที่กดป่มปัจจุบันอัพเดททุกๆ 6 เดือน------
echo '6เดือน<br>';
$Y6 = date(("Y"),strtotime("last month"));
$M6 = date(("m"),strtotime("last month"));
$sixmonthm = date("m");//Update ทุกๆ เดือนที่ 10 และเดือน  4
//echo $sixmonthEnddate  = date(("Y-m-d"),strtotime("2019-04-01 last day of 5 month ")) ;echo '<br>';   // ให้เช็ควันสุดท้ายของอีก 5 เดือนถัดไปรวมเดือนที่ปัจจุบันด้วยเป็น 6 เดือน
$sixmonthBegindate  = date(("Y-m-d"),strtotime("first day of -6 month ")) ;//echo '<br>';    // ให้เช็ควันแรกของเดือน-6
$sixmonthEnddate = date(("Y-m-d"),strtotime("last day of last month"));//echo '<br>'; // เช็ควันสุดท้ายของเดือน

if($sixmonthm == "11"||$sixmonthm == "05"){// ในรอบปีงบ เดือน 4 ถึง เดือน 9 และ เดือน 10 ปีเก่า ถึง เดือน 3 ปีใหม่ 
    $sixmonthBegindate  = date(("Y-m-d"),strtotime("first day of -6 month ")) ;//echo '<br>';  // ให้เช็ควันแรกของเดือนปัจจุบัน -6
    $sixmonthEnddate = date(("Y-m-d"),strtotime("last day of last month"));//echo '<br>'; // วันสุดท้ายของเดือนก่อนหน้าเดือนปัจจุบัน
    $serch1timeperyear = " SELECT * FROM cpareport_kpi_sql WHERE kpi_type = 'Y' AND kpi_event = '6';"; // query เช็คค่าในฐานว่า query sql ตัวไหนเป็นแบบราย 6 เดือน 
    $ronetimeperyear = mysqli_query($con, $serch1timeperyear);
    $kpi_status   = 1;

    foreach ($ronetimeperyear as $sql2timeperyear) {
        $permontha = $sql2timeperyear['kpi_sql_a'];
        $permontb = $sql2timeperyear['kpi_sql_b'];
        $kpi_code  = $sql2timeperyear['kpi_code'];
        $kpi_cal  = $sql2timeperyear['kpi_cal'];
        $resultkpi = 0;
        // แทนที่ข้อความช่วงวันที่ A และ B 
        $sql_a = " $permontha ";
        $sql_a = str_replace("{datepickers}", "'$sixmonthBegindate'", $sql_a);
        $sql_a = str_replace("{datepickert}", "'$sixmonthEnddate'", $sql_a);
        $sql_b = " $permontb ";
        $sql_b = str_replace("{datepickers}", "'$sixmonthBegindate'", $sql_b);
        $sql_b = str_replace("{datepickert}", "'$sixmonthEnddate'", $sql_b);
        //echo '<br>';
        
        // query SQL A count a and insert a  b on database mysql
        if( $permonth != null ){//เช็ค sql ว่ามีค่าใน db เก็บชุดคำสั่งไหม
            $result_a = pg_query($conn,$sql_a);
            $suma = pg_fetch_assoc($result_a );
            $Rsuma = $suma['a'];
            //echo  $kpicode.'<br>cal_A:'.$Rsuma .'<br>';
        }
    
        // query SQL B count a and insert a  b on database mysql
        if( $permontB != null){
            $result_b = pg_query($conn,$sql_b);
            $sumB = pg_fetch_assoc($result_b );
            $RsumB = $sumB['b'];
            //echo  'cal_B:'.$RsumB .'<br>';
        }
    
        if( $Rsuma != null && $RsumB != null ||$Rsuma != '' && $RsumB != '' )
        { 
            if( $kpi_cal == '1'){
                @$resultkpi = ($Rsuma/$RsumB)*100;
                $resultkpisub = number_format($resultkpi,2);
                //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
            }
            if( $kpi_cal == '2'){
                @$resultkpi = $Rsuma/$RsumB;
                @$resultkpisub = number_format($resultkpi,2);
                //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
            }
        }

        echo 'kpicode: '.$kpi_code.' kpi_a: '.$Rsuma.' kpi_b: '.$RsumB.' kpi_c : '.number_format($resultkpi,2).' inserttime: '.$kpi_dateupdate.' kpi_ym: '.$kpi_ym.' kpi_year: '.$Y.' status: '.$kpi_status.'<br>';
        //ใช้คำสั่ง Insert ข้อมูลในเดือนก่อนหน้าของเดือนที่กด Update 
        $kpi_ym6 = date(("Y-m"),strtotime("first day of -6 month "));
        $checkkpi = " SELECT * FROM cpareport_kpi_data where  kpi_code = '".$kpi_code."' AND kpi_ym = '$kpi_ym6' "; // queryดูใน kpicodeว่าเดือนนั้นๆเคย insert ไปรึยัง หากยังให้เพิ่มลงฐาน
        $have_checkkpi_yet = mysqli_query($con, $checkkpi);
        $reshave_kpi_yet = mysqli_fetch_assoc($have_checkkpi_yet);
        $reshave_kpi_yet['kpi_ym'];
        if( $reshave_kpi_yet['kpi_ym'] == null ||  $reshave_kpi_yet['kpi_ym']==''){
             $QueryInsertkpi_data = "INSERT INTO cpareport_kpi_data SET
             kpi_code =   '" . $kpi_code. "',
             kpi_ym = '" .$kpi_ym6. "',
             kpi_endym = '" .$sixmonthEnddate. "',
             kpi_year = '" .$Y6. "',
             kpi_month = '" .$M6. "',
             kpi_cal_a = '" .$Rsuma. "',
             kpi_cal_b = '" .$RsumB. "',
             kpi_cal_c = '" .$resultkpisub. "',
             kpi_status = '" .$kpi_status. "',
             kpi_dateupdate = '" .$kpi_dateupdate. "'";
             $ResultInsert = mysqli_query($con,$QueryInsertkpi_data);
        }
    }
}




//---------------- query ดึชุดคำสั่ง SQL จ่ก DB และแทนที่วันเดือนปีเป็นเดือนก่อนหน้าของวันที่กดป่มปัจจุบันอัพเดททุกๆ 12 เดือน------
echo '1ปีครั้ง<br>';
$Y12 = date(("Y"),strtotime("last month"));
$M12 = date(("m"),strtotime("last month"));
$ononeyear = date("m");//Update ทุกๆ เดือนที่ 11 
$ononeyearBegindate  = date(("Y-m-d"),strtotime("first day of -12 month ")) ;
$ononeyearEnddate = date(("Y-m-d"),strtotime("last day of last month"));

if($ononeyear == "11"){
    $YBegindate  = date(("Y-m-d"),strtotime("first day of -12 month ")) ;// ให้เช็ควันแรกของอีก 5 เดือนถัดไปรวมเดือนที่ปัจจุบันด้วยเป็น 12 เดือน   // ให้เช็ควันแรกของเดือนที่10
    $YEnddate = date(("Y-m-d"),strtotime("last day of last month"));// ให้เช็ควันสุดท้ายของเดือนที่10
    $sercperyear = " SELECT * FROM cpareport_kpi_sql WHERE kpi_type = 'Y' AND kpi_event = '12';"; // query เช็คค่าในฐานว่า query sql ตัวไหนเป็นแบบราย 6 เดือน 
    $Querysercperyear = mysqli_query($con, $sercperyear);
    $kpi_status   = 1;

    foreach ($Querysercperyear as $sqltimeperyear) {
        $peyeara = $sqltimeperyear['kpi_sql_a'];
        $peyearb = $sqltimeperyear['kpi_sql_b'];
        $kpi_code  = $sqltimeperyear['kpi_code'];
        $kpi_cal  = $sqltimeperyear['kpi_cal'];
        $resultkpi = 0;
        // แทนที่ข้อความช่วงวันที่ A และ B 
        $sql_a = " $peyeara ";
        $sql_a = str_replace("{datepickers}", "'$YBegindate'", $sql_a);
        $sql_a = str_replace("{datepickert}", "'$YEnddate'", $sql_a);
        $sql_b = " $peyearb ";
        $sql_b = str_replace("{datepickers}", "'$YBegindate'", $sql_b);
        $sql_b = str_replace("{datepickert}", "'$YEnddate'", $sql_b);
        //echo '<br>';
        
        // query SQL A count a and insert a  b on database mysql
        if( $peyeara != null ){//เช็ค sql ว่ามีค่าใน db เก็บชุดคำสั่งไหม
            $result_a = pg_query($conn,$sql_a);
            $suma = pg_fetch_assoc($result_a );
            $Rsuma = $suma['a'];
            //echo  $kpicode.'<br>cal_A:'.$Rsuma .'<br>';
        }
    
        // query SQL B count a and insert a  b on database mysql
        if( $peyearb != null){
            $result_b = pg_query($conn,$sql_b);
            $sumB = pg_fetch_assoc($result_b );
            $RsumB = $sumB['b'];
            //echo  'cal_B:'.$RsumB .'<br>';
        }
    
        if( $Rsuma != null && $RsumB != null ||$Rsuma != '' && $RsumB != '' )
        { 
            if( $kpi_cal = 1){
                @$resultkpi = ($Rsuma/$RsumB)*100;
                $resultkpisub = number_format($resultkpi,2);
                //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
            }
            if( $kpi_cal = 2){
                @$resultkpi = ($Rsuma/$RsumB);
                @$resultkpisub = number_format($resultkpi,2);
                //echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
            }
        }

        echo 'kpicode: '.$kpi_code.' kpi_a: '.$Rsuma.' kpi_b: '.$RsumB.' kpi_c a/b*100: '.number_format($resultkpi,2).' inserttime: '.$kpi_dateupdate.' kpi_ym: '.$kpi_ym.' kpi_year: '.$Y.' status: '.$kpi_status.'<br>';
        //ใช้คำสั่ง Insert ข้อมูลในเดือนก่อนหน้าของเดือนที่กด Update 
        $kpi_ym12 = date(("Y-m"),strtotime("first day of -12 month "));
        $checkkpi = " SELECT * FROM cpareport_kpi_data where  kpi_code = '".$kpi_code."' AND kpi_ym = '$kpi_ym12' "; // queryดูใน kpicodeว่าเดือนนั้นๆเคย insert ไปรึยัง หากยังให้เพิ่มลงฐาน
        $have_checkkpi_yet = mysqli_query($con, $checkkpi);
        $reshave_kpi_yet = mysqli_fetch_assoc($have_checkkpi_yet);
        $reshave_kpi_yet['kpi_ym'];
        if( $reshave_kpi_yet['kpi_ym'] == null ||  $reshave_kpi_yet['kpi_ym']==''){
             $QueryInsertkpi_data = "INSERT INTO cpareport_kpi_data SET
             kpi_code =   '" . $kpi_code. "',
             kpi_ym = '" .$kpi_ym12. "',
             kpi_endym = '" .$YEnddate. "',
             kpi_year = '" .$Y12. "',
             kpi_month = '" .$M12. "',
             kpi_cal_a = '" .$Rsuma. "',
             kpi_cal_b = '" .$RsumB. "',
             kpi_cal_c = '" .$resultkpisub. "',
             kpi_status = '" .$kpi_status. "',
             kpi_dateupdate = '" .$kpi_dateupdate. "'";
             $ResultInsert = mysqli_query($con,$QueryInsertkpi_data);
        }
    }
}
echo '<br><p style="color:green">Update Success</p>';
?>