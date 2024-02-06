
document.getElementById('button-unggah').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});

window.addEventListener("load", function() {
    const loader = document.querySelector(".loader-wrapper");
    const content = document.querySelector(".content");

    // Hide the loader
    loader.style.display = "none";

});