<?php
    session_start();
// Connect to your database
include("function.php");
include("connection.php");
$like=1;
if (!isset($_SESSION['id'])) {
    echo "sorry..";
    exit;
}
if (isset($_POST['postid'])) {
    $postId = $_POST['postid'];  

    // Check if the user has already liked the content.
     $user_id = $_SESSION['id'];
     $liked = checkIfUserLikedPost($postId, $user_id);
     if($liked){
        $sql2="delete from likes where u_id='$postId'";
        $rep1=mysqli_query($con,$sql2);
        $sql="update posts set likes=likes-1 where id='$postId'";
        $rep=mysqli_query($con,$sql);
     }else{

        $sql2="insert into likes (user_id,u_id,likes)values('$user_id','$postId','$like')";
        $rep1=mysqli_query($con,$sql2);
         $sql="update posts set likes=likes+1 where id='$postId'";
        $rep=mysqli_query($con,$sql);
     }


    // Update the likes count for the post
    $sql1="select likes from posts where id='$postId' limit 1";
    $res1=mysqli_query($con,$sql1);
    $data=mysqli_fetch_assoc($res1);
    echo $data['likes'];
}
?>
