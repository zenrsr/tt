  <?php 
	include("connection.php");
	function check_login($con)
	{
		if(isset($_SESSION['email']))
		{
			$id=$_SESSION['email'];
			$query="select *from user where email='$id' limit 1";
			$result=mysqli_fetch($con,$query);
			if($result && mysqli_num_rows($result)>0)
			{
				$user_data=mysqli_fetch_assoc($result);
				return $user_data;
			}
		}
		header("Location:login1.php");
		die;
	}
	function create_userid()
  		{
  			$length=rand(4,19);
  			$number="";
  			for($i=0;$i<$length;$i++)
  			{
  				$new_rand=rand(0,9);
  				$number=$number.$new_rand;
  			}
  			return $number;
  		}
		function create_postid()
		  {
			  $length=rand(4,19);
			  $number="";
			  for($i=0;$i<$length;$i++)
			  {
				  $new_rand=rand(0,9);
				  $number=$number.$new_rand;
			  }
			  return $number;
		  }
		  
  	function get_user($id)
  	{
  		$con = mysqli_connect("localhost", "root", "", "pathways_db");

  		$query="select * from users where user_id='$id' limit 1";
  		$result=mysqli_query($con,$query);

		if($result && mysqli_num_rows($result)>0)
    	{

    		//$data =mysqli_fetch_assoc($result);

		    if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
    	}
  	}
  	function getReplies($val,$parent_id=0,$user_nam,$level=1)
	{
		
			if ($val['comment_id'] == $parent_id) {
			    echo '<div style="margin-left: ' . 20 . 'px; font-size:' . 15 . 'px;">';
			    echo '<p style="color:#ffffff">' . $val['reply'] . '<label style="color:#000000;font-size:19px;font-family:Georgia">  --'. $user_nam . '</label></p>';
			    echo '</div>';
			}		
	}

	//checking if user alredy liked or not

	function checkIfUserLikedPost($post_id, $user_id) {
		$con = mysqli_connect("localhost", "root", "", "pathways_db");
		$sql1="select *from likes where u_id='$post_id' and user_id='$user_id'";
    	$res1=mysqli_query($con,$sql1);
    	  if ($res1 && mysqli_num_rows($res1) > 0) {
        
		        return true;
		    } else {
		
		        return false;
		    }

	}

	//checking if user already uploaded or not
	function checkIfUserProfile($user_id) {
		$con = mysqli_connect("localhost", "root", "", "pathways_db");
		$sql1="select *from profile where user_id='$user_id'";
    	$res1=mysqli_query($con,$sql1);
    	  if ($res1 && mysqli_num_rows($res1) > 0) {
        
		        return true;
		    } else {
		
		        return false;
		    }

	}


	//checking if user already uploaded or not
	function checkIfUserResume($user_id) {
		$con = mysqli_connect("localhost", "root", "", "pathways_db");
		$sql5="select *from resume where user_id='$user_id'";
    	$res5=mysqli_query($con,$sql5);
    	  if ($res5 && mysqli_num_rows($res5) > 0) {
        
		        return true;
		    } else {
		
		        return false;
		    }

	}

	//checking if tag already uploaded or not
	function checkIfTagExist($pst_id) {
		$con = mysqli_connect("localhost", "root", "", "pathways_db");
		$sql5="select *from tags where post_id='$pst_id'";
    	$res5=mysqli_query($con,$sql5);
    	  if ($res5 && mysqli_num_rows($res5) > 0) {
        
		        return true;
		    } else {
		
		        return false;
		    }

	}
?>