document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("contactForm");
    const errorBox = document.getElementById("ErrorMassage");

    if (form) {
        form.addEventListener("submit", function(event) {
            let error_hapened = false;
            let error_massage = '';
            errorBox.innerHTML = '';

            const user_name = document.getElementById("name").value.trim();
            const user_email = document.getElementById("email").value.trim();
            const user_message = document.getElementById("message").value.trim();
            const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            if (user_name.length < 5) {
                error_hapened = true;
                error_massage = '<div class="alert alert-danger">Name is required or it is to short.</div>';
            } else if (!emailRegex.test(user_email)) {
                error_hapened = true;
                error_massage = '<div class="alert alert-danger">The email is not in correct form.</div>';
            } else if (user_message.length < 10) {
                error_hapened = true;
                error_massage = '<div class="alert alert-danger">Message is too short.</div>';
            }

            if (error_hapened) {
                event.preventDefault();
                errorBox.innerHTML = error_massage;
            }
        });
    }
});