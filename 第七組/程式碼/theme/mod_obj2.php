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
if($account==""){
	?>
<script >alert("非管理者，禁止進入!");</script>
	<?php
	header("Refresh:0.1;url=index.php");
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

    <title>修改器材資料</title>

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
 <?php
		if(isset($_POST["send"])){
			$ID=$_SESSION["ID"];
			$name=$_POST["name"];
			$total=$_POST["total"];
			$res=$_POST["res"];
			$others=$_POST["others"];
			$remark=$_POST["remark"];
			$brand=$_POST["brand"];

			$result=mysqli_query($link,"UPDATE `ITEM` SET `i_name`='$name',`i_brand`='$brand',`i_total`='$total',`i_reserve`='$res',`i_others`='$others',`i_remark`='$remark' WHERE i_id='$ID'");
			header('Refresh:0.1; url=modify_obj.php');
		}
?>
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
          <a class="navbar-brand" href="DB.php">INSTANT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="DB.php">Home</a></li>
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
				<h2>修改器材資料</h2>
				<form method="post" action="mod_obj2.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>名稱</td><td>廠牌型號</td><td>總量</td><td>保留量</td><td>其他量</td><td>備註</td></tr>
				<?php
					$ID=$_GET["ID"];
					$_SESSION["ID"]=$ID;
					$name=$_GET["name"];
					$total=$_GET["total"];
					$res=$_GET["res"];
					$others=$_GET["others"];
					$remark=$_GET["remark"];
					$brand=$_GET["brand"];
					echo "<tr><td><input type='text' class='form-control' style='font-size:20px;width:100px;height:20px;font-family:Microsoft JhengHei;' name='name' maxlength='30' value='$name'/></td><td><input type='text' class='form-control' style='font-size:20px;width:100px;height:20px;font-family:Microsoft JhengHei;' name='brand' maxlength='21' value='$brand'/></td><td><input type='number'class='form-control' style='font-size:0.1cm;width:100px;height:20px;font-family:Microsoft JhengHei;' name='total'  min='1' max='99' required='required' value='$total'/></td><td><input type='number'class='form-control' style='font-size:0.1cm;width:100px;height:20px;font-family:Microsoft JhengHei;' name='res'  min='0' max='99' required='required' value='$res'/></td><td><input type='number'class='form-control' style='font-size:0.1cm;width:100px;height:20px;font-family:Microsoft JhengHei;' name='others'  min='0' max='99' required='required' value='$others'/></td><td><textarea name='remark' rows='1' cols='5'>$remark</textarea></td></tr>";
				?>
				</table><br>
				<input type="submit" class="btn btn-primary" name="send" style="font-family:Microsoft JhengHei;width:60px;height:30px;font-size:0.4cm;" value="修改"/>
				<br>
			</form>
			</span>
			</div>

		</div><! --/row -->
	</div><! --/container -->
	
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
