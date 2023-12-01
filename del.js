function delete_icon(post_id) {
  //s  alert(post_id);

    var result = window.confirm("Confirm: Do you want to delete?");
    var post = document.getElementById(post_id);

    if (result) {
        $.ajax({
            url: "delete_post.php",
            method: "POST",
            data: { delete_id: post_id },
            success: function (response) {
                if (response === 'true') {
                     window.location.href = window.location.href;
                } else {
                    alert("Error: Unable to delete the post.");
                }
            },
            error: function () {
                alert("Error: Unable to communicate with the server.");
            }
        });
    }
}
