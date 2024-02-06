
const slider_tingkat_kebebasan_bertindak = document.querySelectorAll(".form-range-tingkatan-kebebasan-bertindak");
slider_tingkat_kebebasan_bertindak.forEach(function (slider) {
    const sliderId = slider.getAttribute("id").replace("range-tingkatan-kebebasan-bertindak-", "");
    getID(sliderId);
})

function getID(id) {
    var slider_tingkat_kebebasan_bertindak = document.getElementById('range-tingkatan-kebebasan-bertindak-' + id);
    var output_tingkatan_kebebasan_bertindak = document.getElementById("label_bobot_tingkatan_kebebasan_bertindak-" + id);

    // Set the initial text based on the slider's value
    output_tingkatan_kebebasan_bertindak.innerHTML = slider_tingkat_kebebasan_bertindak.value;

    // Update the text when the slider is moved
    slider_tingkat_kebebasan_bertindak.oninput = function () {
        output_tingkatan_kebebasan_bertindak.innerHTML = this.value;
    };
}
