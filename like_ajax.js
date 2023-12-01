    function like_count(postID)
    {
        $.ajax({
                url:"likes.php",
                method:"POST",
                data:{postid:postID},
                success:function(response){
                     var postElement = $(".class-4P[data-postid='" + postID + "']");
                    postElement.find(".like_info").text(response);
                }
            });
}

