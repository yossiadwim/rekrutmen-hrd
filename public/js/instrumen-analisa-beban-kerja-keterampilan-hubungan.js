
const slider_keterampilan_hubungan = document.querySelectorAll(".form-range-keterampilan-hubungan");
slider_keterampilan_hubungan.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-keterampilan-hubungan-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_keterampilan_hubungan = document.getElementById('range-keterampilan-hubungan-' + id);
    var output_keterampilan_hubungan = document.getElementById("label_bobot_keterampilan_hubungan-" + id);

    // Set the initial text based on the slider's value
    output_keterampilan_hubungan.innerHTML = slider_keterampilan_hubungan.value;

    // Update the text when the slider is moved
    slider_keterampilan_hubungan.oninput = function () {
        output_keterampilan_hubungan.innerHTML = this.value;
    };
}