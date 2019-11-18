
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/demo.js"></script>

<script src="http://cdn.jsdelivr.net/typeahead.js/0.9.3/typeahead.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


<script>
  $(function () {
    $(".select2").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลทั้งหมด'
   });
    $(".select3").select2({
     placeholder: 'ทั้งหมด'
   });
    $(".select4").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลคลินิกทั้งหมด'
   });
    $(".select5").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลสิทธิ์ทั้งหมด'
   });
    $(".select6").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลแพทย์ทั้งหมด'
   });
    $(".select7").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลทุกสถานะ'
   });
    $(".select8").select2({
     placeholder: 'ถ้าไม่เลือกจะแสดงข้อมูลทุก Type'
   });

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    );


//eaktamp input strat nd stop date//
     //Date start
     $('#datepickers').datepicker({
      autoclose: true //,
      //format: 'dd-mm-yyyy'
    });
     //Date stop
     $('#datepickert').datepicker({
      autoclose: true//,
      //format: 'dd-mm-yyyy'
    });


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

<script type="text/javascript">                
  function loadct(){
    $.ajax({
   // url: "clinic.php",
   url: "department.class.php",
   method: 'GET',
   data: {'selector':'ct'},
   success: function(result){
    var htmlOption = "";
                      var option = [];                                           // GG select //
                      data = JSON.parse(result);
                       //console.log(result);
                     //  console.log(data);
                     $.each(data, function(i, item) {
                            var o = {id:item.depcode,text:item.department};   // GG select //
                            option.push(o);                                       // GG select //

                            htmlOption += "<option value='"+ item.depcode +"'>"+ item.department + "</option>";
                          });
                     $('#c_dropdown').html(htmlOption);
                     //   $('#c_dropdown').select2({data:option});          // GG select //                 
                   }});
  }
  loadct();

</script>

<script type="text/javascript">                
  function loadct(){
    $.ajax({
      url: "doctor.class.php",
      method: 'GET',
      data: {'selector':'doctor'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.code +"'>"+ item.name +" "+ item.licenseno +"</option>";
        });
        $('#d_dropdown').html(htmlOption);

      }});
  }
  loadct();

</script>

<script type="text/javascript">                
  function loadct(){
    $.ajax({
      url: "pttype.class.php",
      method: 'GET',
      data: {'selector':'ins'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.pttype +"'>"+ item.pttype + " "+ item.name + "</option>";
        });
        $('#i_dropdown').html(htmlOption);

      }});
  }
  loadct();

</script>

<script type="text/javascript">                
  function loadct(){
    $.ajax({
      url: "diag.class.php",
      method: 'GET',
      data: {'selector':'icd101'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.code +"'>"+ item.code + " "+ item.name + "</option>";
        });
        $('#diag_dropdown').html(htmlOption);

      }});
  }
  loadct();

<script type="text/javascript">                
  function loadclinic(){
    $.ajax({
      url: "clinic.class.php",
      method: 'GET',
      data: {'selector':'icd101'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.code +"'>"+ item.code + " "+ item.name + "</option>";
        });
        $('#clinic_dropdown').html(htmlOption);
        
      }});
  }
  loadclinic();

</script>
<style>
  .tt-query,
  .tt-hint {
    width: 396px;
    height: 30px;
    padding: 8px 12px;
    font-size: 24px;
    line-height: 30px;
    border: 2px solid #ccc;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    outline: none;
  }

  .tt-query {
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  }

  .tt-hint {
    color: #999
  }

  .tt-dropdown-menu {
    width: 422px;
    margin-top: 12px;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
  }

  .tt-suggestion {
    padding: 3px 20px;
    font-size: 18px;
    line-height: 24px;
  }

  .tt-suggestion.tt-is-under-cursor {
    color: #fff;
    background-color: #0097cf;

  }
</style>
<script>
  $(document).ready(function(){
    $("#search").typeahead({
      name : 'search',
      remote: {
        url : 'helpdiag.php?query=%QUERY'
      }

    });
  });
</script>



<!-- Modal  DIag Note-->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><font color="green">การระบุรหัสโรคที่ต้องการ</font></h4>
      </div>
      <div class="modal-body">
        <p><B>ตัวอย่าง กรณีต้องการหลายโรคให้ใส่เครื่องหมาย , ระหว่าง Code ที่ต้องการ<input type="text" value=" J45.0,E11,I10.9,E11.9 " readonly></p>
          <p>  หรือ ต้องการแค่โรคเดียว ให้ระบุ Code ที่ต้องการ <input type="text" value=" Z80.0" readonly></B></p>
          <P> </P>
          <center><p><B> ตรวจสอบข้อมูล รหัสโรค </B></p></center>
          <center>
            <input type="text" name="search" id="search">
          </center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

