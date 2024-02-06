document.getElementById('filter').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});


document.addEventListener('DOMContentLoaded', function() {
    // Replace 'your_id_here' with the dynamic ID you want to use
    const button_tutup = document.getElementsByClassName("btn-tutup-lowongan");
    const button_aktifkan_kembali = document.getElementsByClassName("btn-aktifkan-kembali");

    for (let index = 0; index < button_tutup.length; index++) {
        const tutup_value = button_tutup[index].value;
        getID(tutup_value);
    }

    for (let index = 0; index < button_aktifkan_kembali.length; index++) {
        const tutup_value = button_aktifkan_kembali[index].value;
        getID(tutup_value);
    }



});

function getID(id) {
    // Use the 'id' parameter to create the dynamic button ID
    var button = document.getElementById('tutup-lowongan-' + id);

    if (button) {
        button.addEventListener('click', function() {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function() {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';


            }, 2500);
        });
    }

    var button = document.getElementById('simpan-aktifkan-kembali-' + id);

    if (button) {
        button.addEventListener('click', function() {
            const loader = document.getElementById('loader');

            // Display the loader
            loader.style.display = 'flex';

            // Simulate a form submission delay (replace with your actual form submission logic)
            setTimeout(function() {
                // Hide the loader when the form submission is complete
                loader.style.display = 'none';


            }, 2500);
        });
    }
}

document.getElementById('kelola-kandidat').addEventListener('click', function () {
    const loader = document.getElementById('loader');

    // Display the loader
    loader.style.display = 'flex';

    // Simulate a form submission delay (replace with your actual form submission logic)
    setTimeout(function () {
        // Hide the loader when the form submission is complete
        loader.style.display = 'none';

    }, 2500); // Simulate a 2-second delay; replace with actual form submission time
});


