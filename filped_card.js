document.addEventListener("DOMContentLoaded", function() {
  var flipButtons = document.querySelectorAll('.flip-button');

  flipButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var postId = button.getAttribute('data-post-id');     
      var post = document.getElementById(postId);
      
      checkUserData(postId, post);
    });
  });
});

function checkUserData(postID, post) {
	
  $.ajax({
    url: "flip.php",
    method: "POST",
    data: { id: postID }, 
    success: function (response) {
   
      if(response==='true') {
        var flipCardInner = post.querySelector('.flip-card-inner');
        if (flipCardInner.style.transform === "rotateY(180deg)") {
          flipCardInner.style.transform = "rotateY(0deg)";
        } else {
          flipCardInner.style.transform = "rotateY(180deg)";
        }
      } else {
        alert("You are not authorized to access.Sorry...");
      }

    
  }
   });
}
