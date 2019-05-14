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
</script>

