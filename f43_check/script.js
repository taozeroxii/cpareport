function fill(Value) {
   $('#search').val(Value);
   $('#display').hide();
}
$(document).ready(function() {
   $("#search").keyup(function() {
       var id_code = $('#search').val();
       if (id_code == "") {
           $("#display").html("");
       }
       else {
           $.ajax({
               type: "POST",
               url: "ajax.php",
               data: {
                   search: id_code
               },
               success: function(html) {
                   $("#display").html(html).show();
               }
           });
       }
   });
});