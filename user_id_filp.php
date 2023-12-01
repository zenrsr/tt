<?php 
	session_start();
	include("connection.php");
	$uid = $_SESSION['id'];

	if(isset($_POST['post_id'])) {
		$postID = mysqli_real_escape_string($con, $_POST['post_id']); // Use mysqli_real_escape_string to prevent SQL injection
		$sql = "SELECT * FROM posts WHERE post_id='$postID' LIMIT 1";
		$res = mysqli_query($con, $sql);

		if($res) {
			$data = mysqli_fetch_assoc($res);

			if($data && $data['user_id'] == $uid) {
				echo 'true';
			} else {
				echo 'false';
			}
		} else {
			echo "Error in SQL query: " . mysqli_error($con);
		}
	} else {
		echo "Invalid request";
	}
?>
