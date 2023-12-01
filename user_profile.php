	<?php
	include("connection.php");
	$pic1=$key1['user_id'];
	$pic2=$key1['u_id'];
	$syt3="select * from profile where user_id='$pic1' limit 1";
	$raw6=mysqli_query($con,$syt3);
	$ric=mysqli_fetch_assoc($raw6);
//username in the user profile
	$srt="select *from users where user_id!='$id1' and user_id='$pic1' limit 1";
    $query=mysqli_query($con,$srt);
    $name2=mysqli_fetch_assoc($query);
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
	
		<div class="usr-1" onclick="getUserDetails(<?php echo$pic2;?>)">
			<?php 
 				if(isset($ric)){
			 		 	echo "<img src='user/".$ric['image']."' width='100% ' height='100%'>";
			 		}else{
			 			echo "<img src='def.png'>";
			 		}

 			?>
			
			<div class="usr-2" onclick="getUserDetails(<?php echo$pic2;?>)">
				<?php 

				if($key1){
					echo$name2['user_name'];
					
				}
				else{
					echo"user_not_found";
				}?>

			</div>
		</div>

		</body>
	</html>