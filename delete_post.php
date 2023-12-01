<?php 
	include("connection.php");
	session_start();

	$uid=$_SESSION['id'];
	$delete=$_POST['delete_id'];

	$sql="select * from posts where id='$delete' limit 1";
	$res=mysqli_query($con,$sql);
	$data=mysqli_fetch_assoc($res);

	if($data && $data['user_id'] == $uid) {
		
		if($_POST['delete_id'] && $data['user_id'] == $uid){

			$delete=$_POST['delete_id'];
			$pst_id=$data['post_id'];

			$sql="delete from posts where id='$delete'";
			$drs=mysqli_query($con,$sql);
			$sql="delete from comments where post_id='$pst_id'";
			mysqli_query($con,$sql);
			$sql="delete from replies where post_id='$pst_id'";
			mysqli_query($con,$sql);
			$sql="delete from likes where post_id='$pst_id'";
			mysqli_query($con,$sql);
			$sql="delete from tags where post_id='$pst_id'";
			mysqli_query($con,$sql);
			if($drs){
			echo 'true';
			}
		}
	}
	 else {
		echo'false';
	}
?>