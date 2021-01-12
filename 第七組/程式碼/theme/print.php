<?php
$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
			or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			#$link=new mysqli("localhost","s10359017","k222898622","database2016")
			#		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			mysqli_query($link,"SET NAMES 'big5'");
			mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
			mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
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

    <title>列印申請單</title>

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
    <SCRIPT LANGUAGE="JavaScript">

	<!-- This script and many more are available free online at -->
	<!-- The JavaScript Source!! http://javascript.internet.com -->

	<!-- Begin
	function varitext(text){
		text=document
		print(text)
	}
	//  End -->
	</script>
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
            <li class="active"><a href="user.php">Home</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


	<div id="workwrap">
	    <div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<span style="font-family:Microsoft JhengHei;color:#FFFFFF;">
					<h1>列印申請單</h1>
					</span>
				</div>
			</div><! --/row -->
	    </div> <!-- /container -->
	</div><! --/workwrap -->
	
	<section id="works"></section>
	<div class="container">
		<div class="row centered mt mb">
			<div class="col-lg-8 col-lg-offset-2">
				<span style="font-family:Microsoft JhengHei;color:#000000;">
				<?php
					$ID=$_GET["AID"];
					$result=mysqli_query($link,"SELECT * FROM `APPLY` WHERE a_id='$ID';");
					$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				$row=mysqli_fetch_assoc($result);
    				echo "<h1>申請單</h1>";
    				echo "<table align='center' style='border:3px #00DD00 dashed;font-size:30px;' cellpadding='10' border='1'>";
    				echo "<tr><td >申請人</td><td>".$row['a_name']."</td><td>連絡電話</td><td>".$row['a_phone']."</td></tr>";
					echo "<tr><td>指導老師</td><td >".$row['a_teacher']."</td><td>申請單位</td><td>".$row['a_organization']."</td></tr>";
					echo "<tr><td>預借開始</td><td>".$row['a_start']."</td><td>預借結束</td><td>".$row['a_end']."</tr>";
					echo "<tr><td>申請日期</td><td>".$row['a_date']."</td><td>用途</td><td colspan='3'>".$row['a_purpose']."</td></tr>";
					echo "<tr><td >備註</td><td >".$row['a_remark']."</td><td >老師簽名</td><td></td></tr></table>";
					echo "<br><h1>申請物品</h1>";
					echo "<table align='center' style='border:3px #00DD00 dashed;font-size:30px;' cellpadding='10' border='1'>";
    				echo "<tr><td>申請單編號</td><td>租借品</td><td>數量</td></tr>";				
					$result2=mysqli_query($link,"SELECT ITEM.i_name AS name,APPLY_LIST.al_amount AS total FROM `APPLY_LIST`,`ITEM`,`APPLY` WHERE APPLY_LIST.al_a_id=APPLY.a_id AND APPLY_LIST.al_i_id=ITEM.i_id AND APPLY.a_id='$ID';");
					$field2=mysqli_num_fields($result2);
    				$record2=mysqli_num_rows($result2);
    				for($k=0;$k<$record2;$k++){
    					$row2=mysqli_fetch_assoc($result2);
    					echo "<tr><td>".$ID."</td><td>".$row2['name']."</td><td>".$row2['total']."</td></tr>";
    				}
					echo "</table>";
				?>
				</span><br>
				<DIV ALIGN="CENTER">
	<FORM>
	<INPUT NAME="print" TYPE="button" VALUE="列印此頁" 	ONCLICK="varitext()">
	</FORM>
	</DIV>
			</div>
			

		</div><! --/row -->
	</div><! --/container -->
	
	


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
