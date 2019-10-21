<!DOCTYPE HTML5>
<html lang="en">
<head>
    <title>เพิ่มผู้ใช้งาน</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Account Register Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
    function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- css files -->
    <link rel="stylesheet" href="css/cssregisterform.css" type="text/css" media="all" /> <!-- Style-CSS --> 
    <link href="//fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,devanagari,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- //css files -->
    <?php 
        include('../config/my_con.class.php');
        include "../config/pg_con.class.php";
    ?>
</head>


<body style="background-color:rgb(146, 235, 149)">
<!-- main -->
<?
    if (isset($_POST['submit'])) {
        echo 'fname :'.$_POST['fname'] . '<br> ';
        echo 'lname :'.$_POST['lanem'] . '<br> ';
        echo 'user :'.$_POST['username'] . '<br> ';
        echo 'password :'.$_POST['password'] . '<br> ';
        echo 'status :'.$_POST['statud'] . '<br> ';
        echo 'spclty :'.$_POST['spclty'] . '<br> ';
    }
?>





<div class="w3ls-header">
   <br> <br><br> <br>
	<div class="header-main">
    <h2>ADD USERS</h2>
			<div class="header-bottom">
				<div class="header-right w3agile">
					<div class="header-left-bottom agileinfo">
						<form action="#" method="post">
                        <div class="icon1">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <div class="row">
                                    <div class="col-6">   <input class="form-control"  type="text" placeholder="ชื่อ" name="fname" required=""/></div>
                                    <div class="col-6">   <input class="form-control" type="text" placeholder="นามสกุล" name="lname" /></div>
                                </div>
                            </div>
                            
							<div class="icon1">
								<i class="fa fa-user" aria-hidden="true"></i>
								<input  type="text" placeholder="Username" name="username" required=""/>
                            </div>
                            <div class="icon1">
								<i class="fa fa-user" aria-hidden="true"></i>
								<input  type="text" placeholder="password" name="password" required=""/>
                            </div>
                            <select class="custom-select"  required="">
                                <option selected>แผนก ...</option>
                                <option value="1">Admin</option>
                            </select>
                            <hr>

                            <select class="custom-select"  required="">
                                <option selected>การเข้าถึง ...</option>
                                <option value="1">Admin</option>
                                <option value="2">super user</option>
                                <option value="3">users</option>
                            </select>
                            <hr>
							<div class="bottom">
								<input type="submit" name = ''submit value="Create account" />
                            </div>
								<p>มีบัญชีอยู่แล้ว<a href="../login.php">LOGIN</a></p>
							</div>
					</form>	
					</div>
				</div>
			</div>
	</div>
</div>
<!--header end here-->
</body>
</html>