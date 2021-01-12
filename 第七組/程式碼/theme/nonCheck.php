<?php
$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
    or die("connection fail!<br>").mysql_errno()." ".mysql_error();
            #$link=new mysqli("localhost","s10359017","k222898622","database2016")
             #       or die("connection fail!<br>").mysql_errno()." ".mysql_error();
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

    <title>未審核資料</title>

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
				<h2>未審核資料</h2>
				<?php
    				$result=mysqli_query($link,"SELECT * FROM `APPLY` WHERE a_status='尚未批准'");
    				$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);

    				if($record==0){
    					echo "<h3>沒有未批准的資料!</h3>";
    				}else{
    					echo "<table align='center' style='border:3px #00DD00 dashed;' cellpadding='10' border='1'>";
       					echo"<tr><td>申請單編號</td><td>申請人</td><td>申請單位</td><td>電話</td><td>指導老師</td><td>申請日</td><td>申請開始</td><td>申請結束</td><td>目的</td><td>狀態</td><td>備註</td><td>經手人</td><td>修改</td></tr>";
        				for($i=0;$i<$record;$i++){
        					$row=mysqli_fetch_assoc($result);
        					$ID[]=$row['a_id'];
        					$name[]=$row['a_name'];
        					$organ[]=$row['a_organization'];
        					$phone[]=$row['a_phone'];
        					$teacher[]=$row['a_teacher'];
        					$date[]=$row['a_date'];
        					$start[]=$row['a_start'];
        					$end[]=$row['a_end'];
        					$purpose[]=$row['a_purpose'];
        					$status[]=$row['a_status'];
        					$remark[]=$row['a_remark'];
        					$employee[]=$row['a_employee'];
        				echo"<tr><td>".$ID[$i]."</td><td>".$name[$i]."</td><td>".$organ[$i]."</td><td>".$phone[$i]."</td><td>".$teacher[$i]."</td><td>".$date[$i]."</td><td>".$start[$i]."</td><td>".$end[$i]."</td><td>".$purpose[$i]."</td><td>".$status[$i]."</td><td>".$remark[$i]."</td><td>".$employee[$i]."</td><td><a href='mod_apy2.php?ID=".$ID[$i]."&name=".$name[$i]."&organ=".$organ[$i]."&phone=".$phone[$i]."&teacher=".$teacher[$i]."&date=".$date[$i]."&start=".$start[$i]."&end=".$end[$i]."&purpose=".$purpose[$i]."&status=".$status[$i]."&remark=".$remark[$i]."&employee=".$employee[$i]."'>修改</a></td></tr>";
                        }
                        echo "</table><br>";
    				}
				?>
                <hr>
                <div class="col-lg-6 col-md-6 col-sm-6 gallery" style="text-align:center;"><a href="pre_bow.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">預借量查詢</button></a></div>
                <div class="col-lg-6 col-md-6 col-sm-6 gallery" style="text-align:center;"><a href="DB.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">首頁</button></a></div>
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
