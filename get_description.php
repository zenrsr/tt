<?php
include("connection.php");

if(isset($_GET['postid'])){
    $postID=$_GET['postid'];

    

    $query="select *from tags where u_id= '$postID'";
            $result=mysqli_query($con,$query);
            if($result)
            {
                foreach($result as $data){
                if($data)
                {
                    $content = $data['tag_desc'];

                      $url_pattern = '/\b(?:https?:\/\/(?:www\.)?|www\.)[^\s<>\[\]]+\b/i';


                    // Replace URLs with anchor tags
                   $modified_content = preg_replace_callback($url_pattern, function($matches) {
                        $url = $matches[0];
                        return "<a href='$url' target='_blank'>$url</a>";
                    }, $content);

                    // Send the modified content back to the client
                    echo $modified_content;


                        
                }else{
                        echo"Submit Description about post...";
                }
            }
            }
            else{
                echo"Submit Content about post";
            }
    }
    else{
            echo"invalid request";
        }
?>