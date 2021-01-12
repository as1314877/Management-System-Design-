<?php
$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			#$link=new mysqli("localhost","s10359017","k222898622","database2016")
			#		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
			mysqli_query($link,"SET NAMES 'big5'");
			mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
			mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");

	$result=mysqli_query($link,"SELECT count(i_name) AS num,i_name FROM `ITEM` WHERE i_type='器材' AND i_total>0 GROUP BY i_name;");
        $field=mysqli_num_fields($result);
        $record=mysqli_num_rows($result);
        for($i=0;$i<$record;$i++){
            $row=mysqli_fetch_assoc($result);
            $item[]=$row['i_name'];
            $number[]=$row['num'];
        }
        $b=array();
        for($j=0;$j<count($number);$j++){
            $name=$item[$j];
            $num=$number[$j];
            $result=mysqli_query($link,"SELECT i_brand FROM `ITEM` WHERE i_name='$name';");
            $field=mysqli_num_fields($result);
            $record=mysqli_num_rows($result);
            $b[$j]=array();
            for($i=0;$i<$record;$i++){
                $row=mysqli_fetch_assoc($result);
                $b[$j][$i]=$row["i_brand"];
            }
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

    <title>填寫申請單</title>

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
	<script language="javascript">
			var n=1;
			function add_new_data() {
				n++;
				var num = document.getElementById("mytable").rows.length;
				var Tr = document.getElementById("mytable").insertRow(num);
				Td = Tr.insertCell(Tr.cells.length);
				Td.innerHTML ="<select name='first[]' id="+n+" OnChange='Buildkey(this.selectedIndex,this.id);'><?php 
                        for($i=0;$i<count($item);$i++){
                            echo "<option value=".$item[$i].">".$item[$i];
                        }
                        ?></select>";
     
				Td = Tr.insertCell(Tr.cells.length);
				
				Td.innerHTML ="<select name='second[]' id=b"+n+"><?php
                        for($i=0;$i<count($b[0]);$i++){
                            echo "<option value=".$b[0][$i].">".$b[0][$i];
                        }
                        ?></select>";
				Td = Tr.insertCell(Tr.cells.length);
				Td.innerHTML =  "<input name='pre[]' id=p"+n+" type='number' class='form-control' style='font-size:0.1cm;width:200px;height:30px;font-family:Microsoft JhengHei;' min='0'  size='12' />";
			}

			function remove_data() {
				var num = document.getElementById("mytable").rows.length;
				if(num >2)
    				document.getElementById("mytable").deleteRow(-1);
    			n--;
			}
			function add_new_data1() {
				var num = document.getElementById("mytable1").rows.length;
				var Tr = document.getElementById("mytable1").insertRow(num);
				Td = Tr.insertCell(Tr.cells.length);
				Td.innerHTML =   "<select name='place[]'>'<?php
					$result=mysqli_query($link,'SELECT * FROM `ITEM` WHERE i_type="場地" AND i_total>0;');
					$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				for($i="0";$i<$record;$i++){
    					$row=mysqli_fetch_assoc($result);
    					echo "<option value=".$row['i_name'].">".$row['i_name']."</option>";
    				}
				   ?>'</select>";
				Td = Tr.insertCell(Tr.cells.length);
				Td.innerHTML =  "<input name='pre1[]' type='number' class='form-control' style='font-size:0.1cm;width:200px;height:30px;font-family:Microsoft JhengHei;' min='0'  size='12' />";
			}

			function remove_data1() {
				var num = document.getElementById("mytable1").rows.length;
				if(num >2)
    				document.getElementById("mytable1").deleteRow(-1);
			}

			 key=new Array(<?php echo count($item); ?>);
        <?php
        for($k=0;$k<count($item);$k++){
                echo "key[".$k."]=new Array(".count($b[$k]).");";
                for($h=0;$h<count($b[$k]);$h++){
                    echo "key[".$k."][".$h.']="'.$b[$k][$h].'";';
                }
            }
        ?>
        function Buildkey(num,id)
        {

            document.getElementById('b'+id).selectedIndex=0;
            for(ctr=0;ctr<key[num].length;ctr++){
                document.getElementById('b'+id).options[ctr]=new Option(key[num][ctr],key[num][ctr]);
            }
            document.getElementById('b'+id).length=key[num].length;
        }  
	</script>
	<div class="container" >
		<div class="row centered mt mb">
				
				<span style="font-family:Microsoft JhengHei;color:#000000;">
				<h1>填寫申請單</h1><br>
				<form method="post" action="nonApply.php" name="my">
				<table  align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<?php
					date_default_timezone_set('Asia/Taipei');
					$today=date("Y-m-d");
				?>
				<tr><td >申請人</td><td><input type="text" class="form-control" style="font-family:Microsoft JhengHei;" name="UserName" maxlength="21" required="required"/></td>
					<td>連絡電話</td><td><input  type="text" class="form-control" style="font-family:Microsoft JhengHei;" name="cellphone" minlength="10" maxlength="10" required="required"/></tr>
				<tr><td>指導老師</td><td ><input type="text" class="form-control" style="font-family:Microsoft JhengHei;" name="teacher" maxlength="21" required="required"/></td><td>申請單位</td><td><input type="text" class="form-control" style="font-family:Microsoft JhengHei;" name="organization" maxlength="39" required="required"/></td></tr>
				<tr><td>預借開始</td><td><input type="datetime-local" name="start_date" required="required" min='<?php echo $today; ?>'></td><td>預借結束</td><td><input type="datetime-local" name="end_date" required="required"></td></tr>
				<tr><td>用途</td><td colspan="3"><input type="text" class="form-control" style="font-family:Microsoft JhengHei;" name="purpose" maxlength="255" required="required"/></td></tr>
			
				<tr><td >備註</td><td colspan="3"><textarea name="context" rows="1" cols="100"></textarea></td></tr>
				</table>
				<h3>預借器材</h3>
				<table id="mytable" align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>器材名稱</td><td>廠牌型號</td><td>預借量</td></tr>
				<tr><td><select name="first[]" id="1" OnChange="Buildkey(this.selectedIndex,this.id)">
                        <?php
                        for($i=0;$i<count($item);$i++){
                            echo "<option value='".$item[$i]."'>".$item[$i];
                        }
                        ?>
                    </select></td>
                     <td><select name="second[]" id="b1">
                        <?php
                        for($i=0;$i<count($b[0]);$i++){
                            echo "<option value='".$b[0][$i]."'>".$b[0][$i];
                        }
                        ?>
                    </select></td>
					<td><input type='number'class='form-control' style='font-size:0.1cm;width:200px;height:30px;font-family:Microsoft JhengHei;' name="pre[]" id="p1" min='1' max='99' /></td></tr>
				</table>
				<input type="button" value="增加" onclick="add_new_data()"> <input type="button" value="減少" onclick="remove_data()"><br />

				<h3>預借場地</h3>
				<table id="mytable1" align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
				<tr><td>場地名稱</td><td>預借量</td></tr>
				<tr><td><select name="place[]">
				<?php
					$result=mysqli_query($link,"SELECT * FROM `ITEM` WHERE i_type='場地' AND i_total>0;");
					$field=mysqli_num_fields($result);
    				$record=mysqli_num_rows($result);
    				for($i=0;$i<$record;$i++){
    					$row=mysqli_fetch_assoc($result);
    					echo "<option value=".$row['i_name'].">".$row['i_name']."</option>";
    				}
				?>
				</select></td>
				<td><input type='number'class='form-control' style='font-size:0.1cm;width:200px;height:30px;font-family:Microsoft JhengHei;' name="pre1[]"  min='1' max='99' /></td></tr>
				</table>
				<input type="button" value="增加" onclick="add_new_data1()"> <input type="button" value="減少" onclick="remove_data1()"><br />
				<br>
				<input type="submit" class="btn btn-primary" name="send" style="font-family:Microsoft JhengHei;font-size:0.5cm;" value="送出"/>
				</form>
				<hr>
				<a href="applyLogin.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">資料查詢</button></a>
				<a href="index.php"><button class="btn btn-default" type="submit" style="width:200px;height:90px;font-size:35px;">首頁</button></a>
			</span>
			
		</div><! --/row -->
	</div><! --/container -->
	<?php
		if(isset($_POST["send"])){
			$name=$_POST["UserName"];
			$organ=$_POST["organization"];
			$phone=$_POST["cellphone"];
			$teacher=$_POST["teacher"];
			$date=date("Y-m-d");
			$start=$_POST["start_date"];
			$end=$_POST["end_date"];
			$purpose=$_POST["purpose"];
			$remark=$_POST["context"];
			$Itype=$_POST['first'];
			$Ibrand=$_POST['second'];
			$Ipre=$_POST['pre'];
			$place=$_POST['place'];
			$Ppre=$_POST['pre1'];
			$result=mysqli_query($link,"SELECT max(a_id) AS m FROM `APPLY`;");
			$field=mysqli_num_fields($result);
    		$record=mysqli_num_rows($result);
    		$row=mysqli_fetch_assoc($result);
    		$max=$row['m']+1;
    		$result1=mysqli_query($link,"INSERT INTO `APPLY`(`a_id`, `a_name`, `a_organization`, `a_phone`, `a_teacher`, `a_date`, `a_start`, `a_end`, `a_purpose`, `a_remark`) VALUES ('$max','$name','$organ','$phone','$teacher','$date','$start','$end','$purpose','$remark');");

    		for($i=0;$i<count($place);$i++){
    			$re=mysqli_query($link,"SELECT i_id FROM `ITEM` WHERE i_name='$place[$i]';");
    			$field=mysqli_num_fields($re);
    			$record=mysqli_num_rows($re);
    			$row=mysqli_fetch_assoc($re);
    			$IID=$row['i_id'];
    			if($Ppre[$i]>0){
    				$res=mysqli_query($link,"INSERT INTO `APPLY_LIST` (`al_i_id`, `al_a_id`, `al_amount`) VALUES ('$IID','$max','$Ppre[$i]');");
    			}
    		}
    		for($i=0;$i<count($Itype);$i++){
    			$re1=mysqli_query($link,"SELECT i_id FROM `ITEM` WHERE i_brand='$Ibrand[$i]';");
    			$field1=mysqli_num_fields($re1);
    			$record1=mysqli_num_rows($re1);
    			$row1=mysqli_fetch_assoc($re1);
    			$IID1=$row1['i_id'];
    			if($Ipre[$i]>0){
    				$res=mysqli_query($link,"INSERT INTO `APPLY_LIST` (`al_i_id`, `al_a_id`, `al_amount`) VALUES ('$IID1','$max','$Ipre[$i]');");
    			}
    		}
    		    ?>
                <script >
                    altert("填寫成功!")
                </script>
                <?php
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
