document.getElementById("years_before").textContent = "2015 - ";
document.getElementById("current_year").textContent = new Date().getFullYear();

const footer = document.getElementById("footer");
footer.addEventListener("mouseover", function () {
    footer.style.backgroundColor = "white";
    footer.style.color = "black";
});
footer.addEventListener("mouseout", function () {
    footer.style.backgroundColor = "black";
    footer.style.color = "white";
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const errorBox = document.getElementById("ErrorMessage");

    if (form) {
        form.addEventListener("submit", function (event) {
            let errors = [];
            errorBox.innerHTML = '';

            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (name.length < 4) {
                errors.push("Name is too short.");
            }
            if (!emailRegex.test(email)) {
                errors.push("The email is not valid.");
            }
            if (message.length < 10) {
                errors.push("Message is too short.");
            }

            if (errors.length > 0) {
                event.preventDefault();
                errorBox.innerHTML = errors.map(err => `<div class="alert alert-danger">${err}</div>`).join('');
            }
        });
    }

    const dropdown = document.getElementById("serviceDropdown");
    if (dropdown) {
        const cards = Array.from(document.querySelectorAll(".card"));

        dropdown.addEventListener("change", function () {
            const selected = dropdown.value.toLowerCase();

            cards.forEach(card => {
                const content = card.innerText.toLowerCase();
                const matches = selected === "" || content.includes(selected);
                card.parentElement.style.display = matches ? "block" : "none";
            });
        });
    }
});
