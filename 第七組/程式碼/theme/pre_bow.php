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

    <title>預借量查詢</title>

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
				<h2>預借量查詢</h2>
				<form method="post" action="pre_bow.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>開始日期</td><td><input type="date" name="Pdata_start"></td></tr>
				<tr><td>結束日期</td><td><input type="date" name="Pdata_end"></td></tr>
				<tr><td colspan="2"><input type="submit" class="btn btn-primary" name="P_use_search" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></td></tr><br>
				</table>
				</form>
				<?php
					if(isset($_POST["P_use_search"])){
					$start=$_POST["Pdata_start"];
					$end=$_POST["Pdata_end"];
					$result=mysqli_query($link,"SELECT ITEM.i_name AS name,sum(APPLY_LIST.al_amount) AS total FROM `APPLY_LIST`,`ITEM`,`APPLY` WHERE al_a_id IN (SELECT a_id FROM `APPLY` WHERE APPLY.a_date>='$start' AND APPLY.a_date<='$end') AND APPLY_LIST.al_i_id=ITEM.i_id AND APPLY.a_id=APPLY_LIST.al_a_id GROUP BY al_i_id ");
    				$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				if($record==0){
    					echo"此期間沒有租借紀錄!";
    				}else{
    					echo "<span style='font-family:Microsoft JhengHei;color:#000000;'><h2 align='center'>查詢結果</h2>";
    					echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
    					echo "<tr><td>租借項目</td><td>數量</td></tr>";
    					for($i=0;$i<$record;$i++){
        					$row=mysqli_fetch_assoc($result);
        					echo "<tr><td>".$row['name']."</td><td>".$row['total']."</td></tr>";
        				}
        				echo "</table></span><br>";
    				}
    				
					}
				?><hr>
				<a href="nonCheck.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">未審核資料</button></a>
				<a href="DB.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">首頁</button></a>
			</span>
			</div>

		</div><! --/row -->
	</div><! --/container -->
	

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
