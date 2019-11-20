<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <title>Tab Styles Inspiration</title>
  <meta name="description" content="Tab Styles Inspiration: A small collection of styles for tabs" />
  <meta name="keywords" content="tabs, inspiration, web design, css, modern, effects, svg" />
  <meta name="author" content="Codrops" />
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="stylesheet" type="text/css" href="css/normalize.css" />
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/tabs.css" />
  <link rel="stylesheet" type="text/css" href="css/tabstyles.css" />
  <script src="js/modernizr.custom.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 

</head>
<body>
<!-- 		<svg class="hidden">
			<defs>
				<path id="tabshape" d="M80,60C34,53.5,64.417,0,0,0v60H80z"/>
			</defs>
		</svg> -->
		<div class="container">
			<!-- Top Navigation -->
<!-- 			<div class="codrops-top clearfix">
				<a class="codrops-icon codrops-icon-prev" href="http://tympanus.net/Tutorials/PagePreloadingEffect/"><span>Previous Demo</span></a>
				<span class="right"><a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=19559"><span>Back to the Codrops Article</span></a></span>
			</div> -->
	<!-- 		<header class="codrops-header">
				<h1>Tab Styles Inspiration <span>A small collection of styles for tabs</span></h1>
				<p class="support">Your browser does not support <strong>flexbox</strong>! <br />Please view this demo with a <strong>modern browser</strong>.</p>
			</header> -->
			<section>
				<div class="tabs tabs-style-bar">
					<nav>
						<ul>
							<li><a href="#section-bar-1" class="icon icon-tools"><span> ขอเพิ่มชื่อเข้าใช้งานในระบบ HosXp </span></a></li>
							<li><a href="#section-bar-2" class="icon icon-tools"><span> ขอเพิ่มหัตถการใช้งานในระบบ HosXp </span></a></li>
<!-- 							<li><a href="#section-bar-3" class="icon icon-tools"><span>Analytics</span></a></li>
							<li><a href="#section-bar-4" class="icon icon-tools"><span>Upload</span></a></li>
							<li><a href="#section-bar-5" class="icon icon-tools"><span>Settings</span></a></li> -->
						</ul>
					</nav>
					<div class="content-wrap">

						<section id="section-bar-1">

              <div class="container"> 
                <form action="" class="form-horizontal"> 
                  <div class="form-group has-success"> 
                    <div class="col-sm-4"> 
                      <input class="form-control" type="text" id="id1" placeholder="ชื่อผู้ใช้งาน"> 
                    </div> 
                  </div> 
                  <div class="form-group has-success"> 
                    <div class="col-sm-4"> 
                      <input class="form-control" type="password" id="id2" placeholder="รหัสผ่าน"> 
                    </div> 
                  </div> 
                  <div class="container"> 
                    <button type="button" class="btn btn-success">เพิ่มรายการผู้ใช้งาน</button> 
                  </div> 
                </form> 
              </div> 


            </section>




            <section id="section-bar-2">
              <div class="container"> 
                <form action="" class="form-horizontal"> 
                  <div class="form-group has-success"> 
                    <div class="col-sm-4"> 
                      <input class="form-control" type="text" id="id1" placeholder="หัตถการภาษาไทย"> 
                    </div> 
                  </div> 
                  <div class="form-group has-success"> 
                    <div class="col-sm-4"> 
                      <input class="form-control" type="password" id="id2" placeholder="หัตถการอังกฤษ"> 
                    </div> 
                  </div> 
                  <div class="container"> 
                    <button type="button" class="btn btn-success">เพิ่มรายการหัตถการ</button> 
                  </div> 
                </form> 
              </div> 

            </section>























<!-- 						<section id="section-bar-3"><p>3</p></section>
						<section id="section-bar-4"><p>4</p></section>
						<section id="section-bar-5"><p>5</p></section> -->
					</div>
				</div>
			</section>
			
		</div>
		<script src="js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
	</body>
  </html>