document.addEventListener("DOMContentLoaded", function () {
    const toggler = document.querySelector(".navbar-toggler");
    const navMenu = document.getElementById("navbarNav");

    if (toggler && navMenu) {
        toggler.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }
});