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

        $result=mysqli_query($link,"SELECT count(i_name) AS num,i_name FROM `ITEM` WHERE i_type='器材'  GROUP BY i_name;");
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
        $result=mysqli_query($link,"SELECT i_id,i_name,i_total,i_reserve,i_others,i_remark FROM `ITEM` WHERE i_type='場地' ;");
        $field=mysqli_num_fields($result);
        $record=mysqli_num_rows($result);
        for($i=0;$i<$record;$i++){
            $row=mysqli_fetch_assoc($result);
            $PID[]=$row['i_id'];
            $place[]=$row['i_name'];
            $Ptotal[]=$row['i_total'];
            $Pres[]=$row['i_reserve'];
            $Pothers[]=$row['i_others'];
            $Premark[]=$row['i_remark'];
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

    <title>修改物品</title>

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
    <script language="javascript">
        key=new Array(<?php echo count($item); ?>);
        <?php
        for($k=0;$k<count($item);$k++){
                echo "key[".$k."]=new Array(".count($b[$k]).");";
                for($h=0;$h<count($b[$k]);$h++){
                    echo "key[".$k."][".$h.']="'.$b[$k][$h].'";';
                }
            }
        ?>
        function Buildkey(num)
        {
            document.my.second.selectedIndex=0;
            for(ctr=0;ctr<key[num].length;ctr++){
                document.my.second.options[ctr]=new Option(key[num][ctr],key[num][ctr]);
            }
            document.my.second.length=key[num].length;
        }  
    </script>
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
            <li><a href="DB.php">Menu</a></li>
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
                <h2>修改物品</h2>
                <h3>場地<h3>
                    <table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
                    <tr><td>名稱</td><td>總量</td><td>保留量</td><td>其他量</td><td>可外借量</td><td>外借中量</td><td>備註</td><td>修改</td></tr>
                    <?php
                        for($i=0;$i<count($place);$i++){
                            $I=$PID[$i];
                            $result=mysqli_query($link,"SELECT sum(bl_not_return) AS bow_sum FROM `BORROW_LIST` WHERE bl_i_id='$I' ");
                            $field=mysqli_num_fields($result);
                            $record=mysqli_num_rows($result);
                            $row=mysqli_fetch_assoc($result);
                            $bowed=$row['bow_sum'];#不能顯示0欸
                            if($bowed=="")
                                $bowed=0;
                            $can_bow=$Ptotal[$i]-$Pothers[$i]-$Pres[$i]-$bowed;
                            echo "<tr><td>".$place[$i]."</td><td>".$Ptotal[$i]."</td><td>".$Pres[$i]."</td><td>".$Pothers[$i]."</td><td>".$can_bow."</td><td>".$bowed."</td><td>".$Premark[$i]."</td><td><a href='mod_obj.php?name=".$place[$i]."&total=".$Ptotal[$i]."&res=".$Pres[$i]."&others=".$Pothers[$i]."&remark=".$Premark[$i]."&ID=".$PID[$i]."'>修改</a></td></tr>";
                        }
                    ?>
                    </table><br>
                    <h3>物品<h3>
                    <form method="post" action="" name="my">
                    <table align="center" style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>
                    <tr><td><select name="first" OnChange="Buildkey(this.selectedIndex);">
                        <?php
                        for($i=0;$i<count($item);$i++){
                            echo "<option value='".$item[$i]."'>".$item[$i];
                        }
                        ?>
                    </select></td>
                     <td><select name="second">
                        <?php
                        for($i=0;$i<count($b[0]);$i++){
                            echo "<option value='".$b[0][$i]."'>".$b[0][$i];
                        }
                        ?>
                    </select></td>
                    <td><input type="submit" class="btn btn-primary" name="send" style="font-family:Microsoft JhengHei;font-size:0.1cm;" value="查詢"/></td></tr>
                    </table>
                    </form>
                    <?php
                        if(isset($_POST["send"])){
                        $Iname=$_POST['first'];
                        $Ibrand=$_POST['second'];
                        echo "<br>";
                        echo "<table align='center' style='border:3px #00DD00 dashed;font-size:20px;' cellpadding='10' border='1'>";
                        echo "<tr><td>名稱</td><td>廠牌型號</td><td>總量</td><td>保留量</td><td>其他量</td><td>可外借量</td><td>外借中量</td><td>備註</td><td>修改</td></tr>";
                
                        $result1=mysqli_query($link,"SELECT * FROM `ITEM` WHERE  i_brand='$Ibrand'");
                        $field1=mysqli_num_fields($result1);
                        $record1=mysqli_num_rows($result1);
                        $row1=mysqli_fetch_assoc($result1);
                        $ID=$row1['i_id'];
                        $total=$row1['i_total'];
                        $others=$row1['i_others'];
                        $res=$row1['i_reserve'];
                        $remark=$row1['i_remark'];
                        $result2=mysqli_query($link,"SELECT sum(bl_not_return) AS bow_sum FROM `BORROW_LIST`,`ITEM` WHERE i_name='$Iname' AND i_brand='$Ibrand' AND bl_i_id=i_id");
                        $field2=mysqli_num_fields($result2);
                        $record2=mysqli_num_rows($result2);
                        $row2=mysqli_fetch_assoc($result2);
                        $bowed=$row2['bow_sum'];#不能顯示0欸
                        if($bowed==""){
                            $bowed=0;
                        }
                        $can_bow=$total-$others-$res-$bowed;
                        echo "<tr><td>".$Iname."</td><td>".$Ibrand."</td><td>".$total."</td><td>".$res."</td><td>".$others."</td><td>".$can_bow."</td><td>".$bowed."</td><td>".$remark."</td><td><a href='mod_obj2.php?name=".$Iname."&brand=".$Ibrand."&total=".$total."&res=".$res."&others=".$others."&remark=".$remark."&ID=".$ID."'>修改</a></td></tr>";
                        echo"</table>";
        }
                    ?>
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
