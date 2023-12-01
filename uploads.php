<?php

if (isset($_FILES['my_image'])){
    $obj=new Post();
    $image = $_FILES['my_image'];
    if (is_uploaded_file($image['tmp_name'])) {
        $imageFilename = $image['name'];
        $imageTmpName = $image['tmp_name'];

        $uploadsDir = 'uploads/';
        $grade=0;
       // $post_type=$_POST['pt_ty'];
        move_uploaded_file($imageTmpName, $uploadsDir . $imageFilename);
        $result=$obj->create_post($_SESSION["id"],$imageFilename,$grade);
    }
}
if (isset($_FILES['my_video'])) {
    $obj=new Post();
    $video = $_FILES['my_video'];
    if (is_uploaded_file($video['tmp_name'])) {
        $videoFilename = $video['name'];
        $videoTmpName = $video['tmp_name'];

        $uploadsDir = 'uploads/';
        move_uploaded_file($videoTmpName, $uploadsDir . $videoFilename);
        $grade=1;
       // $post_type=$_POST['pt_ty'];
        $result=$obj->create_post($_SESSION["id"],$videoFilename,$grade);
    }
}
	if(!empty($_POST['txt1']))
	{
	    $obj=new Post();
	    $data=$_POST['txt1'];
	    $grade=2;
	  //  $post_type=$_POST['pt_ty'];
	    $result=$obj->create_post($_SESSION['id'],$data,$grade);
	}

//profile pic storage unit
    if (isset($_FILES['my_image1'])){
    $obj=new Post();
    $image = $_FILES['my_image1'];
    if (is_uploaded_file($image['tmp_name'])) {
        $imageFilename = $image['name'];
        $imageTmpName = $image['tmp_name'];

        $uploadsDir = 'user/';
      
       // $post_type=$_POST['pt_ty'];
        move_uploaded_file($imageTmpName, $uploadsDir . $imageFilename);
        $result=$obj->user_pic($_SESSION["id"],$imageFilename);
    }
}
