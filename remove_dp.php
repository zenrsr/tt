<?php
include("connection.php");

if(isset($_POST['id_1'])){
    $id=$_POST['id_1'];
    if(isset($id))
    	$data2="select * from profile where ud_id='$id' limit 1";
    	    	$qt1=mysqli_query($con,$data2);
    	    	$et=mysqli_fetch_assoc($qt1);
    	if($qt1 && mysqli_num_rows($qt1)>0){
    		$data1="delete from profile where ud_id='$id'";
    	    	$qt=mysqli_query($con,$data1);
    	    	echo"Dp Removed...";
    	   }else{
    	   	echo"Dp Not Uploaded..Sorry";
    	   }
}
else{
        echo"invalid request";
     }
?>

	