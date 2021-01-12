<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>申請單查閱</title>

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
          <a class="navbar-brand" href="user.php">INSTANT</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="user.php">Home</a></li>
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
	
	<div class="container" >
		<div class="row centered mt mb">
			<div class="col-lg-8 col-lg-offset-2">
				<span style="font-family:Microsoft JhengHei;color:#000000;">
				<h1>請輸入基本資料</h1><br>
				<form method="post" action="applyLogin.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:25px;'  border='1'>
				<tr><td>姓名</td><td colspan="2"><input size="10" type="text" class="form-control" style="font-size:0.7cm;font-family:Microsoft JhengHei;" name="UserName" maxlength="20" required="required"/></td></tr>
				<tr><td>手機</td><td colspan="10"><input size="10" type="text" class="form-control" style="font-size:0.7cm;font-family:Microsoft JhengHei;" name="cellphone" maxlength="10" required="required"/></td></tr>
				<tr><td colspan="2"><input type="submit" class="btn btn-primary" name="send" style="font-family:Microsoft JhengHei;font-size:0.5cm;" value="查詢"/></td></tr>
				</table>
				</form>
				<br>
			</span>
			</div>
			
		</div><! --/row -->
	</div><! --/container -->
	<?php
		if(isset($_POST["send"])){
			$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
					or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			#$link=new mysqli("localhost","s10359017","k222898622","database2016")
			#		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			mysqli_query($link,"SET NAMES 'big5'");
			mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
			mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");

			$name=$_POST["UserName"];
			$phone=$_POST["cellphone"];
			$result=mysqli_query($link,"SELECT * FROM `APPLY` WHERE a_name='$name' AND a_phone='$phone';");
			$field=mysqli_num_fields($result);
    		$record=mysqli_num_rows($result);
    		if($record==0){
    			echo"<span style='font-family:Microsoft JhengHei;color:#000000;'><center><h3>此期間沒有租借紀錄!</h3></center></span>";
    		}else{
    			echo "<span style='font-family:Microsoft JhengHei;color:#000000;'><h2 align='center'><hr>查詢結果</h2>
    			<h3 align='center'>申請單</h3>";
    			echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    			echo "<tr><td>編號</td><td>申請人</td><td>申請單位</td><td>電話</td><td>指導老師</td><td>申請日</td><td>申請開始</td><td>申請結束</td><td>目的</td><td>狀態</td><td>備註</td><td>租借單</td><td>列印</td></tr>";
    			for($i=0;$i<$record;$i++){
    				$row=mysqli_fetch_assoc($result);
    				$ID[]=$row['a_id'];
    				$status[]=$row['a_status'];
    				$name=$row['a_name'];
    				$pos=$row['a_organization'];
    				$phone=$row['a_phone'];
    				$teacher=$row['a_teacher'];
    				$date=$row['a_date'];
    				$start=$row['a_start'];
    				$end=$row['a_end'];
    				$purpose=$row['a_purpose'];
    				$remark=$row['a_remark'];

        			echo "<tr><td>".$row['a_id']."</td><td>".$name."</td><td>".$pos."</td><td>".$phone."</td><td>".$teacher
        			."</td><td>".$date."</td><td>".$start."</td><td>".$end."</td><td>".$purpose."</td><td>".$row['a_status']."</td><td>".$remark."</td>";
        			if($status[$i]=="批准成功"){
        				echo"<td><a href='doBow.php?AID=".$ID[$i]."'>填寫</a></td>";
        			}else{
        				echo"<td>X</td>";
        			}
        			echo "<td><a href='print.php?AID=".$ID[$i]."&name=".$name."&pos=".$pos."&phone=".$phone."&teacher=".$teacher."&date=".$date."&start=".$start."&end=".$end."&purpose=".$purpose."&remark=".$remark."'>列印</a></td></tr>";
				}
				echo "</table><br>";
				echo "<h3 align='center'>申請租借物</h3>";
        		echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    			echo "<tr><td>申請單編號</td><td>租借品</td><td>數量</td></tr>";
				for($j=0;$j<count($ID);$j++){
    				$result2=mysqli_query($link,"SELECT ITEM.i_name AS name,APPLY_LIST.al_amount AS total FROM `APPLY_LIST`,`ITEM`,`APPLY` WHERE APPLY_LIST.al_a_id=APPLY.a_id AND APPLY_LIST.al_i_id=ITEM.i_id AND APPLY.a_id='$ID[$j]';");
					$field2=mysqli_num_fields($result2);
    				$record2=mysqli_num_rows($result2);
    				for($k=0;$k<$record2;$k++){
    					$row2=mysqli_fetch_assoc($result2);
    					echo "<tr><td>".$ID[$j]."</td><td>".$row2['name']."</td><td>".$row2['total']."</td></tr>";
    				}
    				
				}
				echo "</table>";
			}
			echo"<h3 align='center'>租借單</h3>";
			echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    		echo "<tr><td>租借單編號</td><td>租借人</td><td>租借日</td><td>實還日期</td><td>預還日期</td><td>備註</td></tr>";
			for($i=0;$i<count($ID);$i++){
				if($status[$i]!="尚未批准" && $status[$i]!="批准失敗" && $status[$i]!="批准成功"){
					$ID2[]=$ID[$i];
					
        			$result=mysqli_query($link,"SELECT * FROM `BORROW` WHERE b_a_id='$ID[$i]';");
					$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				
    				for($j=0;$j<$record;$j++){
    						$row=mysqli_fetch_assoc($result);
        					echo "<tr><td>".$row['b_a_id']."</td><td>".$row['b_name']."</td><td>".$row['b_date']."</td><td>".$row['b_return_date']."</td><td>".$row['b_predict_return']."</td><td>".$row['b_remark']."</td></tr>";
        			}
				}
			}
			echo "</table>";
			echo "<h3 align='center'>租借單租借物</h3>";
        	echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    		echo "<tr><td>租借單編號</td><td>租借品</td><td>數量</td><td>為歸還量</td></tr>";
			for($i=0;$i<count($ID2);$i++){
    			$result=mysqli_query($link,"SELECT ITEM.i_name AS name,BORROW_LIST.bl_amount AS total ,BORROW_LIST.bl_not_return AS non FROM `BORROW_LIST`,`ITEM`,`BORROW` WHERE BORROW_LIST.bl_b_id=BORROW.b_a_id AND BORROW_LIST.bl_i_id=ITEM.i_id AND BORROW.b_a_id='$ID2[$i]';");
				$field=mysqli_num_fields($result);
    			$record=mysqli_num_rows($result);
    			for($k=0;$k<$record;$k++){
    				$row=mysqli_fetch_assoc($result);
    				echo "<tr><td>".$ID2[$i]."</td><td>".$row['name']."</td><td>".$row['total']."</td><td>".$row['non']."</td></tr>";
    			}
			}
			echo "</table>";
			echo "</span>";
		}
	?>
	<hr><center><span style='font-family:Microsoft JhengHei;color:#000000;'>
		<a href="index.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">首頁</button></a></span></center>
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
