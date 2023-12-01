 <?php
 
 	include("connection.php");
	include("function.php");
 	class Post
 	{
 		private $error=" ";
 		public function create_post($userid,$data,$grade)
 		{
 			if (!empty($data) && !empty(trim($data))) 
 			{
 				$like=0;
 				$currentDate = date('Y-m-d H:i:s');
 				$timestamp = strtotime($currentDate);
     			$timestamp=$timestamp;   
				$con = mysqli_connect("localhost", "root", "", "pathways_db");
 				//$post=addslashes($data['post']);
				$postid=create_postid();
				 // Assuming $con is your mysqli connection

				$sql = "INSERT INTO posts (user_id, post_id, post, has_image, likes,stamp) VALUES (?, ?, ?, ?, ?,?)";

				$stmt = mysqli_prepare($con, $sql);

				// Assuming $userid, $postid, $data, $grade, and $like are your variables
				mysqli_stmt_bind_param($stmt, "ssssis", $userid, $postid, $data, $grade, $like,$timestamp);

				// Execute the statement
				mysqli_stmt_execute($stmt);

				// Close the statement
				mysqli_stmt_close($stmt);

 			}
 			else
 			{

 				$this->error ="Plese type something to post!<br>"; 

 			}
 			return $this->error;
 		}


 	public function get_posts()
 		{
 			$con = mysqli_connect("localhost", "root", "", "pathways_db");
			 if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
				// Get the search term from the AJAX request
				$searchTerm = $_GET['search'];
				$_GET['search']=null;
			
				// Modify the SQL query based on the search term
				$query = "SELECT * FROM posts WHERE post LIKE '%$searchTerm%' OR post_id IN (SELECT post_id FROM tags WHERE tag LIKE '%$searchTerm%') ORDER BY id DESC";
												
				$result = mysqli_query($con, $query);

				// You can save the modified query to a session variable or return it in the AJAX response
				// For this example, we'll just display a success message
		
			} else {
				if (isset($_GET['type'])) {
					$type = $_GET['type'];
					
					// Retrieve posts of the specified type from the database
					$sql = "SELECT * FROM posts WHERE pt_type = '$type' ORDER BY id desc";
					$result=mysqli_query($con,$sql);
				} else {
					// If 'type' parameter is not specified, retrieve all posts
					$sql = "SELECT * FROM posts ORDER BY id desc";
					$result=mysqli_query($con,$sql);
				}
				
			}


		    if($result)
		    {
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
 		}

 		//profile pic update code

 		public function user_pic($userid1,$data1){
 			$con = mysqli_connect("localhost", "root", "", "pathways_db");

 			 $str1="select *from users where user_id='$userid1' limit 1";
			    $ud3=mysqli_query($con,$str1);
			    $nam=mysqli_fetch_assoc($ud3);
			    $idr=$nam['id'];
 			if(!empty($data1))
 			{
 				$Exits=checkIfUserProfile($userid1);
 				if($Exits){

 					$sql2 = "UPDATE profile SET image = '$data1' WHERE user_id = '$userid1'";
					$rep1 = mysqli_query($con, $sql2);
        			
 				}else{

		 			$etr = "INSERT INTO profile (user_id, image, ud_id) VALUES (?, ?, ?)";
					$stmt = mysqli_prepare($con, $etr);

					// Assuming $userid1, $data1, and $idr are your variables
					mysqli_stmt_bind_param($stmt, "sss", $userid1, $data1, $idr);

					// Execute the prepared statement
					mysqli_stmt_execute($stmt);

					// Close the statement
					mysqli_stmt_close($stmt);

	 			}

 			}else
 			{

 				$this->error ="Plese type something to post!<br>"; 

 			}
 			return $this->error;

 		}

}
	if (isset($_POST['Back_btn'])) {
	   
	        if (!empty(trim($_POST["btxt1"])) && !empty(trim($_POST["btxt2"])))
	        {
	            if (isset($_POST["btxt1"]) && isset($_POST["btxt2"])) {
				    $type = $_POST['pt_typ'];
				    $tag1 = $_POST["btxt1"];
				    $tag2 = $_POST["btxt2"];
				    $u_id = $_SESSION["id"];
				    $pst_id = $_POST["BFD"];
				    $u1_id = $_POST["ud_id1"];
				    $Tager = checkIfTagExist($pst_id);

				    if ($Tager) {
				        $sqt = "delete from tags where post_id='$pst_id'";
				        $del = mysqli_query($con, $sqt);

				        if ($del) {
				            if (!empty($tag1) && !empty($tag2)) {
				                $query = "UPDATE posts SET pt_type = '$type' WHERE post_id = '$pst_id'";
				                mysqli_query($con, $query);

				                $sql = "INSERT INTO tags (user_id, post_id, pt_type, tag, tag_desc, u_id) VALUES (?, ?, ?, ?, ?, ?)";

								$stmt = mysqli_prepare($con, $sql);

								// Assuming $u_id, $pst_id, $type, $tag1, $tag2, and $u1_id are your variables
								mysqli_stmt_bind_param($stmt, "ssssss", $u_id, $pst_id, $type, $tag1, $tag2, $u1_id);

								// Execute the prepared statement
								mysqli_stmt_execute($stmt);

								// Close the statement
								mysqli_stmt_close($stmt);

				            }
				        }
				    } else {
				        if (!empty($tag1) && !empty($tag2)) {
				            $query = "UPDATE posts SET pt_type = '$type' WHERE post_id = '$pst_id'";
				            mysqli_query($con, $query);

				           $sql = "INSERT INTO tags (user_id, post_id, pt_type, tag, tag_desc, u_id) VALUES (?, ?, ?, ?, ?, ?)";

						$stmt = mysqli_prepare($con, $sql);

						// Assuming $u_id, $pst_id, $type, $tag1, $tag2, and $u1_id are your variables
						mysqli_stmt_bind_param($stmt, "ssssss", $u_id, $pst_id, $type, $tag1, $tag2, $u1_id);

						// Execute the prepared statement
						mysqli_stmt_execute($stmt);

						// Close the statement
						mysqli_stmt_close($stmt);

				        }
				    }
				}

	        }  
	    }


	  //storing the resume content in database


	if (isset($_POST['u-btn'])) {
    if (isset($_SESSION["id"])) {
        $bio1 = $_POST['utxt1'];
        $cam2 = $_POST['ucam2'];
        $cor3 = $_POST['ucor3'];
        $per4 = $_POST['uper4'];
        $pl5 = $_POST['upl5'];
        $web6 = $_POST['uweb6'];
        $nt7 = $_POST['unt7'];
        $crt8 = $_POST['ucrt8'];
        $ud1 = $_SESSION["id"];
        $ud_id=$_POST['ud_id'];

        // Check if the user has a resume
        $Resume = checkIfUserResume($ud1);

        if ($Resume) {
            // Delete the existing resume
            $sql9 = "DELETE FROM resume WHERE user_id = ?";
            $stmt = $con->prepare($sql9);
            $stmt->bind_param("i", $ud1);
            $stmt->execute();
            $stmt->close();
        }

        // Insert the new resume
       if (
		    !empty(trim($bio1)) &&
		    !empty(trim($cam2)) &&
		    !empty(trim($cor3)) &&
		    !empty(trim($per4)) &&
		    !empty(trim($pl5)) &&
		    !empty(trim($web6)) &&
		    !empty(trim($nt7)) &&
		    !empty(trim($crt8)) &&
		    !empty(trim($ud1))
		) {
            $sqt = "INSERT INTO resume (user_id, bio, campus, course, percentage, p_languages, w_languages, non_technical, certifications, u_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sqt);
            $stmt->bind_param("issssssssi", $ud1, $bio1, $cam2, $cor3, $per4, $pl5, $web6, $nt7, $crt8,$ud_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}



