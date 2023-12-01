function getUserDetails(userId) {
  // alert(userId);
    $.ajax({
        url: "profile_data.php",
        method: "POST",
        data: { user_id: userId }, 
        success: function (response) {
           
            displayUserDetails(response);
        }
    });
}

function displayUserDetails(user) {
   
   document.getElementById('prp-1').innerText=user.bio;
   document.getElementById('prp-2').innerText=user.campus;
   document.getElementById('prp-3').innerText=user.course;
   document.getElementById('prp-4').innerText=user.percentage;
   document.getElementById('prp-5').innerText=user.p_languages;
   document.getElementById('prp-6').innerText=user.w_languages;
   document.getElementById('prp-7').innerText=user.non_technical;
   document.getElementById('prp-8').innerText=user.certifications;
}
