

const sliders_pengalaman = document.querySelectorAll(".form-range-pengalaman");
sliders_pengalaman.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-pengalaman-", "");
    getID(sliderId);
})

function getID(id) {
    var sliders_pengalaman = document.getElementById('range-pengalaman-' + id);
    var output_pengalaman = document.getElementById("label_bobot_pengalaman-" + id);

    // Set the initial text based on the slider's value
    output_pengalaman.innerHTML = sliders_pengalaman.value;

    // Update the text when the slider is moved
    sliders_pengalaman.oninput = function () {
        output_pengalaman.innerHTML = this.value;
    };
}