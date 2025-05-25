document.getElementById("years_before").textContent = "2015 - ";
document.getElementById("corrent_year").textContent = new Date().getFullYear();

const footer = document.getElementById("footer");
footer.addEventListener("mouseover", function() {
    footer.style.backgroundColor = "darkgrey";
    footer.style.color = "brown";
});
footer.addEventListener("mouseout", function() {
    footer.style.backgroundColor = "black";
    footer.style.color = "white";
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const errorBox = document.getElementById("ErrorMassage");

    if (form) {
        form.addEventListener("submit", function(event) {
            let error = false;
            let e_massage = '';
            errorBox.innerHTML = '';

            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (name.length === 0) {
                error = true;
                e_massage = '<div class="alert alert-danger">Name is required.</div>';
            } else if (!emailRegex.test(email)) {
                error = true;
                e_massage = '<div class="alert alert-danger">The email is not valid.</div>';
            } else if (message.length < 10) {
                error = true;
                e_massage = '<div class="alert alert-danger">Message is too short.</div>';
            }

            if (error) {
                event.preventDefault();
                errorBox.innerHTML = e_massage;
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
