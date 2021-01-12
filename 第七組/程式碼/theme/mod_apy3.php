 <?php
 $link=new mysqli("localhost","S10359017","Z25P6C4HTN","s10359017")
or die("connection fail!<br>").mysql_errno()." ".mysql_error();
            #$link=new mysqli("localhost","s10359017","k222898622","database2016")
            #       or die("connection fail!<br>").mysql_errno()." ".mysql_error();
            mysqli_query($link,"SET NAMES 'big5'");
            mysqli_query($link,"SET CHARACTER_SET_CLIENT='utf8'");
            mysqli_query($link,"SET CHARACTER_SET_RESULTS='utf8'");
            session_start();
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