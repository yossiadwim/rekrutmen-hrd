
const slider_sikap_dan_besaran_dampak = document.querySelectorAll(".form-range-sikap-dan-besaran-dampak");
slider_sikap_dan_besaran_dampak.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-sikap-dan-besaran-dampak-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_sikap_dan_besaran_dampak = document.getElementById('range-sikap-dan-besaran-dampak-' + id);
    var output_sikap_dan_besaran_dampak = document.getElementById("label_bobot_sikap_dan_besaran_dampak-" + id);

    // Set the initial text based on the slider's value
    output_sikap_dan_besaran_dampak.innerHTML = slider_sikap_dan_besaran_dampak.value;

    // Update the text when the slider is moved
    slider_sikap_dan_besaran_dampak.oninput = function () {
        output_sikap_dan_besaran_dampak.innerHTML = this.value;
    };
}
