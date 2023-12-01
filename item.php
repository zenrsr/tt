<?php 
//include('user_id_filp.php');
    include("connection.php");
          //  $globalVar1;

   $query="select * from tags";
	$rd=mysqli_query($con,$query);

	//selecting the posts 
	$qt="select *from posts";
	$rp=mysqli_query($con,$qt);		
     $rtc=mysqli_fetch_assoc($rp);

       $pic_id=$ROW['user_id'];

//profile for respective profile 
	$syt="select * from profile where user_id='$pic_id' limit 1";
	$raw5=mysqli_query($con,$syt);
	$rt_pic=mysqli_fetch_assoc($raw5);

//username for repective post
	$sql10="select * from users where user_id='$pic_id' limit 1";
	$raw8=mysqli_query($con,$sql10);
	$rt_name=mysqli_fetch_assoc($raw8);
           
//date format check

 // $timestamp = strtotime($ROW['stamp']);
     $timestamp=$ROW['stamp'];   
        if ($timestamp === false) {
            echo "Invalid timestamp: " . $ROW['date'] . "<br>";
        } else {
            $current_time = time();
            $time_difference =  $current_time-$timestamp ;

            // Format the time difference
            if ($time_difference < 60) {
                $formatted_time1 = $time_difference . " sec ago";
            } elseif ($time_difference < 3600) {
                $formatted_time1 = round($time_difference / 60) . " min ago";
            } elseif ($time_difference < 86400) {
                $formatted_time1 = round($time_difference / 3600) . " hours ago";
            } elseif ($time_difference < 2592000) {
                $formatted_time1 = round($time_difference / 86400) . " days ago";
            } elseif ($time_difference < 31536000) {
                $formatted_time1 = round($time_difference / 2592000) . " months ago";
            } else {
                $formatted_time1 = round($time_difference / 31536000) . " years ago";
            }
	}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		#YE{
				display: none;
		}
	</style>
	<script type="text/javascript">

function show_filp(post_id) {
	var u1 = <?php echo $id1; ?>; // Assuming $id1 is defined in your PHP code
  	var u2 = <?php echo $ROW['user_id'];?>;
  	if(u1!==u2)
  	{
  		equal=true;
  	 
  	}else{
  		equal=false;
  	}
	const submit = document.getElementById("YE-"+post_id);
	if (submit.style.display = "none" && equal) {

        submit.style.display = "block";
    } else {
        submit.style.display = "none";
    }



}
	


function showptBtn(post_id) {
	//alert(post_id);
			 const options = document.getElementsByName("radiogroup");
			 let isDataEntered = false;

    for (let i = 0; i < options.length; i++) {
        if (options[i].checked) {
            options[i].name = "pt_typ";
            isDataEntered = true;
            break;
        }
    }

    const textArea = document.getElementById("Rtxt");

    if (textArea.value.trim() !== "") {
        isDataEntered = true;
    }

    const submitButton = document.getElementById("pt-btn-" + post_id);

    if (isDataEntered) {
        submitButton.style.display = "block";
    } else {
        submitButton.style.display = "none";
    }
}
		 
		    

		  

	
	</script>
	
</head>
<body>



<div class="flip-card" id="<?php echo$ROW['post_id'];?>">
	<div class="flip-card-inner" >

			<div class="class-4P" data-postid="<?php echo$ROW['id'];?>">
					<div class="class-4p1">
							<?php 
			     				if(isset($rt_pic)){
		     			 		 	echo "<img src='user/".$rt_pic['image']."' width='100% ' height='100%'>";
		     			 		}else{
		     			 			echo "<img src='def.png'>";
		     			 		}

			     			?>
						<div class="Wrap"><label><?php
						if(isset($rt_name)){
							echo$rt_name['user_name'];
						}else{
							echo"User";
						}

						?> Update..</label><br>
						<label class ="id4p1" id="postTime"><?php

							echo $formatted_time1;


					?></label>

					</div>
				


				</div>

					<div class="class-4PH">

						<!-- <label id="Tag4"> -->
							 <?php 

                    if(mysqli_num_rows($rd)>0)
                    {
                        foreach($rd as $ro)
                        {
                        	if($ro['u_id']==$ROW['id'])
                            {
                            		$ta_line=$ro['tag'];
                            		if(!empty($ta_line)){

                            				echo $ta_line;
                            		}
                            }                         

                        }
                     }
                ?>
						<!-- </label> -->

					</div>
					<div class="class-4P1">
						<label>
							<?php
					                if($ROW['has_image']==2)
					                {
					                   
									    $content = $ROW['post'];

									    // Define a regular expression pattern to match URLs
									  
									   $url_pattern = '/\b(?:https?:\/\/(?:www\.)?|www\.)[^\s<>\[\]]+\b/i';


									    // Replace URLs with anchor tags
									   $modified_content = preg_replace_callback($url_pattern, function($matches) {
										    $url = $matches[0];
										    return "<a href='$url' target='_blank'>$url</a>";
										}, $content);

									    // Send the modified content back to the client
									    echo $modified_content;
					                    
					                }  
					                elseif($ROW['has_image']==0){
					                    echo "<img src='uploads/".$ROW['post']."' width='100% ' height='100%'>";
					                }
					                else{
					                   echo "<video src='uploads/".$ROW['post']."' width='100%' height='100%' style='outline:none' controls>";
					                }

					             ?>

					         </label>
						
					</div>


							<div class="class-4P2i" style="cursor:pointer;">


								<i class="fa-regular fa-thumbs-up" class="like_tag" onclick="like_count(<?php echo $ROW['id'];?>)"></i>
								<span  class="like_info"> 

								 <?php 

				                    if(mysqli_num_rows($rp)>0)
				                    {
				                        foreach($rp as $rl)
				                        {
				                        	if($rl['post_id']==$ROW['post_id'])
				                            {
				                            		echo $rl['likes'];
				                            }                         

				                        }
				                     }
				                ?>
								 </span>

								
								<a href="hk.php?post_id=<?php echo$ROW['post_id'];?>" id="post-link" style="color: inherit;text-decoration: none;">
					    		<i class="fa-regular fa-comments"></i>
								<label class="view-comments" data-postid="<?php echo $ROW['post_id'];?>" style="cursor:pointer;">comment</label></a>

								<i class="fa-regular fa-pen-to-square" onclick="get_data()"></i>
								<label class="des_tag"  style="cursor:pointer;" onclick="get_data()" >About</label>
								<label class="trash"><i class="fa-solid fa-trash"  onclick="delete_icon(<?php echo$ROW['id'];?>)"></i></label>

											

							</div>
			</div>
			<div class="back">

				<center>
					<label id="RG">..Post Info..</label></center>
					<form id="RF" method="post">
							<label id="RL">Category:</label><br><br>
								  <input type="radio" id="option1" name="radiogroup" value="placement" onclick="showptBtn(<?php echo$ROW['id'];?>)" style="cursor:pointer;">
								  <label for="option1">PLACEMENT</label><br>

								  <input type="radio" id="option2" name="radiogroup" value="sports" onclick="showptBtn(<?php echo$ROW['id'];?>)" style="cursor:pointer;">
								  <label for="option2">SPORTS</label><br>

								  <input type="radio" id="option3" name="radiogroup" value="others" onclick="showptBtn(<?php echo$ROW['id'];?>)" style="cursor:pointer;">
								  <label for="option3">OTHERS</label><br>

									<label id="RL">Tag:</label><br>
									<textarea name="btxt1" id="Rtxt"></textarea><br><br>

									<label id="RL">About:</label><br>
									<textarea name="btxt2" id="Rtxt"></textarea><br>

									<input type="hidden" name="BFD" id="BD" value="<?php echo $ROW['post_id'];?>">
									<input type="hidden" name="ud_id1"  value="<?php echo $ROW['id'];?>">
									<input type="submit" name="Back_btn" id="pt-btn-<?php echo $ROW['id'];?>" class="pt-btn1" style="cursor:pointer; display: none;">

					</form>


			</div>

		</div>
		<center><button type="button"  class="flip-button"  data-post-id="<?php echo $ROW['post_id'];?>" id="YE-<?php echo $ROW['post_id'];?>" onclick="show_flip(<?php echo $ROW['post_id'];?>)" style="display: block;"><i class="fa-solid fa-rotate"></i></button></center>
</div>
		

</body>
</html>