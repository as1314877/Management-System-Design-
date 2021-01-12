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

    <title>租借紀錄查詢</title>

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
	
	<div class="container" >
		<div align="center">
				<span style="font-family:Microsoft JhengHei;color:#000000;">
				<h1>申請單查詢</h1><br>
				<form method="post" action="apply.php">
				<span style="font-size:0.7cm;">申請單編號:<input type="number" name="A_ID" min="1">&nbsp;<input type="submit" class="btn btn-primary" name="IDsearch" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></span><br><br><span style="font-size:0.7cm;">
				日期:<input type="date" name="day">~<input type="date" name="day_e"><input type="submit" class="btn btn-primary" name="DATAsearch" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></span>
				<br><br><h1>租借單查詢</h1><br>
				<form method="post" action="apply.php">
				<span style="font-size:0.7cm;">
				租借單編號:<input type="number" name="B_ID" min="1">&nbsp;
				<input type="submit" class="btn btn-primary" name="IDsearch2"  style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></span><br><br>
				<span style="font-size:0.7cm;">
				日期:<input type="date" name="day2">~<input type="date" name="day2_e"><input type="submit" class="btn btn-primary" name="DATAsearch2" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></span>
				</form>
				<br>
			</span>
		</div><! --/row -->
	</div><! --/container -->
<?php
        echo "<span style='font-family:Microsoft JhengHei;color:#000000;'>";
		if(isset($_POST["IDsearch"])){
    		$AID=$_POST["A_ID"];
    		$result=mysqli_query($link,"SELECT * FROM `APPLY` WHERE a_id='$AID'");
    		$field=mysqli_num_fields($result);
    		$record=mysqli_num_rows($result);
    		#echo "D=".$record;
    		if($record==0){
        		echo "<hr><center><h3>沒有找到符合的資料!</h3></center>";
    		}else{
                echo "<hr><center><h3>申請單</h3></center>";
        		echo "<table align='center' style='border:3px #00DD00 dashed;' cellpadding='10' border='1'>";
       			echo"<tr><td>申請單編號</td><td>申請人</td><td>申請單位</td><td>電話</td><td>指導老師</td><td>申請日</td><td>申請開始</td><td>申請結束</td><td>目的</td><td>狀態</td><td>備註</td><td>經手人</td><td>修改</td></tr>";
        for($i=0;$i<$record;$i++){
        	$row=mysqli_fetch_assoc($result);
        	$ID[$i]=$row['a_id'];
        	$name[$i]=$row['a_name'];
        	$organ[$i]=$row['a_organization'];
        	$phone[$i]=$row['a_phone'];
        	$teacher[$i]=$row['a_teacher'];
        	$date[$i]=$row['a_date'];
        	$start[$i]=$row['a_start'];
        	$end[$i]=$row['a_end'];
        	$purpose[$i]=$row['a_purpose'];
        	$status[$i]=$row['a_status'];
        	$remark[$i]=$row['a_remark'];
        	$employee[$i]=$row['a_employee'];
        	echo"<tr><td>".$ID[$i]."</td><td>".$name[$i]."</td><td>".$organ[$i]."</td><td>".$phone[$i]."</td><td>".$teacher[$i]."</td><td>".$date[$i]."</td><td>".$start[$i]."</td><td>".$end[$i]."</td><td>".$purpose[$i]."</td><td>".$status[$i]."</td><td>".$remark[$i]."</td><td>".$employee[$i]."</td><td><a href='mod_apy.php?ID=".$ID[$i]."&name=".$name[$i]."&organ=".$organ[$i]."&phone=".$phone[$i]."&teacher=".$teacher[$i]."&date=".$date[$i]."&start=".$start[$i]."&end=".$end[$i]."&purpose=".$purpose[$i]."&status=".$status[$i]."&remark=".$remark[$i]."&employee=".$employee[$i]."'>修改</a></td></tr>";
        	echo "</table>";
        }
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
        }
        if(isset($_POST["DATAsearch"])){
    		$day=$_POST["day"];
            $day2=$_POST["day_e"];
    		$result=mysqli_query($link,"SELECT * FROM `APPLY` WHERE a_date>='$day' AND a_date<='$day2'");
    		$field=mysqli_num_fields($result);
        	$record=mysqli_num_rows($result);
    		if($record==0){
        		echo "<hr><center><h3>沒有找到符合的資料!</h3></center>";
    		}else{
   			echo "<hr><center><h3>申請單</h3></center>";
        	echo "<table align='center' style='border:3px #00DD00 dashed;' cellpadding='10' border='1'>";
        	echo"<tr><td>申請單編號</td><td>申請人</td><td>申請單位</td><td>電話</td><td>指導老師</td><td>申請日</td><td>申請開始</td><td>申請結束</td><td>目的</td><td>狀態</td><td>備註</td><td>經手人</td><td>修改</td></tr>";
        	for($i=0;$i<$record;$i++){
        		$row=mysqli_fetch_assoc($result);
        		$ID[$i]=$row['a_id'];
        		$name[$i]=$row['a_name'];
        		$organ[$i]=$row['a_organization'];
        		$phone[$i]=$row['a_phone'];
        		$teacher[$i]=$row['a_teacher'];
        		$date[$i]=$row['a_date'];
        		$start[$i]=$row['a_start'];
        		$end[$i]=$row['a_end'];
        		$purpose[$i]=$row['a_purpose'];
        		$status[$i]=$row['a_status'];
        		$remark[$i]=$row['a_remark'];
        		$employee[$i]=$row['a_employee'];
        		echo"<tr><td>".$ID[$i]."</td><td>".$name[$i]."</td><td>".$organ[$i]."</td><td>".$phone[$i]."</td><td>".$teacher[$i]."</td><td>".$date[$i]."</td><td>".$start[$i]."</td><td>".$end[$i]."</td><td>".$purpose[$i]."</td><td>".$status[$i]."</td><td>".$remark[$i]."</td><td>".$employee[$i]."</td><td><a href='mod_apy.php?ID=".$ID[$i]."&name=".$name[$i]."&organ=".$organ[$i]."&phone=".$phone[$i]."&teacher=".$teacher[$i]."&date=".$date[$i]."&start=".$start[$i]."&end=".$end[$i]."&purpose=".$purpose[$i]."&status=".$status[$i]."&remark=".$remark[$i]."&employee=".$employee[$i]."'>修改</a></td></tr>";
        	}
            echo "</table>";
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
		}
		if(isset($_POST["IDsearch2"])){
    		$BID=$_POST["B_ID"];
    		$result=mysqli_query($link,"SELECT * FROM `BORROW` WHERE b_a_id='$BID'");
    		$field=mysqli_num_fields($result);
        	$record=mysqli_num_rows($result);
    		if($record==0){
        		echo "<hr><center><h3>沒有找到符合的資料!</h3></center>";
    		}else{
   			echo "<hr><center><h3>租借單</h3></center>";
        echo "<table align='center' style='border:3px #00DD00 dashed;' cellpadding='10' border='1'>";
        echo"<tr><td>租借單編號</td><td>租借人</td><td>租借日</td><td>實還日期</td><td>預還日期</td><td>備註</td><td>經手人</td><td>修改</td></tr>";
        for($i=0;$i<$record;$i++){
        	$row=mysqli_fetch_assoc($result);
        	$ID[$i]=$row['b_a_id'];
        	$name[$i]=$row['b_name'];
        	$date[$i]=$row['b_date'];
        	$return[$i]=$row['b_return_date'];
        	$PREreturn[$i]=$row['b_predict_return'];
        	$remark[$i]=$row['b_remark'];
        	$employee[$i]=$row['b_employee'];
        	echo"<tr><td>".$ID[$i]."</td><td>".$name[$i]."</td><td>".$date[$i]."</td><td>".$return[$i]."</td><td>".$PREreturn[$i]."</td><td>".$remark[$i]."</td><td>".$employee[$i]."</td><td><a href='mod_bow.php?return=".$return[$i]."&employee=".$employee[$i]."&name=".$name[$i]."&date=".$date[$i]."&return=".$return[$i]."&PREreturn=".$PREreturn[$i]."&remark=".$remark[$i]."&ID=".$ID[$i]."'>修改</a></td></tr>";
        }
        echo "</table>";
            echo "<h3 align='center'>租借單租借物</h3>";
            echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
            echo "<tr><td>租借單編號</td><td>租借品</td><td>數量</td><td>未歸還量</td><td>修改</td></tr>";
            for($i=0;$i<count($ID);$i++){
                $result=mysqli_query($link,"SELECT ITEM.i_name AS name,BORROW_LIST.bl_amount AS total ,BORROW_LIST.bl_not_return AS non FROM `BORROW_LIST`,`ITEM`,`BORROW` WHERE BORROW_LIST.bl_b_id=BORROW.b_a_id AND BORROW_LIST.bl_i_id=ITEM.i_id AND BORROW.b_a_id='$ID[$i]';");
                $field=mysqli_num_fields($result);
                $record=mysqli_num_rows($result);
                for($k=0;$k<$record;$k++){
                    $row=mysqli_fetch_assoc($result);
                    $name1[]=$row['name'];
                    $total1[]=$row['total'];
                    $non1[]=$row['non'];
                    echo "<tr><td>".$ID[$i]."</td><td>".$row['name']."</td><td>".$row['total']."</td><td>".$row['non']."</td><td><a href='mod_bow2.php?ID=".$ID[$i]."&name=".$name1[$k]."&total=".$total1[$k]."&non=".$non1[$k]."'>修改</a></td></tr>";
                }
            }
            echo "</table>";
    	}
        }
        if(isset($_POST["DATAsearch2"])){
    		$day=$_POST["day2"];
            $day2=$_POST["day2_e"];
    		$result=mysqli_query($link,"SELECT * FROM `BORROW` WHERE b_date>='$day' AND b_date<='$day2'");
    		$field=mysqli_num_fields($result);
        	$record=mysqli_num_rows($result);
    		if($record==0){
        		echo "<center><h3>沒有找到符合的資料!</h3></center>";
    		}else{
   			echo "<hr><center><h3>租借單</h3></center>";
        echo "<table align='center' style='border:3px #00DD00 dashed;' cellpadding='10' border='1'>";
        echo"<tr><td>租借單編號</td><td>租借人</td><td>租借日</td><td>實還日期</td><td>預還日期</td><td>備註</td><td>經手人</td><td>修改</td></tr>";
        for($i=0;$i<$record;$i++){
        	$row=mysqli_fetch_assoc($result);
        	$ID[$i]=$row['b_a_id'];
        	$name[$i]=$row['b_name'];
        	$date[$i]=$row['b_date'];
        	$return[$i]=$row['b_return_date'];
        	$PREreturn[$i]=$row['b_predict_return'];
        	$remark[$i]=$row['b_remark'];
        	$employee[$i]=$row['b_employee'];
        	echo"<tr><td>".$ID[$i]."</td><td>".$name[$i]."</td><td>".$date[$i]."</td><td>".$return[$i]."</td><td>".$PREreturn[$i]."</td><td>".$remark[$i]."</td><td>".$employee[$i]."</td><td><a href='mod_bow.php?return=".$return[$i]."&employee=".$employee[$i]."&name=".$name[$i]."&date=".$date[$i]."&return=".$return[$i]."&PREreturn=".$PREreturn[$i]."&remark=".$remark[$i]."&ID=".$ID[$i]."'>修改</a></td></tr>";
        }
            echo "</table>";
            echo "<h3 align='center'>租借單租借物</h3>";
            echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
            echo "<tr><td>租借單編號</td><td>租借品</td><td>數量</td><td>未歸還量</td><td>修改</td></tr>";
            for($i=0;$i<count($ID);$i++){
                $ii=$ID[$i];
                $result=mysqli_query($link,"SELECT ITEM.i_name AS name,BORROW_LIST.bl_amount AS total ,BORROW_LIST.bl_not_return AS non FROM `BORROW_LIST`,`ITEM`,`BORROW` WHERE BORROW_LIST.bl_b_id=BORROW.b_a_id AND BORROW_LIST.bl_i_id=ITEM.i_id AND BORROW.b_a_id='$ii';");
                $field=mysqli_num_fields($result);
                $record=mysqli_num_rows($result);
                for($k=0;$k<$record;$k++){
                    $row=mysqli_fetch_assoc($result);
                    $name1[$k]=$row['name'];
                    $total1[$k]=$row['total'];
                    $non1[$k]=$row['non'];
                    echo "<tr><td>".$ID[$i]."</td><td>".$name1[$k]."</td><td>".$total1[$k]."</td><td>".$non1[$k]."</td><td><a href='mod_bow2.php?ID=".$ID[$i]."&name=".$name1[$k]."&total=".$total1[$k]."&non=".$non1[$k]."'>修改</a></td></tr>";
                }
            }
            echo "</table>";
        }
		}
		echo "</span>";

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
