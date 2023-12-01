<?php
	session_start();
	include("connection.php");
	include("function.php");

	if($_SERVER['REQUEST_METHOD']== "POST")
	{
		//Something was posted
		$email=$_POST['email'];
		$password_1 =  $_POST['password_1'];
  		$password_2 =  $_POST['password_2'];
        if($password_1 != $password_2) {
			echo "The two passwords do not match";
 		 }
         else{
            if(!empty($email) && !empty($password_1) && !empty($password_2))
            {
                //save to database.

                $query="select *from users where email= '$email' limit 1";
                $result=mysqli_query($con,$query);
                if($result)
                {
                    if($result && mysqli_num_rows($result)>0)
                    {
                        $user_data=mysqli_fetch_assoc($result);
                        if($user_data['email']=== $email)
                        {
                            $sql="update users set password='$password_1' where email='$email'";
                            mysqli_query($con,$sql);
                            header("Location:login1.php");
                            die;
                        }
                    }
                    else
                    {
                        echo "please enter valid email.";
                    }
                }
                else
                {
                    echo "Wrong email or password.";
                }

            }
            else
            {
                echo "Wrong email or password.";
            }
        }   
	}
?>
<html>
    <head>
        <title>forgot</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body id="signup-body" style="background: url(forgot.jpg); background-size: cover; background-position: center;">
	<img src="logo3.png" class="logo">
	<div id="signup-box">
        <p>Recover Your Account</p>
        <form id="login-form" method="post">
            <label>Enter your email address</label><br>
            <input type="email" name="email" placeholder="you@gmail.com" class="text-box" required><br>
            <label>Password</label><br>
            <input type="password" name="password_1" placeholder="Your Password" class="text-box" required>
            <label>Re-enter Password</label><br>
            <input type="password" name="password_2" placeholder="Confirm your password" class="text-box" required>
            <input type="checkbox">I've read and agree to the <label class="sp">terms of services</label><br>
            <input  type="submit" value="change password" class="sign-in-btn">

        </form>
    </div>
    <p class="sin2">If password Remember?<a href="login1.php">Sign in</a></p>

</body>
</html>