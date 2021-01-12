<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>使用量查詢</title>

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
				<h2>使用量查詢</h2>
				<form method="post" action="useRate.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>場地名稱</td>
				<td><select name="item"><?php
					#$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
        			#	or die("connection fail!<br>").mysql_errno()." ".mysql_error();
					$link=new mysqli("localhost","s10359017","k222898622","database2016")
        				or die("connection fail!<br>").mysql_errno()." ".mysql_error();
    				mysqli_query($link,"SET NAMES 'big5'");
    				mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
    				mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
    				$result=mysqli_query($link,"SELECT i_name FROM `ITEM` where i_type='場地';");
    				$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				for($i=0;$i<$record;$i++){
        				$row=mysqli_fetch_assoc($result);
        				echo "<option value='".$row['i_name']."'>".$row['i_name']."</option>";
        			}
				?></select></td></tr>
				<tr><td>開始日期</td><td><input type="date" name="Pdata_start"></td></tr>
				<tr><td>結束日期</td><td><input type="date" name="Pdata_end"></td></tr>
				<tr><td colspan="2"><input type="submit" class="btn btn-primary" name="P_use_search" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></td></tr><br>
				</table><br><br>
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>物品名稱(下拉式選單要從資料庫拉名稱)</td>
				<td><select name="item">
					<option value="camera">相機</option>
					<option value="sound">音響</option>
				</select></td></tr>
				<tr><td>廠牌型號(下拉式選單要從資料庫拉名稱)</td>
				<td><select name="item">
					<option value="v1">nicon</option>
					<option value="v2">sony</option>
				</select></td></tr>
				<tr><td>開始日期</td><td><input type="date" name="Idata_start"></td>
				<tr><td>結束日期</td><td><input type="date" name="Idata_end"></td>
				<tr><td colspan="2"><input type="submit" class="btn btn-primary" name="DATAsearch" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></td></tr>
				</table>
				</form>
			</span>
			</div>

		</div><! --/row -->
	</div><! --/container -->
	<?php
		if(isset($_POST["P_use_search"])){
			$start=$_POST["Pdata_start"];
			$end=$_POST["Pdata_end"];
			$result=mysqli_query($link,"SELECT bl_i_id,sum(bl_amount) AS total FROM `borrow_list`
WHERE bl_b_id IN (SELECT bl_b_id FROM `borrow` WHERE borrow.b_date>'$start' AND borrow.b_date<'$end')
GROUP BY bl_i_id;");
    				$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				if($record==0){
    					echo"此期間沒有租借紀錄!";
    				}else{
    					echo "<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    					echo "<tr><td></td></tr>"
    				}
    				for($i=0;$i<$record;$i++){
        				$row=mysqli_fetch_assoc($result);
        				echo "<option value='".$row['i_name']."'>".$row['i_name']."</option>";
        			}
		}
	?>
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
