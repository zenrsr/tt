$(document).ready(function () {
    $(".des_tag").on("click", function () {
        var postID = $(this).closest(".class-4P").data("postid");
      // alert(postID);
        $.ajax({
            url: "get_description.php",
            method: "GET",
            data: { postid: postID },
            success: function (response) {
               

                // Extract the URL and link text from the response
                var matches = response.match(/<a.*?href=['"](.*?)['"].*?>(.*?)<\/a>/ig);

                if (matches) {
                    for (var i = 0; i < matches.length; i++) {
                        var match = matches[i].match(/<a.*?href=['"](.*?)['"].*?>(.*?)<\/a>/i);

                        if (match && match.length >= 3) {
                            var url = match[1];
                            var linkText = match[2];

                            // Update each link with the actual URL
                            response = response.replace(matches[i], "<a href='" + url + "' target='_blank'>" + linkText + "</a>");
                        }
                    }

                    // Append the modified content to the description element
                    $(".description").html(response);
                  
                } else {
                    console.error("Failed to extract link and link text from response.");

                    // If no links are found, just append the original response
                   $(".description").html(response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("AJAX error:", textStatus, errorThrown);
            }
        });
    });
});
