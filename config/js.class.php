 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
 <script src="plugins/daterangepicker/daterangepicker.js"></script>
 <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
 <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
 <script src="bower_components/fastclick/lib/fastclick.js"></script>
 <script src="plugins/select2/select2.js"></script>
 <script src="dist/js/adminlte.min.js"></script>
 <script src="dist/js/demo.js"></script>
 <script type="text/javascript" src="js/loader.js"></script>

 <script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(pie_chart);
  google.charts.setOnLoadCallback(sex);
  google.charts.setOnLoadCallback(ptt);
  google.charts.setOnLoadCallback(cmi);
  google.charts.setOnLoadCallback(top10death);
  google.charts.setOnLoadCallback(top10ipd);
  google.charts.setOnLoadCallback(top10opd);
  google.charts.setOnLoadCallback(bar_chart);
  google.charts.setOnLoadCallback(line_chart);
  google.charts.setOnLoadCallback(chart_age);

  function chart_age() { 
  var jsonData = $.ajax({
    url: 'charts/chart_age.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.PieChart(document.getElementById('chart_age'));
      chart.draw(data);

    } 
  }).responseText;
}

  function pie_chart() {
    var jsonData = $.ajax({
      url: "pie_chart.php",
      dataType: "json",
      async: false
    }).responseText;
    var data  = new google.visualization.DataTable(jsonData);
    var chart = new google.visualization.PieChart(document.getElementById('piechart_div'));
    chart.draw(data, {width: 400, height: 240});
  }
////////////////////////////////////////////////////////////////////////////////////////////
function cmi() { 
  var jsonData = $.ajax({
    url: 'charts/c_cmi.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.ColumnChart(document.getElementById('cmi'));
      chart.draw(data);

    } 
  }).responseText;
}

function sex() { 
  var jsonData = $.ajax({
    url: 'charts/chart_sex.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.PieChart(document.getElementById('sex'));
      chart.draw(data);

    } 
  }).responseText;
}


function ptt() { 
  var jsonData = $.ajax({
    url: 'charts/chart_pttype.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.PieChart(document.getElementById('ptt'));
      chart.draw(data);

    } 
  }).responseText;
}

function top10death() { 
  var jsonData = $.ajax({
    url: 'charts/chart_top10death.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.ColumnChart(document.getElementById('top10death'));
      chart.draw(data);

    } 
  }).responseText;
}

function top10ipd() { 
  var jsonData = $.ajax({
    url: 'charts/chart_top10ipd.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.ColumnChart(document.getElementById('top10ipd'));
      chart.draw(data);

    } 
  }).responseText;
}

function top10opd() { 
  var jsonData = $.ajax({
    url: 'charts/chart_top10opd.php',
    dataType:"json",
    async: false,
    success: function(jsonData)
    {
      var data  = new google.visualization.arrayToDataTable(jsonData);  
      var chart = new google.visualization.ColumnChart(document.getElementById('top10opd'));
      chart.draw(data);

    } 
  }).responseText;
}




</script>






<script type="text/javascript">                
	function load_department(){
    $.ajax({
    	url: "config/department.class.php",
    	method: 'GET',
    	data: {'selector':'load_department'},
      success: function(result){
      	var htmlOption = "";
        var option = [];                                         
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          var o = {id:item.depcode,text:item.department};   
          option.push(o);                                     
          htmlOption += "<option value='"+ item.depcode +"'>"+ item.department + "</option>";
        });
        $('#c_department').html(htmlOption);            
      }});
  }
  load_department();
  function load_ward(){
    $.ajax({
      url: "config/ward.class.php",
      method: 'GET',
      data: {'selector':'load_ward'},
      success: function(result){
        var htmlOption = "";
        var option = [];                                         
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          var o = {id:item.ward,text:item.name};   
          option.push(o);                                     
          htmlOption += "<option value='"+ item.ward +"'>"+ item.name + "</option>";
        });
        $('#c_ward').html(htmlOption);            
      }});
  }
  load_ward();

  function load_doctor(){
    $.ajax({
      url: "config/doctor.class.php",
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

  function loadct(){
    $.ajax({
      url: "config/pttype.class.php",
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

  function load_d(){
    $.ajax({
      url: "config/diag.class.php",
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
  load_d();	

  function load_pct(){
    $.ajax({
      url: "config/spclty.class.php",
      method: 'GET',
      data: {'selector':'pct'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.spclty +"'>"+ item.spclty + " "+ item.name + "</option>";
        });
        $('#pct_dropdown').html(htmlOption);

      }});
  }
  load_pct();

  function load_cli(){
    $.ajax({
      url: "config/clinic.class.php",
      method: 'GET',
      data: {'selector':'cli'},
      success: function(result){
        var htmlOption = "";
        data = JSON.parse(result);
        $.each(data, function(i, item) {
          htmlOption += "<option value='"+ item.clinic +"'>"+ item.clinic + " "+ item.name + "</option>";
        });
        $('#cli_dropdown').html(htmlOption);

      }});
  }
  load_cli();

</script>


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Template <sup class="sutt"></sup></h4>
      </div>
      <div class="modal-body">
        <p> </p>
        <p> </p>
        <hr>
        <div class="form-group">
          <textarea class="form-control" rows="20" id="sql_code" readonly><?php echo $sql; ?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info" onclick="Fcopy_code()">COPY SQL</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">EXIT</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModalpdf_dn0101" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="graph-outline">
        <object style="width:100%; height:800px;" data="image/dn0101.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf">
          <embed src="image/dn0101.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf" />
        </object>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalpdf_dn0107" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="graph-outline">
        <object style="width:100%; height:800px;" data="image/dn0107.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf">
          <embed src="image/dn0107.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf" />
        </object>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalpdf_dc0107" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="graph-outline">
        <object style="width:100%; height:800px;" data="image/dc0107.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf">
          <embed src="image/dc0107.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf" />
        </object>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalpdf_dr0101" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="graph-outline">
        <object style="width:100%; height:800px;" data="image/dr0101.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf">
          <embed src="image/dr0101.pdf?#zoom=85&scrollbar=0&toolbar=0&navpanes=0" type="application/pdf" />
        </object>
      </div>
    </div>
  </div>
</div>

<script>
  function Fcopy_code() {
    var copysql = document.getElementById("sql_code");
    copysql.select();
    document.execCommand("copy");
    alert("Copied the text: " + copysql.value);
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2();
  });    
  $('#datepickers').datepicker({
    autoclose: true
  });
  $('#datepickert').datepicker({
    autoclose: true
  });   

$('#input_starttime').pickatime({
   autoclose: true
});

</script>
