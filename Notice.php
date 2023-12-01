<?php

   $pic_id=$Ntp['user_id'];

//profile for respective profile 
	$syt="select * from profile where user_id='$pic_id' limit 1";
	$raw5=mysqli_query($con,$syt);
	$rt_pic=mysqli_fetch_assoc($raw5);
//username for repective post
	$sql10="select * from users where user_id='$pic_id' limit 1";
	$raw8=mysqli_query($con,$sql10);
	$rt_name=mysqli_fetch_assoc($raw8);

	//date format check

$date = DateTime::createFromFormat('Y-m-d H:i:s', $Ntp['date']);
if ($date !== false) {
    $timestamp = $date->getTimestamp();
    
}

 $timestamp = strtotime($Ntp['date']);
     $timestamp=$timestamp-16200;   
        if ($timestamp === false) {
            echo "Invalid timestamp: " . $Ntp['date'] . "<br>";
        } else {
            $current_time = time();
            $time_difference = $current_time - $timestamp;

            // Format the time difference
            if ($time_difference < 60) {
                $formatted_time = $time_difference . " sec ago";
            } elseif ($time_difference < 3600) {
                $formatted_time = round($time_difference / 60) . " min ago";
            } elseif ($time_difference < 86400) {
                $formatted_time = round($time_difference / 3600) . " hours ago";
            } elseif ($time_difference < 2592000) {
                $formatted_time = round($time_difference / 86400) . " days ago";
            } elseif ($time_difference < 31536000) {
                $formatted_time = round($time_difference / 2592000) . " months ago";
            } else {
                $formatted_time = round($time_difference / 31536000) . " years ago";
            }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
		<div class="class-2A1">
				<?php 
     				if(isset($rt_pic)){
 			 		 	echo "<img src='user/".$rt_pic['image']."' width='100% ' height='100%'>";
 			 		}else{
 			 			echo "<img src='def.png'>";
 			 		}

     			?>
			<div class="class-2A11">
				<?php
						if(isset($rt_name)){
							echo$rt_name['user_name'];
						}else{
							echo"User";
						}

						?><br><span><?php echo$formatted_time;?></span>
				<!-- <div class="date2A11">
					
				</div> -->    	 
			</div>
			<div class="class-2A12">
				<?php 
					echo $Ntp['tag'];
				?>
			</div>
		</div>