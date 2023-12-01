// script.js
document.addEventListener("DOMContentLoaded", function() {
    const container = document.querySelector(".class-4");
    const posts = document.querySelectorAll(".class-4P");

    container.addEventListener("scroll", function() {
        posts.forEach((post) => {
            if (isElementInViewport(post, container)) {
                post.classList.add("appear");
            } else {
                post.classList.remove("appear");
            }
        });
    });

    function isElementInViewport(el, container) {
        const rect = el.getBoundingClientRect();
        const containerRect = container.getBoundingClientRect();
        return (
            rect.left >= containerRect.left && rect.right <= containerRect.right
        );
    }
});
