<?php

include("connection.php");

if(isset($_POST['arg_2'])){
    $pic_id=$_POST['arg_2'];

 	//username for repective post
	$sql10="select * from users where user_id='$pic_id' limit 1";
	$raw8=mysqli_query($con,$sql10);
	$rt_name=mysqli_fetch_assoc($raw8);
	if(isset($rt_name)){
		echo$rt_name['user_name'];
    }
    else{
            echo"user";
        }
}
else{
            echo"invalid request";
        }
?>