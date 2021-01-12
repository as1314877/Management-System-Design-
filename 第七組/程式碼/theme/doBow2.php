    <!DOCTYPE HTML>
    <html>
    <head>
    <meta charset="utf-8">
    
    </head>
    <body>
    <?php
    $link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
           or die("connection fail!<br>").mysql_errno()." ".mysql_error();
    #$link=new mysqli("localhost","s10359017","k222898622","database2016")
     #  or die("connection fail!<br>").mysql_errno()." ".mysql_error();
    mysqli_query($link,"SET NAMES 'big5'");
    mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
    mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
        if(isset($_POST["send"])){
            session_start();
            $BID=$_SESSION["Apply_ID"];
            echo "F BID=".$BID;
            $name=$_POST["UserName"];
            echo "name=".$name;
            $preDate=$_POST["preDate"];
            $remark=$_POST["remark"];
            $Itype=$_POST['first'];
            $Ibrand=$_POST['second'];
            $Ipre=$_POST['pre'];
            $place=$_POST['place'];
            $Ppre=$_POST['pre1'];
            date_default_timezone_set('Asia/Taipei');
            $date=date("Y-m-d H:i:s");
            mysqli_query($link,"UPDATE `APPLY` SET `a_status` = '領取中' WHERE `APPLY`.`a_id` = '$BID'");
            $result1=mysqli_query($link,"INSERT INTO `BORROW`(`b_a_id`,`b_date`, `b_name`,`b_predict_return`, `b_remark`) VALUES ('$BID','$date','$name','$preDate','$remark');");

            for($i=0;$i<count($place);$i++){
                if($Ppre[$i]!=0){
                    $re=mysqli_query($link,"SELECT i_id FROM `ITEM` WHERE i_name='$place[$i]';");
                    $field=mysqli_num_fields($re);
                    $record=mysqli_num_rows($re);
                    $row=mysqli_fetch_assoc($re);
                    $IID=$row['i_id'];
                    if($Ppre[$i]>0){
                        $res=mysqli_query($link,"INSERT INTO `BORROW_LIST` (`bl_b_id`, `bl_i_id`, `bl_amount`, `bl_not_return`) VALUES ('$BID','$IID','$Ppre[$i]','$Ppre[$i]');");
                    }
                    
                }
            }
            echo "BID=".$BID;
            for($i=0;$i<count($Itype);$i++){
                $re1=mysqli_query($link,"SELECT i_id FROM `ITEM` WHERE i_brand='$Ibrand[$i]';");
                $field1=mysqli_num_fields($re1);
                $record1=mysqli_num_rows($re1);
                $row1=mysqli_fetch_assoc($re1);
                $IID1=$row1['i_id'];
                if($Ipre[$i]>0){
                    $res=mysqli_query($link,"INSERT INTO `BORROW_LIST` (`bl_b_id`, `bl_i_id`, `bl_amount`, `bl_not_return`) VALUES ('$BID','$IID1','$Ipre[$i]','$Ipre[$i]');");
                }
            }
            header('Location: applyLogin.php');
        }
        
    ?>
    </body>
    </html>