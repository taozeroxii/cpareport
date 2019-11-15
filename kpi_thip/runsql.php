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
$Y  =  date("Y");
$M  = date("m")-1;
if($M < 1){$M = date("m"); $Y = date("Y")-1; }
$D  =  date("dd");
$YMDbegin = $Y.'-'.$M.'-01'; // วันที่เริ่ม
$enddayofmonth = "SELECT (date_trunc('month', '$YMDbegin'::date) + interval '1 month' - interval '1 day')::date AS end_of_month"; //คำสั่งรัน query เพื่อเอาค่าวันที่เดือนที่แล้วไปหาวันสุดท้ายของเดือน
$resultenddayofmonth = pg_query($conn,$enddayofmonth);
$enddate = pg_fetch_assoc($resultenddayofmonth);
$end_date_of_month = $enddate['end_of_month'] ;//เ็บค่าวันที่สุดท้ายของเดือน

//---------------- query ดึชุดคำสั่ง SQL จ่ก DB และแทนที่วันเดือนปีเป็นเดือนก่อนหน้าของวันที่กดป่มปัจจุบันอัพเดททุกๆ 1 เดือน------
$serch1timepermonth = " SELECT * FROM cpareport_kpi_sql WHERE kpi_type = 'Y'  ;";
$ronetimepermonth = mysqli_query($con, $serch1timepermonth);
$kpi_ym = $Y.'-'.$M;
$kpi_dateupdate = date("Y/m/d h:i:s");
$kpi_status   = 1;

foreach ($ronetimepermonth as $sql1time) {
    $permonth = $sql1time['kpi_sql_a'];
    $permontB = $sql1time['kpi_sql_b'];
    $kpicode  = $sql1time['kpi_code'];
    $kpi_cal  = $sql1time['kpi_cal'];

    // แทนที่ข้อความช่วงวันที่ A และ B 
    $sql_a = " $permonth ";
    $sql_a = str_replace("{datepickers}", "'$YMDbegin'", $sql_a);
    $sql_a = str_replace("{datepickert}", "'$end_date_of_month'", $sql_a);
    $sql_b = " $permontB ";
    $sql_b = str_replace("{datepickers}", "'$YMDbegin'", $sql_b);
    $sql_b = str_replace("{datepickert}", "'$end_date_of_month'", $sql_b);
    
    echo 'inserttime: '.$kpi_dateupdate.' kpi_ym: '.$kpi_ym.' kpi_year: '.$Y.' status: '.$kpi_status.'<br>';
    // query SQL A count a and insert a  b on database mysql
    if( $permonth != null ){//เช็ค sql ว่ามีค่าใน db เก็บชุดคำสั่งไหม
        $result_a = pg_query($conn,$sql_a);
        $suma = pg_fetch_assoc($result_a );
        $Rsuma = $suma['a'];
        echo  $kpicode.'<br>cal_A:'.$Rsuma .'<br>';
    }

    // query SQL B count a and insert a  b on database mysql
    if( $permontB != null){
        $result_b = pg_query($conn,$sql_b);
        $sumB = pg_fetch_assoc($result_b );
        $RsumB = $sumB['b'];
        echo  'cal_B:'.$RsumB .'<br>';
    }

    if( $Rsuma != null && $RsumB != null ||$Rsuma != 0 && $RsumB != 0 )
    { 
        if( $kpi_cal = 1){
            $resultkpi1 = ($Rsuma/$RsumB)*100;
            echo 'Kpi :'.number_format($resultkpi1,2) .'<br>';
        }
    }
    echo '<br>';
    //ใช้คำสั่ง Insert ข้อมูลในเดือนก่อนหน้าของเดือนที่กด Update 

}
?>