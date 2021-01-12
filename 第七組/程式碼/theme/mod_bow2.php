<?php
$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
	or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			#$link=new mysqli("localhost","s10359017","k222898622","database2016")
			#		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			mysqli_query($link,"SET NAMES 'big5'");
			mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
			mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
			$res=mysqli_query($link,"SELECT e_account FROM `EMPLOYEE`");
            $record=mysqli_num_rows($res);
            session_start();
  			$account=$_SESSION["account"];
  			$check=0;
            for($k=0;$k<$record;$k++){
                $row=mysqli_fetch_assoc($res);
                $mem[]=$row['e_account'];
                if($account==$mem[$k])
                	$check=1;
			}
  		
  		if($check!=1){
  			?>
  			<script>
  				alert("非管理者，禁止進入!");
  			</script>
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

    <title>修改租借單</title>

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
			$ID=$_SESSION["BID"];
			$non=$_POST["non"];
			$name=$_SESSION["Bname"];
			

			$re=mysqli_query($link,"SELECT i_id FROM `ITEM` WHERE i_name='$name';");
    			$field=mysqli_num_fields($re);
    			$record=mysqli_num_rows($re);
    			$row=mysqli_fetch_assoc($re);
    			$IID=$row['i_id'];
    			echo "IID".$IID;
			$result=mysqli_query($link,"UPDATE `BORROW_LIST` SET bl_not_return='$non' WHERE bl_b_id='$ID' AND bl_i_id='$IID';");
			?>
				<script >alert("修改成功!");</script>
			<?php
			header('Refresh:0.1; url=apply.php');
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
				<h2>修改租借單</h2>
				<form method="post" action="mod_bow2.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>租借單編號</td><td>租借品</td><td>數量</td><td>未歸還量</td></tr>
				<?php
					$BID=$_GET["ID"];
					$_SESSION["BID"]=$BID;
					$name=$_GET["name"];
					$_SESSION["Bname"]=$name;
					$total=$_GET["total"];
					$non=$_GET["non"];
					echo "<tr><td>".$BID."</td><td>".$name."</td><td>".$total."</td><td><input type='number' name='non' value='".$non."' min='0' max='99'></td></tr>";
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
