<?php
$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
					or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			#$link=new mysqli("localhost","s10359017","k222898622","database2016")
			#		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			mysqli_query($link,"SET NAMES 'big5'");
			mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
			mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
      session_start();
      $account=$_SESSION["account"];
      if($account!="boss"){
        ?>
        <script>
          alert("非主管理者，禁止進入!");
        </script>
        <?php
        header("Refresh:0.1;url=DB.php");
      }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>員工資料</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">INSTANT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


	<div id="aboutwrap">
	    <div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
				</div>
			</div><! --/row -->
	    </div> <!-- /container -->
	</div><! --/aboutwrap -->
	
	<div class="container">
		<div class="row centered mt mb">
			<div class="col-lg-8 col-lg-offset-2">
			<span style="font-family:Microsoft JhengHei;color:#000000;">
				<h2>員工資料</h2>
				<form method="get">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>帳號</td><td>密碼</td><td>姓名</td><td>職位</td><td>修改</td></tr>
				<?php
    				$result=mysqli_query($link,"SELECT * FROM `EMPLOYEE`");
    				$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				for($i=0;$i<$record;$i++){
    					$row=mysqli_fetch_assoc($result);
    					$v[0]=$row['e_account'];
    					$_SESSION["ACCOUNT1"]=$v[0];
    					$v[1]=$row['e_password'];
    					$v[2]=$row['e_name'];
    					$v[3]=$row['e_job'];
    					echo "<tr><td>".$row['e_account']."</td><td>".$row['e_password']."</td><td>".$row['e_name']."</td><td>".$row['e_job']."</td><td><a href='mod_mem.php?account=".$v[0]."&password=".$v[1]."&name=".$v[2]."&job=".$v[3]."'>修改</a></td><tr>";
    				}
    				
				?>
				</table><br>
				</form>
				<br>
				
			</span>
			</div>

		</div><! --/row -->
	</div><! --/container -->
	<hr><center><span style='font-family:Microsoft JhengHei;color:#000000;'>
		<a href="member.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">員工管理</button></a>
		<a href="DB.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">首頁</button></a></span></center>
	<div id="social">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-dribbble"></i></a>
				</div>
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-facebook"></i></a>
				</div>
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-twitter"></i></a>
				</div>
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-linkedin"></i></a>
				</div>
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-instagram"></i></a>
				</div>
				<div class="col-lg-2">
					<a href="#"><i class="fa fa-tumblr"></i></a>
				</div>
			
			</div><! --/row -->
		</div><! --/container -->
	</div><! --/social -->

	<div id="footerwrap">
		<div class="container">
			<div class="row centered">
				<div class="col-lg-4">
					<p><b>WEB DESIGNER, DEVELOPER & GAME ADDICT</b></p>
				</div>
			
				<div class="col-lg-4">
					<p>Living in the amazing London.</p>
				</div>
				<div class="col-lg-4">
					<p>hello@instant.com</p>
				</div>
			
			</div>
		
		</div>
	</div><! --/footerwrap -->
	


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
