<?php
if(isset($_POST["send"])){
	$Account=$_POST["account"];
	$Password=$_POST["password"];
	session_start();
	$link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
		or die("connection fail!<br>").mysql_errno()." ".mysql_error();
	#$link=new mysqli("localhost","s10359017","k222898622","database2016")
	#	or die("connection fail!<br>").mysql_errno()." ".mysql_error();
	mysqli_query($link,"SET NAMES 'big5'");
	mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
	mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
	$sql="SELECT e_account,e_name FROM `EMPLOYEE` WHERE e_account='$Account' AND e_password='$Password'";
	$result=mysqli_query($link,$sql);
	$field=mysqli_num_fields($result);
    $record=mysqli_num_rows($result);

    if($record!=0){
    	$row=mysqli_fetch_assoc($result);
		$Account=$row['e_account'];
		$E_name=$row['e_name'];
		$_SESSION["account"]=$Account;
		$_SESSION["E_name"]=$E_name;

		if($Account=="boss" && $Password=="666"){
	?>
		<script>
			alert("管理者 成功登入!");
		</script>
	<?php
		header("Refresh:0.1; url=DB.php");
		}else{
	?>
		<script>
			alert("成功登入!");
		</script>
	<?php
		header("Refresh:1; url=DB.php");
		}
    }else{
	?>
		<script>
			alert("登入失敗!");
		</script>
	<?php
		header("Refresh:1; url=login.php");
	}
	//mysqli_free_result($result);
	mysqli_close($link);
}
?>