$(document).ready(function(){
    $("#submit").click(function(){
    var firstname  = $("#firstname").val();
    var lastname   = $("#lastname").val();
    var email      = $("#email").val();
    var department = $("#department").val();
    var telephone  = $("#telephone").val();
    var jobtitle   = $("#jobtitle").val();

    var dataString = 'firstname='+ firstname + '&lastname='+ lastname + '&email='+ email + '&department='+ department+ '&telephone='+ telephone+ '&jobtitle='+ jobtitle;
    if(firstname==''||lastname==''||email==''||department==''||telephone==''||jobtitle=='')
    {
    alert("กรุณาตรวจสอบข้อมูลที่ท่านกรอกให้ถูกต้อง");
    }
    else
    {

    $.ajax({
    type: "POST",
    url: "ajaxsubmit.php",
    data: dataString,
    cache: false,
    success: function(result){
    alert(result);
    }
    });
    }
    return false;
    });
    });