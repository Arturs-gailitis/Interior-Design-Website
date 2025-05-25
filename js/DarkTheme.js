const darkModeToggle = document.getElementById("darkModeToggle");
const body = document.body;

darkModeToggle.addEventListener("click", () => {
    body.classList.toggle("dark-mode");
    document.querySelector("nav").classList.toggle("dark-mode");
    document.querySelector("footer").classList.toggle("dark-mode");
    document.querySelectorAll(".card").forEach(card => card.classList.toggle("dark-mode"));
    darkModeToggle.classList.toggle("btn-dark");
    darkModeToggle.classList.toggle("btn-light");
    localStorage.setItem("darkMode", body.classList.contains("dark-mode"));
});

if (localStorage.getItem("darkMode") === "true") {
    body.classList.add("dark-mode");
    document.querySelector("nav").classList.add("dark-mode");
    document.querySelector("footer").classList.add("dark-mode");
    document.querySelectorAll(".card").forEach(card => card.classList.add("dark-mode"));
    darkModeToggle.classList.replace("btn-light", "btn-dark");
}