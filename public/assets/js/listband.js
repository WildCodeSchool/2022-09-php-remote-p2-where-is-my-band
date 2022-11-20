//provisoire en cours de réflexion
const message =
    "Merci d'avoir soumis votre message. Nous vous répondrons dès que possible.";

document
    .getElementById("contactForm")
    .addEventListener("submit", function (event) {
        event.preventDefault();
        alert(message);
    });
