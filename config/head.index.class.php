<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Report</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="css/estyle.css">
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
      <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.js"></script>
  <script type="text/javascript">
          $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_opd.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_opd").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_ipd.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_ipd").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_app.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_app").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_admit.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_admit").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_dsc.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_dsc").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });
      
           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_referin.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_referin").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_referout.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_referout").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });

           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_bed.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_bed").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });
           $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_death.php", function(data){
                    data = $.parseJSON(data);
                            $("#dhc_death").html("<span class='rt'>" + data + "</span>");
                });
            }, 8000);
        });


        $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_age18.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_age18").html("<span class='rt'>" + data + "</span>");
                });
            }, 1000);
        });

        
        $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_age40.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_age40").html("<span class='rt'>" + data + "</span>");
                });
            }, 1000);
        });

        
        $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_age60.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_age60").html("<span class='rt'>" + data + "</span>");
                });
            }, 1000);
        });

        
        $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_age80.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_age80").html("<span class='rt'>" + data + "</span>");
                });
            }, 1000);
        });

        
        $(document).ready(function(){
            var shownIds = new Array();
            setInterval(function(){
                $.get("sql_rt/realtime_age80up.php", function(data){
                    data = $.parseJSON(data);
                            $("#realtime_age80up").html("<span class='rt'>" + data + "</span>");
                });
            }, 1000);
        });


  </script>

</head>