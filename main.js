document.addEventListener("DOMContentLoaded", function () {
    const categories = document.querySelectorAll(".categories .category");
    const showMoreBtn = document.getElementById("show-more-btn");
    let expanded = false;

    showMoreBtn.addEventListener("click", function () {
        if (!expanded) {
            categories.forEach(cat => cat.style.display = "block"); // Show all categories
            showMoreBtn.textContent = "Show Less";
        } else {
            categories.forEach((cat, index) => {
                if (index >= 8) cat.style.display = "none"; // Hide extra categories
            });
            showMoreBtn.textContent = "Show More";
        }
        expanded = !expanded;
    });
});

document.addEventListener("DOMContentLoaded", function() {
    let text = "Karaksooq empowers you to sell anything effortlessly.Buy and sell with ease, anytime, anywhere.Experience seamless online marketplace!";
    let typingText = document.getElementById("typing-text");
    let index = 0;

    function typeText() {
        if (index < text.length) {
            typingText.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeText, 50);
        }
    }

    typeText();
});