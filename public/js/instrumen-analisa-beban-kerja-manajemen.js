

const sliders_manajemen = document.querySelectorAll(".form-range-manajemen");
sliders_manajemen.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-manajemen-", "");
    getID(sliderId);
})

function getID(id) {
    var sliders_manajemen = document.getElementById('range-manajemen-' + id);
    var output_manajemen = document.getElementById("label_bobot_manajemen-" + id);

    // Set the initial text based on the slider's value
    output_manajemen.innerHTML = sliders_manajemen.value;

    // Update the text when the slider is moved
    sliders_manajemen.oninput = function () {
        output_manajemen.innerHTML = this.value;
    };
}