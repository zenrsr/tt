<?php
	include("connection.php");
	$rep="select * from replies";
	$res=mysqli_query($con,$rep);

	

$pic_id=$row['user_id'];

//username for repective post
	$sql10="select * from users where user_id='$pic_id' limit 1";
	$raw8=mysqli_query($con,$sql10);
	$rt_name=mysqli_fetch_assoc($raw8);

//profile for respective profile 
	$syt1="select * from profile where user_id='$pic_id' limit 1";
	$raw6=mysqli_query($con,$syt1);
	$rt_pic=mysqli_fetch_assoc($raw6);

//date format check
$date = DateTime::createFromFormat('Y-m-d H:i:s', $row['date']);
if ($date !== false) {
    $timestamp = $date->getTimestamp();
    
}

 $timestamp = strtotime($row['date']);
     $timestamp=$timestamp-16200;   
        if ($timestamp === false) {
            echo "Invalid timestamp: " . $row['date'] . "<br>";
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
	<div class="class-61c">

				<div class="leftR1">

					<div class="class-612c">
						<?php 
			     				if(isset($rt_pic)){
		     			 		 	echo "<img src='user/".$rt_pic['image']."' width='100% ' height='100%'>";
		     			 		}else{
		     			 			echo "<img src='def.png'>";
		     			 		}

			     			?>
					</div>
					
				</div>
				<div class="rightR1">

					<div class="class-613c">
						<?php
						if(isset($rt_name)){
							echo$rt_name['user_name'];
						}else{
							echo"UserName";
						}

						?><label><?php echo$formatted_time;?></label>
					</div>
					<div class="class-614c">
						<label><?php echo$row['comment']; ?></label>
					</div>
					<div class="class-614btn">
						<button type="button"  id="cid2" onclick="changePlaceholder('<?php echo $row['id'];?>','<?php echo $row['post_id'];?>','<?php echo $row['user_id'];?>')">Reply</button>
					</div>
						<?php
			            	while($val=mysqli_fetch_assoc($res))
			            	{
				            	
				            	$up=$val['user_id'];
								//user name replies
								$tf="select * from users where user_id='$up' limit 1";
								$qt=mysqli_query($con,$tf);
								$rt=mysqli_fetch_assoc($qt);
				            	getReplies($val,$row['id'],$rt['user_name']);
			            	}
			            ?>

				</div>
			</div>
	</body>
	</html>

						