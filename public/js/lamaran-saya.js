
window.addEventListener("load", function () {
    const loader = document.querySelector(".loader-wrapper");
    const content = document.querySelector(".content");

    // Hide the loader
    loader.style.display = "none";

});


document.addEventListener('DOMContentLoaded', function () {
    // Replace 'your_id_here' with the dynamic ID you want to use
    const application_form_link = document.getElementsByClassName("link-application-form");
    for (let index = 0; index < application_form_link.length; index++) {
        const slug = application_form_link[index].getAttribute('data-pk-id');
        getID(slug);
    }

});

function getID(id) {
    // Use the 'id' parameter to create the dynamic button ID
    var button = document.getElementById('button-link-application-form-' + id);

    if (button) {
        button.addEventListener('click', function () {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function () {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';

            }, 2500);
        });
    }
}