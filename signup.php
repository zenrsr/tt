<?php
	session_start();
	include("connection.php");
	include("function.php");
	$data3="";
	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		//Something was posted
		$user1=$_POST['user'];
		$email=$_POST['email'];
		$password_1 =  $_POST['password_1'];
  		$password_2 =  $_POST['password_2'];

  		//create by the php
  		
  		$userid=create_userid();
  		$url_address= $email;
		 if($password_1 != $password_2) {
			$data3= "The two passwords do not match";
 		 }
 		$password =md5($password_1);//encrypt the password before saving in the database
 		//echo $email;
 		//echo $password;
			
 		if (!empty($user1) && !is_numeric($user1)  && preg_match('/^[a-zA-Z]/', $user1))
 			{
				if (!empty(trim($email)) && !empty(trim($password)))
				{
					$query="select * from users where email= '$email' or user_name='$email' limit 1";
					$result=mysqli_query($con,$query);
					if($result)
					{
						if($result && mysqli_num_rows($result)==0)
						{

							//save to database
							$sql="insert into users (user_id,email,password,user_name) values('$userid','$email','$password_1','$user1')";
							mysqli_query($con,$sql);
							header("Location:Entry.php");
							die;
						}else{
							$data3="Sorry this email is already registred..";
						}
					}
				}else
				{
					$data3= "please enter some valid information..";
				}
			
			}else{
				$data3="username starts with letter only..";
			}

 		
 	}	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="wel1.css">
	<title>signup</title>
	<script src="https://kit.fontawesome.com/cae14f18b4.js" crossorigin="anonymous"></script>
	<script>
        function validateForm() {
            var user_name = document.getElementById("user_name").value;
            var password = document.getElementById("password").value;
            var retype_password = document.getElementById("retype_password").value;
            var email = document.getElementById("email").value;
            if (!user_name || !password || !retype_password || !email) {
			  alert("Error: Please fill in all required fields.");
			} 
        
            // Check if the passwords match
            if (password !== retype_password) {
                alert("The two passwords do not match.");
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
</head>
<body>
	<div class="class-1">
		<div class="left-left">
			<div class="class-2">
				<div class="l12">
				<img src="jlogo.jpg">
				<label>Pathways</label></div>
				<div class="class-4">
				<center><img src="jlogo.jpg"></center>
				<label>Welcome</label>
				<div class="class-7"><?php echo$data3 ?></div>
					<div class="class-5">
						<form method="post" onsubmit="return validateForm();">
							<i class="fa-solid fa-user"></i>
							<input type="text"  placeholder="username.." name="user" id="user_name"><br>
							<i class="fa-solid fa-unlock"></i>
							<input type="password"  placeholder="password" name="password_1" id="password"><br>
							<i class="fa-solid fa-unlock"></i>
							<input type="password" placeholder="Re-enter-password" name="password_2" id="retype_password">
							<br>
							<i class="fa-solid fa-envelope"></i>
							<input type="email"  placeholder="email.." name="email" id="email">
							<input type="submit"  id="s_btn">
					</form>
					</div>
				</div>
			</div>
		</div>
		<div class="right-right">
			<div class="class-3">
				<a href="Entry.php"><label id="ld1">login</label></a>
			</div>
		</div>
	</div>
</body>
</html>