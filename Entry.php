<?php
	session_start();
	include("connection.php");
	include("function.php");

	if($_SERVER['REQUEST_METHOD']== "POST")
	{

		$email=$_POST['email'];
		$password=$_POST['password'];
 	
		if(!empty($email) && !empty($password))
		{
		

			$query="select * from users where email= '$email' or user_name='$email' limit 1";
			$result=mysqli_query($con,$query);
			if($result)
			{
				if($result && mysqli_num_rows($result)>0)
				{
					$user_data=mysqli_fetch_assoc($result);
					if($user_data['password']=== $password)
					{
						$_SESSION['id']=$user_data['user_id'];
						$_SESSION['email']= $user_data['email'];
					
						header("Location:hk.php");
						die;
					}
					else{
						 $error_message = 'Wrong email or password.';
					}
				}
				else{
					 $error_message = 'User Not Registered Sorry.';
				}
			}
			else
			{
				echo '<div class="error-message">Invalid Query.</div>';
			}
		}
		else
		{

			 $error_message = 'Email or Password is Empty.';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="wel1.css">
	 <script src="https://kit.fontawesome.com/cae14f18b4.js" crossorigin="anonymous"></script>
	 <style>
    .error-message {
    	width: 300px;
    	height: 15px;
    	
        color: red;
        font-size: 16px;
        margin-top: 10px;
		text-align:center;		
		justify-content: center;
		position: relative;
		left: 440px;
		bottom: 45px;

    }
	 </style>
		<script>
    function validateForm() {
        var email = document.forms["loginForm"]["email"].value;
        var password = document.forms["loginForm"]["password"].value;

        
        if (email === "") {
            alert("Email must be filled out");
            return false;
        }

        
        if (password === "") {
            alert("Password must be filled out");
            return false;
        }
    }
</script>

	
</head>
<body>
	<div class="l1">
		<div class="pl1">
			<div class="left">
			<div class="l12" >
				<img src="jlogo.jpg">
				<label>Pathways</label>
				<div class="error-message"><?php if (isset($error_message)){ echo $error_message;
				} ?></div>

			</div>
		</div>
		<div class="right">
				<div class="l3"><a href="signup.php"><label id="ld1"  target="_self">signup</label></a></div>
		</div>
		</div>


		<center><div class="l2">
			<div class="right1">
				<div class="l4">
					<div class="l41">
						<label>Join the club</label></div>
						<div class="l42">
							Pathways it way to your career..give all facilities to reach your dream faster..
						</div>	
						<div class="l43">
							<div id="id3"><i class="fa-solid fa-house"></i>
							<label id="id1">User Updates</label>
						<p>	Provide user information and skills</p></div>
						</div>
						<div class="l43">
							<div id="id2"><i class="fa-solid fa-baseball"></i>
							<label id="id1">Sports</label>
						<p>	Provide all sports updates</p></div>
						</div>
						<div class="l43">
							<i class="fa-solid fa-tv"></i>
							<label id="id1">Placement</label>
						<p>	Provide latest job opportunities</p>
						</div>
						
					</div>
			</div>
			<div class="left">
				<div class="l5">
				<form method="post" onsubmit="return validateForm()" name="loginForm">

					<center><img src="jlogo.jpg"></center>
					<label id="id4">Welcome</label>	
					<p id="id5">Join the gazillions of people online</p>
					<div class="l6">
						<i class="fa-solid fa-user"></i>
						<input type="text" name="email" placeholder="email or username.." id="entry1"><br>
						<i class="fa-solid fa-unlock"></i>
						<input type="password" name="password" placeholder="password" id="entry2">
						<input type="submit" name="lg-btn" id="lbtn">
					</div>
				</form>

				</div>
			</div>
		</div></center>
	</div>
</body>
</html>