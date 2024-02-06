
const sliders = document.querySelectorAll(".form-range-pendidikan");

sliders.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-pendidikan-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_pendidikan = document.getElementById('range-pendidikan-' + id);
    var output = document.getElementById("label_bobot_pendidikan-" + id);

    // Set the initial text based on the slider's value
    output.innerHTML = slider_pendidikan.value;

    // Update the text when the slider is moved
    slider_pendidikan.oninput = function () {
        output.innerHTML = this.value;
    };
}

