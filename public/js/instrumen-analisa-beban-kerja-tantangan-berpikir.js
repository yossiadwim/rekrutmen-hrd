
const slider_tantangan_berpikir = document.querySelectorAll(".form-range-tantangan-berpikir");
slider_tantangan_berpikir.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-tantangan-berpikir-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_tantangan_berpikir = document.getElementById('range-tantangan-berpikir-' + id);
    var output_tantangan_berpikir = document.getElementById("label_bobot_tantangan_berpikir-" + id);

    // Set the initial text based on the slider's value
    output_tantangan_berpikir.innerHTML = slider_tantangan_berpikir.value;

    // Update the text when the slider is moved
    slider_tantangan_berpikir.oninput = function () {
        output_tantangan_berpikir.innerHTML = this.value;
    };
}
