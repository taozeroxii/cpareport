$(document).ready(function() {
    $("#submitadd").click(function() {
        var hn = $("#hn").val();
        var pname = $("#pname").val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var cid = $("#cid").val();
        var pttype = $("#pttype").val();
        var phone = $("#phone").val();
        var adddess = $("#adddess").val();
        var moo = $("#moo").val();
        var district = $("#district").val();
        var amphoe = $("#amphoe").val();
        var province = $("#province").val();
        var zipcode = $("#zipcode").val();
        var birthday = $("#birthday").val();
        var full_name = $("#full_name").val();

        var dataString = 'hn=' + hn + '&pname=' + pname + '&fname=' + fname + '&lname=' + lname + '&cid=' + cid + '&pttypee=' + pttype + '&phone=' + phone + '&adddess=' + adddess + '&moo=' + moo + '&district=' + district + '&amphoe=' + amphoe + '&province=' + province + '&zipcode=' + zipcode + '&birthday=' + birthday + '&full_name=' + full_name;
        /*
                if (name == '' || cid == '') {

                    alert("Please Fill All Fields");
                } else { */
        $.ajax({
            type: "POST",
            url: "ajax_hn.php",
            data: dataString,
            cache: false,
            success: function(result) {
                //  console.log(data)
                alert(result);
            }
        });
        //   }
        return false;
    });
});