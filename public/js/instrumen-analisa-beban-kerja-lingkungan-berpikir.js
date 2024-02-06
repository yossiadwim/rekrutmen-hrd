
const slider_lingkungan_berpikir = document.querySelectorAll(".form-range-lingkungan-berpikir");
slider_lingkungan_berpikir.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-lingkungan-berpikir-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_lingkungan_berpikir = document.getElementById('range-lingkungan-berpikir-' + id);
    var output_lingkungan_berpikir = document.getElementById("label_bobot_lingkungan_berpikir-" + id);

    // Set the initial text based on the slider's value
    output_lingkungan_berpikir.innerHTML = slider_lingkungan_berpikir.value;

    // Update the text when the slider is moved
    slider_lingkungan_berpikir.oninput = function () {
        output_lingkungan_berpikir.innerHTML = this.value;
    };
}
