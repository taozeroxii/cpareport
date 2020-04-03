<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var shownIds = new Array();
            setInterval(function() {
                $.get("data_j.php", function(data) {
                    data = $.parseJSON(data);
                    $("#realtime_visitperday").html("" + data + "");
                });
            }, 1000);
        });

    </script>

</head>
  <body class="">
    <div class="content-wrapper">
      <section class="content">
              <div class="row">
                <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title "> ข้อมูลจำนวนผู้รับบริการปัจจุบัน - ย้อนหลัง</h3>
                       </div>
                    <center>
                      <div id="realtime_visitperday" >
                        <div class="spinner-grow text-secondary" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                      </div>
                    </center>
                  </tr>
                </div>
              </div>
    </section>
  </div>
</body>
</html>