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

    <title>修改申請單</title>

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
			$ID=$_SESSION["AID"];
			$EMPLOYEE=$_SESSION["account"];
			$status=$_POST["status"];
			
			if($status=="租借中"){
				$check=1;
				$res=mysqli_query($link,"SELECT `bl_i_id`FROM `BORROW_LIST` WHERE bl_b_id='$ID'");
				$field=mysqli_num_fields($res);
                $record=mysqli_num_rows($res);
                for($k=0;$k<$record;$k++){
                	$row=mysqli_fetch_assoc($res);
                	$item[]=$row['bl_i_id'];
                	$result=mysqli_query($link,"SELECT sum( `bl_not_return`) AS bow_sum,i_total,i_reserve,i_others FROM `BORROW_LIST` ,`ITEM` WHERE bl_i_id='$item[$k]' AND bl_i_id=i_id ");
                    $field=mysqli_num_fields($result);
                    $record=mysqli_num_rows($result);
                    $row=mysqli_fetch_assoc($result);
                    $bowed=$row['bow_sum'];
                    $total=$row['i_total'];
                    $res=$row['i_reserve'];
                    $other=$row['i_others'];
                    if($bowed=="")
                        $bowed=0;
                    $can_bow[]=$total-$other-$res-$bowed;
                    if($can_bow[$k]<=0){
                    	$check=0;
                    }
                }
                if($check==0){
                	?>
                	<script>
                		alert("可外借量不足!");
                	</script>
                	<?php
                	header('Refresh:0.1; url=apply.php');
                }else{
				mysqli_query($link,"UPDATE `APPLY` SET a_status='$status',a_employee='$EMPLOYEE' WHERE a_id='$ID'");
				?>
					<script >alert("修改成功!");</script>
				<?php
				header('Refresh:0.1; url=apply.php');
				}
			
			}else{
				mysqli_query($link,"UPDATE `APPLY` SET a_status='$status',a_employee='$EMPLOYEE' WHERE a_id='$ID'");
				?>
					<script >alert("修改成功!");</script>
				<?php
				header('Refresh:0.1; url=apply.php');
			}
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
				<h2>修改申請單</h2>
				<form method="post" action="mod_apy.php">
				<table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>申請單編號</td><td>申請人</td><td>申請單位</td><td>電話</td><td>指導老師</td><td>申請日</td><td>申請開始</td><td>申請結束</td><td>目的</td><td>狀態</td><td>備註</td><td>經手人</td></tr>
				<?php
					$AID=$_GET["ID"];
					$_SESSION["AID"]=$AID;
					$name=$_GET["name"];
					$organ=$_GET["organ"];
        			$phone=$_GET["phone"];
        			$teacher=$_GET["teacher"];
        			$date=$_GET["date"];
        			$start=$_GET["start"];
        			$end=$_GET["end"];
        			$purpose=$_GET["purpose"];
        			$status=$_GET["status"];
        			$remark=$_GET["remark"];
        			$employee=$_GET["employee"];
					echo"<tr><td>".$AID."</td><td>".$name."</td><td>".$organ."</td><td>".$phone."</td><td>".$teacher."</td><td>".$date."</td><td>".$start."</td><td>".$end."</td><td>".$purpose."</td><td><select name='status'><option value='尚未批准'>尚未批准</option><option value='批准失敗'>批准失敗</option><option value='批准成功'>批准成功</option><option value='領取中'>領取中</option><option value='租借中'>租借中</option><option value='已歸還'>已歸還</option></select></td><td>".$remark."</td><td>".$employee."</td></tr>";
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
