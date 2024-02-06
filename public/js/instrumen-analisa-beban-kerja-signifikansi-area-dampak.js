
const slider_signifikansi_area_dampak = document.querySelectorAll(".form-range-signifikansi-area-dampak");
slider_signifikansi_area_dampak.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-signifikansi-area-dampak-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_signifikansi_area_dampak = document.getElementById('range-signifikansi-area-dampak-' + id);
    var output_signifikansi_area_dampak = document.getElementById("label_bobot_signifikansi_area_dampak-" + id);

    // Set the initial text based on the slider's value
    output_signifikansi_area_dampak.innerHTML = slider_signifikansi_area_dampak.value;

    // Update the text when the slider is moved
    slider_signifikansi_area_dampak.oninput = function () {
        output_signifikansi_area_dampak.innerHTML = this.value;
    };
}
