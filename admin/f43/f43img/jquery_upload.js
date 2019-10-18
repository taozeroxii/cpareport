$(document).ready(function(){
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	$('#image_upload').on('change',function(){   
		 $('#image_upload_form').ajaxForm({           
			beforeSend: function() {
				$(".progress").show();
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal);
				percent.html(percentVal);
			},
			uploadProgress: function(event, position, total, percentComplete) {		
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				percent.html(percentVal);
			},
			success: function(data, statusText, xhr) {
				var percentVal = '100%';
				bar.width(percentVal);
				percent.html(percentVal);
				status.html(xhr.responseText);
			},
			error: function(xhr, statusText, err) {
				status.html(err || statusText);
			}    
		 }).submit();
	});   
});