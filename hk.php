<?php 
session_start();


include("connection.php");
include("posts.php");
include("uploads.php");

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $obj=new Post();
    
   
}
    //collect posts
    $obj=new Post();
   $id1=$_SESSION["id"];

    $posts=$obj->get_posts();
//echo$id1;



   //saving comments in database;

    if (isset($_POST['cmt-btn'])) {
   
        if (!empty(trim($_POST["comment"])))
        {
            if (isset($_POST["comment"])){

            	if (isset($_GET['post_id'])) {

   				 $_SESSION['post_id'] = $_GET['post_id'];

                 $comment = $_POST["comment"];
   
                 $c_id=$_GET['post_id'];
               
                 // Assuming $con is your mysqli connection

				$sql = "INSERT INTO comments (user_id, comment, post_id) VALUES (?, ?, ?)";

				$stmt = mysqli_prepare($con, $sql);

				// Assuming $id1, $comment, and $c_id are your variables
				mysqli_stmt_bind_param($stmt, "iss", $id1, $comment, $c_id);

				// Execute the statement
				mysqli_stmt_execute($stmt);

				// Close the statement
				mysqli_stmt_close($stmt);
                 $_POST['comment']=NULL;
              
            }
        }  
    }
}
		
          
    //Display comments;
    $query="select * from comments order by id desc";
    $result=mysqli_query($con,$query);

    //Display tags
    $query="select * from tags order by id desc";
    $Rtags=mysqli_query($con,$query);

    //display resume
    $str="select *from resume where user_id='$id1' limit 1";
    $udr=mysqli_query($con,$str);
    $tdr=mysqli_fetch_assoc($udr);


    //counting the placements in posts table
    $dd1 = "SELECT COUNT(pt_type) FROM tags WHERE pt_type = 'placement' AND user_id='$id1'";
	$counter1 = mysqli_query($con, $dd1);

	if ($counter1) {
	    $row = mysqli_fetch_row($counter1);
	    $red = $row[0]; 
	    mysqli_free_result($counter1); 
	}

     //counting the sports in posts table
   	$dd2 = "SELECT COUNT(pt_type) FROM tags WHERE pt_type = 'sports' AND user_id='$id1'";
	$counter2 = mysqli_query($con, $dd2);

	if ($counter2) {
	    $row1 = mysqli_fetch_row($counter2);
	    $red1 = $row1[0]; 
	    mysqli_free_result($counter2); 
	}

    //counting the others in posts table
    $dd3="select count(pt_type) from tags where pt_type='others' and user_id='$id1'";
    $counter3=mysqli_query($con,$dd3);
    $row2 = mysqli_fetch_row($counter3);
    $red2 = $row2[0];

    //display profile pic
    $str_pic="select *from profile where user_id='$id1' limit 1";
    $udr2=mysqli_query($con,$str_pic);
    $pic_data=mysqli_fetch_assoc($udr2);


    //display username in all positions
    $str_pic1="select *from users where user_id='$id1' limit 1";
    $udr3=mysqli_query($con,$str_pic1);
    $name=mysqli_fetch_assoc($udr3);
    $u_code=$name['id'];
 //   echo$name['user_id'];

    //dispaly others profiles
    $str_pic2="select *from resume where user_id !='$id1'";
    $row5=mysqli_query($con,$str_pic2);
    //$name1=mysqli_fetch_assoc($udr4);


 ?>
    
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="kk.css">
	<title>Pathways</title>
	 <script src="https://kit.fontawesome.com/cae14f18b4.js" crossorigin="anonymous"></script>
 	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 	<script src="filped_card.js"></script>
 	<script src="aja2.js"></script>
 	<script src="profile1.js"></script>
 	<script src="like_aja.js"></script>
 	<script src="del.js"></script>
 	
	<style type="text/css">
		 input[type="file"]{
            display: none;
        }
		.class-4P2{
			display: none;
		}
		.class-4P2 option{
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">

		function remove_dp(id) {
			// body...
		//alert(id);
			 $.ajax({
                url:"remove_dp.php",
                method:"POST",
                data:{id_1:id},
                success:function(response){
                   alert(response);
                   window.location.href = window.location.href;
                }
            });

		}
		



		function get_data() {
			
			var inputDiv=document.getElementById('post_data');
			
			var inputDiv3=document.getElementById('comment_div');
			if(inputDiv.style.display==="none"||inputDiv.style.display==="")
			{
				inputDiv.style.display="block";
				
				inputDiv3.style.display="none";
			}
			
		
		}

		function get_comment_div() {
		


			var inputDiv3=document.getElementById('post_data');
			
			var inputDiv1=document.getElementById('comment_div');
			if(inputDiv1.style.display==="none"||inputDiv1.style.display==="")
			{
			
				inputDiv1.style.display="block";
				
				inputDiv3.style.display="none";
			}

		}


		    function changePlaceholder(arg1,arg2,arg3) {
            	
		    	 $.ajax({
                url:"get_name.php",
                method:"POST",
                data:{arg_2:arg3},
                success:function(response){
                   user_name(response);
                }
            });
		    	//alert(arg2);
		    	 function user_name(user){
                var inputElement = document.getElementById("myInput");
                var newPlaceholder = "Reply..to "+user;
                inputElement.placeholder = newPlaceholder;
                inputElement.focus();
            }

                const input =document.getElementById("btnChange");
                input.name = "rp-btn";

                var inputElement1=document.getElementById("cid");
                inputElement1.value= arg1;

               	var inputElement =document.getElementById('pd_id');
				inputElement.value=arg2;
               
           }
           
           function user_icon() {
           	var inputDiv1 = document.getElementById("uid2");
           	var inputDiv = document.getElementById("uid1");
           
	           	if(inputDiv1.style.display==="none"||inputDiv1.style.display==="")
				{
				
					inputDiv1.style.display="block";
					inputDiv.style.display="none";
					
				}
           }


			
			function usr_display() {
			          	// body...
			 	var inputDiv1 = document.getElementById("id_1");
          		var inputDiv = document.getElementById("id_2");
	           	if(inputDiv1.style.display==="none"||inputDiv1.style.display==="")
				{
				
					inputDiv1.style.display="block";
					inputDiv.style.display="none";
					
				}
           }   

           function user_btn(){
           	 document.getElementById('prpid').style.display='block';
           }    


           function resume(userId){
           	alert(userId);
           }
	
	</script>

</head>
<body>
	<div class="home">
		<div class="left">
		<div class="class-1"> 
			<img src="jlogo.jpg"><br>
			<label style="font-size: 20px; font-family:Georgia;">Pathways</label>
			<div class="class-2">
				<div class="class-1A"> 
					<div id="id1A">
						<?php 
			     				if(isset($pic_data)){
		     			 		 	echo "<img src='user/".$pic_data['image']."' width='100% ' height='100%'>";
		     			 		}else{
		     			 			echo "<img src='def.png'>";
		     			 		}

			     			?></div>
					<center><label><?php
						if(isset($name)){
							echo$name['user_name'];
						}else{
							echo"UserName";
						}

						?></label></center>
					
				</div>
				<div class="class-1AN">
						Have a Look..
				</div>
				<div class="class-2A">
					
					<?php //notice board people

					foreach($Rtags as $Ntp)
					{
						include("Notice.php");
					}

					?>

				</div>
			</div>
		</div>
		</div>
		<div class="right">
			<div class="class-3"> 
				<form>
			<input type="text" name="search" placeholder=" &#128269; Search Feed..." id="Search_tag" aria-label="Search">
			
			</form>
				<div class="class-3A" >
					<a href="hk.php" ><i class="fa-solid fa-house"></i></a>
					<a href="hk.php?type=placement"><i class="fa-solid fa-tv"></i></a>
					<a href="hk.php?type=sports"><i class="fa-solid fa-baseball"></i></a>
					<i class="fa-solid fa-user-tie" onclick="user_icon();" style="cursor:pointer;"></i>
				</div>
			</div>
			<div class="right-content">
				<div class="right-left">
					<div class="class-4" id="uid1">

							
						<?php
						  // posts are started here 

							if(isset($posts)){
				            	 foreach ($posts as $ROW) {

				            	
				            	 	include("item.php");
				            	 		            			
			                        }
				                }
			                  else{
			                  	 echo "NO POSTS ARE AVAILABLE...SORRY..";
			                  }

						?>

			     	</div>

			     	<div class="user-1" id="uid2">
			     		<div class="p1">
			     			<img src="sky.jpg"> 

	     				</div>
			     		<div class="p3">
			     			<div><?php 
			     				if(isset($pic_data)){
		     			 		 	echo "<img src='user/".$pic_data['image']."' width='100% ' height='100%'>";
		     			 		}else{
		     			 			echo "<img src='def.png'>";
		     			 		}

			     			?></div>
			     			<div class="e1">
			     				<label id="eid1"><?php
						if(isset($name)){
							echo$name['user_name'];
						}else{
							echo"UserName";
						}

						?></label><br>
			     				<div class="e2" >
			     					<form method="post" enctype="multipart/form-data">
			     					 <input type="file" name="my_image1" id="img1" accept="image/*"><label for="img1" style="cursor:pointer;" onclick="user_btn()">Update Dp</label> |
			     					<label id="edit_1" onclick="usr_display()" style="cursor:pointer;">Update Your Info</label> | <label onclick="remove_dp(<?php echo$u_code; ?>)" style="cursor: pointer;">Remove Dp</label> | <a href="Entry.php" style="color: inherit;text-decoration: none; "><label style="cursor: pointer;"  target="_self">log out</label></a>
			     				</div>
			     				<div class="e3"> 
			     					<div class="e4"><label><?php echo$red;?></label><label id="l2"><?php echo$red1;?></label><label id="l1"><?php echo$red2;?></label></div>
			     					<div class="e5"><label>Placements</label><label>Sports</label><label>Other</label>
			     						<button type="submit" name="prp-u" id="prpid">save</button>
			     						</form> 
			     					</div>
			     				</div>
			     			</div>
							
			     		</div>
			     		
			     		<div class="u_data" id="id_1">			     		
			     			 <center><label id="top" >..YOUR CAPABILITIES..</label></center>
			     			 <div class="p6">
			     			 	<form method="post">
			     			 	<label><b>BIO:</b></label>
			     			 	<textarea name="utxt1" id="urbio"></textarea>
			     			 	<div>
			     			 		<label><b>Qualifications:</b></label><br>
				     			 	<label id="p6id1">@Campus:</label>
				     			 	<input type="text" name="ucam2">
				     			 	<label id="y1" >@Course:</label>
				     			 	<input type="text" name="ucor3" id="y2">
				     			 	<label id="y3">@Percentage:</label>
				     			 	<input type="text" name="uper4" id="y4">
			     				 </div>
			     			 	<div class="y5">
			     			 		<label ><b>Skills:</b></label><br>
			     			 		<label id="p6id1">@Programming Languages:</label>
			     			 		<input type="text" name="upl5">
			     			 		<label id="y1" >@Web Languages:</label>
				     			 	<input type="text" name="uweb6" id="y2">
				     			 	<label id="y3">@Non-Technical:</label>
				     			 	<input type="text" name="unt7" id="y4">
			     			 	</div>

			     			 	<div class="y6">
			     			 		<label ><b>Certifications:</b></label><br>
			     			 		<textarea name="ucrt8"></textarea>
			     			 		<input type="hidden" name="ud_id" value="<?php echo$name['id'];?>">

				     		 	</div>
				     		 		<center><button type="submit" class="dd" name="u-btn">submit</button></center>

				     		 	</form>
			     			 </div>
			     		</div>

			     		<!-- <div class="user_info" id="id_2">
			     		
 			     		</div> -->

 			     		<div class="person-1" id="id_2">
							<div class="lt-1">
								<div class="person-2">
									<div class="usr-H">Profile's</div>
									<div class="usr-H1">

										<?php
										foreach ($row5 as $key1) {
											// code...
											include("user_profile.php");
										}

										?>
										
									</div>
									
								</div>

							</div>
							<div class="rt-1">
								<div class="person-3">
									<center><label id="top" >..STRENGTHS..</label></center>
									<div class="person-4">
										<label id="kt-1"><b>Bio:</b></label><br>
										<span id="prp-1" style="font-style: italic;"><?php
			     			 		if(isset($tdr)){
			     			 		  echo$tdr['bio'];
			     			 		}else{
			     			 			echo"share your bio";	
			     			 		}
			     			 	?></span>
									</div>
									<div class="person-4">
										<label id="kt-1"><b>Qualifications:</b></label><br>
										<label class="ty">@Campus:</label>
										<span id="prp-2" style="font-style: italic;"><?php 
						     			 		if(isset($tdr)){
						     			 		 	echo$tdr['campus'];
						     			 		}else{
						     			 			echo"Campus Details.";	
						     			 		}
			     			 			?></span><br>
										<label class="ty">@Course:</label>
										<span id="prp-3" style="font-style: italic;"><?php 
			     			 					if(isset($tdr)){
						     			 		 	echo$tdr['course'];
						     			 		}else{
						     			 			echo"Course Details.";	
						     			 		}?></span><br>
										<label class="ty">@Percentage:</label>
										<span id="prp-4" style="font-style: italic;"><?php 
			     			 					if(isset($tdr)){
						     			 		 	echo$tdr['percentage'];
						     			 		}else{
						     			 			echo"Course Percentage.";	
						     			 		}?></span>
									</div>
									<div class="person-4">
										<label id="kt-1"><b>Skills:</b></label><br>
										<label class="ty">@Programming Languages:</label>
										<span id="prp-5" style="font-style: italic;"><?php 
				     							 if(isset($tdr)){
						     			 		 	echo$tdr['p_languages'];
						     			 		}else{
						     			 			echo"Known Programming Languages";	
						     			 		}?></span><br>
										<label class="ty">@Web Technologies:</label>
										<span id="prp-6" style="font-style: italic;"><?php 
				     							 if(isset($tdr)){
						     			 		 	echo$tdr['w_languages'];
						     			 		}else{
						     			 			echo"Known Web Languages";	
						     			 		}?></span><br>
										<label class="ty" >@Non-Technical:</label>
										<span id="prp-7" style="font-style: italic;"><?php 
				     							 if(isset($tdr)){
						     			 		 	echo$tdr['non_technical'];
						     			 		}else{
						     			 			echo"Non-Technical Skills";	
						     			 		}?></span>
									</div>
									<div class="person-4">
										<label id="kt-1"><b>Certifications:</b></label><br>
										<span id="prp-8" style="font-style: italic;"><?php 
				     			 		if(isset($tdr)){
						     			 		 	echo$tdr['certifications'];
						     			 		}else{
						     			 			echo"Merit Certifications";	
						     			 		}?></span>
									</div>
								</div>

							</div>
 			     		</div>


			     	</div>

					<div class="class-5">

						<div class="left-text">
							<label id="feed" >Feed...</label>

							<br>
							<form method="post" enctype="multipart/form-data" >
								<div class="icons"><input type="file" name="my_image" id="img" accept="image/*"><label for="img"><i class="fa-regular fa-images"></i></label>
									 <input type="file" name="my_video" id="vid" accept="video/*"><label for="vid"><i class="fa-solid fa-video"></i></label></div>
								<textarea placeholder="Send us job leads.." id="post_info" name="txt1"></textarea>
							
						</div>
						<div class="right-text">
							
								
									 
									<button type="submit" name="post" id="main-btn"><i class="fa-solid fa-arrow-up"></i></button>
								</form>
							
					</div>
				</div>
</div>



				<div class="right-right">
				
					<div class="class-6Tag_div" id="post_data">
						<div class="class-6AH">
							<label>Tag Info...</label>
						</div>

						<div class="class-6AB" >

									
								<label id="tag_info" class="description">
								</label>

							<!--copy ends here-->
						</div>
					</div>


						<div class="class-6" id="comment_div" style="display:">
							<div class="class-6AH">
								<label>Comments..</label>
							</div>

							<div class="class-6AB" >
								<div class="C6AB-comment">
									
										
										<form method="post">
										
											<input type="hidden" name="pid" id="pd_id" value="">
											<input type="hidden" name="Cid"  id="cid"value="">
										<textarea id="myInput" placeholder="comment..." name="comment" ></textarea>
										<button type="submit" id="btnChange" name="cmt-btn"><i class="fa-solid fa-arrow-up"></i></button>
									</form>
									
								</div>
								<div class="cmt-body">
								  <?php 				
								       
					                  	foreach ($result as $row) {
					                  		// code...
					                  		 if (isset($_POST['rp-btn'])) {
     
					                                if (!empty(trim($_POST["comment"])))
					                                {
					                                  if (isset($_POST["comment"])){

					                                         $comment = $_POST["comment"];
					                                        
					                                        $c_id=$_POST['pid'];
					                                        $globalVar1=$_POST['Cid'];

					                                       $sql="insert into replies(user_id,post_id,comment_id,reply) values('$id1','$c_id','$globalVar1','$comment')";
					                                       mysqli_query($con,$sql);
					                                       $_POST['comment']=NULL;
					                                    }
					                                } 
					                            }	


											

					                  		if (isset($_GET['post_id'])) {
					                  			
    												$post_id = $_GET['post_id'];
							                  	if($row['post_id']==$post_id){

			                            			include("comment_id.php");
							                  	}
						                  }
                       				}
                       																				
                            	?>


                            	</div>
							</div>
						</div>


					</div>
			</div>
		</div>
		
	</div>
</body>
</html>