<?php
include("connection.php");
session_start();
$uid=$_SESSION['id'];
if(isset($_POST['id']) && isset($uid)){

	$pdid=$_POST['id'];
	$sql="select * from posts where post_id='$pdid' limit 1";
	$res=mysqli_query($con,$sql);
	$data=mysqli_fetch_assoc($res);
	if($data && $data['user_id'] == $uid) {
		echo 'true';
	} else {
		echo'false';
	}

}


?>